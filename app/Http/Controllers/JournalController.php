<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JournalController extends Controller
{
    /**
     * Journal list page.
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $search = $request->query('search');
        $filter = $request->query('filter');

        $query = $user->journals()->search($search)->latest();

        if ($filter === 'this_week') {
            $query->where('created_at', '>=', now()->startOfWeek());
        } elseif ($filter === 'this_month') {
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        }

        $journals    = $query->paginate(9)->withQueryString();
        $dailyPrompt = $this->getDailyPrompt();

        return view('journal.index', compact('journals', 'search', 'dailyPrompt'));
    }

    /**
     * New journal form.
     */
    public function create()
    {
        $dailyPrompt = $this->getDailyPrompt();

        return view('journal.create', compact('dailyPrompt'));
    }

    /**
     * Store a new journal entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'content'     => ['nullable', 'string'],
            'banner'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'media'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('journals/banners', 'public');
        }

        if ($request->hasFile('media')) {
            $validated['media'] = $request->file('media')->store('journals/media', 'public');
        }

        /** @var \App\Models\User $user */
        $user    = Auth::user();
        $journal = $user->journals()->create($validated);

        return redirect()->route('journal.show', $journal)
            ->with('success', 'Jurnal berhasil disimpan!');
    }

    /**
     * Show one journal entry.
     */
    public function show(Journal $journal)
    {
        $this->authorizeJournal($journal);

        return view('journal.show', compact('journal'));
    }

    /**
     * Edit form.
     */
    public function edit(Journal $journal)
    {
        $this->authorizeJournal($journal);

        return view('journal.edit', compact('journal'));
    }

    /**
     * Update existing journal.
     */
    public function update(Request $request, Journal $journal)
    {
        $this->authorizeJournal($journal);

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'content'     => ['nullable', 'string'],
            'banner'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'media'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        if ($request->hasFile('banner')) {
            if ($journal->banner && !str_starts_with($journal->banner, 'http')) {
                Storage::disk('public')->delete($journal->banner);
            }
            $validated['banner'] = $request->file('banner')->store('journals/banners', 'public');
        }

        if ($request->hasFile('media')) {
            if ($journal->media && !str_starts_with($journal->media, 'http')) {
                Storage::disk('public')->delete($journal->media);
            }
            $validated['media'] = $request->file('media')->store('journals/media', 'public');
        }

        $journal->update($validated);

        return redirect()->route('journal.show', $journal)
            ->with('success', 'Jurnal berhasil diperbarui!');
    }

    /**
     * Soft-delete a journal.
     */
    public function destroy(Journal $journal)
    {
        $this->authorizeJournal($journal);

        $journal->delete();

        return redirect()->route('journal.index')
            ->with('success', 'Jurnal berhasil dihapus.');
    }

    /**
     * Upload inline image from Tiptap editor.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // Max 5MB
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('journals/images', 'public');
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Gagal mengunggah gambar.'], 400);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function authorizeJournal(Journal $journal): void
    {
        abort_if($journal->user_id !== Auth::id(), 403, 'Kamu tidak memiliki akses ke jurnal ini.');
    }

    private function getDailyPrompt(): string
    {
        $prompts = [
            'Apa yang membuatmu bersyukur hari ini?',
            'Satu hal kecil yang ingin kamu capai hari ini?',
            'Bagaimana perasaanmu setelah bangun tidur pagi ini?',
            'Apa yang ingin kamu lepaskan dari kemarin?',
            'Siapa yang ingin kamu berikan apresiasi hari ini?',
            'Ceritakan satu momen indah yang kamu rasakan baru-baru ini.',
            'Apa yang membuatmu merasa kuat hari ini?',
        ];

        return $prompts[now()->dayOfYear % count($prompts)];
    }
}
