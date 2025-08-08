@extends('dashboard')
@section('content')
    <h2>Reports</h2>
    <form method="GET" action="{{ route('reports.index') }}">
        <div class="mb-3">
            <label>Institution</label>
            <select name="institution_id" class="form-control">
                <option value="">All Institutions</option>
                @foreach($institutions as $institution)
                    <option value="{{ $institution->id }}" {{ request('institution_id') == $institution->id ? 'selected' : '' }}>{{ $institution->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Date Range</label>
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>
        <button type="submit" class="btn btn-primary">Generate Report</button>
    </form>

    <h3>Allocated vs Planted</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Institution</th>
                <th>Species</th>
                <th>Allocated</th>
                <th>Planted</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allocations->groupBy('institution_id') as $institutionId => $instAllocations)
                <tr>
                    <td>{{ $instAllocations->first()->institution->name }}</td>
                    <td>{{ $instAllocations->first()->treeSpecies->name }}</td>
                    <td>{{ $instAllocations->sum('quantity_allocated') }}</td>
                    <td>{{ $plantings->where('institution_id', $institutionId)->sum('quantity_planted') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Tree Planting Locations</h3>
    <div id="map" style="height: 500px;"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script>
        // Initialize map
        var map = L.map('map').setView([-1.286389, 36.817223], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Plantings data
        const plantings = @json($plantings->whereNotNull('latitude')->whereNotNull('longitude')->map(function ($planting) {
            return [
                'latitude' => $planting->latitude,
                'longitude' => $planting->longitude,
                'popup' => "<b>Institution:</b> " . e($planting->institution->name) . "<br>" .
                           "<b>Species:</b> " . e($planting->treeSpecies->name) . "<br>" .
                           "<b>Quantity:</b> " . $planting->quantity_planted . "<br>" .
                           "<b>Date:</b> " . $planting->planting_date . "<br>" .
                           "<b>Growth Stage:</b> " . $planting->growth_stage . "<br>" .
                           ($planting->pictorial_evidence ? "<img src=\"" . asset('storage/' . $planting->pictorial_evidence) . "\" width=\"100\">" : "")
            ];
        }));

        // Add markers
        plantings.forEach(planting => {
            L.marker([planting.latitude, planting.longitude])
                .addTo(map)
                .bindPopup(planting.popup);
        });
    </script>
@endsection

