<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'kegiatan';

    // Primary key
    protected $primaryKey = 'idkegiatan';

    public $timestamps = false;

    // Kolom yang boleh diisi mass assignment
    protected $fillable = [
        'idJenis_kegiatan',
        'idPegawai',
        'nama_kegiatan',
        'lokasi',
        'anggaran',
        'verifikasi',
        'publikasi',
        'waktu',
        'catatan_verifikasi',
    ];
     protected $appends = ['status_kegiatan'];


    // Relasi ke tabel jenis_kegiatan
    public function jenis()
    {
        return $this->belongsTo(JenisKegiatan::class, 'idJenis_kegiatan', 'idJenis_kegiatan');
    }

    // Relasi ke tabel skpd
        public function skpd()
    {
        return $this->belongsToMany(Skpd::class, 'skpd_kegiatan', 'idKegiatan', 'idSKPD');
    }


    // Relasi ke tabel pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idPegawai', 'idPegawai');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'idKegiatan', 'idkegiatan');
    }

    public function getStatusKegiatanAttribute()
    {
        $dokCount = $this->dokumen()->count();

        if ($dokCount === 0) {
            return 'Belum ada dokumen';
        }

        return match ($this->verifikasi) {
            0 => 'Dokumen ada (belum dikirim)', // operator sudah upload tapi belum kirim
            1 => 'Menunggu verifikasi Kabid',   // sudah kirim, kabid belum cek
            2 => 'Sudah diverifikasi Kabid',
            3 => 'Ditolak Kabid',
            default => 'Status tidak diketahui',
        };
    }

    protected $casts = [
        'verifikasi' => 'integer',
    ];



}