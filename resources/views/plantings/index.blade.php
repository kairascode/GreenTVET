@extends('dashboard')
@section('content')
    <h2>Tree Plantings</h2>
    <a href="{{ route('plantings.create') }}" class="btn btn-primary">Add Planting</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Institution</th>
                <th>Species</th>
                <th>Quantity Planted</th>
                <th>Planting Date</th>
                <th>Growth Stage</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plantings as $planting)
                <tr>
                    <td>{{ $planting->institution->name }}</td>
                    <td>{{ $planting->treeSpecies->name }}</td>
                    <td>{{ $planting->quantity_planted }}</td>
                    <td>{{ $planting->planting_date }}</td>
                    <td>{{ $planting->growth_stage }}</td>
                    <td>
                        <form action="{{ route('plantings.updateGrowthStage', $planting) }}" method="POST">
                            @csrf
                            <select name="growth_stage" onchange="this.form.submit()">
                                <option value="seedling" {{ $planting->growth_stage == 'seedling' ? 'selected' : '' }}>Seedling</option>
                                <option value="sapling" {{ $planting->growth_stage == 'sapling' ? 'selected' : '' }}>Sapling</option>
                                <option value="mature" {{ $planting->growth_stage == 'mature' ? 'selected' : '' }}>Mature</option>
                                <option value="harvested" {{ $planting->growth_stage == 'harvested' ? 'selected' : '' }}>Harvested</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection