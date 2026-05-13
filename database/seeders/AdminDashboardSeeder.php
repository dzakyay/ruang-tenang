<?php

namespace Database\Seeders;

use App\Models\Emotion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminDashboardSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create([
                'name'     => 'Admin User',
                'email'    => 'admin@ruangtenang.test',
                'password' => bcrypt('password'),
                'role'     => 'admin',
            ]);
        }

        // Gunakan key yang valid dari Emotion::MOODS
        $moodKeys = array_keys(Emotion::MOODS); // ['sedih','biasa','senang','sangat','semangat']

        for ($i = 30; $i >= 0; $i--) {
            $entriesToday = rand(1, 3);

            for ($j = 0; $j < $entriesToday; $j++) {
                $baseScore = sin($i / 3) * 1.5 + 3;
                $score     = (int) min(5, max(1, round($baseScore + (rand(-10, 10) / 10))));

                // Pilih mood key yang score-nya cocok dengan score yang di-generate
                // agar mood dan score konsisten
                $mood = match ($score) {
                    1       => 'sedih',
                    2       => 'biasa',
                    3       => 'senang',
                    4       => 'sangat',
                    5       => 'semangat',
                    default => 'biasa',
                };

                $timestamp = Carbon::now()->subDays($i)->addHours(rand(8, 20));

                Emotion::create([
                    'user_id'    => $user->id,
                    'mood'       => $mood,
                    'score'      => $score,
                    'note'       => 'Dummy data seeder',
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }
        }

        $this->command->info('AdminDashboardSeeder: ' . (31 * 2) . '± dummy emotions created.');
    }
}
