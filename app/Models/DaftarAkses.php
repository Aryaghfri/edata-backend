<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarAkses extends Model
{
    protected $table = 'daftar_akses';
    protected $primaryKey = 'idAkses';
    public $timestamps = false;
}
