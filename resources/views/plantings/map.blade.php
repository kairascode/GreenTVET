@extends('dashboard')
@section('content')
    <h2>Tree Planting Locations</h2>
    <div id="map" style="height: 500px;"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script>
        // Initialize the map centered on Kenya
        var map = L.map('map').setView([-1.286389, 36.817223], 6); // Center on Nairobi, zoom level 6

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add markers for each tree planting
            @foreach($plantings as $planting)
            L.marker([{{ $planting->latitude }}, {{ $planting->longitude }}])
                .addTo(map)
                .bindPopup(`
                    <b>Institution:</b> {{ $planting->institution->name }}<br>
                    <b>Species:</b> {{ $planting->treeSpecies->name }}<br>
                    <b>Quantity:</b> {{ $planting->quantity_planted }}<br>
                    <b>Date:</b> {{ $planting->planting_date }}<br>
                    <b>Growth Stage:</b> {{ $planting->growth_stage }}<br>
                    @if($planting->pictorial_evidence)
                        <img src="{{ asset('storage/' . $planting->pictorial_evidence) }}" width="100">
                    @endif
                `);
        @endforeach
    </script>
@endsection