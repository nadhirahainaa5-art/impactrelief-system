@extends('layouts.app')

@section('title', 'Add Staff')
@section('page_title', 'Add Staff')

@section('content')

<div class="page-header">
    <div>
        <p class="eyebrow">Admin</p>
        <h1>Add New Staff</h1>
        <p class="muted">Create new staff account.</p>
    </div>
</div>

<div class="form-shell">

    <form method="POST" action="{{ route('admin.staff.store') }}">
        @csrf

        <div class="field">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="field">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="field">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">
            Create Staff
        </button>
    </form>

</div>

@endsection