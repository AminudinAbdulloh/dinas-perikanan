<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class InformationRequestModel extends Model
{
    protected $table            = 'information_requests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'registration_number',
        'applicant_category',
        'name',
        'occupation',
        'address',
        'identity_type',
        'identity_number',
        'phone',
        'email',
        'information_detail',
        'information_purpose',
        'obtain_method',
        'copy_method',
        'status',
        'admin_notes',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /** Status constants */
    public const STATUS_DITERIMA  = 'diterima';
    public const STATUS_DIPROSES  = 'diproses';
    public const STATUS_SELESAI   = 'selesai';
    public const STATUS_DITOLAK   = 'ditolak';

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
            return Database::connect()->tableExists('information_requests');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Generate next registration number: PPID/YYYY/NNN
     */
    public function generateRegistrationNumber(): string
    {
        $year = date('Y');
        $prefix = "PPID/{$year}/";

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
     * Get all rows for admin listing.
     *
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
     * Search by identity number, phone, or email for tracking.
     *
     * @return array<int, array<string, mixed>>
     */
    public function trackByQuery(string $query): array
    {
        $query = trim($query);
        if ($query === '') {
            return [];
        }

        return $this->groupStart()
            ->like('identity_number', $query)
            ->orLike('phone', $query)
            ->orLike('email', $query)
            ->orLike('registration_number', $query)
            ->groupEnd()
            ->orderBy('created_at', 'DESC')
            ->findAll();
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
