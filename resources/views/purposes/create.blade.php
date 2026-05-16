@extends('layouts.app')

@section('title', 'Add Purpose')

@section('content')
    <h1>Add Purpose</h1>

    <form action="{{ route('purposes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="is_active" class="form-control" required>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn">Save</button>
    </form>
@endsection
