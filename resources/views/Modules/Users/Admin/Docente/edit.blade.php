@extends('layouts.app')
@section('title', 'Editar docente')
@section('content')
    @livewire('modules.users.admin.docente.edit',['id' => $id])
@endsection
