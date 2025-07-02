<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerima_id',
        'tanggal',
        'pendapatan',
        'jumlah_tanggungan',
        'kondisi_rumah',
        'status_layak',
        'catatan',
    ];

    public function penerima()
    {
        return $this->belongsTo(PenerimaBantuan::class, 'penerima_id');
    }
}