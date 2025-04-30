<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::all();
        return view('renter.dashboard', compact('workspaces'));
    }
}
