<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::orderBy('rating', 'desc')->take(4)->get();
        return view('renter.workspaces.index', ['workspaces' => $workspaces]);
    }

    public function show(Workspace $workspace)
    {
        return view('renter.workspaces.show', compact('workspace'));
    }
}
