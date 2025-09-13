<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.alumnos');
})->name('panel');


Route::get('/talleres', function () {
    return view('Modules.Paneles.alumnos');
})->name('talleres');

Route::get('/catalogos/talleres', function () {
    return view('Modules.Paneles.alumnos');
})->name('catalogos.talleres');

Route::get('/creditos', function () {
    return view('Modules.Paneles.alumnos');
})->name('creditos');
