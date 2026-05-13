<?php

namespace App\Http\Controllers;

use App\Models\Encyclopedia;
use Illuminate\Http\Request;

class EncyclopediaController extends Controller
{
    /**
     * Feelings Library: grid of emotion cards.
     */
    public function index(Request $request)
    {
        $search   = $request->query('search');
        $category = $request->query('category', 'semua');

        $entries = Encyclopedia::search($search)
            ->category($category)
            ->orderBy('feeling')
            ->paginate(9)
            ->withQueryString();

        return view('encyclopedia.index', compact('entries', 'search', 'category'));
    }

    /**
     * Validation Card Detail page.
     */
    public function show(Encyclopedia $encyclopedia)
    {
        $encyclopedia->load('tips');
        return view('encyclopedia.show', compact('encyclopedia'));
    }
}
