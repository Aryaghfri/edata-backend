<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== SKPD ====================
        DB::table('skpd')->insert([
            [
                'kode_skpd' => '1.01.01',
                'nama_skpd' => 'Dinas Komunikasi dan Informatika',
                'alamat_skpd' => 'Jl. Merdeka No. 10, Kota Malang',
                'nomor_telepon' => '0341-234567',
                'email' => 'info@diskominfo.malangkota.go.id',
                'website' => 'https://diskominfo.malangkota.go.id',
                'tanggal_dibentuk' => '2000-01-15',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '1.01.02',
                'nama_skpd' => 'Dinas Pendidikan',
                'alamat_skpd' => 'Jl. Veteran No. 5, Kota Malang',
                'nomor_telepon' => '0341-345678',
                'email' => 'info@disdik.malangkota.go.id',
                'website' => 'https://disdik.malangkota.go.id',
                'tanggal_dibentuk' => '1995-05-15',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '1.02.01',
                'nama_skpd' => 'Dinas Kesehatan',
                'alamat_skpd' => 'Jl. Simpang Panji Suroso No. 18, Kota Malang',
                'nomor_telepon' => '0341-456789',
                'email' => 'info@dinkes.malangkota.go.id',
                'website' => 'https://dinkes.malangkota.go.id',
                'tanggal_dibentuk' => '1998-03-20',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '1.03.01',
                'nama_skpd' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'alamat_skpd' => 'Jl. Bingkil No. 1, Kota Malang',
                'nomor_telepon' => '0341-567890',
                'email' => 'info@dpupr.malangkota.go.id',
                'website' => 'https://dpupr.malangkota.go.id',
                'tanggal_dibentuk' => '2001-07-10',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '2.01.01',
                'nama_skpd' => 'Dinas Sosial',
                'alamat_skpd' => 'Jl. Raya Sulfat No. 22, Kota Malang',
                'nomor_telepon' => '0341-678901',
                'email' => 'info@dinsos.malangkota.go.id',
                'website' => 'https://dinsos.malangkota.go.id',
                'tanggal_dibentuk' => '2003-09-01',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '2.02.01',
                'nama_skpd' => 'Dinas Pertanian dan Ketahanan Pangan',
                'alamat_skpd' => 'Jl. Raya Gadang No. 3, Kota Malang',
                'nomor_telepon' => '0341-789012',
                'email' => 'info@distanpangan.malangkota.go.id',
                'website' => 'https://distanpangan.malangkota.go.id',
                'tanggal_dibentuk' => '2005-02-28',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '3.01.01',
                'nama_skpd' => 'Badan Perencanaan Pembangunan Daerah',
                'alamat_skpd' => 'Jl. Tugu No. 1, Kota Malang',
                'nomor_telepon' => '0341-890123',
                'email' => 'info@bappeda.malangkota.go.id',
                'website' => 'https://bappeda.malangkota.go.id',
                'tanggal_dibentuk' => '1997-01-01',
                'status_skpd' => 1,
            ],
            [
                'kode_skpd' => '3.02.01',
                'nama_skpd' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'alamat_skpd' => 'Jl. Mayjen Sungkono No. 45, Kota Malang',
                'nomor_telepon' => '0341-901234',
                'email' => 'info@disdukcapil.malangkota.go.id',
                'website' => 'https://disdukcapil.malangkota.go.id',
                'tanggal_dibentuk' => '2002-06-15',
                'status_skpd' => 1,
            ],
        ]);

        // ==================== JENIS DOKUMEN ====================
        DB::table('jenis_dokumen')->insert([
            ['nama_jenis_dokumen' => 'Dokumentasi Foto'],
            ['nama_jenis_dokumen' => 'Surat Tugas'],
            ['nama_jenis_dokumen' => 'Laporan Kegiatan'],
            ['nama_jenis_dokumen' => 'Notulensi Rapat'],
            ['nama_jenis_dokumen' => 'Daftar Hadir'],
            ['nama_jenis_dokumen' => 'Materi Presentasi'],
            ['nama_jenis_dokumen' => 'Surat Undangan'],
            ['nama_jenis_dokumen' => 'Berita Acara'],
        ]);

        // ==================== JENIS KEGIATAN ====================
        DB::table('jenis_kegiatan')->insert([
            ['nama_jenis_kegiatan' => 'sosialisasi'],
            ['nama_jenis_kegiatan' => 'pembinaan'],
            ['nama_jenis_kegiatan' => 'pelatihan'],
            ['nama_jenis_kegiatan' => 'monitoring'],
            ['nama_jenis_kegiatan' => 'evaluasi'],
        ]);

        // ==================== PERAN ====================
        DB::table('peran')->insert([
            ['kode_peran' => 1, 'nama_peran' => 'kepala bidang'],
            ['kode_peran' => 2, 'nama_peran' => 'operator'],
            ['kode_peran' => 3, 'nama_peran' => 'tim dokumentasi'],
            ['kode_peran' => 4, 'nama_peran' => 'superadmin'],
        ]);

        // ==================== DAFTAR AKSES ====================
        DB::table('daftar_akses')->insert([
            ['jenis_akses' => 'input kegiatan'],
            ['jenis_akses' => 'input dokumen'],
            ['jenis_akses' => 'verifikasi kegiatan'],
            ['jenis_akses' => 'publikasi'],
        ]);

        // ==================== PEGAWAI ====================
        DB::table('pegawai')->insert([
            // --- Diskominfo (SKPD 1) ---
            [
                'idSKPD' => 1,
                'NIP' => '197001011995031001',
                'nama_pegawai' => 'Dr. Budi Santoso',
                'alamat_pegawai' => 'Jl. Ijen No. 15, Kota Malang',
                'email' => 'budi.santoso@diskominfo.malangkota.go.id',
                'nomor_telepon' => '081234567890',
                'gelar_depan' => 'Dr.',
                'gelar_belakang' => 'M.Eng',
                'agama' => 'Islam',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1970-01-01',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '1995-03-01',
                'tanggal_berhenti' => '2030-01-01',
                'status_pegawai' => 1,
            ],
            [
                'idSKPD' => 1,
                'NIP' => '198505102010022002',
                'nama_pegawai' => 'Dewi Lestari',
                'alamat_pegawai' => 'Jl. Kamboja No. 5, Kota Malang',
                'email' => 'dewi.lestari@diskominfo.malangkota.go.id',
                'nomor_telepon' => '085678901234',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.Kom',
                'agama' => 'Kristen',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1985-05-10',
                'jenis_kelamin' => 'P',
                'status_kawin' => 'Belum Menikah',
                'tanggal_diangkat' => '2010-02-20',
                'tanggal_berhenti' => '2045-05-10',
                'status_pegawai' => 1,
            ],
            [
                'idSKPD' => 1,
                'NIP' => '199003152015031003',
                'nama_pegawai' => 'Doni Pratama',
                'alamat_pegawai' => 'Jl. Soekarno Hatta No. 7, Kota Malang',
                'email' => 'doni.pratama@diskominfo.malangkota.go.id',
                'nomor_telepon' => '085678901000',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.Kom',
                'agama' => 'Islam',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1990-03-15',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2015-03-01',
                'tanggal_berhenti' => '2050-03-15',
                'status_pegawai' => 1,
            ],
            [
                'idSKPD' => 1,
                'NIP' => '199207122016042004',
                'nama_pegawai' => 'Ani Widya',
                'alamat_pegawai' => 'Jl. Melati No. 5, Kota Malang',
                'email' => 'ani.widya@diskominfo.malangkota.go.id',
                'nomor_telepon' => '085678801002',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.Kom, M.Kom',
                'agama' => 'Katolik',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1992-07-12',
                'jenis_kelamin' => 'P',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2016-04-01',
                'tanggal_berhenti' => '2052-07-12',
                'status_pegawai' => 1,
            ],
            [
                'idSKPD' => 1,
                'NIP' => '196501011990031005',
                'nama_pegawai' => 'Wawan Setiawan',
                'alamat_pegawai' => 'Jl. Veteran No. 99, Kota Malang',
                'email' => 'wawan.setiawan@diskominfo.malangkota.go.id',
                'nomor_telepon' => '081234000999',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.T',
                'agama' => 'Islam',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1965-01-01',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '1990-03-01',
                'tanggal_berhenti' => '2025-01-01',
                'status_pegawai' => 1,
            ],

            // --- Dinas Pendidikan (SKPD 2) ---
            [
                'idSKPD' => 2,
                'NIP' => '198901152015032006',
                'nama_pegawai' => 'Siti Rahmawati',
                'alamat_pegawai' => 'Jl. Kenanga No. 12, Kota Malang',
                'email' => 'siti.rahmawati@disdik.malangkota.go.id',
                'nomor_telepon' => '081223344556',
                'gelar_depan' => '',
                'gelar_belakang' => 'M.Pd',
                'agama' => 'Islam',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '1989-01-15',
                'jenis_kelamin' => 'P',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2015-03-01',
                'tanggal_berhenti' => '2049-01-15',
                'status_pegawai' => 1,
            ],
            [
                'idSKPD' => 2,
                'NIP' => '197511202000121007',
                'nama_pegawai' => 'Ir. Agus Prasetyo',
                'alamat_pegawai' => 'Jl. Melur No. 8, Kota Malang',
                'email' => 'agus.prasetyo@disdik.malangkota.go.id',
                'nomor_telepon' => '082233445566',
                'gelar_depan' => 'Ir.',
                'gelar_belakang' => 'M.Sc',
                'agama' => 'Islam',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1975-11-20',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2000-12-01',
                'tanggal_berhenti' => '2035-11-20',
                'status_pegawai' => 1,
            ],

            // --- Dinas Kesehatan (SKPD 3) ---
            [
                'idSKPD' => 3,
                'NIP' => '198203052007032008',
                'nama_pegawai' => 'dr. Ratna Sari',
                'alamat_pegawai' => 'Jl. Candi Panggung No. 20, Kota Malang',
                'email' => 'ratna.sari@dinkes.malangkota.go.id',
                'nomor_telepon' => '081345678901',
                'gelar_depan' => 'dr.',
                'gelar_belakang' => 'M.Kes',
                'agama' => 'Islam',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '1982-03-05',
                'jenis_kelamin' => 'P',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2007-03-01',
                'tanggal_berhenti' => '2042-03-05',
                'status_pegawai' => 1,
            ],
            [
                'idSKPD' => 3,
                'NIP' => '199108222018011009',
                'nama_pegawai' => 'Eko Yulianto',
                'alamat_pegawai' => 'Jl. Dieng No. 33, Kota Malang',
                'email' => 'eko.yulianto@dinkes.malangkota.go.id',
                'nomor_telepon' => '085712345678',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.KM',
                'agama' => 'Islam',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1991-08-22',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Belum Menikah',
                'tanggal_diangkat' => '2018-01-01',
                'tanggal_berhenti' => '2051-08-22',
                'status_pegawai' => 1,
            ],

            // --- DPUPR (SKPD 4) ---
            [
                'idSKPD' => 4,
                'NIP' => '198607142012011010',
                'nama_pegawai' => 'Hendra Wijaya',
                'alamat_pegawai' => 'Jl. Tidar No. 55, Kota Malang',
                'email' => 'hendra.wijaya@dpupr.malangkota.go.id',
                'nomor_telepon' => '081256789012',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.T, M.T',
                'agama' => 'Hindu',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '1986-07-14',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2012-01-01',
                'tanggal_berhenti' => '2046-07-14',
                'status_pegawai' => 1,
            ],

            // --- Dinas Sosial (SKPD 5) ---
            [
                'idSKPD' => 5,
                'NIP' => '199305182019032011',
                'nama_pegawai' => 'Maya Puspita',
                'alamat_pegawai' => 'Jl. Borobudur No. 17, Kota Malang',
                'email' => 'maya.puspita@dinsos.malangkota.go.id',
                'nomor_telepon' => '085867890123',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.Sos',
                'agama' => 'Islam',
                'tempat_lahir' => 'Kediri',
                'tanggal_lahir' => '1993-05-18',
                'jenis_kelamin' => 'P',
                'status_kawin' => 'Belum Menikah',
                'tanggal_diangkat' => '2019-03-01',
                'tanggal_berhenti' => '2053-05-18',
                'status_pegawai' => 1,
            ],

            // --- Bappeda (SKPD 7) ---
            [
                'idSKPD' => 7,
                'NIP' => '197805102003021012',
                'nama_pegawai' => 'Bambang Hermawan',
                'alamat_pegawai' => 'Jl. Tugu No. 3, Kota Malang',
                'email' => 'bambang.hermawan@bappeda.malangkota.go.id',
                'nomor_telepon' => '081367890123',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.E, M.Si',
                'agama' => 'Islam',
                'tempat_lahir' => 'Blitar',
                'tanggal_lahir' => '1978-05-10',
                'jenis_kelamin' => 'L',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2003-02-01',
                'tanggal_berhenti' => '2038-05-10',
                'status_pegawai' => 1,
            ],

            // --- Disdukcapil (SKPD 8) ---
            [
                'idSKPD' => 8,
                'NIP' => '198812012014032013',
                'nama_pegawai' => 'Lina Marlina',
                'alamat_pegawai' => 'Jl. Arjuno No. 9, Kota Malang',
                'email' => 'lina.marlina@disdukcapil.malangkota.go.id',
                'nomor_telepon' => '085890123456',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.H',
                'agama' => 'Islam',
                'tempat_lahir' => 'Malang',
                'tanggal_lahir' => '1988-12-01',
                'jenis_kelamin' => 'P',
                'status_kawin' => 'Menikah',
                'tanggal_diangkat' => '2014-03-01',
                'tanggal_berhenti' => '2048-12-01',
                'status_pegawai' => 1,
            ],
        ]);

        // ==================== AKUN ====================
        // Password semua akun: Password123!
        $pw = Hash::make('Password123!');

        DB::table('akun')->insert([
            // Kepala Bidang
            ['username' => 'budi.kabid',    'idPeran' => 1, 'idPegawai' => 1,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-10 08:00:00'],
            // Operator
            ['username' => 'dewi.op',       'idPeran' => 2, 'idPegawai' => 2,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-10 09:00:00'],
            ['username' => 'ratna.op',      'idPeran' => 2, 'idPegawai' => 8,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-09 14:00:00'],
            // Tim Dokumentasi
            ['username' => 'doni.dok',      'idPeran' => 3, 'idPegawai' => 3,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-10 09:30:00'],
            ['username' => 'ani.dok',       'idPeran' => 3, 'idPegawai' => 4,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-10 10:00:00'],
            ['username' => 'siti.dok',      'idPeran' => 3, 'idPegawai' => 6,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-09 15:00:00'],
            ['username' => 'agus.dok',      'idPeran' => 3, 'idPegawai' => 7,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-09 16:00:00'],
            // Super Admin
            ['username' => 'wawan.admin',   'idPeran' => 4, 'idPegawai' => 5,  'password_hash' => $pw, 'status_akun' => 1, 'akses_terakhir' => '2026-05-10 07:00:00'],
        ]);

        // ==================== HAK AKSES AKUN ====================
        DB::table('hak_akses_akun')->insert([
            // Kabid → verifikasi + publikasi
            ['idAkun' => 1, 'idAkses' => 3],
            ['idAkun' => 1, 'idAkses' => 4],
            // Operator → input kegiatan
            ['idAkun' => 2, 'idAkses' => 1],
            ['idAkun' => 3, 'idAkses' => 1],
            // Tim Dok → input dokumen
            ['idAkun' => 4, 'idAkses' => 2],
            ['idAkun' => 5, 'idAkses' => 2],
            ['idAkun' => 6, 'idAkses' => 2],
            ['idAkun' => 7, 'idAkses' => 2],
            // Admin → semua
            ['idAkun' => 8, 'idAkses' => 1],
            ['idAkun' => 8, 'idAkses' => 2],
            ['idAkun' => 8, 'idAkses' => 3],
            ['idAkun' => 8, 'idAkses' => 4],
        ]);

        // ==================== KEGIATAN ====================
        DB::table('kegiatan')->insert([
            // --- Kegiatan oleh Dewi (operator, idPegawai=2) ---

            // 1. Sudah diverifikasi & publik
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 2,
                'nama_kegiatan' => 'Sosialisasi Sensus Ekonomi 2026',
                'lokasi' => 'Balai Kota Malang', 'waktu' => '2025-03-15',
                'anggaran' => 15000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Dokumentasi lengkap, disetujui.', 'publikasi' => 1,
            ],
            // 2. Sudah diverifikasi & publik
            [
                'idJenis_kegiatan' => 2, 'idPegawai' => 2,
                'nama_kegiatan' => 'Pembinaan Teknis Pengisian Data Statistik Sektoral',
                'lokasi' => 'Ruang Rapat Diskominfo Lt. 3', 'waktu' => '2025-04-22',
                'anggaran' => 8500000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Sesuai prosedur.', 'publikasi' => 1,
            ],
            // 3. Menunggu verifikasi (dokumen sudah dikirim)
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 2,
                'nama_kegiatan' => 'Sosialisasi Perlindungan Data Pribadi',
                'lokasi' => 'Hotel Aria Gajayana, Malang', 'waktu' => '2025-06-10',
                'anggaran' => 25000000.00, 'verifikasi' => 1,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],
            // 4. Ditolak Kabid
            [
                'idJenis_kegiatan' => 3, 'idPegawai' => 2,
                'nama_kegiatan' => 'Pelatihan Keamanan Siber untuk ASN',
                'lokasi' => 'Lab Komputer Diskominfo', 'waktu' => '2025-07-05',
                'anggaran' => 12000000.00, 'verifikasi' => 3,
                'catatan_verifikasi' => 'Surat tugas tidak sesuai format. Mohon upload ulang.', 'publikasi' => 0,
            ],
            // 5. Draft (belum ada dokumen)
            [
                'idJenis_kegiatan' => 4, 'idPegawai' => 2,
                'nama_kegiatan' => 'Monitoring Jaringan Internet Kelurahan',
                'lokasi' => 'Kelurahan Lowokwaru', 'waktu' => '2025-08-20',
                'anggaran' => 5000000.00, 'verifikasi' => 0,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],
            // 6. Draft (belum ada dokumen)
            [
                'idJenis_kegiatan' => 5, 'idPegawai' => 2,
                'nama_kegiatan' => 'Evaluasi Penerapan SPBE Kota Malang',
                'lokasi' => 'Aula Diskominfo', 'waktu' => '2025-09-12',
                'anggaran' => 7500000.00, 'verifikasi' => 0,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],

            // --- Kegiatan lintas SKPD (tetap oleh Dewi) ---
            // 7. Sudah diverifikasi & publik
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 2,
                'nama_kegiatan' => 'Sosialisasi Program Stunting Terpadu',
                'lokasi' => 'GOR Ken Arok, Malang', 'waktu' => '2025-05-08',
                'anggaran' => 35000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Sangat baik, kegiatan berjalan lancar.', 'publikasi' => 1,
            ],
            // 8. Menunggu verifikasi
            [
                'idJenis_kegiatan' => 2, 'idPegawai' => 2,
                'nama_kegiatan' => 'Pembinaan Administrasi Kependudukan Desa',
                'lokasi' => 'Kecamatan Kedungkandang', 'waktu' => '2025-07-18',
                'anggaran' => 10000000.00, 'verifikasi' => 1,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],

            // --- Kegiatan oleh Ratna (operator, idPegawai=8) ---
            // 9. Sudah diverifikasi
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 8,
                'nama_kegiatan' => 'Sosialisasi Perilaku Hidup Bersih dan Sehat (PHBS)',
                'lokasi' => 'Puskesmas Kendalsari', 'waktu' => '2025-02-14',
                'anggaran' => 6000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Bagus, lanjutkan ke puskesmas lain.', 'publikasi' => 1,
            ],
            // 10. Menunggu verifikasi
            [
                'idJenis_kegiatan' => 3, 'idPegawai' => 8,
                'nama_kegiatan' => 'Pelatihan Kader Posyandu',
                'lokasi' => 'Aula Dinkes Kota Malang', 'waktu' => '2025-08-05',
                'anggaran' => 18000000.00, 'verifikasi' => 1,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],
            // 11. Draft
            [
                'idJenis_kegiatan' => 4, 'idPegawai' => 8,
                'nama_kegiatan' => 'Monitoring Capaian Imunisasi Dasar Lengkap',
                'lokasi' => 'Puskesmas Arjuno', 'waktu' => '2025-09-25',
                'anggaran' => 4500000.00, 'verifikasi' => 0,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],
            // 12. Draft
            [
                'idJenis_kegiatan' => 2, 'idPegawai' => 8,
                'nama_kegiatan' => 'Pembinaan Teknis Surveilans Penyakit Menular',
                'lokasi' => 'Gedung Diklat Dinkes', 'waktu' => '2025-10-10',
                'anggaran' => 9000000.00, 'verifikasi' => 0,
                'catatan_verifikasi' => null, 'publikasi' => 0,
            ],

            // 13. Tahun 2024 (untuk statistik chart)
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 2,
                'nama_kegiatan' => 'Sosialisasi Smart City Kota Malang',
                'lokasi' => 'Balai Kota Malang', 'waktu' => '2024-04-20',
                'anggaran' => 20000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Kegiatan selesai dengan baik.', 'publikasi' => 1,
            ],
            // 14. Tahun 2024
            [
                'idJenis_kegiatan' => 2, 'idPegawai' => 2,
                'nama_kegiatan' => 'Pembinaan Pengelolaan Website OPD',
                'lokasi' => 'Lab Komputer Diskominfo', 'waktu' => '2024-09-15',
                'anggaran' => 7000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Disetujui.', 'publikasi' => 1,
            ],
            // 15. Tahun 2023
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 2,
                'nama_kegiatan' => 'Sosialisasi E-Government untuk Kelurahan',
                'lokasi' => 'Kecamatan Blimbing', 'waktu' => '2023-06-12',
                'anggaran' => 10000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Selesai.', 'publikasi' => 1,
            ],
            // 16. Tahun 2023
            [
                'idJenis_kegiatan' => 3, 'idPegawai' => 8,
                'nama_kegiatan' => 'Pelatihan Penanganan Gizi Buruk',
                'lokasi' => 'RS Saiful Anwar Malang', 'waktu' => '2023-11-05',
                'anggaran' => 22000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Selesai dan disetujui.', 'publikasi' => 1,
            ],
            // 17. Tahun 2022
            [
                'idJenis_kegiatan' => 1, 'idPegawai' => 2,
                'nama_kegiatan' => 'Sosialisasi Mal Pelayanan Publik',
                'lokasi' => 'Mal Pelayanan Publik Kota Malang', 'waktu' => '2022-08-01',
                'anggaran' => 12000000.00, 'verifikasi' => 2,
                'catatan_verifikasi' => 'Disetujui.', 'publikasi' => 1,
            ],
        ]);

        // ==================== SKPD_KEGIATAN (pivot) ====================
        DB::table('skpd_kegiatan')->insert([
            // Kegiatan 1-6: Diskominfo
            ['idKegiatan' => 1, 'idSKPD' => 1],
            ['idKegiatan' => 2, 'idSKPD' => 1],
            ['idKegiatan' => 3, 'idSKPD' => 1],
            ['idKegiatan' => 4, 'idSKPD' => 1],
            ['idKegiatan' => 5, 'idSKPD' => 1],
            ['idKegiatan' => 6, 'idSKPD' => 1],
            // Kegiatan 7: Lintas (Dinkes + Dinsos + Bappeda)
            ['idKegiatan' => 7, 'idSKPD' => 3],
            ['idKegiatan' => 7, 'idSKPD' => 5],
            ['idKegiatan' => 7, 'idSKPD' => 7],
            // Kegiatan 8: Disdukcapil
            ['idKegiatan' => 8, 'idSKPD' => 8],
            // Kegiatan 9-12: Dinkes
            ['idKegiatan' => 9, 'idSKPD' => 3],
            ['idKegiatan' => 10, 'idSKPD' => 3],
            ['idKegiatan' => 11, 'idSKPD' => 3],
            ['idKegiatan' => 12, 'idSKPD' => 3],
            // Kegiatan historis
            ['idKegiatan' => 13, 'idSKPD' => 1],
            ['idKegiatan' => 14, 'idSKPD' => 1],
            ['idKegiatan' => 15, 'idSKPD' => 1],
            ['idKegiatan' => 16, 'idSKPD' => 3],
            ['idKegiatan' => 17, 'idSKPD' => 1],
            ['idKegiatan' => 17, 'idSKPD' => 8], // lintas SKPD
        ]);

        // ==================== DOKUMEN ====================
        DB::table('dokumen')->insert([
            // --- Kegiatan 1: Sosialisasi Sensus (verifikasi=2, publik) ---
            [
                'nomor_dokumen' => 'DOK/2025/001', 'nama_dokumen' => 'Foto Kegiatan Sosialisasi Sensus Ekonomi',
                'idKegiatan' => 1, 'idJenis_dokumen' => 1, 'idPegawai' => 3,
                'upload_file' => 'uploads/foto-sensus-2025.jpg', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/002', 'nama_dokumen' => 'Surat Tugas Sosialisasi Sensus Ekonomi',
                'idKegiatan' => 1, 'idJenis_dokumen' => 2, 'idPegawai' => 3,
                'upload_file' => 'uploads/st-sensus-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/003', 'nama_dokumen' => 'Daftar Hadir Sosialisasi Sensus Ekonomi',
                'idKegiatan' => 1, 'idJenis_dokumen' => 5, 'idPegawai' => 3,
                'upload_file' => 'uploads/hadir-sensus-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],

            // --- Kegiatan 2: Pembinaan Teknis (verifikasi=2, publik) ---
            [
                'nomor_dokumen' => 'DOK/2025/004', 'nama_dokumen' => 'Laporan Pembinaan Teknis Data Statistik',
                'idKegiatan' => 2, 'idJenis_dokumen' => 3, 'idPegawai' => 4,
                'upload_file' => 'uploads/lap-pembinaan-stat-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/005', 'nama_dokumen' => 'Materi Presentasi Pengisian Data Sektoral',
                'idKegiatan' => 2, 'idJenis_dokumen' => 6, 'idPegawai' => 4,
                'upload_file' => 'uploads/materi-stat-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/006', 'nama_dokumen' => 'Notulensi Pembinaan Teknis',
                'idKegiatan' => 2, 'idJenis_dokumen' => 4, 'idPegawai' => 4,
                'upload_file' => 'uploads/notul-pembinaan-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],

            // --- Kegiatan 3: Sosialisasi PDP (menunggu verifikasi) ---
            [
                'nomor_dokumen' => 'DOK/2025/007', 'nama_dokumen' => 'Foto Sosialisasi Perlindungan Data Pribadi',
                'idKegiatan' => 3, 'idJenis_dokumen' => 1, 'idPegawai' => 3,
                'upload_file' => 'uploads/foto-pdp-2025.jpg', 'verifikasi' => 1, 'publikasi' => 0,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/008', 'nama_dokumen' => 'Surat Tugas Sosialisasi PDP',
                'idKegiatan' => 3, 'idJenis_dokumen' => 2, 'idPegawai' => 3,
                'upload_file' => 'uploads/st-pdp-2025.pdf', 'verifikasi' => 1, 'publikasi' => 0,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/009', 'nama_dokumen' => 'Surat Undangan Sosialisasi PDP',
                'idKegiatan' => 3, 'idJenis_dokumen' => 7, 'idPegawai' => 3,
                'upload_file' => 'uploads/undangan-pdp-2025.pdf', 'verifikasi' => 1, 'publikasi' => 0,
            ],

            // --- Kegiatan 4: Pelatihan Siber (ditolak, verifikasi=3) ---
            [
                'nomor_dokumen' => 'DOK/2025/010', 'nama_dokumen' => 'Foto Pelatihan Keamanan Siber',
                'idKegiatan' => 4, 'idJenis_dokumen' => 1, 'idPegawai' => 4,
                'upload_file' => 'uploads/foto-siber-2025.jpg', 'verifikasi' => 3, 'publikasi' => 0,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/011', 'nama_dokumen' => 'Surat Tugas Pelatihan Siber (salah format)',
                'idKegiatan' => 4, 'idJenis_dokumen' => 2, 'idPegawai' => 4,
                'upload_file' => 'uploads/st-siber-2025.pdf', 'verifikasi' => 3, 'publikasi' => 0,
            ],

            // --- Kegiatan 7: Stunting Terpadu (verifikasi=2, publik) ---
            [
                'nomor_dokumen' => 'DOK/2025/012', 'nama_dokumen' => 'Berita Acara Sosialisasi Stunting Terpadu',
                'idKegiatan' => 7, 'idJenis_dokumen' => 8, 'idPegawai' => 6,
                'upload_file' => 'uploads/ba-stunting-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/013', 'nama_dokumen' => 'Daftar Hadir Sosialisasi Stunting',
                'idKegiatan' => 7, 'idJenis_dokumen' => 5, 'idPegawai' => 6,
                'upload_file' => 'uploads/hadir-stunting-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/014', 'nama_dokumen' => 'Foto Kegiatan Stunting Terpadu',
                'idKegiatan' => 7, 'idJenis_dokumen' => 1, 'idPegawai' => 6,
                'upload_file' => 'uploads/foto-stunting-2025.jpg', 'verifikasi' => 2, 'publikasi' => 1,
            ],

            // --- Kegiatan 8: Pembinaan Adminduk (menunggu verifikasi) ---
            [
                'nomor_dokumen' => 'DOK/2025/015', 'nama_dokumen' => 'Laporan Pembinaan Adminduk Desa',
                'idKegiatan' => 8, 'idJenis_dokumen' => 3, 'idPegawai' => 7,
                'upload_file' => 'uploads/lap-adminduk-2025.pdf', 'verifikasi' => 1, 'publikasi' => 0,
            ],

            // --- Kegiatan 9: PHBS (verifikasi=2) ---
            [
                'nomor_dokumen' => 'DOK/2025/016', 'nama_dokumen' => 'Foto Sosialisasi PHBS di Puskesmas',
                'idKegiatan' => 9, 'idJenis_dokumen' => 1, 'idPegawai' => 6,
                'upload_file' => 'uploads/foto-phbs-2025.jpg', 'verifikasi' => 2, 'publikasi' => 1,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/017', 'nama_dokumen' => 'Materi PHBS untuk Masyarakat',
                'idKegiatan' => 9, 'idJenis_dokumen' => 6, 'idPegawai' => 6,
                'upload_file' => 'uploads/materi-phbs-2025.pdf', 'verifikasi' => 2, 'publikasi' => 1,
            ],

            // --- Kegiatan 10: Pelatihan Posyandu (menunggu verifikasi) ---
            [
                'nomor_dokumen' => 'DOK/2025/018', 'nama_dokumen' => 'Foto Pelatihan Kader Posyandu',
                'idKegiatan' => 10, 'idJenis_dokumen' => 1, 'idPegawai' => 7,
                'upload_file' => 'uploads/foto-posyandu-2025.jpg', 'verifikasi' => 1, 'publikasi' => 0,
            ],
            [
                'nomor_dokumen' => 'DOK/2025/019', 'nama_dokumen' => 'Surat Tugas Pelatihan Posyandu',
                'idKegiatan' => 10, 'idJenis_dokumen' => 2, 'idPegawai' => 7,
                'upload_file' => 'uploads/st-posyandu-2025.pdf', 'verifikasi' => 1, 'publikasi' => 0,
            ],
        ]);

        // ==================== PENYUSUN ====================
        DB::table('penyusun')->insert([
            // Doni (akun 4) → kegiatan 1, 3, 4
            ['idAkun' => 4, 'idKegiatan' => 1],
            ['idAkun' => 4, 'idKegiatan' => 3],
            ['idAkun' => 4, 'idKegiatan' => 4],
            // Ani (akun 5) → kegiatan 2, 4
            ['idAkun' => 5, 'idKegiatan' => 2],
            ['idAkun' => 5, 'idKegiatan' => 4],
            // Siti (akun 6) → kegiatan 7, 9
            ['idAkun' => 6, 'idKegiatan' => 7],
            ['idAkun' => 6, 'idKegiatan' => 9],
            // Agus (akun 7) → kegiatan 8, 10
            ['idAkun' => 7, 'idKegiatan' => 8],
            ['idAkun' => 7, 'idKegiatan' => 10],
        ]);
    }
}
