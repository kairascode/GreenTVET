@extends('dashboard')
@section('title', 'Edit Tree Species')
@section('content')
    <div>
        <h2 class="mb-4">Edit Tree Species</h2>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit {{ $species->name }}</h5>
                <form action="{{ route('species.update', $species) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $species->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="climatic_conditions" class="form-label">Climatic Conditions</label>
                        <input type="text" name="climatic_conditions" class="form-control @error('climatic_conditions') is-invalid @enderror" value="{{ old('climatic_conditions', $species->climatic_conditions) }}">
                        @error('climatic_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('species.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection