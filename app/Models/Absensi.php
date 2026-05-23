<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['jurnal_id', 'siswa_id', 'status'];

    public function siswa()
    {
        // Parameter 'siswa_id' adalah foreign key di tabel absensis
        // Parameter 'id' adalah primary key di tabel siswas
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}