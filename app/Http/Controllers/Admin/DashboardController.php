<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_lessors' => User::where('role', 'lessor')->count(),
            'total_renters' => User::where('role', 'renter')->count(),
            'total_workspaces' => Workspace::count(),
            'total_bookings' => Booking::count(),
            'recent_bookings' => Booking::with(['renter', 'workspace'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        $totalUsers = User::count();
        $totalWorkspaces = Workspace::count();
        $totalBookings = Booking::count();
        $recentUsers = User::latest()->take(5)->get();
        $recentWorkspaces = Workspace::latest()->take(5)->get();
        $recentBookings = Booking::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'totalUsers', 'totalWorkspaces', 'totalBookings', 'recentUsers', 'recentWorkspaces', 'recentBookings'));
    }
}
