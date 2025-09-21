@extends('layouts.alumno-app')
@section('title', 'Ver creditos')
@section('content')
    @livewire('modules.users.alumnos.creditos.read', ['id' => $id])
@endsection
