<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';
    protected $primaryKey = 'idDokumen';
    public $timestamps = false;
    protected $appends = ['status_dokumen', 'editable', 'deletable'];

    protected $fillable = [
        'nomor_dokumen',
        'nama_dokumen',
        'idKegiatan',
        'idJenis_dokumen',
        'idPegawai',
        'upload_file',
        'verifikasi',
        'publikasi',
    ];

    // Relasi ke Kegiatan
    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'idKegiatan', 'idkegiatan');
    }

    // Relasi ke Jenis Dokumen
    public function jenis()
    {
        return $this->belongsTo(JenisDokumen::class, 'idJenis_dokumen', 'idJenis_dokumen');
    }

    // Relasi ke Pegawai (penyusun/upload)
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idPegawai', 'idPegawai');
    }
    public function getStatusDokumenAttribute()
    {
        return match ($this->verifikasi) {
            0 => 'Draft',
            1 => 'Menunggu verifikasi Kabid',
            2 => 'Disetujui Kabid',
            3 => 'Ditolak Kabid',
            default => 'Status tidak diketahui',
        };
    }
    // tambahan: logic boleh edit/hapus
    public function getEditableAttribute()
    {
        // Bisa diedit hanya kalau masih Draft (0) atau Menunggu Kabid (1)
        return in_array((int) $this->verifikasi, [0, 1]);
    }

    public function getDeletableAttribute()
    {
        // Bisa dihapus hanya kalau masih Draft (0)
        return (int) $this->verifikasi === 0;
    }

}


