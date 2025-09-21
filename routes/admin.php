<?php

use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.admin');
})->name('panel');

//& ====================================================================================== Talleres
Route::get('/catalogos/talleres', function () {
    return view('Modules.Users.Admin.Catalogos.Talleres.index');
})->name('catalogos.talleres.index');

Route::get('/catalogos/talleres/create', function () {
    return view('Modules.Users.Admin.Catalogos.Talleres.create');
})->name('catalogos.talleres.create');

Route::get('/catalogos/talleres/{id}/edit', function ($id) {
    return view('Modules.Users.Admin.Catalogos.Talleres.edit',['id' => $id]);
})->name('catalogos.talleres.edit');

Route::get('/catalogos/talleres/{id}/read', function ($id) {
    return view('Modules.Users.Admin.Catalogos.Talleres.read',['id' => $id]);
})->name('catalogos.talleres.read');

//& ====================================================================================== Carreras
Route::get('/catalogos/carreras', function () {
    return view('Modules.Users.Admin.Catalogos.carreras');
})->name('catalogos.carreras');

//& ====================================================================================== Dias de la semana
Route::get('/catalogos/dias_semana', function () {
    return view('Modules.Users.Admin.Catalogos.dias_semana');
})->name('catalogos.dias_semana');

//& ====================================================================================== Usuarios
Route::get('/usuarios', function () {
    return view('Modules.Users.Admin.index');
})->name('usuarios');


//& ====================================================================================== Docentes
Route::get('/usuarios/docentes', function () {
    return view('Modules.Users.Admin.Docente.index');
})->name('usuarios.docentes');

Route::get('/usuarios/docentes/create', function () {
    return view('Modules.Users.Admin.Docente.create');
})->name('usuarios.docentes.create');

Route::get('/usuarios/docentes/edit/{id}', function ($id) {
    return view('Modules.Users.Admin.Docente.edit', ['id'=> $id]);
})->name('usuarios.docentes.edit');

Route::get('/usuarios/docentes/read/{id}', function ($id) {
    return view('Modules.Users.Admin.Docente.read', ['id'=> $id]);
})->name('usuarios.docentes.read');


//& ====================================================================================== Alumnos
Route::get('/usuarios/alumnos', function () {
    return view('Modules.Users.Admin.Alumno.index');
})->name('usuarios.alumnos');

Route::get('/usuarios/alumnos/create', function () {
    return view('Modules.Users.Admin.Alumno.create');
})->name('usuarios.alumnos.create');

Route::get('/usuarios/alumnos/edit/{id}', function ($id) {
    return view('Modules.Users.Admin.Alumno.edit', ['id'=> $id]);
})->name('usuarios.alumnos.edit');

Route::get('/usuarios/alumnos/read/{id}', function ($id) {
    return view('Modules.Users.Admin.Alumno.read', ['id'=> $id]);
})->name('usuarios.alumnos.read');
