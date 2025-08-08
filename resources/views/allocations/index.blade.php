@extends('dashboard')
@section('content')
    <h2>Tree Allocations</h2>
    <a href="{{ route('allocations.create') }}" class="btn btn-primary mb-3">Add New Allocation</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Institution</th>
                <th>Tree Species</th>
                <th>Quantity Allocated</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($allocations as $allocation)
                <tr>
                    <td>{{ $allocation->institution ? $allocation->institution->name : 'N/A' }}</td>
                    <td>{{ $allocation->treeSpecies ? $allocation->treeSpecies->name : 'N/A' }}</td>
                    <td>{{ $allocation->quantity_allocated }}</td>
                    <td>
                        <a href="{{ route('allocations.edit', $allocation) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('allocations.destroy', $allocation) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this allocation?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No allocations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection