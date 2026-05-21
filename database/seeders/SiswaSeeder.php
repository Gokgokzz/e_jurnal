<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $kelas_id = 1; 

        $dataSiswa = [
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Alfonda Frederick Karmacenna Ritonga', 'no_absen' => 1],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Anak Agung Kompyang Agung Ardhinata Sanjaya', 'no_absen' => 2],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Anak Agung Laksmi Bintang Indryani', 'no_absen' => 3],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Anak Agung Ngurah Agung Kusuma Yoga', 'no_absen' => 4],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Anindhita Anjani Putri Kusumadjaya', 'no_absen' => 5],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Dewa Putu Kresna Putra Pratama', 'no_absen' => 6],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Dieva Nayzila Putri', 'no_absen' => 7],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Dimas Kurniawan Haqiqi', 'no_absen' => 8],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Falihah Nailatusy Syarafah', 'no_absen' => 9],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Gede Prabha Dananjaya', 'no_absen' => 10],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Gede Putra Wijaya', 'no_absen' => 11],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Gede Dharma Sumanditha Yasa', 'no_absen' => 12],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Gede Sastra Wiguna', 'no_absen' => 13],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Gusti Agung Made Damma AriKusuma', 'no_absen' => 14],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Gusti Ayu Ari Marcella Setiawan', 'no_absen' => 15],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Kadek Ready Udiyana Priananda', 'no_absen' => 16],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Ketut Margayu Sinartha', 'no_absen' => 17],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Komang Agus Anggara Dipa', 'no_absen' => 18],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Komang Arya Putra Widnyana', 'no_absen' => 19],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Komang Widi Astawa Jaya', 'no_absen' => 20],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Made Adiputra Sedana', 'no_absen' => 21],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Made Danuyasa', 'no_absen' => 22],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Made Okta Dwi Samiartha', 'no_absen' => 23],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Nyoman Arta Suputra', 'no_absen' => 24],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Putu Bagas Wikananda', 'no_absen' => 25], 
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Putu Egik Krisnanta', 'no_absen' => 26],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Putu Radisthyana Paramarta', 'no_absen' => 27],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'I Wayan Trijata Ananda Putra', 'no_absen' => 28],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Ida Ayu Anggie Aristya Nareswari', 'no_absen' => 29],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Ida Bagus Mas Candra Wibawa', 'no_absen' => 30],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Ida Bagus Putu Sanjaya', 'no_absen' => 31],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Kadek Agus Arya Pranata', 'no_absen' => 32],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Kadek Jaya Pratama Tanuwibawa', 'no_absen' => 33],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'M. Rafi Anwar', 'no_absen' => 34],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Moch Ilham Fathurohman Iswahyudi', 'no_absen' => 35],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Nadilla Udayani', 'no_absen' => 36],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Ni Kadek Sri Devi Dharmaning Putri', 'no_absen' => 37],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Ni Made Dinda Putri Surandina', 'no_absen' => 38],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Ni Putu Srie Cahya Wulandari', 'no_absen' => 39],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Pande Putu JanmaJyestha Khuswanta', 'no_absen' => 40],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Putu Meyta Saskya Putri', 'no_absen' => 41],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Rizky Ramadhan', 'no_absen' => 42],
    ['kelas_id' => $kelas_id, 'nama_siswa' => 'Surya Nur Hardiwan Saputra', 'no_absen' => 43],
];

        DB::table('siswas')->insert($dataSiswa);
    }
}