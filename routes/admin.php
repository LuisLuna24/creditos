<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.admin');
})->name('panel');

Route::get('/catalogos/talleres', function () {
    return view('dashboard');
})->name('catalogos.talleres');

Route::get('/catalogos/carreras', function () {
    return view('dashboard');
})->name('catalogos.carreras');

Route::get('/catalogos/dias_semana', function () {
    return view('dashboard');
})->name('catalogos.dias_semana');

Route::get('/usuarios/docentes', function () {
    return view('dashboard');
})->name('usuarios.docentes');

Route::get('/usuarios/alumnos', function () {
    return view('dashboard');
})->name('usuarios.alumnos');
