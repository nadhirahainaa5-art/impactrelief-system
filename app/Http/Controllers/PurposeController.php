<?php

namespace App\Http\Controllers;

use App\Models\Purpose;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PurposeController extends Controller
{
    public function index()
    {
        $purposes = Purpose::latest()->get();

        return view('purposes.index', compact('purposes'));
    }

    public function create()
    {
        return view('purposes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:purposes,name',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        Purpose::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('purposes.index')->with('success', 'Purpose created successfully.');
    }

    public function edit(Purpose $purpose)
    {
        return view('purposes.edit', compact('purpose'));
    }

    public function update(Request $request, Purpose $purpose)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:purposes,name,' . $purpose->id,
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $purpose->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('purposes.index')->with('success', 'Purpose updated successfully.');
    }

    public function destroy(Purpose $purpose)
    {
        $purpose->delete();

        return redirect()->route('purposes.index')->with('success', 'Purpose deleted successfully.');
    }
}
