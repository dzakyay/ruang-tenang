<?php

namespace App\Http\Controllers;

use App\Models\Emotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmotionController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

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

        // Current month emotions for calendar (keyed by day)
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

        // Average score this month
        $avgScore     = (float) $user->emotions()->thisMonth()->avg('score');
        $avgMoodLabel = $this->scoreToLabel($avgScore);

        // Happiest day this month = highest score, tie-break by latest
        $happiestEmotion = $user->emotions()
            ->thisMonth()
            ->orderByDesc('score')
            ->orderByDesc('created_at')
            ->first();

        $todayEmotion = $user->todayEmotion();
        $moods        = Emotion::MOODS;

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
                'emotion' => array_merge($emotion->toArray(), [
                    'color' => $emotion->mood_color,
                    'emoji' => $emotion->mood_emoji,
                    'label' => $emotion->mood_label,
                ]),
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Perasaanmu telah disimpan!');
    }

    /**
     * JSON for Chart.js (?days=7|30)
     * JSON for calendar (?type=calendar&month=M&year=Y)
     */
    public function chartData(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Calendar mode: return day-keyed emotion map for a given month/year
        if ($request->query('type') === 'calendar') {
            $month = (int) $request->query('month', now()->month);
            $year  = (int) $request->query('year',  now()->year);

            $data = $user->emotions()
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->orderBy('created_at')
                ->get()
                ->groupBy(fn ($e) => $e->created_at->day)
                ->map(fn ($group) => [
                    'mood'  => $group->last()->mood,
                    'color' => $group->last()->mood_color,
                    'emoji' => $group->last()->mood_emoji,
                ]);

            return response()->json($data);
        }

        // Trend chart mode
        $days = (int) $request->query('days', 7);
        $days = in_array($days, [7, 30]) ? $days : 7;

        $data = $user->emotions()
            ->lastDays($days)
            ->orderBy('created_at')
            ->get(['mood', 'score', 'created_at'])
            ->map(fn ($e) => [
                'date'  => $e->created_at->format('D, d M'),
                'score' => $e->score,
                'mood'  => $e->mood_label,
                'emoji' => $e->mood_emoji,
                'color' => $e->mood_color,
            ]);

        return response()->json($data);
    }

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