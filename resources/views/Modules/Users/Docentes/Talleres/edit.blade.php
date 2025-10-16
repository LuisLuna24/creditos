@extends('layouts.docente-app')
@section('title', 'Editar taller')
@section('content')
    @livewire('modules.users.docentes.talleres.edit', ['id' => $id])
@endsection
