<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class PublicationTypeModel extends Model
{
    protected $table            = 'publication_types';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'slug',
        'sort_order',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public static function tableReady(): bool
    {
        try {
            return Database::connect()->tableExists('publication_types');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Generate slug from name.
     */
    public static function generateSlug(string $name): string
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug) ?? $slug;
        $slug = preg_replace('/[\s-]+/', '-', $slug) ?? $slug;
        return trim($slug, '-');
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public function getAllForAdmin(int $limit = 10): array
    {
        return $this->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->paginate($limit, 'admin');
    }

    /**
     * Find category by slug.
     */
    public function findBySlug(string $slug): ?array
    {
        $row = $this->where('slug', $slug)->first();
        return is_array($row) ? $row : null;
    }
}
