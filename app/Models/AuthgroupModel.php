<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthgroupModel extends Model
{

    protected $table = 'auth_groups_users';
    protected $allowedFields = [
        'group_id',
        'user_id'
    ];

    public function group($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('user_id', $id);
        $result = $builder->get();
        return $result;
    }


    public function AuthgroupAll()
    {
        return $this->findall();
    }


    public function detail($id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        $result = $builder->get();
        return $result;
    }
}
