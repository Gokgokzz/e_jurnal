<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['jurnal_id', 'siswa_id', 'status'];

    // Di dalam class Absensi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}