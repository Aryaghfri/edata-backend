<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = 'peran';
    protected $primaryKey = 'idPeran';
    public $timestamps = false;

    protected $fillable = ['kode_peran', 'nama_peran'];

    public function akun()
    {
        return $this->hasMany(Akun::class, 'idPeran');
    }
}
