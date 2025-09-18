@extends('layouts.app')
@section('title', 'Editar taller')
@section('content')
    @livewire('modules.users.admin.catalogos.talleres.edit',['id' => $id])
@endsection
