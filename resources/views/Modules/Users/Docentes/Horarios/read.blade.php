@extends('layouts.docente-app')
@section('title', 'Ver horario')
@section('content')
    @livewire('modules.users.docentes.horarios.read',['id' => $id])
@endsection
