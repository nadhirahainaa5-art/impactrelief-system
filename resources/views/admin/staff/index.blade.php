@extends('layouts.app')

@section('title', 'Staff Management')
@section('page_title', 'Staff Management')

@section('content')

<div class="page-header">
    <div>
        <p class="eyebrow">Admin</p>
        <h1>Staff Management</h1>
        <p class="muted">Manage NGO staff accounts.</p>
    </div>

    <div class="toolbar">
        <a href="{{ route('admin.staff.create') }}" class="btn">
            + Add Staff
        </a>
    </div>
</div>

<div class="table-shell">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($staff as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ ucfirst($member->role) }}</td>

                    <td>
                        <span class="badge badge-{{ $member->status }}">
                            {{ ucfirst($member->status) }}
                        </span>
                    </td>

                    <td>
                        <form method="POST" action="{{ route('admin.staff.toggle-status', $member->id) }}">
                            @csrf
                            @method('PATCH')

                            @if($member->status === 'active')
                                <button type="submit" class="btn-warning">
                                    Deactivate
                                </button>
                            @else
                                <button type="submit" class="btn">
                                    Activate
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No staff found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection