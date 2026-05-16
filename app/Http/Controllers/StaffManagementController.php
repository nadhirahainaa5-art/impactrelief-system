<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffManagementController extends Controller
{
    public function index()
    {
        $staff = User::where('role', 'staff')->latest()->get();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => 'staff',
    'status' => 'active',
]);

        return redirect()->route('admin.staff.index')
            ->with('success', 'Staff added successfully.');
    }

    public function toggleStatus(User $user)
{
    if ($user->role !== 'staff') {
        abort(403);
    }

    if ($user->status === 'active') {
        $user->status = 'inactive';
    } else {
        $user->status = 'active';
    }

    $user->save();

    return redirect()->route('admin.staff.index')
        ->with('success', 'Staff status updated successfully.');
}
}