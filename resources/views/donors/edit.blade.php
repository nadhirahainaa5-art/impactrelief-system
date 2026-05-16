@extends('layouts.app')

@section('title', 'Edit Donor')

@section('content')
    <h1>Edit Donor</h1>

    <form action="{{ route('donors.update', $donor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $donor->full_name }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $donor->email }}">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $donor->phone }}">
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $donor->address }}</textarea>
        </div>

        <div class="form-group">
            <label>Preferred Purpose</label>
            <input type="text" name="preferred_purpose" class="form-control" value="{{ $donor->preferred_purpose }}">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $donor->is_active ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$donor->is_active ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn">Update</button>
    </form>
@endsection
