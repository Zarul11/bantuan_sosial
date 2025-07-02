<?php

use App\Livewire\AssessmentIndex;
use App\Http\Livewire\PenerimaBantuanIndex;
use Illuminate\Support\Facades\Route;

Route::get('/assessment', AssessmentIndex::class);
Route::get('/penerima-bantuan', PenerimaBantuanIndex::class);