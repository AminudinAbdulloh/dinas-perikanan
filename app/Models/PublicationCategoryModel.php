<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class PublicationCategoryModel extends Model
{
    protected $table            = 'publication_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'slug',
        'publication_type',
        'sort_order',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * @return array<string, string>
     */
    public static function publicationTypeLabels(): array
    {
        if (\App\Models\PublicationTypeModel::tableReady()) {
            $types = model(\App\Models\PublicationTypeModel::class)->orderBy('sort_order', 'ASC')->findAll();
            $labels = [];
            foreach ($types as $type) {
                $labels[(string) $type['slug']] = (string) $type['name'];
            }
            if (!empty($labels)) {
                return $labels;
            }
        }
        
        return [
            'perencanaan' => 'Perencanaan',
            'keuangan'    => 'Keuangan',
            'pelaporan'   => 'Pelaporan',
        ];
    }

    /**
     * @return string[]
     */
    public static function validPublicationTypes(): array
    {
        return array_keys(self::publicationTypeLabels());
    }

    public static function publicationTypeLabel(string $type): string
    {
        return self::publicationTypeLabels()[$type] ?? ucfirst($type);
    }

    public static function tableReady(): bool
    {
        try {
            return Database::connect()->tableExists('publication_categories');
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
        return $this->orderBy('publication_type', 'ASC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->paginate($limit, 'admin');
    }

    /**
     * Get all categories grouped by publication type.
     *
     * @return array<string, array<int, array<string, mixed>>>
     */
    public function getAllGroupedByType(): array
    {
        $rows = $this->orderBy('sort_order', 'ASC')->orderBy('name', 'ASC')->findAll();
        $grouped = [];
        foreach (self::validPublicationTypes() as $type) {
            $grouped[$type] = [];
        }
        foreach ($rows as $row) {
            $type = (string) ($row['publication_type'] ?? '');
            if (isset($grouped[$type])) {
                $grouped[$type][] = $row;
            }
        }
        return $grouped;
    }

    /**
     * Get all categories as flat list for select dropdown.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAllForSelect(): array
    {
        return $this->orderBy('publication_type', 'ASC')
            ->orderBy('sort_order', 'ASC')
            ->orderBy('name', 'ASC')
            ->findAll();
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
