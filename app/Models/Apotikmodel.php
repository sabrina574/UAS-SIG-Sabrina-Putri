<?php

namespace App\Models;

use CodeIgniter\Model;

class apotikModel extends Model
{
    protected $table = 'apotik'; // nama tabel
    protected $primaryKey = 'kode_pos'; // primary key tabel
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useAutoIncrement = false;
    // nama semua field pada tabel
    protected $allowedFields =
    ['kode_pos', 'kode_kecamatan', 'nama_apotik', 'alamat_apotik', 'koordinat'];
    protected $skipValidation = true;
}
