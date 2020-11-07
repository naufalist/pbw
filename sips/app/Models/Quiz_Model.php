<?php
  
namespace App\Models;
  
use CodeIgniter\Model;
  
class Quiz_Model extends Model
{
    protected $table = "quiz";
    protected $primaryKey = "id_quiz";
    protected $allowedFields = ['id_pelajar', 'nilai_quiz', 'waktu_quiz'];

    public function getData($id_pelajar, $data = 'id_quiz')
    {
        return $this->select($data)->where(['id_pelajar' => $id_pelajar])->first()[$data];
    }
  
}