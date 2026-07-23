@extends('layouts.app')

@section('content')
<div class="container mt-4">
        @livewire('student-enrolled', ['student' => $student, 'studentData' => $studentData])

</div>
@endsection