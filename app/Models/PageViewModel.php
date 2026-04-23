<?php

namespace App\Models;

use CodeIgniter\Model;

class PageViewModel extends Model
{
    protected $table            = 'page_views';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['url', 'created_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public static function tableReady(): bool
    {
        try {
            return \Config\Database::connect()->tableExists('page_views');
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function getTodayViews()
    {
        return $this->like('created_at', date('Y-m-d'), 'after')->countAllResults();
    }

    public function getTotalViews()
    {
        return $this->countAllResults();
    }
}
