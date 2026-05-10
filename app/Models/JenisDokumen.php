<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{
    use HasFactory;

    protected $table = 'jenis_dokumen'; // tabel di database
    protected $primaryKey = 'idJenis_dokumen'; // primary key
    public $timestamps = false; // karena tabel tidak ada kolom created_at, updated_at

    protected $fillable = [
        'nama_jenis_dokumen',
    ];

    // relasi balik ke dokumen
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'idJenis_dokumen', 'idJenis_dokumen');
    }
}
