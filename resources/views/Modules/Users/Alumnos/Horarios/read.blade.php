@extends('layouts.alumno-app')
@section('title', 'Horarios del taller')
@section('content')
    @livewire('modules.users.alumnos.horarios.read',['id' => $id])
@endsection
