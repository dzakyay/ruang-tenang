<?php

namespace Database\Seeders;

use App\Models\Emotion;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmotionSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $this->command->warn('Tidak ada user. Buat user dulu.');
            return;
        }

        $pattern = [
            'senang', 'senang', 'biasa', 'sedih', 'biasa',
            'semangat', 'sangat', 'senang', 'biasa', 'senang',
            'sedih', 'biasa', 'senang', 'semangat', 'sangat',
            'senang', 'biasa', 'sedih', 'biasa', 'senang',
            'semangat', 'senang', 'sangat', 'biasa', 'senang',
            'sedih', 'biasa', 'semangat', 'sangat', 'senang',
        ];

        $notes = [
            'Hari yang menyenangkan!', 'Biasa saja.',
            'Agak lelah hari ini.', 'Bersemangat memulai hari baru!',
            'Merasa damai dan tenang.', null, null,
        ];

        $this->command->info("Membuat data mood 30 hari untuk: {$user->name}");

        // Hapus data lama
        DB::table('emotions')->where('user_id', $user->id)->delete();

        $rows = [];
        for ($i = 29; $i >= 0; $i--) {
            $date     = now()->subDays($i)->setTime(rand(7, 21), rand(0, 59), 0);
            $moodKey  = $pattern[$i];
            $moodData = Emotion::MOODS[$moodKey];

            $rows[] = [
                'user_id'    => $user->id,
                'mood'       => $moodKey,
                'score'      => $moodData['score'],
                'note'       => $notes[array_rand($notes)],
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        DB::table('emotions')->insert($rows);
        $this->command->info('✓ Berhasil membuat 30 entri mood.');
    }
}
