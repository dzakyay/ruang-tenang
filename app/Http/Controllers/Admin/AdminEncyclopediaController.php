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
            'tips.*.description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('encyclopedia/banners', 'public');
        }

        // 1. Buat Encyclopedia-nya dulu
        $encyclopedia = Encyclopedia::create($validated);

        // 2. Insert relasi tips ke tabel EncyclopediaTip
        if (!empty($validated['tips'])) {
            $encyclopedia->tips()->createMany($validated['tips']);
        }

        return redirect()->route('admin.encyclopedia.index')
            ->with('success', 'Entri emosi berhasil ditambahkan.');
    }

    public function show(Encyclopedia $encyclopedia)
    {
        // Wajib me-load relasi tips supaya tampil di halaman show
        $encyclopedia->load('tips');
        return view('admin.encyclopedia.show', compact('encyclopedia'));
    }

    public function edit(Encyclopedia $encyclopedia)
    {
        // Wajib me-load relasi tips supaya dibaca oleh Alpine.js di halaman edit
        $encyclopedia->load('tips');
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
            'tips.*.description' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('banner')) {
            if ($encyclopedia->banner && !str_starts_with($encyclopedia->banner, 'http')) {
                Storage::disk('public')->delete($encyclopedia->banner);
            }
            $validated['banner'] = $request->file('banner')->store('encyclopedia/banners', 'public');
        }

        // 1. Update Encyclopedia utama
        $encyclopedia->update($validated);

        // 2. Update tips: Cara paling aman untuk dynamic input adalah hapus yang lama, lalu insert yang baru
        $encyclopedia->tips()->delete();
        if (!empty($validated['tips'])) {
            $encyclopedia->tips()->createMany($validated['tips']);
        }

        return redirect()->route('admin.encyclopedia.index')
            ->with('success', 'Entri emosi berhasil diperbarui.');
    }

    public function destroy(Encyclopedia $encyclopedia)
    {
        if ($encyclopedia->banner && !str_starts_with($encyclopedia->banner, 'http')) {
            Storage::disk('public')->delete($encyclopedia->banner);
        }

        // Hapus child/relasinya dulu sebelum menghapus parent
        $encyclopedia->tips()->delete();
        $encyclopedia->delete();

        return redirect()->route('admin.encyclopedia.index')
            ->with('success', 'Entri emosi berhasil dihapus.');
    }
}
