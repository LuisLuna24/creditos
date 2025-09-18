<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.alumnos');
})->name('panel');


//& ====================================================================================== Talleres
Route::get('/mis_talleres', function () {
    return view('Modules.Users.Alumnos.Talleres.index');
})->name('talleres.index');

Route::get('/mis_talleres/{id}/read/', function ($id) {
    return view('Modules.Users.Alumnos.Talleres.read');
})->name('talleres.read');

Route::get('/talleres/inscríbete_a_un_taller', function () {
    return view('Modules.Users.Alumnos.Talleres.create');
})->name('talleres.create');


//& ====================================================================================== Creditos
Route::get('/mis_creditos', function () {
    return view('Modules.Users.Alumnos.Creditos.index');
})->name('creditos.index');

Route::get('/mis_creditos/{id}/read', function ($id) {
    return view('Modules.Users.Alumnos.Creditos.read',['id' => $id]);
})->name('creditos.read');


//& ====================================================================================== Perfil
Route::get('/perfile', function () {
    return view('Modules.Users.Alumnos.profile');
})->name('profile');
