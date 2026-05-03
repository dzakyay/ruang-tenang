<?php

namespace App\Http\Controllers;

use App\Models\Emotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmotionController extends Controller
{
    /**
     * Mood Tracker: analytics & calendar page.
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Last 7 days trend for the line chart
        $trendData = $user->emotions()
            ->lastDays(7)
            ->orderBy('created_at')
            ->get()
            ->map(fn ($e) => [
                'date'  => $e->created_at->format('D, d M'),
                'score' => $e->score,
                'mood'  => $e->mood_label,
                'emoji' => $e->mood_emoji,
                'color' => $e->mood_color,
            ]);

        // This month's emotions grouped by day number (for calendar dots)
        $monthEmotions = $user->emotions()
            ->thisMonth()
            ->orderBy('created_at')
            ->get()
            ->groupBy(fn ($e) => $e->created_at->day)
            ->map(fn ($group) => [
                'mood'  => $group->last()->mood,
                'color' => $group->last()->mood_color,
                'emoji' => $group->last()->mood_emoji,
            ]);

        // Average score this month → human-readable label
        $avgScore     = (float) $user->emotions()->thisMonth()->avg('score');
        $avgMoodLabel = $this->scoreToLabel($avgScore);

        // Happiest day this month
        $happiestEmotion = $user->emotions()
            ->thisMonth()
            ->orderByDesc('score')
            ->first();

        // Show/hide mood input modal
        $todayEmotion = $user->todayEmotion();

        // All mood options for the form
        $moods = Emotion::MOODS;

        return view('mood', compact(
            'trendData',
            'monthEmotions',
            'avgMoodLabel',
            'avgScore',
            'happiestEmotion',
            'todayEmotion',
            'moods',
        ));
    }

    /**
     * Store a new emotion entry (supports both regular POST and AJAX).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mood'  => ['required', 'in:' . implode(',', array_keys(Emotion::MOODS))],
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'note'  => ['nullable', 'string', 'max:500'],
        ]);

        /** @var \App\Models\User $user */
        $user    = Auth::user();
        $emotion = $user->emotions()->create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Perasaanmu telah disimpan.',
                'emotion' => $emotion,
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Perasaanmu telah disimpan. Semoga harimu menyenangkan!');
    }

    /**
     * JSON endpoint for Chart.js — accepts ?days=7 or ?days=30.
     */
    public function chartData(Request $request)
    {
        $days = (int) $request->query('days', 7);
        $days = in_array($days, [7, 30]) ? $days : 7;

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = $user->emotions()
            ->lastDays($days)
            ->orderBy('created_at')
            ->get(['mood', 'score', 'created_at'])
            ->map(fn ($e) => [
                'label' => $e->created_at->format('d M'),
                'score' => $e->score,
                'mood'  => $e->mood_label,
                'emoji' => $e->mood_emoji,
                'color' => $e->mood_color,
            ]);

        return response()->json($data);
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function scoreToLabel(float $score): string
    {
        return match (true) {
            $score >= 4.5 => 'Semangat & Penuh Energi',
            $score >= 3.5 => 'Bahagia & Bersemangat',
            $score >= 2.5 => 'Tenang & Damai',
            $score >= 1.5 => 'Kurang Bersemangat',
            default       => 'Perlu Perhatian Lebih',
        };
    }
}
