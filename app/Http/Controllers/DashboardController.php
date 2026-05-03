<?php

namespace App\Http\Controllers;

use App\Models\Emotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Has user already logged mood today?
        $todayEmotion = $user->todayEmotion();

        // Mini mood trend: last 7 days for the sparkline chart
        $moodTrend = $user->emotions()
            ->lastDays(7)
            ->orderBy('created_at')
            ->get(['mood', 'score', 'created_at'])
            ->map(fn ($e) => [
                'date'  => $e->created_at->format('D'),
                'score' => $e->score,
                'emoji' => $e->mood_emoji,
                'mood'  => $e->mood_label,
            ]);

        // Journal consistency: distinct days with an entry this month
        $journalDaysThisMonth = $user->journals()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->selectRaw('DATE(created_at) as date')
            ->distinct()
            ->count();

        // Daily prompt rotates by day-of-year
        $dailyPrompt = $this->getDailyPrompt();

        // Available moods for the modal
        $moods = Emotion::MOODS;

        return view('dashboard', compact(
            'user',
            'todayEmotion',
            'moodTrend',
            'journalDaysThisMonth',
            'dailyPrompt',
            'moods',
        ));
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
