@extends('layouts.app')

@section('title', 'Audit Logs')

@section('content')
    <h1>Audit Log List</h1>

    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Action</th>
                <th>Module</th>
                <th>Record ID</th>
                <th>Description</th>
                <th>Performed At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($auditLogs as $log)
                <tr>
                    <td>{{ $log->user->name ?? 'System' }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->module }}</td>
                    <td>{{ $log->record_id ?? '-' }}</td>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->performed_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No audit logs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
