<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('penerima_bantuan', function (Blueprint $table) {
        $table->id();
        $table->string('nik', 16)->unique();
        $table->string('nama');
        $table->enum('jenis_kelamin', ['L', 'P']);
        $table->string('alamat');
        $table->string('desa');
        $table->string('pekerjaan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};