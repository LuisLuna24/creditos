@extends('layouts.app')
@section('title', 'Ver taller')
@section('content')
    @livewire('modules.users.admin.catalogos.talleres.read',['id' => $id])
@endsection
