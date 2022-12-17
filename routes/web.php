<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// Route::get('/', function () {
//     return view('display');
// });
// Route::get('addlist', function () {
//     return view('add_list');
// });
// Route::post('/save-data', [TodoController::class, 'add'])->name('save-data'); 
// Route::get('display', [TodoController::class, 'display'])->name('display');
// Route::get('edit-list/{id}', [TodoController::class, 'edit'])->name('edit-list');
// Route::post('update-list', [TodoController::class, 'update'])->name('update-list');
// Route::get('delete-list/{id}', [TodoController::class, 'delete'])->name('delete-list');









Route::resource('id', TodoController::class);