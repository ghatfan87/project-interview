<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ResponseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('IsLogin','CekRole:admin')->group(function () {
    Route::get('/data',[InterviewController::class,'data'])->name('data.admin');
    Route::delete('/hapus/{id}',[InterviewController::class,'destroy'])->name('delete');
    Route::get('/export/pdf', [InterviewController::class, 'createPDF'])->name('export.pdf');
    Route::get('/export/excel', [InterviewController::class, 'createExcel'])->name('export.excel');


});

Route::middleware('IsLogin','CekRole:petugas')->group(function () {
    Route::get('/data/petugas', [InterviewController::class,'dataPetugas'])->name('data_petugas');
    Route::get('/response/edit/{interview_id}', [ResponseController::class,'edit'])->name('response_edit');
    Route::patch('/response/update/{interview_id}', [ResponseController::class,'updateResponse'])->name('response.update');
});

Route::middleware('IsLogin', 'CekRole:admin,petugas')->group(function()
{
    Route::get('/logout',[InterviewController::class,'logout'])->name('logout');
});

Route::get('/',[InterviewController::class,'index'])->name('home');
Route::get('/login',[InterviewController::class,'login'])->name('login');
Route::post('/auth',[InterviewController::class,'auth'])->name('auth');
Route::post('/kirim-data',[InterviewController::class,'store'])->name('kirim_data');



