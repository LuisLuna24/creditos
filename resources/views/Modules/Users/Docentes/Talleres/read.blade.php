@extends('layouts.docente-app')
@section('title', 'Ver taller')
@section('content')
    @livewire('modules.users.docentes.talleres.read', ['id' => $id])
@endsection
