<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $workspaces = Workspace::all();
        return view('admin.dashboard', compact('users', 'workspaces'));
    }
}
