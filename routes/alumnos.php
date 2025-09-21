<?php

use App\Models\creditosAlumnos;
use App\Models\horariosAlumnos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\error;

Route::get('/panel', function () {
    return view('Modules.Paneles.alumnos');
})->name('panel');


//& ====================================================================================== Talleres
Route::get('/mis_talleres', function () {
    return view('Modules.Users.Alumnos.Talleres.index');
})->name('talleres.index');

Route::get('/mis_talleres/{id}/read/', function ($id) {

    $esMiTaller = horariosAlumnos::where('alumno_id', Auth::user()->alumno->alumno_id)
        ->where('horario_alumno_id', $id)
        ->exists();

    if ($esMiTaller) {
        return view('Modules.Users.Alumnos.Talleres.read', ['id' => $id]);
    } else {
        abort(404);
    }
})->name('talleres.read');

Route::get('/talleres/inscríbete_a_un_taller', function () {
    return view('Modules.Users.Alumnos.Talleres.create');
})->name('talleres.create');

//& ====================================================================================== Horarios

Route::get('/horarios/{id}/read', function ($id) {
    return view('Modules.Users.Alumnos.Horarios.read', ['id' => $id]);
})->name('horarios.read');

//& ====================================================================================== Creditos
Route::get('/mis_creditos', function () {
    return view('Modules.Users.Alumnos.Creditos.index');
})->name('creditos.index');

Route::get('/mis_creditos/{id}/read', function ($id) {

    $esMiCredito = creditosAlumnos::where('alumno_id', Auth::user()->alumno->alumno_id)
        ->where('credito_id', $id)
        ->exists();

    if ($esMiCredito) {
        return view('Modules.Users.Alumnos.Creditos.read', ['id' => $id]);
    } else {
        abort(404);
    }
})->name('creditos.read');


//& ====================================================================================== Perfil
Route::get('/perfile', function () {
    return view('Modules.Users.Alumnos.profile');
})->name('profile');
