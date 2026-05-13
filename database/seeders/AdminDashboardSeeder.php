<?php

namespace Database\Seeders;

use App\Models\Emotion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminDashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada setidaknya satu user untuk dikaitkan dengan emosi
        $user = User::first();
        
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@ruangtenang.test',
                'password' => bcrypt('password'),
            ]);
        }

        $moods = ['Senang', 'Biasa', 'Sedih', 'Marah', 'Cemas'];

        // Buat data emosi dummy untuk 30 hari terakhir
        for ($i = 30; $i >= 0; $i--) {
            // Randomize berapa banyak entri per hari (0 sampai 3)
            $entriesToday = rand(1, 3);
            
            for ($j = 0; $j < $entriesToday; $j++) {
                // Score berfluktuasi antara 1 sampai 5
                // Kita buat sedikit pattern agar chart terlihat menarik
                $baseScore = sin($i / 3) * 1.5 + 3; // Gelombang dasar
                $score = min(5, max(1, round($baseScore + (rand(-10, 10) / 10))));

                Emotion::create([
                    'user_id' => $user->id,
                    'mood' => $moods[array_rand($moods)],
                    'score' => $score,
                    'note' => 'Dummy data seeder',
                    'created_at' => Carbon::now()->subDays($i)->addHours(rand(8, 20)),
                    'updated_at' => Carbon::now()->subDays($i)->addHours(rand(8, 20)),
                ]);
            }
        }
    }
}
