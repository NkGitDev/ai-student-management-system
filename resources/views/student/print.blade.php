@extends('layouts.app')

@section('content')

    @livewire('receipt', ['student' => $student])

@endsection