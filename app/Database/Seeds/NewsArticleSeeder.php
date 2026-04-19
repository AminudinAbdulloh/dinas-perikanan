<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use App\Models\NewsArticleModel;
use CodeIgniter\Database\Seeder;

class NewsArticleSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->db->tableExists('news_articles') === false) {
            return;
        }

        if ((int) $this->db->table('news_articles')->countAll() > 0) {
            return;
        }

        $model = model(NewsArticleModel::class);

        $rows = [
            [
                'title'        => 'Penyerahan Bantuan Alat Tangkap kepada 200 Nelayan',
                'excerpt'      => 'Gubernur Papua Tengah menyerahkan bantuan alat tangkap modern kepada nelayan di Kabupaten Nabire.',
                'image'        => 'https://images.unsplash.com/photo-1660278988532-d55143363abb?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'author'       => 'Admin Dinas',
                'views'        => 0,
                'content'      => '<p>Nabire - Gubernur Papua Tengah menyerahkan bantuan alat tangkap modern kepada 200 nelayan di Kabupaten Nabire pada Jumat, 5 April 2026. Program ini merupakan bagian dari upaya pemerintah provinsi dalam meningkatkan produktivitas dan kesejahteraan nelayan.</p>
<p>Dalam sambutannya, Gubernur menyampaikan bahwa bantuan ini diharapkan dapat membantu nelayan meningkatkan hasil tangkapan mereka. "Alat tangkap modern ini dirancang untuk lebih efisien dan ramah lingkungan," ujar Gubernur.</p>
<h2>Bantuan yang Diberikan</h2>
<p>Bantuan yang diserahkan meliputi:</p>
<ul>
  <li>Jaring ikan modern dengan ukuran yang sesuai standar</li>
  <li>Pancing tuna longline</li>
  <li>Alat bantu penangkapan ikan</li>
  <li>GPS dan fish finder</li>
</ul>
<h2>Dampak Positif</h2>
<p>Para nelayan menyambut baik program ini. Menurut salah satu penerima bantuan, Bapak Johannes Kogoya, alat tangkap modern ini akan sangat membantu meningkatkan hasil tangkapan. "Kami sangat berterima kasih kepada Pemerintah Provinsi Papua Tengah atas perhatiannya terhadap kesejahteraan nelayan," ungkapnya.</p>
<p>Kepala Dinas Perikanan dan Kelautan Papua Tengah menambahkan bahwa program ini akan dilanjutkan ke kabupaten lain di Papua Tengah. "Tahun ini kami menargetkan 1.000 nelayan akan menerima bantuan alat tangkap," jelasnya.</p>
<h2>Pelatihan Pendampingan</h2>
<p>Selain bantuan alat tangkap, para nelayan juga akan mendapatkan pelatihan cara penggunaan alat dan teknik penangkapan ikan yang berkelanjutan. Pelatihan ini akan dilaksanakan selama 3 hari dengan didampingi oleh tim teknis dari dinas.</p>
<p>Program ini diharapkan dapat meningkatkan produksi perikanan tangkap di Papua Tengah serta meningkatkan pendapatan nelayan secara signifikan.</p>',
                'is_published' => 1,
            ],
            [
                'title'        => 'Pelatihan Budidaya Ikan Nila untuk Kelompok Tani',
                'excerpt'      => 'Dinas menggelar pelatihan budidaya ikan nila sistem bioflok untuk 50 kelompok pembudidaya',
                'image'        => 'https://images.unsplash.com/photo-1562656611-2b26567ccf19?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwyfHxmaXNoZXJtYW4lMjBvY2VhbiUyMGluZG9uZXNpYXxlbnwxfHx8fDE3NzU4MzcwNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080',
                'author'       => 'Bidang Budidaya',
                'views'        => 0,
                'content'      => '<p>Dinas Kelautan dan Perikanan menggelar pelatihan budidaya ikan nila sistem bioflok bagi 50 kelompok pembudidaya di Nabire. Kegiatan ini bertujuan meningkatkan kapasitas teknis masyarakat dalam budidaya berkelanjutan.</p>
<p>Materi pelatihan meliputi manajemen kualitas air, formulasi pakan, dan pengendalian penyakit ikan. Peserta juga mendapatkan praktik langsung untuk penerapan teknologi bioflok di kolam budidaya.</p>',
                'is_published' => 1,
            ],
            [
                'title'        => 'Monitoring Kesehatan Terumbu Karang di Teluk Cenderawasih',
                'excerpt'      => 'Tim survei melakukan monitoring kondisi ekosistem terumbu karang di kawasan konservasi',
                'image'        => 'https://images.unsplash.com/photo-1724257154172-b7dcef926dea?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHw0fHxjb3JhbCUyMHJlZWYlMjB1bmRlcndhdGVyJTIwcGFwdWF8ZW58MXx8fHwxNzc1ODM3MDY2fDA&ixlib=rb-4.1.0&q=80&w=1080',
                'author'       => 'Tim Konservasi',
                'views'        => 0,
                'content'      => '<p>Tim survei melakukan monitoring kondisi ekosistem terumbu karang di kawasan konservasi Teluk Cenderawasih. Monitoring dilakukan untuk mengukur tutupan karang hidup dan kesehatan habitat laut.</p>
<p>Hasil awal menunjukkan tren positif pada beberapa lokasi inti konservasi. Pemerintah daerah akan melanjutkan program rehabilitasi dan edukasi masyarakat pesisir untuk menjaga keberlanjutan ekosistem.</p>',
                'is_published' => 1,
            ],
        ];

        foreach ($rows as $row) {
            $model->insert($row);
        }
    }
}
