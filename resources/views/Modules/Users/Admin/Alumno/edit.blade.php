@extends('layouts.app')
@section('title', 'Editar alumno')
@section('content')
    @livewire('modules.users.admin.alumno.edit', ['id' => $id])
@endsection
