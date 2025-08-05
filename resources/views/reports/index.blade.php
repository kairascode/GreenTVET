@extends('partials.dashboard')
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
@endsection