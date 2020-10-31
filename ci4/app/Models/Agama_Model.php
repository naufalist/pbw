<?php

namespace App\Models;

use CodeIgniter\Model;

class agama_Model extends Model
{
    protected $table = 'agama';
    protected $primaryKey = 'kode_agama';
    protected $allowedFields = ['agama'];
}