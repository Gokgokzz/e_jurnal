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
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke Absensi (Satu jurnal punya banyak catatan absen)
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    // Accessor untuk format jam pelajaran
    public function getFormattedJamAttribute()
    {
        $jadwal = [
            '1' => '07:30',
            '2' => '08:10',
            '3' => '08:50',
            '4' => '09:30',
            '5' => '10:30',
            '6' => '11:10',
            '7' => '11:50',
            '8' => '12:30',
            '9' => '13:30',
            '10' => '14:10',
            '11' => '14:50',
        ];

        $input = $this->jam_pelajaran;

        // Jika input mengandung tanda hubung (range), contoh: "1-2"
        if (str_contains($input, '-')) {
            $parts = explode('-', $input);
            $start = $jadwal[$parts[0]] ?? $parts[0];
            $end = $jadwal[$parts[1]] ?? $parts[1];
            
            return $start . '-' . $end;
        }

        // Jika input angka tunggal, contoh: "7"
        return $jadwal[$input] ?? $input;
    }
}