<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Akun extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $table = 'akun';
    protected $primaryKey = 'idAkun';
    public $timestamps = false;
    
    protected $fillable = [
        'username', 'idPeran', 'idPegawai', 'password_hash',
        'status_akun', 'akses_terakhir'
    ];
    
    // kasih tau Laravel pakai kolom password_hash
    public function getAuthPassword()
    {
        return $this->password_hash;
    }
    
    public function peran()
    {
        return $this->belongsTo(Peran::class, 'idPeran');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'idPegawai');
    }

    public function hakAkses()
    {
        return $this->belongsToMany(DaftarAkses::class, 'hak_akses_akun', 'idAkun', 'idAkses');
    }

}
