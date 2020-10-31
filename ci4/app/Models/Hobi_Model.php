<?php

namespace App\Models;

use CodeIgniter\Model;

class Hobi_Model extends Model
{
    protected $table = 'hobi';
    protected $primaryKey = 'kode_hobi';
    protected $allowedFields = ['hobi'];

    public function getKodeHobi()
    {
        $data = $this->select('kode_hobi')->orderBy('kode_hobi', 'asc')->findAll();

        foreach ($data as $hobi) {
            $dataHobi[] = $hobi['kode_hobi'];
        }

        return $dataHobi;
    }

    public function getHobi($kode_hobi = "")
    {
        if (empty($kode_hobi)) {
            $data = $this->select('hobi')->orderBy('kode_hobi', 'asc')->findAll();
        } else {
            $data = $this->select('hobi')->where('kode_hobi', $kode_hobi)->first();  
        }

        if (!empty($data)) {
            $dataHobi = $data;
        } else {
            $dataHobi = '';
        }

        return $dataHobi;
    }
}