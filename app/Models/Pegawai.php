<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'idPegawai';
    public $timestamps = false;

    protected $fillable = [
        'idSKPD',
        'NIP',
        'nama_pegawai',
        'alamat_pegawai',
        'email',
        'nomor_telepon',
        'gelar_depan',
        'gelar_belakang',
        'agama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_kawin',
        'tanggal_diangkat',
        'tanggal_berhenti',
        'status_pegawai',
    ];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'idSKPD');
    }

    // Relasi ke kegiatan
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'idPegawai', 'idPegawai');
    }
    public function akun()
    {
        return $this->hasOne(Akun::class, 'idPegawai', 'idPegawai');
    }
}
