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
        Schema::create('absensis', function (Blueprint $table) {
            $table->increments('id_absensi');

            $table->string('nis');
            $table->foreign('nis')->references('nis')->on('siswas');

            $table->enum('status', ['sakit', 'hadir', 'izin', 'alfa'])->default('alfa');
            $table->string('foto_masuk')->nullable();
            $table->string('foto_pulang')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('menit_keterlambatan')->nullable();
            $table->integer('menit_TAP')->nullable();
            $table->date('date')->nullable();
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->string('titik_koordinat_masuk')->nullable();
            $table->string('titik_koordinat_pulang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
