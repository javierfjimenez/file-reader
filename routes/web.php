<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload', [FileController::class, 'showForm'])->name('upload.form');
Route::post('/process-files', [FileController::class, 'processFiles'])->name('process.files');


Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/files/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->name('files.show');