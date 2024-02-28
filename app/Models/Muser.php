<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    protected $table            = 'tbl_user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user','nama_user', 'username','password','level'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getUser($user, $pass)
{
    $where =[
        'username' => $user,
        'password' => $pass
    ];
    $user = new Muser();
    $user->select('tbl_user.id_user,tbl_user.username, tbl_user.nama_user, tbl_user.password,tbl_user.level');
    $user->where($where);
    return $user->find();
}
public function updateUser($id = false)
{
    if ($id == false) {
        return $this->findAll();
    }

    return $this->where(['id_user' => $id])->first();
}
public function getEnumValues()
{
    $query = $this->db->query("SHOW COLUMNS FROM tbl_user WHERE Field = 'level'");
    $row = $query->getRow();
    $enum = explode("','", substr($row->Type, 6, -2));
    
    return $enum;
}
}
