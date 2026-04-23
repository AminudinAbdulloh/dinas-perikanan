<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table            = 'visitors';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ip_address', 'user_agent', 'created_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = '';

    public static function tableReady(): bool
    {
        try {
            return \Config\Database::connect()->tableExists('visitors');
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function getTodayVisitors()
    {
        return $this->like('created_at', date('Y-m-d'), 'after')->countAllResults();
    }

    public function get7DaysVisitors()
    {
        return $this->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))->countAllResults();
    }

    public function getTotalVisitors()
    {
        return $this->countAllResults();
    }
}
