<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBantuan extends Model
{
    use HasFactory;

    protected $table = 'penerima_bantuan'; // WAJIB jika nama tabel tidak plural otomatis

    protected $fillable = [
        'nik',
        'nama',
        'jenis_kelamin',
        'alamat',
        'desa',
        'pekerjaan',
    ];

    /**
     * Relasi: Satu penerima bantuan bisa memiliki banyak assessment
     */
    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'penerima_id');
    }
}