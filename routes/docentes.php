<?php

use App\Models\talleres;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/panel', function () {
    return view('Modules.Paneles.docentes');
})->name('panel');

Route::get('/perfil', function () {
    return view('Modules.Users.Docentes.profile');
})->name('profile');

//& ====================================================================================== Talleres
Route::get('talleres', function () {
    return view('Modules.Users.Docentes.Talleres.index');
})->name('talleres.index');

Route::get('talleres/create', function () {
    return view('Modules.Users.Docentes.Talleres.create');
})->name('talleres.create');

Route::get('talleres/{id}/edit', function ($id) {
    $docente = Auth::user()->docente->docente_id;

    $taller = talleres::findOrFail($id);
    if ($taller->docente_id !== $docente) {
        abort(403, 'No tienes permiso para ver este taller.');
    }

    return view('Modules.Users.Docentes.Talleres.edit', ['id' => $id]);
})->name('talleres.edit');

Route::get('talleres/{id}/read', function ($id) {
    $docente = Auth::user()->docente->docente_id;

    $taller = talleres::findOrFail($id);
    if ($taller->docente_id !== $docente) {
        abort(403, 'No tienes permiso para ver este taller.');
    }
    return view('Modules.Users.Docentes.Talleres.read', ['id' => $id]);
})->name('talleres.read')->middleware('auth');

//& ====================================================================================== Horarios

Route::get('horarios/{id}/read', function ($id) {
    return view('Modules.Users.Docentes.Horarios.read', ['id' => $id]);
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
