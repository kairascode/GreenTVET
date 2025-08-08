@extends('dashboard')
@section('content')
    <h2>Add New Tree Allocation</h2>
    <form action="{{ route('allocations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="institution_id" class="form-label">Institution</label>
            <select name="institution_id" id="institution_id" class="form-control @error('institution_id') is-invalid @enderror" required>
                <option value="">Select Institution</option>
                @foreach($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>
            @error('institution_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tree_species_id" class="form-label">Tree Species</label>
            <select name="tree_species_id" id="tree_species_id" class="form-control @error('tree_species_id') is-invalid @enderror" required>
                <option value="">Select Species</option>
                @foreach($species as $specie)
                    <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                @endforeach
            </select>
            @error('tree_species_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quantity_allocated" class="form-label">Quantity Allocated</label>
            <input type="number" name="quantity_allocated" id="quantity_allocated" class="form-control @error('quantity_allocated') is-invalid @enderror" value="{{ old('quantity_allocated') }}" required>
            @error('quantity_allocated')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('allocations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection