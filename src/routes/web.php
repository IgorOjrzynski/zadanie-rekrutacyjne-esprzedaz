<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('pets.index');
});

use App\Http\Controllers\PetController;

Route::resource('pets', PetController::class)->only(['index','store','update','destroy']);
