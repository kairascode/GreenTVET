@extends('dashboard')
@section('title', 'Tree Species')
@section('content')
    <div>
        <h2 class="mb-4">Tree Species</h2>

        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('species.create') }}" class="btn btn-primary mb-4">Add New Species</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Species List</h5>
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
                                        <a href="{{ route('species.edit', $specie) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('species.destroy', $specie) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
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
            </div>
        </div>
    </div>
@endsection