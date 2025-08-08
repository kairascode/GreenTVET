@extends('dashboard')
@section('title', 'Tree Species Details')
@section('content')
    <div>
        <h2 class="mb-4">Tree Species Details</h2>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $species->name }}</h5>
                <p><strong>Name:</strong> {{ $species->name }}</p>
                <p><strong>Climatic Conditions:</strong> {{ $species->climatic_conditions }}</p>
                <a href="{{ route('species.edit', $species) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('species.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection