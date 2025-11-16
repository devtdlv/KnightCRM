@extends('layouts.app')

@section('content')
    @livewire('client-notes', ['clientId' => $clientId])
@endsection

