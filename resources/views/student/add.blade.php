@extends('layouts.app')

@section('content')
    @php
        try {
            echo view('livewire.student-registration')->render();
        } catch (\Throwable $e) {
            dd('BLADE ERROR:', $e->getMessage(), 'FILE:', $e->getFile(), 'LINE:', $e->getLine());
        }
    @endphp

    <livewire:student-registration :course="$course" />
@endsection