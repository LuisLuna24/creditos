@extends('layouts.alumno-app')
@section('title', 'Ver taller')
@section('content')
    @livewire('modules.users.alumnos.talleres.read', ['id' => $id])
@endsection
