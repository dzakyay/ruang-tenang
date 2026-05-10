<?php

namespace Database\Seeders;

use App\Models\Encyclopedia;
use Illuminate\Database\Seeder;

class EncyclopediaSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate first to avoid duplicate on re-seed
        Encyclopedia::truncate();

        $entries = [
            [
                'feeling'     => 'Burnout (Kelelahan Mental)',
                'category'    => 'Sulit',
                'description' => 'Perasaan ketika sumber daya batinmu terasa terkuras habis. Ini adalah sinyal dari tubuh untuk berhenti sejenak dan memulihkan energi.',
                'banner'      => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Berhenti sejenak bukan berarti menyerah. Itu berarti kamu cukup bijak untuk mengisi ulang energimu.',
                'content'     => '<p>Burnout adalah kondisi kelelahan fisik, emosional, dan mental yang disebabkan oleh stres kronis yang berkepanjangan. Ini lebih dari sekadar lelah biasa — ini adalah sinyal serius bahwa tubuh dan pikiranmu membutuhkan perhatian khusus.</p><p>Tanda-tanda burnout meliputi rasa kelelahan yang tidak hilang meski sudah beristirahat, kehilangan motivasi, sulit berkonsentrasi, dan merasa sinisme terhadap pekerjaan atau aktivitas yang biasanya kamu sukai.</p>',
                'tips'        => json_encode([
                    ['title' => 'Istirahat Terstruktur', 'body' => 'Jadwalkan waktu istirahat nyata — bukan hanya tidur, tapi aktivitas yang benar-benar mengisi ulang energimu seperti berjalan di alam, membaca, atau meditasi.'],
                    ['title' => 'Tetapkan Batas', 'body' => 'Belajar berkata tidak. Mengenali batas kemampuanmu adalah tanda kekuatan, bukan kelemahan.'],
                    ['title' => 'Jurnal Perasaan', 'body' => 'Tuliskan apa yang kamu rasakan setiap hari. Mengeksternalisasi emosi membantu kamu memahami pola stresmu.'],
                ]),
            ],
            [
                'feeling'     => 'Kecemasan',
                'category'    => 'Sulit',
                'description' => 'Rasa tidak tenang akan masa depan yang belum terjadi. Kecemasan mengajak kita untuk kembali berlabuh pada nafas dan saat ini.',
                'banner'      => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Tidak apa-apa merasa cemas. Perasaanmu valid, dan kamu tidak sendirian.',
                'content'     => '<p>Kecemasan adalah emosi alami yang dialami setiap manusia. Ia hadir sebagai respons tubuh terhadap situasi yang dianggap mengancam. Menyadari bahwa kecemasan adalah sebuah sinyal — bukan musuh — adalah langkah pertama menuju ketenangan.</p>',
                'tips'        => json_encode([
                    ['title' => 'Teknik Pernapasan 4-7-8', 'body' => 'Tarik napas 4 detik, tahan 7 detik, buang perlahan 8 detik. Ulangi 4 kali.'],
                    ['title' => 'Grounding 5-4-3-2-1', 'body' => 'Sebutkan 5 benda yang kamu lihat, 4 yang bisa disentuh, 3 suara, 2 bau, dan 1 rasa.'],
                    ['title' => 'Tuliskan Pikiranmu', 'body' => 'Gunakan fitur Jurnal untuk menuangkan apa yang mengganjal di hati.'],
                ]),
            ],
            [
                'feeling'     => 'Kebahagiaan',
                'category'    => 'Positif',
                'description' => 'Percikan cahaya dalam keseharian. Kebahagiaan bukan hanya tujuan, melainkan cara kita menghargai momen-momen kecil yang bermakna.',
                'banner'      => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Kebahagiaan bukan tentang kesempurnaan, melainkan menemukan keindahan dalam ketidaksempurnaan.',
                'content'     => '<p>Kebahagiaan adalah kondisi emosional positif yang ditandai dengan perasaan senang, puas, dan bermakna. Penelitian menunjukkan bahwa kebahagiaan sejati datang dari koneksi dengan orang lain, rasa syukur, dan menjalani kehidupan sesuai nilai-nilai terdalam kita.</p>',
                'tips'        => json_encode([
                    ['title' => 'Jurnal Syukur', 'body' => 'Tuliskan 3 hal yang kamu syukuri setiap hari untuk melatih otak fokus pada hal positif.'],
                    ['title' => 'Rayakan Hal Kecil', 'body' => 'Akui setiap pencapaian kecil. Otak melepaskan dopamin setiap kali kita menyelesaikan sesuatu.'],
                    ['title' => 'Habiskan Waktu di Alam', 'body' => '20 menit di alam terbukti secara ilmiah dapat meningkatkan mood secara signifikan.'],
                ]),
            ],
            [
                'feeling'     => 'Kesepian',
                'category'    => 'Sulit',
                'description' => 'Kerinduan akan koneksi dan pemahaman. Kesepian adalah ruang sunyi yang mengundangmu untuk berteman dengan diri sendiri terlebih dahulu.',
                'banner'      => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Kesepian bukan tentang seberapa banyak orang di sekitarmu, tapi seberapa dalam kamu terhubung dengan dirimu sendiri.',
                'content'     => '<p>Kesepian adalah pengalaman subjektif di mana seseorang merasa terputus dari orang lain. Ini bukan hanya tentang sendirian secara fisik, tapi tentang merasa tidak dipahami atau tidak terhubung secara emosional.</p>',
                'tips'        => json_encode([
                    ['title' => 'Mulai dari Diri Sendiri', 'body' => 'Habiskan waktu berkualitas dengan dirimu sendiri. Kenali apa yang kamu sukai dan nilai-nilaimu.'],
                    ['title' => 'Hubungi Seseorang', 'body' => 'Kirim pesan kepada seseorang yang sudah lama tidak kamu hubungi. Koneksi kecil bisa membuat perbedaan besar.'],
                    ['title' => 'Bergabung dengan Komunitas', 'body' => 'Temukan komunitas dengan minat yang sama untuk koneksi yang lebih bermakna.'],
                ]),
            ],
            [
                'feeling'     => 'Ketenangan',
                'category'    => 'Positif',
                'description' => 'Keadaan di mana hati merasa cukup dan damai. Ini adalah tempat di mana badai emosi mereda dan kejernihan pikiran mulai muncul.',
                'banner'      => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Ketenangan bukan berarti tidak ada badai. Artinya menemukan kedamaian di tengah-tengahnya.',
                'content'     => '<p>Ketenangan adalah kondisi mental dan emosional yang ditandai dengan keseimbangan, penerimaan, dan kejernihan pikiran. Ini adalah tujuan banyak praktik meditasi dan mindfulness, dan dapat dilatih meski berada di tengah situasi penuh tekanan.</p>',
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
                'banner'      => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Kesedihan adalah harga dari cinta. Mengizinkan dirimu berduka adalah tanda kekuatan.',
                'content'     => '<p>Kesedihan adalah respons emosional alami terhadap kehilangan atau kekecewaan. Mengizinkan diri untuk bersedih adalah bagian penting dari proses penyembuhan — menekannya justru memperlambat pemulihan.</p>',
                'tips'        => json_encode([
                    ['title' => 'Izinkan Dirimu Bersedih', 'body' => 'Jangan menekan perasaan sedih. Menangis memiliki manfaat terapeutik nyata dan membantu melepaskan ketegangan.'],
                    ['title' => 'Cari Dukungan', 'body' => 'Ceritakan perasaanmu kepada seseorang yang kamu percaya. Kamu tidak harus menanggung kesedihan sendirian.'],
                    ['title' => 'Bergerak Perlahan', 'body' => 'Berjalan kaki ringan atau olahraga lembut membantu memproses emosi dan meningkatkan mood.'],
                ]),
            ],
            [
                'feeling'     => 'Rasa Syukur',
                'category'    => 'Positif',
                'description' => 'Kemampuan menghargai apa yang sudah ada. Rasa syukur adalah jembatan antara apa yang kita miliki dan apa yang kita butuhkan.',
                'banner'      => 'https://images.unsplash.com/photo-1463736932348-4915535cf6f9?q=80&w=1632&auto=format&fit=crop&q=80',
                'quote'       => 'Syukur bukan hanya tentang merasa baik — ini tentang melatih pikiran untuk melihat kebaikan yang sudah ada.',
                'content'     => '<p>Rasa syukur adalah praktik sadar untuk mengakui dan menghargai hal-hal baik dalam hidup. Penelitian psikologi positif menunjukkan bahwa rasa syukur yang dilatih secara rutin dapat meningkatkan kesejahteraan emosional secara signifikan.</p>',
                'tips'        => json_encode([
                    ['title' => 'Jurnal Syukur Harian', 'body' => 'Setiap malam tuliskan 3 hal yang kamu syukuri. Tidak perlu besar — yang kecil pun bermakna.'],
                    ['title' => 'Ucapkan Terima Kasih', 'body' => 'Ekspresikan rasa syukur secara langsung kepada orang-orang yang berarti bagimu.'],
                    ['title' => 'Mindful Moments', 'body' => 'Berhenti sejenak di tengah hari dan perhatikan satu hal sederhana yang indah di sekitarmu.'],
                ]),
            ],
            [
                'feeling'     => 'Marah',
                'category'    => 'Reflektif',
                'description' => 'Sinyal kuat bahwa ada sesuatu yang melanggar nilai atau batasmu. Kemarahan bukan musuh — ia adalah pesan yang perlu didengar.',
                'banner'      => 'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Di balik setiap amarah ada kebutuhan yang belum terpenuhi. Dengarkan pesannya.',
                'content'     => '<p>Kemarahan adalah emosi yang kuat dan seringkali disalahpahami. Alih-alih menekan atau meledakkannya, belajar memahami dan mengelola kemarahan adalah keterampilan emosional yang sangat berharga.</p>',
                'tips'        => json_encode([
                    ['title' => 'Pause Sebelum Bereaksi', 'body' => 'Tarik napas dalam dan hitung sampai 10 sebelum merespons. Ini memberi ruang untuk memilih respons yang bijak.'],
                    ['title' => 'Identifikasi Pemicunya', 'body' => 'Tanyakan pada diri sendiri: apa sebenarnya yang membuatku marah? Seringkali ada kebutuhan yang lebih dalam.'],
                    ['title' => 'Ekspresikan dengan Sehat', 'body' => 'Tulis, olahraga, atau bicarakan perasaanmu — jangan pendam, tapi jangan juga meledak.'],
                ]),
            ],
            [
                'feeling'     => 'Rasa Malu',
                'category'    => 'Sulit',
                'description' => 'Perasaan bahwa ada yang salah dengan dirimu, bukan hanya perilakumu. Rasa malu yang tidak dikelola bisa menghambat pertumbuhan.',
                'banner'      => 'https://images.unsplash.com/photo-1474631245212-32dc3c8310c6?w=800&auto=format&fit=crop&q=80',
                'quote'       => 'Kamu bukan kesalahanmu. Kamu adalah manusia yang sedang belajar.',
                'content'     => '<p>Rasa malu berbeda dengan rasa bersalah. Bersalah berkata "Aku melakukan sesuatu yang buruk", sedangkan malu berkata "Aku adalah sesuatu yang buruk." Memahami perbedaan ini adalah langkah pertama untuk menyembuhkannya.</p>',
                'tips'        => json_encode([
                    ['title' => 'Bedakan Malu dan Bersalah', 'body' => 'Ingat: perilakumu bukan identitasmu. Kamu bisa berubah tanpa harus membenci dirimu sendiri.'],
                    ['title' => 'Bicarakan dengan Orang Terpercaya', 'body' => 'Rasa malu tumbuh dalam kerahasiaan dan mati dalam koneksi. Berbagi mempercepat penyembuhan.'],
                    ['title' => 'Latih Self-Compassion', 'body' => 'Perlakukan dirimu seperti kamu memperlakukan sahabat yang sedang kesulitan — dengan kebaikan, bukan hukuman.'],
                ]),
            ],
        ];

        foreach ($entries as $entry) {
            Encyclopedia::create($entry);
        }

        $this->command->info('Encyclopedia seeded with ' . count($entries) . ' entries.');
    }
}
