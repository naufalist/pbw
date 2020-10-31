<?php

namespace App\Models;

use CodeIgniter\Model;

class HobiMahasiswa_Model extends Model
{
    protected $table = 'hobi_mahasiswa';
    protected $primaryKey = 'kode_hobi_mahasiswa';
    protected $allowedFields = ['kode_hobi', 'nim'];
    
    public function getKodeHobi($nim = "")
    {
        if (empty($nim)) {
            $data = $this->select('kode_hobi')->orderBy('kode_hobi', 'asc')->findAll();
        } else {
            $data = $this->select('kode_hobi')->where('nim', $nim)->orderBy('kode_hobi', 'asc')->findAll();
        }

        if (!empty($data)) {
            foreach ($data as $hobi) {
                $dataHobi[] = $hobi['kode_hobi'];
            }
        } else {
            $dataHobi = [];
        }

        return $dataHobi;
    }
}