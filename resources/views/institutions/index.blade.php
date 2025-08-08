@extends('dashboard')
@section('content')
    <h2>TVET Institutions</h2>
    <a href="{{ route('institutions.create') }}" class="btn btn-primary mb-3">Add New Institution</a>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Contact Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($institutions as $institution)
                <tr>
                    <td>{{ $institution->name }}</td>
                    <td>{{ $institution->location }}</td>
                    <td>{{ $institution->contact_email ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('institutions.edit', $institution) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('institutions.destroy', $institution) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this institution?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No institutions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection