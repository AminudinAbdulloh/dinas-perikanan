<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class FaqModel extends Model
{
    protected $table            = 'faqs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'question',
        'answer',
        'sort_order',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public static function tableReady(): bool
    {
        try {
            return Database::connect()->tableExists('faqs');
        } catch (\Throwable) {
            return false;
        }
    }

    /**
     * Get all FAQs ordered by sort_order for admin.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAllForAdmin(): array
    {
        return $this->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    /**
     * Get only active FAQs ordered by sort_order for public display.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getActiveForPublic(): array
    {
        return $this->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('id', 'ASC')
            ->findAll();
    }

    /**
     * Get the next sort_order value.
     */
    public function getNextSortOrder(): int
    {
        $max = $this->selectMax('sort_order', 'max_sort')->first();

        return ((int) ($max['max_sort'] ?? 0)) + 1;
    }
}
