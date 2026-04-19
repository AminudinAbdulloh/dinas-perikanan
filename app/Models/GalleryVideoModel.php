<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class GalleryVideoModel extends Model
{
    protected $table            = 'gallery_videos';
    protected $primaryKey     = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'youtube_id',
        'youtube_url',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public static function tableReady(): bool
    {
        try {
            return Database::connect()->tableExists('gallery_videos');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * @param array<string, mixed> $row
     * @return array<string, int|string>
     */
    public function rowToPublicShape(array $row): array
    {
        $created = (string) ($row['created_at'] ?? '');
        $dateKey = '';
        if ($created !== '' && preg_match('/^(\d{4}-\d{2}-\d{2})/', $created, $m) === 1) {
            $dateKey = $m[1];
        }

        return [
            'id'          => (int) $row['id'],
            'youtube_id'  => (string) ($row['youtube_id'] ?? ''),
            'youtube_url' => (string) ($row['youtube_url'] ?? ''),
            'title'       => (string) ($row['title'] ?? ''),
            'date'        => NewsArticleModel::formatIndonesianDate($dateKey),
        ];
    }

    /**
     * @return array<int, array<string, int|string>>
     */
    public function getForPublic(): array
    {
        $rows = $this->orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->findAll();

        $out = [];
        foreach ($rows as $row) {
            $out[] = $this->rowToPublicShape($row);
        }

        return $out;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAllForAdmin(): array
    {
        return $this->orderBy('created_at', 'DESC')
            ->orderBy('id', 'DESC')
            ->findAll();
    }

    public static function displayDateFromRow(array $row): string
    {
        $created = (string) ($row['created_at'] ?? '');
        if ($created !== '' && preg_match('/^(\d{4}-\d{2}-\d{2})/', $created, $m) === 1) {
            return NewsArticleModel::formatIndonesianDate($m[1]);
        }

        return '';
    }
}
