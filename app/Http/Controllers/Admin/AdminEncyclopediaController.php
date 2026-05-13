<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Encyclopedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEncyclopediaController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->query('search');
        $category = $request->query('category');

        $entries = Encyclopedia::query()
            ->when($search, fn ($q) => $q->where('feeling', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%"))
            ->when($category && $category !== 'semua', fn ($q) => $q->where('category', $category))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.encyclopedia.index', compact('entries', 'search', 'category'));
    }

    public function create()
    {
        return view('admin.encyclopedia.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'feeling'     => ['required', 'string', 'max:255'],
            'category'    => ['required', 'in:Positif,Sulit,Reflektif'],
            'description' => ['required', 'string'],
            'quote'       => ['nullable', 'string', 'max:500'],
            'content'     => ['nullable', 'string'],
            'banner'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'tips'        => ['nullable', 'array'],
            'tips.*.title'=> ['required_with:tips', 'string', 'max:255'],
            'tips.*.body' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('encyclopedia/banners', 'public');
        }

        // Encode tips as JSON
        if (!empty($validated['tips'])) {
            $validated['tips'] = json_encode(array_values($validated['tips']));
        }

        Encyclopedia::create($validated);

        return redirect()->route('admin.encyclopedia.index')
            ->with('success', 'Entri emosi berhasil ditambahkan.');
    }

    public function show(Encyclopedia $encyclopedia)
    {
        return view('admin.encyclopedia.show', compact('encyclopedia'));
    }

    public function edit(Encyclopedia $encyclopedia)
    {
        return view('admin.encyclopedia.edit', compact('encyclopedia'));
    }

    public function update(Request $request, Encyclopedia $encyclopedia)
    {
        $validated = $request->validate([
            'feeling'     => ['required', 'string', 'max:255'],
            'category'    => ['required', 'in:Positif,Sulit,Reflektif'],
            'description' => ['required', 'string'],
            'quote'       => ['nullable', 'string', 'max:500'],
            'content'     => ['nullable', 'string'],
            'banner'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'tips'        => ['nullable', 'array'],
            'tips.*.title'=> ['required_with:tips', 'string', 'max:255'],
            'tips.*.body' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('banner')) {
            // Delete old banner if stored locally
            if ($encyclopedia->banner && !str_starts_with($encyclopedia->banner, 'http')) {
                Storage::disk('public')->delete($encyclopedia->banner);
            }
            $validated['banner'] = $request->file('banner')->store('encyclopedia/banners', 'public');
        }

        if (!empty($validated['tips'])) {
            $validated['tips'] = json_encode(array_values($validated['tips']));
        }

        $encyclopedia->update($validated);

        return redirect()->route('admin.encyclopedia.index')
            ->with('success', 'Entri emosi berhasil diperbarui.');
    }

    public function destroy(Encyclopedia $encyclopedia)
    {
        if ($encyclopedia->banner && !str_starts_with($encyclopedia->banner, 'http')) {
            Storage::disk('public')->delete($encyclopedia->banner);
        }

        $encyclopedia->delete();

        return redirect()->route('admin.encyclopedia.index')
            ->with('success', 'Entri emosi berhasil dihapus.');
    }
}
