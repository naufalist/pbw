<?php

namespace App\Models;

use CodeIgniter\Model;

class Mahasiswa_Model extends Model
{
    protected $table = 'mahasiswa';
    // protected $primaryKey = 'nim';
    protected $allowedFields = ['nim','nama','jenis_kelamin','kode_agama','alamat','foto','tempat_lahir','tanggal_lahir'];
    
}