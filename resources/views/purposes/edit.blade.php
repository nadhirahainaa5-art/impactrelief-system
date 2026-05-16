@extends('layouts.app')

@section('title', 'Edit Purpose')

@section('content')
    <h1>Edit Purpose</h1>

    <form action="{{ route('purposes.update', $purpose->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $purpose->name }}" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $purpose->description }}</textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control" required>
                <option value="1" {{ $purpose->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$purpose->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn">Update</button>
    </form>
@endsection
