<?php
  
namespace App\Models;
  
use CodeIgniter\Model;
  
class Pelajar_Model extends Model
{
    protected $table = "pelajar";
    protected $primaryKey = "id_pelajar";
    protected $allowedFields = ['email', 'nama', 'katasandi', 'organisasi', 'aktivasi', 'token_aktivasi', 'token_lupa_katasandi'];
  
    public function getLogin($username, $password)
    {
        // return $this->db->table($this->table)->where(['username' => $username, 'password' => $password])->get()->getRowArray();
        // return $this->db->table($this->table)->where(['email' => $username, 'password' => $password])->get()->getRowArray();
        // return $this->db->table($this->table)->where(['email' => $username, 'katasandi' => $password])->get()->getRowArray();
        return $this->select('id_pelajar')->where(['email' => $username, 'katasandi' => $password])->first();
    }

    public function getData($email, $data = 'email')
    {
        return $this->select($data)->where(['email' => $email])->first()[$data];
    }

    public function getDataById($id_pelajar, $data = 'email')
    {
        return $this->select($data)->where(['id_pelajar' => $id_pelajar])->first()[$data];
    }

    public function getToken($id_pelajar)
    {
        return $this->select('token_aktivasi')->where(['id_pelajar' => $id_pelajar])->first()['token_aktivasi'];
    }

    // public function cekKatasandi($username)
    // {
    //     return $this->select('katasandi')->where(['email' => $username])->first()['katasandi'];
    // }
  
}