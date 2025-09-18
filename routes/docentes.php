<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.docentes');
})->name('panel');


//& ====================================================================================== Talleres
Route::get('talleres', function () {
    return view('Modules.Users.Docentes.Talleres.index');
})->name('talleres.index');

Route::get('talleres/create', function () {
    return view('Modules.Users.Docentes.Talleres.create');
})->name('talleres.create');

Route::get('talleres/{id}/edit', function ($id) {
    return view('Modules.Users.Docentes.Talleres.edit',['id' => $id]);
})->name('talleres.edit');

Route::get('talleres/{id}/read', function ($id) {
    return view('Modules.Users.Docentes.Talleres.read',['id' => $id]);
})->name('talleres.read');

//& ====================================================================================== Horarios
Route::get('horarios', function () {
    return view('Modules.Users.Docentes.Horarios.index');
})->name('horarios.index');

Route::get('horarios/create', function () {
    return view('Modules.Users.Docentes.Horarios.create');
})->name('horarios.create');

Route::get('horarios/{id}/edit', function ($id) {
    return view('Modules.Users.Docentes.Horarios.edit',['id' => $id]);
})->name('horarios.edit');

Route::get('horarios/{id}/read', function ($id) {
    return view('Modules.Users.Docentes.Horarios.read',['id' => $id]);
})->name('horarios.read');


//& ====================================================================================== Alumnos
Route::get('/usuarios/alumnos', function () {
    return view('Modules.Users.Docentes.Alumnos.index');
})->name('usuarios.alumnos.index');

Route::get('/usuarios/alumnos/{id}/', function ($id) {
    return view('Modules.Users.Docentes.Alumnos.read', ['id' => $id]);
})->name('usuarios.alumnos.read');


//& ====================================================================================== Creditos
Route::get('/usuarios/alumnos/{id}/creditos', function ($id) {
    return view('Modules.Paneles.docentes', ['id' => $id]);
})->name('usuarios.alumnos.creditos');
