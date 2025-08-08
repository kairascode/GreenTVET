@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div>
        <h2 class="mb-4">Dashboard</h2>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Allocations</h5>
                        <p class="card-text display-6">{{ number_format($total_allocations) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Plantings</h5>
                        <p class="card-text display-6">{{ number_format($total_plantings) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Institutions</h5>
                        <p class="card-text display-6">{{ number_format($total_institutions) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Tree Species</h5>
                        <p class="card-text display-6">{{ number_format($total_species) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Filters</h5>
                <form action="{{ route('dashboard') }}" method="GET">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="institution_id" class="form-label">Institution</label>
                            <select name="institution_id" class="form-control">
                                <option value="">All Institutions</option>
                                @foreach($institutions as $institution)
                                    <option value="{{ $institution->id }}" {{ $institution_id == $institution->id ? 'selected' : '' }}>
                                        {{ $institution->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_from" class="form-label">Date From</label>
                            <input type="date" name="date_from" class="form-control" value="{{ $date_from }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_to" class="form-label">Date To</label>
                            <input type="date" name="date_to" class="form-control" value="{{ $date_to }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Clear</a>
                </form>
            </div>
        </div>

        <!-- Tables and Map -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Allocations</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Institution</th>
                                        <th>Species</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($allocations as $allocation)
                                        <tr>
                                            <td>{{ $allocation->institution ? $allocation->institution->name : 'N/A' }}</td>
                                            <td>{{ $allocation->treeSpecies ? $allocation->treeSpecies->name : 'N/A' }}</td>
                                            <td>{{ $allocation->quantity_allocated }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No allocations found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Recent Plantings</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Institution</th>
                                        <th>Species</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($plantings as $planting)
                                        <tr>
                                            <td>{{ $planting->institution ? $planting->institution->name : 'N/A' }}</td>
                                            <td>{{ $planting->treeSpecies ? $planting->treeSpecies->name : 'N/A' }}</td>
                                            <td>{{ $planting->quantity_planted }}</td>
                                            <td>{{ $planting->planting_date }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No plantings found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tree Species Section -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Recent Tree Species</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Climatic Conditions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($species as $specie)
                                <tr>
                                    <td>{{ $specie->name }}</td>
                                    <td>{{ $specie->climatic_conditions }}</td>
                                    <td>
                                        <a href="{{ route('species.show', $specie) }}" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No tree species found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('species.index') }}" class="btn btn-primary">Manage Tree Species</a>
            </div>
        </div>

        <!-- Map -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Tree Planting Locations</h5>
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var map = L.map('map').setView([-1.286389, 36.817223], 6);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                function updateMap() {
                    let url = '/api/plantings';
                    const params = new URLSearchParams();
                    if($institution_id)
                        params.append('institution_id', '{{ $institution_id }}');
                    endif
                    if($date_from && $date_to)
                        params.append('date_from', '{{ $date_from }}');
                        params.append('date_to', '{{ $date_to }}');
                    endif
                    if (params.toString()) {
                        url += '?' + params.toString();
                    }

                    fetch(url)
                        .then(response => response.json())
                        .then(plantings => {
                            map.eachLayer(layer => {
                                if (layer instanceof L.Marker) map.removeLayer(layer);
                            });
                            plantings.forEach(planting => {
                                L.marker([planting.latitude, planting.longitude])
                                    .addTo(map)
                                    .bindPopup(planting.popup);
                            });
                        })
                        .catch(error => console.error('Error loading plantings:', error));
                }

                updateMap();
            });
        </script>
    </div>
@endsection