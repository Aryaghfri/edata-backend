<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //================== SKPD ==================//
        if (!Schema::hasTable('skpd')) {
            Schema::create('skpd', function (Blueprint $table) {
                $table->id('idSKPD'); //Auto nullable dan increment pk
                $table->string('kode_skpd', 128);
                $table->text('nama_skpd')->nullable();
                $table->text('alamat_skpd')->nullable();
                $table->string('nomor_telepon', 32)->nullable();
                $table->string('email', 255)->nullable();
                $table->text('website')->nullable();
                $table->date('tanggal_dibentuk')->nullable();
                $table->integer('status_skpd')->nullable();
            });
        }

        //================== Jenis Dokumen ==================//
        if (!Schema::hasTable('jenis_dokumen')) {
            Schema::create('jenis_dokumen', function (Blueprint $table){
                $table->id('idJenis_dokumen');
                $table->text('nama_jenis_dokumen');
            });
        }

        //================== Jenis Kegiatan ==================//
        if (!Schema::hasTable('jenis_kegiatan')) {
            Schema::create('jenis_kegiatan', function (Blueprint $table){
                $table->id('idJenis_kegiatan');
                $table->string('nama_jenis_kegiatan', 100);
            });
        }

        //================== Peran ==================//
        if (!Schema::hasTable('peran')) {
            Schema::create('peran', function (Blueprint $table){
                $table->id('idPeran');
                $table->integer('kode_peran');
                $table->string('nama_peran',100);
            });
        }

        //================== Daftar Akses ==================//
        if (!Schema::hasTable('daftar_akses')) {
            Schema::create('daftar_akses', function (Blueprint $table){
                $table->id('idAkses');
                $table->string('jenis_akses',100);
            });
        }

        //================== Pegawai ==================//
        if (!Schema::hasTable('pegawai')){
            Schema::create('pegawai', function (Blueprint $table){
                $table->id('idPegawai');
                $table->unsignedBigInteger('idSKPD');
                $table->string('NIP', 32)->nullable();
                $table->string('nama_pegawai', 255);
                $table->longText('alamat_pegawai');
                $table->string('email', 255);
                $table->string('nomor_telepon', 32);
                $table->string('gelar_depan', 32);
                $table->string('gelar_belakang', 64);
                $table->string('agama', 64);
                $table->string('tempat_lahir', 64);
                $table->date('tanggal_lahir')->nullable();
                $table->char('jenis_kelamin', 1)->nullable();
                $table->string('status_kawin', 32)->nullable();
                $table->date('tanggal_diangkat')->nullable();
                $table->date('tanggal_berhenti')->nullable();
                $table->integer('status_pegawai');
                // relasi
                $table->foreign('idSKPD')->references('idSKPD')->on('skpd');
            });
        }

        //================== Akun ==================//
        if (!Schema::hasTable('akun')) {
            Schema::create('akun', function (Blueprint $table) {
                $table->id('idAkun');
                $table->string('username', 32);
                $table->unsignedBigInteger('idPeran');
                $table->unsignedBigInteger('idPegawai');
                $table->string('password_hash', 255)->nullable();
                $table->integer('status_akun')->nullable();
                $table->dateTime('akses_terakhir')->nullable();
                // relasi
                $table->foreign('idPeran')->references('idPeran')->on('peran');
                $table->foreign('idPegawai')->references('idPegawai')->on('pegawai');
                $table->rememberToken(); // untuk token
            });
        }

        //================== Hak Akses Akun ==================//
        if (!Schema::hasTable('hak_akses_akun')) {
            Schema::create('hak_akses_akun', function (Blueprint $table){
                $table->unsignedBigInteger('idAkun');
                $table->unsignedBigInteger('idAkses');
                $table->primary(['idAkun', 'idAkses']);
                // relasi
                $table->foreign('idAkun')->references('idAkun')->on('akun');
                $table->foreign('idAkses')->references('idAkses')->on('daftar_akses');
            });
        }

        //================== Kegiatan ==================//
        if (!Schema::hasTable('kegiatan')) {
            Schema::create('kegiatan', function (Blueprint $table) {
                $table->id('idkegiatan');
                $table->unsignedBigInteger('idJenis_kegiatan');
                $table->unsignedBigInteger('idPegawai');
                $table->unsignedBigInteger('idSKPD');
                $table->string('nama_kegiatan', 100);
                $table->string('lokasi', 100);
                $table->date('waktu')->nullable();
                $table->decimal('anggaran', 15, 2);
                $table->tinyInteger('verifikasi');
                $table->text('catatan_verifikasi')->nullable();
                $table->tinyInteger('publikasi');
                // relasi 
                $table->foreign('idJenis_kegiatan')->references('idJenis_kegiatan')->on('jenis_kegiatan');
                $table->foreign('idPegawai')->references('idPegawai')->on('pegawai');
                $table->foreign('idSKPD')->references('idSKPD')->on('skpd');
            });
        }


        //================== Dokumen ==================//
        if (!Schema::hasTable('dokumen')) {
            Schema::create('dokumen', function (Blueprint $table) {
                $table->id('idDokumen');
                $table->string('nomor_dokumen', 28)->unique()->nullable();
                $table->string('nama_dokumen', 150);
                $table->unsignedBigInteger('idKegiatan');
                $table->unsignedBigInteger('idJenis_dokumen');
                $table->unsignedBigInteger('idPegawai');
                $table->string('upload_file', 255);
                $table->tinyInteger('verifikasi');
                $table->tinyInteger('publikasi');
                // relasi
                $table->foreign('idKegiatan')->references('idkegiatan')->on('kegiatan');
                $table->foreign('idJenis_dokumen')->references('idJenis_dokumen')->on('jenis_dokumen');
                $table->foreign('idPegawai')->references('idPegawai')->on('pegawai');
            });
        }

        //================== Akun ==================//
        if (!Schema::hasTable('penyusun')) {
            Schema::create('penyusun', function (Blueprint $table) {
                $table->unsignedBigInteger('idAkun');
                $table->unsignedBigInteger('idKegiatan');
                $table->primary(['idAkun', 'idKegiatan']);
                // relasi
                $table->foreign('idAkun')->references('idAkun')->on('akun');
                $table->foreign('idKegiatan')->references('idkegiatan')->on('kegiatan');
            });
        }

        //================== SKPD Kegiatan ==================//
        if (!Schema::hasTable('skpd_kegiatan')) {
            Schema::create('skpd_kegiatan', function (Blueprint $table) {
                $table->unsignedBigInteger('idKegiatan');
                $table->unsignedBigInteger('idSKPD');
                $table->primary(['idKegiatan', 'idSKPD']);
                // relasi
                $table->foreign('idKegiatan')->references('idkegiatan')->on('kegiatan');
                $table->foreign('idSKPD')->references('idSKPD')->on('skpd');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpd_kegiatan');
        Schema::dropIfExists('penyusun');
        Schema::dropIfExists('dokumen');
        Schema::dropIfExists('kegiatan');
        Schema::dropIfExists('akun');
        Schema::dropIfExists('pegawai');
        Schema::dropIfExists('hak_akses_akun');
        Schema::dropIfExists('daftar_akses');
        Schema::dropIfExists('peran');
        Schema::dropIfExists('jenis_kegiatan');
        Schema::dropIfExists('jenis_dokumen');
        Schema::dropIfExists('skpd');
    }
};
