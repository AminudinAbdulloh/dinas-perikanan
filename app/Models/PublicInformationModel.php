<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class PublicInformationModel extends Model
{
    protected $table            = 'public_informations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category',
        'publication_type',
        'publication_category_id',
        'title',
        'description',
        'file_name',
        'file_path',
        'responsible_party',
        'time_period',
        'information_format',
        'year',
        'is_published',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /** Category constants */
    public const CATEGORY_BERKALA      = 'berkala';
    public const CATEGORY_SERTA_MERTA  = 'serta-merta';
    public const CATEGORY_SETIAP_SAAT  = 'setiap-saat';
    public const CATEGORY_DIKECUALIKAN = 'dikecualikan';

    /**
     * @return array<string, string>
     */
    public static function categoryLabels(): array
    {
        return [
            self::CATEGORY_BERKALA      => 'Informasi Berkala',
            self::CATEGORY_SERTA_MERTA  => 'Informasi Serta Merta',
            self::CATEGORY_SETIAP_SAAT  => 'Informasi Setiap Saat',
            self::CATEGORY_DIKECUALIKAN => 'Informasi yang Dikecualikan',
        ];
    }

    public static function categoryLabel(string $category): string
    {
        return self::categoryLabels()[$category] ?? ucwords(str_replace('-', ' ', $category));
    }

    /**
     * @return string[]
     */
    public static function validCategories(): array
    {
        return array_keys(self::categoryLabels());
    }

    public static function tableReady(): bool
    {
        try {
            return Database::connect()->tableExists('public_informations');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Get all rows for admin listing.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAllForAdmin(?string $category = null): array
    {
        $builder = $this->select('public_informations.*, publication_categories.name as pub_cat_name, publication_categories.slug as pub_cat_slug')
            ->join('publication_categories', 'publication_categories.id = public_informations.publication_category_id', 'left')
            ->orderBy('public_informations.created_at', 'DESC')
            ->orderBy('public_informations.id', 'DESC');

        if ($category !== null && in_array($category, self::validCategories(), true)) {
            $builder->where('public_informations.category', $category);
        }

        return $builder->findAll();
    }

    /**
     * Get published items for public display, optionally filtered by category.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getPublishedForPublic(?string $category = null): array
    {
        $builder = $this->select('public_informations.*, publication_categories.name as pub_cat_name, publication_categories.slug as pub_cat_slug')
            ->join('publication_categories', 'publication_categories.id = public_informations.publication_category_id', 'left')
            ->where('public_informations.is_published', 1)
            ->orderBy('public_informations.year', 'DESC')
            ->orderBy('public_informations.created_at', 'DESC')
            ->orderBy('public_informations.id', 'DESC');

        if ($category !== null && in_array($category, self::validCategories(), true)) {
            $builder->where('public_informations.category', $category);
        }

        return $builder->findAll();
    }

    /**
     * Get published items by publication category (sub-category).
     *
     * @return array<int, array<string, mixed>>
     */
    public function getPublishedByPubCategory(int $pubCategoryId): array
    {
        return $this->select('public_informations.*, publication_categories.name as pub_cat_name, publication_categories.slug as pub_cat_slug')
            ->join('publication_categories', 'publication_categories.id = public_informations.publication_category_id', 'left')
            ->where('public_informations.is_published', 1)
            ->where('public_informations.publication_category_id', $pubCategoryId)
            ->orderBy('public_informations.year', 'DESC')
            ->orderBy('public_informations.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get a single published item by ID with category info.
     *
     * @return array<string, mixed>|null
     */
    public function getPublishedById(int $id): ?array
    {
        $row = $this->select('public_informations.*, publication_categories.name as pub_cat_name, publication_categories.slug as pub_cat_slug')
            ->join('publication_categories', 'publication_categories.id = public_informations.publication_category_id', 'left')
            ->where('public_informations.is_published', 1)
            ->find($id);

        return is_array($row) ? $row : null;
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
