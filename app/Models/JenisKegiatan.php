<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kegiatan';
    protected $primaryKey = 'idJenis_kegiatan';
    public $timestamps = false;

    protected $fillable = [
    'nama_jenis_kegiatan'
    ];

    // Relasi ke kegiatan
    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'idJenis_kegiatan', 'idJenis_kegiatan');
    }
}
