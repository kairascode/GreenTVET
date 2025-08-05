@extends('partials.dashboard')
@section('content')
    <h2>Add Tree Planting</h2>
    <form action="{{ route('plantings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Institution</label>
            <select name="institution_id" class="form-control" required>
                @foreach($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Tree Species</label>
            <select name="tree_species_id" class="form-control" required>
                @foreach($species as $specie)
                    <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Quantity Planted</label>
            <input type="number" name="quantity_planted" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Planting Date</label>
            <input type="date" name="planting_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pictorial Evidence</label>
            <input type="file" name="pictorial_evidence" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection