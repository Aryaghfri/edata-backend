<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $table = 'skpd';
    protected $primaryKey = 'idSKPD';
    public $timestamps = false;

    protected $fillable = [
        'kode_skpd',
        'nama_skpd',
        'alamat_skpd',
        'nomor_telepon',
        'email',
        'website',
        'tanggal_dibentuk',
        'status_skpd'
    ];


    public function kegiatan()
{
    return $this->belongsToMany(Kegiatan::class, 'skpd_kegiatan', 'idSKPD', 'idKegiatan');
}

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'idSKPD', 'idSKPD');
    }
}
