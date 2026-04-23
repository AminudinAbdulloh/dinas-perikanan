<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class InformationObjectionModel extends Model
{
    protected $table            = 'information_objections';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'registration_number',
        'name',
        'identity_type',
        'identity_number',
        'address',
        'phone',
        'objection_reason',
        'case_description',
        'request_registration_number',
        'attachment_path',
        'attachment_name',
        'status',
        'admin_notes',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /** Status constants */
    public const STATUS_DITERIMA = 'diterima';
    public const STATUS_DIPROSES = 'diproses';
    public const STATUS_SELESAI  = 'selesai';
    public const STATUS_DITOLAK  = 'ditolak';

    /** Objection reason constants */
    public const REASON_DITOLAK          = 'ditolak';
    public const REASON_TIDAK_DITANGGAPI = 'tidak-ditanggapi';
    public const REASON_TIDAK_SESUAI     = 'tidak-sesuai';
    public const REASON_TIDAK_DIPENUHI   = 'tidak-dipenuhi';
    public const REASON_MELEBIHI_WAKTU   = 'melebihi-waktu';
    public const REASON_BIAYA_TIDAK_WAJAR = 'biaya-tidak-wajar';
    public const REASON_INFORMASI_BERKALA = 'informasi-berkala';

    /**
     * @return array<string, string>
     */
    public static function reasonLabels(): array
    {
        return [
            self::REASON_DITOLAK          => 'Permohonan Informasi Ditolak',
            self::REASON_TIDAK_DITANGGAPI => 'Permintaan Informasi Tidak Ditanggapi',
            self::REASON_TIDAK_SESUAI     => 'Permintaan Informasi Ditanggapi Tidak Sebagaimana Yang Diminta',
            self::REASON_TIDAK_DIPENUHI   => 'Permintaan Informasi Tidak Dipenuhi',
            self::REASON_MELEBIHI_WAKTU   => 'Informasi Yang Disampaikan Melebihi Jangka Waktu',
            self::REASON_BIAYA_TIDAK_WAJAR => 'Biaya Yang Dikenakan Tidak Wajar',
            self::REASON_INFORMASI_BERKALA => 'Informasi Berkala Tidak Disediakan',
        ];
    }

    public static function reasonLabel(string $reason): string
    {
        return self::reasonLabels()[$reason] ?? ucwords(str_replace('-', ' ', $reason));
    }

    /**
     * @return string[]
     */
    public static function validReasons(): array
    {
        return array_keys(self::reasonLabels());
    }

    /**
     * @return array<string, string>
     */
    public static function statusLabels(): array
    {
        return [
            self::STATUS_DITERIMA => 'Diterima',
            self::STATUS_DIPROSES => 'Diproses',
            self::STATUS_SELESAI  => 'Selesai',
            self::STATUS_DITOLAK  => 'Ditolak',
        ];
    }

    public static function statusLabel(string $status): string
    {
        return self::statusLabels()[$status] ?? ucfirst($status);
    }

    /**
     * @return string[]
     */
    public static function validStatuses(): array
    {
        return array_keys(self::statusLabels());
    }

    public static function statusBadgeClass(string $status): string
    {
        return match ($status) {
            self::STATUS_DITERIMA => 'text-bg-info',
            self::STATUS_DIPROSES => 'text-bg-warning',
            self::STATUS_SELESAI  => 'text-bg-success',
            self::STATUS_DITOLAK  => 'text-bg-danger',
            default               => 'text-bg-secondary',
        };
    }

    public static function tableReady(): bool
    {
        try {
            return Database::connect()->tableExists('information_objections');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Generate next registration number: KBR/YYYY/NNN
     */
    public function generateRegistrationNumber(): string
    {
        $year = date('Y');
        $prefix = "KBR/{$year}/";

        $last = $this->like('registration_number', $prefix, 'after')
            ->orderBy('id', 'DESC')
            ->first();

        $nextNum = 1;
        if ($last !== null) {
            $parts = explode('/', (string) $last['registration_number']);
            $lastNum = (int) ($parts[2] ?? 0);
            $nextNum = $lastNum + 1;
        }

        return $prefix . str_pad((string) $nextNum, 3, '0', STR_PAD_LEFT);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAllForAdmin(?string $status = null, int $limit = 10): array
    {
        $builder = $this->orderBy('created_at', 'DESC')->orderBy('id', 'DESC');

        if ($status !== null && in_array($status, self::validStatuses(), true)) {
            $builder->where('status', $status);
        }

        return $builder->paginate($limit, 'admin');
    }

    /**
     * Format date for display.
     */
    public static function displayDateFromRow(array $row): string
    {
        $created = (string) ($row['created_at'] ?? '');
        if ($created !== '' && preg_match('/^(\d{4}-\d{2}-\d{2})/', $created, $m) === 1) {
            return NewsArticleModel::formatIndonesianDate($m[1]);
        }

        return '';
    }
}
