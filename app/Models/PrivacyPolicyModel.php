<?php

namespace App\Models;

use CodeIgniter\Model;

class PrivacyPolicyModel extends Model
{
    protected $table            = 'privacy_policies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['content', 'updated_at'];

    // Dates
    protected $useTimestamps = false; // We manage updated_at manually or it could be managed here
    protected $dateFormat    = 'datetime';
    
    // We just need a single row for the privacy policy, so we could add a helper method
    public function getPolicy()
    {
        $policy = $this->first();
        if (!$policy) {
            $this->insert(['content' => '', 'updated_at' => date('Y-m-d H:i:s')]);
            return $this->first();
        }
        return $policy;
    }

    public function updatePolicy($content)
    {
        $policy = $this->getPolicy();
        return $this->update($policy['id'], [
            'content' => $content,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
