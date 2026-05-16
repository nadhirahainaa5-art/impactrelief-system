@extends('layouts.app')

@section('title', 'Purposes')

@section('content')
    <h1>Purpose List</h1>

    @auth
        @if(auth()->user()->role === 'admin')
            <div class="page-actions">
                <a href="{{ route('purposes.create') }}" class="btn">Add Purpose</a>
            </div>
        @endif
    @endauth

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purposes as $purpose)
                <tr>
                    <td>{{ $purpose->name }}</td>
                    <td>{{ $purpose->slug }}</td>
                    <td>{{ $purpose->description }}</td>
                    <td>{{ $purpose->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('purposes.edit', $purpose->id) }}" class="btn">Edit</a>
                            <form action="{{ route('purposes.destroy', $purpose->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this purpose?')">Delete</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No purposes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
