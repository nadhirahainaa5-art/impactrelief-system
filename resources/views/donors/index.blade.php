@extends('layouts.app')

@section('title', 'Donors')

@section('content')
    <div class="page-header">
        <div>
            <h1>Donor Directory</h1>
            <p class="muted">
                Self-register donor model is active. Staff can view donor records only, while admin may update limited donor profile details when needed.
            </p>
        </div>
    </div>

    <div class="table-shell">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Preferred Purpose</th>
                    <th>Total Donations</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($donors as $donor)
                    <tr>
                        <td>{{ $donor->full_name }}</td>
                        <td>{{ $donor->email ?? '-' }}</td>
                        <td>{{ $donor->phone ?? '-' }}</td>
                        <td>{{ $donor->preferred_purpose ?? '-' }}</td>
                        <td>{{ $donor->donations_count }}</td>
                        <td>
                            <span class="badge badge-{{ $donor->is_active ? 'active' : 'inactive' }}">
                                {{ $donor->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('donors.edit', $donor->id) }}" class="btn-secondary">Edit</a>
                            @else
                                <span class="muted">Read only</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No donors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
