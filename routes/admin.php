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


Route::get('/usuarios', function () {
    return view('Modules.Users.Admin.index');
})->name('usuarios');



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
