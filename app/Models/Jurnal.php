<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi
    protected $fillable = [
        'tanggal',
        'user_id',
        'mapel_id',
        'kelas_id',
        'jam_pelajaran',
        'pertemuan_ke',
        'materi',
        'dokumentasi'
    ];

    // Relasi ke Guru (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Mata Pelajaran
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // Relasi ke Absensi (Satu jurnal punya banyak catatan absen)
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}