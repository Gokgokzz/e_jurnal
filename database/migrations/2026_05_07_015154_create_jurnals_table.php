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
    Schema::create('jurnals', function (Blueprint $table) {
        $table->id(); // Tipe: Big Increments (Penting!)
        $table->date('tanggal');
        $table->foreignId('user_id')->constrained('users'); // Pastikan tabel 'users' sudah ada
        $table->foreignId('mapel_id')->constrained('mapels');
        $table->foreignId('kelas_id')->constrained('kelas');
        $table->string('jam_pelajaran');
        $table->integer('pertemuan_ke');
        $table->text('materi');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
