<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model 
{
    protected $fillable = ['nama_siswa', 'kelas_id', 'no_absen'];

    // Tambahkan relasi ke Absensi agar mudah dipanggil balik jika perlu
    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'siswa_id');
    }
}