<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
    $kelas = \App\Models\Kelas::create(['nama_kelas' => 'XI RPL 2']);
    \App\Models\Mapel::create(['nama_mapel' => 'Pemrograman Web']);
    \App\Models\Siswa::create(['nama_siswa' => 'Ready', 'kelas_id' => $kelas->id]);
    \App\Models\Siswa::create(['nama_siswa' => 'Danan', 'kelas_id' => $kelas->id]);
    }   
}
