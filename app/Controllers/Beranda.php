<?php

namespace App\Controllers;

use App\Models\BerandaModel;
use App\Models\InformationObjectionModel;
use App\Models\InformationRequestModel;
use App\Models\NewsArticleModel;
use App\Models\PublicInformationModel;
use App\Models\FaqModel;
use App\Models\PengumumanModel;
use App\Models\PrivacyPolicyModel;
use App\Models\PublicationCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class Beranda extends BaseController
{
    public function __construct(
        private readonly BerandaModel $berandaModel = new BerandaModel()
    ) {
    }

    public function index(): string
    {
        $data = [
            'services' => $this->berandaModel->getServices(),
            'newsList' => $this->berandaModel->getNewsList(),
            'galleryPhotos' => $this->berandaModel->getGalleryPhotos(),
            'latestVideos' => $this->berandaModel->getLatestVideos(),
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
        ];

        return view('public/index', $data);
    }

    public function page(string $slug, ?string $subSlug = null): string
    {
        $path = $subSlug ? $slug . '/' . $subSlug : $slug;
        $pageData = $this->berandaModel->getPublicPageData($path);

        if ($pageData === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'pageData' => $pageData,
        ];

        return view('public/page', $data);
    }

    public function berita(): string
    {
        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'newsList' => $this->berandaModel->getNewsList(),
            'pageData' => [
                'title' => 'Berita',
                'description' => 'Informasi dan kegiatan terbaru Dinas Kelautan dan Perikanan Provinsi Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Berita', 'href' => null],
                ],
            ],
        ];

        return view('public/berita', $data);
    }

    public function beritaDetail(int $id): string
    {
        $news = $this->berandaModel->getNewsDetail($id);

        if ($news === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (NewsArticleModel::tableReady()) {
            model(NewsArticleModel::class)->recordReaderVisitIfNewSession($id);
            $news = $this->berandaModel->getNewsDetail($id) ?? $news;
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'news' => $news,
            'popularNews' => $this->berandaModel->getPopularNews((int) $news['id']),
            'pageData' => [
                'title' => $news['title'],
                'description' => 'Berita terbaru Dinas Kelautan dan Perikanan Papua Tengah.',
                'backgroundImage' => $news['image'] ?? null,
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Berita', 'href' => base_url('berita')],
                    ['label' => $news['title'], 'href' => null],
                ],
            ],
        ];

        return view('public/berita_detail', $data);
    }

    public function galeriFoto(): string
    {
        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'galleryPhotos' => $this->berandaModel->getGalleryPhotos(),
            'pageData' => [
                'title' => 'Galeri Foto',
                'description' => 'Dokumentasi visual kegiatan dan potensi sektor kelautan dan perikanan Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Galeri Foto', 'href' => null],
                ],
            ],
        ];

        return view('public/galeri_foto', $data);
    }

    public function galeriFotoDetail(int $id): string
    {
        $photo = $this->berandaModel->getGalleryPhotoDetail($id);

        if ($photo === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'photo' => $photo,
            'relatedPhotos' => $this->berandaModel->getRelatedGalleryPhotos((int) $photo['id']),
            'pageData' => [
                'title' => $photo['title'],
                'description' => 'Detail dokumentasi kegiatan dan potensi sektor kelautan dan perikanan Papua Tengah.',
                'backgroundImage' => $photo['image'] ?? null,
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Galeri Foto', 'href' => base_url('galeri/foto')],
                    ['label' => $photo['title'], 'href' => null],
                ],
            ],
        ];

        return view('public/galeri_foto_detail', $data);
    }

    public function galeriVideo(): string
    {
        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData' => $this->berandaModel->getPublicFooterData(),
            'latestVideos' => $this->berandaModel->getLatestVideos(),
            'pageData' => [
                'title' => 'Galeri Video',
                'description' => 'Kumpulan video kegiatan, edukasi, dan profil sektor kelautan serta perikanan Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Galeri Video', 'href' => null],
                ],
            ],
        ];

        return view('public/galeri_video', $data);
    }

    public function pengumuman(): string
    {
        $pengumuman = [];
        try {
            $pengumuman = model(PengumumanModel::class)->orderBy('id', 'DESC')->findAll();
        } catch (\Throwable) {
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'   => $this->berandaModel->getPublicFooterData(),
            'pengumuman'   => $pengumuman,
            'pageData'     => [
                'title'       => 'Pengumuman',
                'description' => 'Pengumuman resmi dan edaran terkait layanan Dinas Kelautan dan Perikanan Provinsi Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Pengumuman', 'href' => null],
                ],
            ],
        ];

        return view('public/pengumuman', $data);
    }

    public function pengumumanDetail(int $id): string
    {
        $pengumuman = null;
        try {
            $pengumuman = model(PengumumanModel::class)->find($id);
        } catch (\Throwable) {
        }

        if ($pengumuman === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $title = (string) ($pengumuman['judul'] ?? 'Detail Pengumuman');

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'   => $this->berandaModel->getPublicFooterData(),
            'pengumuman'   => $pengumuman,
            'pageData'     => [
                'title'       => $title,
                'description' => 'Detail pengumuman resmi Dinas Kelautan dan Perikanan Provinsi Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Pengumuman', 'href' => base_url('pengumuman')],
                    ['label' => $title, 'href' => null],
                ],
            ],
        ];

        return view('public/pengumuman_detail', $data);
    }

    public function faq(): string
    {
        $faqs = [];
        if (FaqModel::tableReady()) {
            $faqs = model(FaqModel::class)->getActiveForPublic();
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'   => $this->berandaModel->getPublicFooterData(),
            'faqs'         => $faqs,
            'pageData'     => [
                'title'       => 'FAQ',
                'description' => 'Pertanyaan yang sering diajukan seputar layanan Dinas Kelautan dan Perikanan Provinsi Papua Tengah.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'FAQ', 'href' => null],
                ],
            ],
        ];

        return view('public/faq', $data);
    }

    public function kebijakanPrivasi(): string
    {
        $model = new PrivacyPolicyModel();
        $policy = $model->getPolicy();

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'   => $this->berandaModel->getPublicFooterData(),
            'policy'       => $policy,
            'pageData'     => [
                'title'       => 'Kebijakan Privasi',
                'description' => 'Aturan mengenai pengumpulan dan perlindungan data pengguna.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => 'Kebijakan Privasi', 'href' => null],
                ],
            ],
        ];

        return view('public/kebijakan_privasi', $data);
    }

    /**
     * Informasi Publik – list by category.
     */
    public function informasiPublik(?string $categorySlug = null): string
    {
        $categoryMap = [
            'informasi-berkala'      => PublicInformationModel::CATEGORY_BERKALA,
            'informasi-serta-merta'  => PublicInformationModel::CATEGORY_SERTA_MERTA,
            'informasi-setiap-saat'  => PublicInformationModel::CATEGORY_SETIAP_SAAT,
            'informasi-dikecualikan' => PublicInformationModel::CATEGORY_DIKECUALIKAN,
        ];

        $modelCategory = $categoryMap[$categorySlug] ?? null;
        $pageTitle = match ($modelCategory) {
            PublicInformationModel::CATEGORY_BERKALA      => 'Informasi Berkala',
            PublicInformationModel::CATEGORY_SERTA_MERTA  => 'Informasi Serta Merta',
            PublicInformationModel::CATEGORY_SETIAP_SAAT  => 'Informasi Setiap Saat',
            PublicInformationModel::CATEGORY_DIKECUALIKAN => 'Informasi yang Dikecualikan',
            default => 'Daftar Informasi Publik',
        };

        $infoItems = [];
        if (PublicInformationModel::tableReady()) {
            $infoItems = model(PublicInformationModel::class)->getPublishedForPublic($modelCategory);
        }

        // Search filter
        $searchQuery = trim((string) $this->request->getGet('cari'));
        if ($searchQuery !== '' && $infoItems !== []) {
            $infoItems = array_values(array_filter($infoItems, static function (array $item) use ($searchQuery): bool {
                $haystack = strtolower(
                    ((string) ($item['title'] ?? ''))
                    . ' ' . ((string) ($item['description'] ?? ''))
                    . ' ' . ((string) ($item['responsible_party'] ?? ''))
                );
                return str_contains($haystack, strtolower($searchQuery));
            }));
        }

        $breadcrumbs = [
            ['label' => 'Beranda', 'href' => base_url('/')],
            ['label' => 'PPID', 'href' => null],
        ];
        if ($modelCategory !== null) {
            $breadcrumbs[] = ['label' => $pageTitle, 'href' => null];
        }

        $data = [
            'menuNavigasi'      => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'        => $this->berandaModel->getPublicFooterData(),
            'infoItems'         => $infoItems,
            'currentCategory'   => $modelCategory,
            'currentCategorySlug' => $categorySlug,
            'searchQuery'       => $searchQuery,
            'pageData'          => [
                'title'       => $pageTitle,
                'description' => 'Informasi publik yang disediakan oleh Dinas Kelautan dan Perikanan Provinsi Papua Tengah.',
                'breadcrumbs' => $breadcrumbs,
            ],
        ];

        return view('public/informasi_publik', $data);
    }

    /**
     * Publikasi – list documents by sub-category.
     */
    public function publikasiList(string $categorySlug): string
    {
        $pubCatModel = model(PublicationCategoryModel::class);
        $pubCategory = $pubCatModel->findBySlug($categorySlug);

        if ($pubCategory === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $pubTypeName = PublicationCategoryModel::publicationTypeLabel((string) ($pubCategory['publication_type'] ?? ''));
        $catName = (string) ($pubCategory['name'] ?? '');

        $documents = [];
        if (PublicInformationModel::tableReady()) {
            $documents = model(PublicInformationModel::class)->getPublishedByPubCategory((int) $pubCategory['id']);
        }

        // Search filter
        $searchQuery = trim((string) $this->request->getGet('cari'));
        if ($searchQuery !== '' && $documents !== []) {
            $documents = array_values(array_filter($documents, static function (array $doc) use ($searchQuery): bool {
                $haystack = strtolower(((string) ($doc['title'] ?? '')) . ' ' . ((string) ($doc['description'] ?? '')));
                return str_contains($haystack, strtolower($searchQuery));
            }));
        }

        $allPubCategories = $pubCatModel->getAllForSelect();

        $data = [
            'menuNavigasi'       => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'         => $this->berandaModel->getPublicFooterData(),
            'documents'          => $documents,
            'currentCategorySlug' => $categorySlug,
            'allPubCategories'   => $allPubCategories,
            'searchQuery'        => $searchQuery,
            'breadcrumbs'        => [
                ['label' => 'Beranda', 'href' => base_url('/')],
                ['label' => 'Publikasi', 'href' => null],
                ['label' => $pubTypeName, 'href' => null],
                ['label' => $catName, 'href' => null],
            ],
            'pageData'           => [
                'title'       => 'Publikasi',
                'description' => 'Daftar dokumen publikasi ' . $catName . '.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => $catName, 'href' => null],
                ],
            ],
        ];

        return view('public/publikasi_list', $data);
    }

    /**
     * Publikasi – detail view of a single document.
     */
    public function publikasiDetail(string $categorySlug, int $id): string
    {
        $pubCatModel = model(PublicationCategoryModel::class);
        $pubCategory = $pubCatModel->findBySlug($categorySlug);

        if ($pubCategory === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $pubTypeName = PublicationCategoryModel::publicationTypeLabel((string) ($pubCategory['publication_type'] ?? ''));
        $catName = (string) ($pubCategory['name'] ?? '');

        $document = null;
        if (PublicInformationModel::tableReady()) {
            $document = model(PublicInformationModel::class)->getPublishedById($id);
        }

        if ($document === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $docTitle = (string) ($document['title'] ?? $catName);
        $allPubCategories = $pubCatModel->getAllForSelect();

        $data = [
            'menuNavigasi'       => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'         => $this->berandaModel->getPublicFooterData(),
            'document'           => $document,
            'currentCategorySlug' => $categorySlug,
            'allPubCategories'   => $allPubCategories,
            'breadcrumbs'        => [
                ['label' => 'Beranda', 'href' => base_url('/')],
                ['label' => 'Publikasi', 'href' => null],
                ['label' => $catName, 'href' => base_url('publikasi/' . $categorySlug)],
                ['label' => $docTitle, 'href' => null],
            ],
            'pageData'           => [
                'title'       => $docTitle,
                'description' => 'Detail dokumen publikasi.',
                'breadcrumbs' => [
                    ['label' => 'Beranda', 'href' => base_url('/')],
                    ['label' => $docTitle, 'href' => null],
                ],
            ],
        ];

        return view('public/publikasi_detail', $data);
    }

    /**
     * Handle form permohonan informasi submission.
     */
    public function submitPermohonan(): ResponseInterface
    {
        $rules = [
            'kategori'          => 'required|in_list[Perorangan,Lembaga]',
            'nama'              => 'required|max_length[255]',
            'pekerjaan'         => 'required|max_length[255]',
            'alamat'            => 'required|max_length[2000]',
            'identitas'         => 'required|max_length[50]',
            'nomor_identitas'   => 'required|max_length[100]',
            'telepon'           => 'required|max_length[30]',
            'email'             => 'required|valid_email|max_length[255]',
            'rincian_informasi' => 'required|max_length[5000]',
            'tujuan_informasi'  => 'required|max_length[5000]',
            'cara_mendapatkan'  => 'required|in_list[membaca,salinan]',
            'cara_salinan'      => 'required|in_list[langsung,kurir,pos,faksimili,email]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = model(InformationRequestModel::class);
        $regNumber = $model->generateRegistrationNumber();

        $model->insert([
            'registration_number' => $regNumber,
            'applicant_category'  => (string) $this->request->getPost('kategori'),
            'name'                => (string) $this->request->getPost('nama'),
            'occupation'          => (string) $this->request->getPost('pekerjaan'),
            'address'             => (string) $this->request->getPost('alamat'),
            'identity_type'       => (string) $this->request->getPost('identitas'),
            'identity_number'     => (string) $this->request->getPost('nomor_identitas'),
            'phone'               => (string) $this->request->getPost('telepon'),
            'email'               => (string) $this->request->getPost('email'),
            'information_detail'  => (string) $this->request->getPost('rincian_informasi'),
            'information_purpose' => (string) $this->request->getPost('tujuan_informasi'),
            'obtain_method'       => (string) $this->request->getPost('cara_mendapatkan'),
            'copy_method'         => (string) $this->request->getPost('cara_salinan'),
            'status'              => InformationRequestModel::STATUS_DITERIMA,
        ]);

        return redirect()->to(base_url('layanan/form-permohonan-informasi'))
            ->with('permohonan_success', 'Permohonan informasi berhasil dikirim. Nomor registrasi Anda: ' . $regNumber . '. Simpan nomor ini untuk melacak status permohonan.');
    }

    /**
     * Handle tracking permohonan informasi.
     */
    public function lacakPermohonan(): string
    {
        $query = trim((string) $this->request->getPost('query_lacak'));

        $trackResults = [];
        if ($query !== '' && InformationRequestModel::tableReady()) {
            $trackResults = model(InformationRequestModel::class)->trackByQuery($query);
        }

        $pageData = $this->berandaModel->getPublicPageData('layanan/form-permohonan-informasi');
        if ($pageData === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'menuNavigasi' => $this->berandaModel->getPublicNavigationMenu(),
            'footerData'   => $this->berandaModel->getPublicFooterData(),
            'pageData'     => $pageData,
            'trackQuery'   => $query,
            'trackResults' => $trackResults,
            'activeLacakTab' => true,
        ];

        return view('public/page', $data);
    }

    /**
     * Handle form keberatan informasi submission.
     */
    public function submitKeberatan(): ResponseInterface
    {
        $rules = [
            'nama'            => 'required|max_length[255]',
            'identitas'       => 'required|max_length[50]',
            'nomor_identitas' => 'required|max_length[100]',
            'alamat'          => 'required|max_length[2000]',
            'telepon'         => 'required|max_length[30]',
            'alasan'          => 'required|in_list[' . implode(',', InformationObjectionModel::validReasons()) . ']',
            'kasus_posisi'    => 'required|max_length[10000]',
            'no_registrasi_permohonan' => 'permit_empty|max_length[50]',
            'lampiran'        => 'permit_empty|uploaded[lampiran]|max_size[lampiran,10240]|ext_in[lampiran,pdf,doc,docx,jpg,jpeg,png]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = model(InformationObjectionModel::class);
        $regNumber = $model->generateRegistrationNumber();

        // Handle file upload
        $attachPath = null;
        $attachName = null;
        $file = $this->request->getFile('lampiran');
        if ($file !== null && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/keberatan', $newName);
            $attachPath = 'uploads/keberatan/' . $newName;
            $attachName = $file->getClientName();
        }

        $model->insert([
            'registration_number'          => $regNumber,
            'name'                         => (string) $this->request->getPost('nama'),
            'identity_type'                => (string) $this->request->getPost('identitas'),
            'identity_number'              => (string) $this->request->getPost('nomor_identitas'),
            'address'                      => (string) $this->request->getPost('alamat'),
            'phone'                        => (string) $this->request->getPost('telepon'),
            'objection_reason'             => (string) $this->request->getPost('alasan'),
            'case_description'             => (string) $this->request->getPost('kasus_posisi'),
            'request_registration_number'  => trim((string) $this->request->getPost('no_registrasi_permohonan')) ?: null,
            'attachment_path'              => $attachPath,
            'attachment_name'              => $attachName,
            'status'                       => InformationObjectionModel::STATUS_DITERIMA,
        ]);

        return redirect()->to(base_url('layanan/form-keberatan-informasi'))
            ->with('keberatan_success', 'Keberatan berhasil dikirim. Nomor registrasi: ' . $regNumber . '. Keberatan akan diproses maksimal 30 hari kerja.');
    }
}