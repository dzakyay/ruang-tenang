<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emotion;
use App\Models\Encyclopedia;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Top viewed feelings — based on encyclopedia entry count (placeholder logic)
        // In real app you'd track page views; here we use encyclopedia entries as proxy
        $topFeelings = Encyclopedia::withCount([])
            ->orderBy('feeling')
            ->take(120)
            ->get(['id', 'feeling', 'category']);

        // Weekly mood trend: average score per day for last 30 days
        $moodTrend = Emotion::query()
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw("DATE(created_at) as date, ROUND(AVG(score), 2) as avg_score")
            ->groupByRaw("DATE(created_at)")
            ->orderBy('date')
            ->get()
            ->map(fn ($row) => [
                'date'      => \Carbon\Carbon::parse($row->date)->translatedFormat('d M'),
                'avg_score' => (float) $row->avg_score,
            ]);

        // Summary stats
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalEmotions     = Emotion::count();
        $totalEncyclopedia = Encyclopedia::count();

        return view('admin.dashboard', compact(
            'topFeelings',
            'moodTrend',
            'totalUsers',
            'totalEmotions',
            'totalEncyclopedia',
        ));
    }
}
