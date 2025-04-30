<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\User;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::all();
        return view('admin.workspaces.index', compact('workspaces'));
    }

    public function show(Workspace $workspace)
    {
        return view('admin.workspaces.show', compact('workspace'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.workspaces.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'price_per_hour' => 'nullable|numeric',
            'price_per_day' => 'nullable|numeric',
            'price_per_month' => 'nullable|numeric',
            'minimum_term' => 'required|integer',
            'minimum_term_unit' => 'required|in:hour,day',
            'size' => 'required|numeric',
            'people_capacity' => 'required|integer',
            'space_type' => 'required|in:Coworking space,Meeting space,Office space',
            'status' => 'required|in:available,booked'
        ]);

        Workspace::create($request->all());

        return redirect()->route('admin.workspaces.index')->with('success', 'Workspace created successfully');
    }

    public function destroy(Workspace $workspace)
    {
        $workspace->delete();
        return redirect()->route('admin.workspaces.index')->with('success', 'Workspace deleted successfully');
    }
}
