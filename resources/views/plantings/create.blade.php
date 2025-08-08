@extends('dashboard')
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
        <div class="mb-3">
            <label>Latitude</label>
            <input type="number" step="any" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}" placeholder="e.g., -1.2921">
            @error('latitude')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label>Longitude</label>
            <input type="number" step="any" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}" placeholder="e.g., 36.8219">
            @error('longitude')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button type="button" onclick="getLocation()" class="btn btn-secondary">Get Current Location</button>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                }, function(error) {
                    alert('Error getting location: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }
    </script>
@endsection