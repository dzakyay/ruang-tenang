<?php

namespace Database\Seeders;

use App\Models\Encyclopedia;
use Illuminate\Database\Seeder;

class EncyclopediaSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            [
                'feeling'     => 'Burnout (Kelelahan Mental)',
                'category'    => 'Sulit',
                'description' => 'Perasaan ketika sumber daya batinmu terasa terkuras habis. Ini adalah sinyal dari tubuh untuk berhenti sejenak dan memulihkan energi.',
                'banner'      => 'https://images.unsplash.com/photo-1542644917-768a415a995e?auto=format&fit=crop&w=800&q=80',
                'quote'       => 'Berhenti sejenak bukan berarti menyerah. Itu berarti kamu cukup bijak untuk mengisi ulang energimu.',
                'content'     => 'Burnout adalah kondisi kelelahan fisik, emosional, dan mental yang disebabkan oleh stres kronis yang berkepanjangan, terutama di tempat kerja atau dalam situasi di mana kamu merasa kewalahan dan tidak dihargai. Ini lebih dari sekadar lelah biasa.',
                'tips'        => json_encode([
                    ['title' => 'Istirahat Terstruktur', 'body' => 'Jadwalkan waktu istirahat yang nyata, bukan hanya tidur, tapi aktivitas yang benar-benar mengisi ulang energimu.'],
                    ['title' => 'Tetapkan Batas', 'body' => 'Belajar untuk berkata tidak. Mengenali batas kemampuanmu adalah tanda kekuatan, bukan kelemahan.'],
                    ['title' => 'Jurnal Perasaan', 'body' => 'Tuliskan apa yang kamu rasakan. Mengeksternalisasi emosi dapat membantu kamu memahami pola stresmu.'],
                ]),
            ],
            [
                'feeling'     => 'Kecemasan',
                'category'    => 'Sulit',
                'description' => 'Rasa tidak tenang akan masa depan yang belum terjadi. Kecemasan mengajak kita untuk kembali berlabuh pada nafas dan saat ini.',
                'banner'      => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&w=800&q=80',
                'quote'       => 'Tidak apa-apa merasa cemas. Perasaanmu valid, dan kamu tidak sendirian. Kecemasan adalah cara tubuhmu mencoba melindungimu.',
                'content'     => 'Kecemasan adalah emosi alami yang dialami oleh setiap manusia. Ia hadir sebagai respons tubuh terhadap situasi yang dianggap mengancam atau penuh tekanan. Menyadari bahwa kecemasan adalah sebuah sinyal, bukan musuh, adalah langkah pertama menuju ketenangan.',
                'tips'        => json_encode([
                    ['title' => 'Teknik Pernapasan 4-7-8', 'body' => 'Tarik napas dalam 4 detik, tahan 7 detik, buang perlahan 8 detik. Ulangi 4 kali.'],
                    ['title' => 'Grounding 5-4-3-2-1', 'body' => 'Sebutkan 5 benda yang kamu lihat, 4 yang bisa kamu sentuh, 3 suara, 2 bau, dan 1 rasa.'],
                    ['title' => 'Tuliskan Pikiranmu', 'body' => 'Gunakan fitur Jurnal di RuangTenang untuk menuangkan apa yang mengganjal di hati.'],
                ]),
            ],
            [
                'feeling'     => 'Kebahagiaan',
                'category'    => 'Positif',
                'description' => 'Percikan cahaya dalam keseharian. Kebahagiaan bukan hanya tujuan, melainkan cara kita menghargai momen-momen kecil yang bermakna.',
                'banner'      => 'https://images.unsplash.com/photo-1490750967868-88cb4eca8929?auto=format&fit=crop&w=800&q=80',
                'quote'       => 'Kebahagiaan bukan tentang kesempurnaan, melainkan menemukan keindahan dalam ketidaksempurnaan setiap harinya.',
                'content'     => 'Kebahagiaan adalah kondisi emosional positif yang ditandai dengan perasaan senang, puas, dan bermakna. Penelitian menunjukkan bahwa kebahagiaan sejati datang dari koneksi dengan orang lain, rasa syukur, dan menjalani kehidupan sesuai nilai-nilai terdalam kita.',
                'tips'        => json_encode([
                    ['title' => 'Jurnal Syukur', 'body' => 'Tuliskan 3 hal yang kamu syukuri setiap hari. Otak kita cenderung fokus pada hal negatif, jadi kita perlu melatihnya.'],
                    ['title' => 'Rayakan Hal Kecil', 'body' => 'Akui setiap pencapaian kecil. Otak melepaskan dopamin setiap kali kita menyelesaikan sesuatu.'],
                    ['title' => 'Habiskan Waktu di Alam', 'body' => 'Penelitian menunjukkan bahwa 20 menit di alam dapat meningkatkan mood secara signifikan.'],
                ]),
            ],
            [
                'feeling'     => 'Kesepian',
                'category'    => 'Sulit',
                'description' => 'Kerinduan akan koneksi dan pemahaman. Kesepian adalah ruang sunyi yang mengundangmu untuk berteman dengan diri sendiri terlebih dahulu.',
                'banner'      => 'https://images.unsplash.com/photo-1542223189-67a03fa0f0bd?auto=format&fit=crop&w=800&q=80',
                'quote'       => 'Kesepian bukan tentang seberapa banyak orang di sekitarmu, tapi seberapa dalam kamu terhubung dengan dirimu sendiri.',
                'content'     => 'Kesepian adalah pengalaman subjektif di mana seseorang merasa terputus dari orang lain atau komunitas. Ini bukan hanya tentang sendirian secara fisik, tapi tentang merasa tidak dipahami atau tidak terhubung secara emosional.',
                'tips'        => json_encode([
                    ['title' => 'Mulai dari Diri Sendiri', 'body' => 'Habiskan waktu berkualitas dengan dirimu sendiri. Kenali apa yang kamu sukai, nilai-nilaimu, impianmu.'],
                    ['title' => 'Hubungi Seseorang', 'body' => 'Kirim pesan kepada seseorang yang sudah lama tidak kamu hubungi. Koneksi kecil bisa membuat perbedaan besar.'],
                    ['title' => 'Bergabung dengan Komunitas', 'body' => 'Temukan komunitas dengan minat yang sama. Koneksi berbasis nilai dan minat seringkali lebih bermakna.'],
                ]),
            ],
            [
                'feeling'     => 'Ketenangan',
                'category'    => 'Positif',
                'description' => 'Keadaan di mana hati merasa cukup dan damai. Ini adalah tempat di mana badai emosi mereda dan kejernihan pikiran mulai muncul.',
                'banner'      => 'https://images.unsplash.com/photo-1518837695005-2083093ee35b?auto=format&fit=crop&w=800&q=80',
                'quote'       => 'Ketenangan bukan berarti tidak ada badai. Artinya menemukan kedamaian di tengah-tengahnya.',
                'content'     => 'Ketenangan adalah kondisi mental dan emosional yang ditandai dengan keseimbangan, penerimaan, dan kejernihan pikiran. Ini adalah tujuan banyak praktik meditasi dan mindfulness, dan dapat dilatih meski kita berada di tengah situasi yang penuh tekanan.',
                'tips'        => json_encode([
                    ['title' => 'Meditasi Mindfulness', 'body' => 'Mulai dengan 5 menit sehari. Fokus pada napas, amati pikiran tanpa menghakiminya.'],
                    ['title' => 'Kurangi Stimulasi Berlebih', 'body' => 'Batasi waktu layar, terutama sebelum tidur. Otak butuh waktu untuk memproses dan tenang.'],
                    ['title' => 'Praktik Penerimaan', 'body' => 'Belajar menerima hal-hal yang tidak bisa kamu kontrol. Fokus hanya pada apa yang ada dalam kendalimu.'],
                ]),
            ],
            [
                'feeling'     => 'Kesedihan',
                'category'    => 'Reflektif',
                'description' => 'Emosi yang membantu kita melepaskan apa yang telah pergi. Kesedihan adalah proses penyembuhan alami yang melunakkan kekakuan hati.',
                'banner'      => 'https://images.unsplash.com/photo-1515694346937-94d85e41e6f0?auto=format&fit=crop&w=800&q=80',
                'quote'       => 'Kesedihan adalah harga dari cinta. Memungkinkan dirimu untuk berduka adalah tanda kekuatan, bukan kelemahan.',
                'content'     => 'Kesedihan adalah respons emosional alami terhadap kehilangan atau kekecewaan. Ia hadir untuk membantu kita memproses pengalaman menyakitkan dan akhirnya melepaskannya. Mengizinkan diri untuk bersedih adalah bagian penting dari proses penyembuhan.',
                'tips'        => json_encode([
                    ['title' => 'Izinkan Dirimu Bersedih', 'body' => 'Jangan menekan perasaan sedih. Menangis memiliki manfaat terapeutik nyata dan membantu melepaskan ketegangan.'],
                    ['title' => 'Cari Dukungan', 'body' => 'Ceritakan perasaanmu kepada seseorang yang kamu percaya. Kamu tidak harus menanggung kesedihan sendirian.'],
                    ['title' => 'Bergerak Perlahan', 'body' => 'Berjalan kaki ringan atau olahraga lembut dapat membantu memproses emosi dan meningkatkan mood.'],
                ]),
            ],
        ];

        foreach ($entries as $entry) {
            $tips = json_decode($entry['tips'], true);
            unset($entry['tips']);

            $encyclopedia = Encyclopedia::firstOrCreate(
                ['feeling' => $entry['feeling']],
                $entry
            );

            // Create tips for this encyclopedia if they don't exist yet
            if ($encyclopedia->wasRecentlyCreated || $encyclopedia->tips()->count() === 0) {
                foreach ($tips as $tip) {
                    $encyclopedia->tips()->create([
                        'title' => $tip['title'],
                        'description' => $tip['description'],
                        'icon' => $tip['icon'] ?? null,
                    ]);
                }
            }
        }
    }
}
