<?php

use App\Http\Controllers\PDFController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;



Route::get('/', [PdfController::class, 'index']);
Route::get('/generate-pdf', [PdfController::class, 'generatePdf'])->name('generate.pdf');

