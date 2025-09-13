<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.docentes');
})->name('panel');

Route::get('/catalogos/talleres', function () {
    return view('Modules.Paneles.docentes');
})->name('catalogos.talleres');

Route::get('/catalogos/horarios', function () {
    return view('Modules.Paneles.docentes');
})->name('catalogos.horarios');

Route::get('/usuarios/alumnos', function () {
    return view('Modules.Paneles.docentes');
})->name('usuarios.alumnos');

Route::get('/usuarios/alumnos/{id}/creditos', function ($id) {
    return view('Modules.Paneles.docentes', ['id'=> $id]);
})->name('usuarios.alumnos.creditos');
