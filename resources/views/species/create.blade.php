@extends('dashboard')
@section('title', 'Create Tree Species')
@section('content')
    <div>
        <h2 class="mb-4">Create Tree Species</h2>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add New Species</h5>
                <form action="{{ route('species.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="climatic_conditions" class="form-label">Climatic Conditions</label>
                        <input type="text" name="climatic_conditions" class="form-control @error('climatic_conditions') is-invalid @enderror" value="{{ old('climatic_conditions') }}">
                        @error('climatic_conditions')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('species.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection