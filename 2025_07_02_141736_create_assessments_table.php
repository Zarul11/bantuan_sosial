<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penerima_id');
            $table->date('tanggal');
            $table->integer('pendapatan');
            $table->integer('jumlah_tanggungan');
            $table->enum('kondisi_rumah', ['Baik', 'Sedang', 'Buruk']);
            $table->boolean('status_layak'); // true: layak, false: tidak layak
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('penerima_id')
                ->references('id')->on('penerima_bantuan')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};