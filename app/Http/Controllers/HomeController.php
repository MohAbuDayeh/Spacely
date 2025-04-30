<?php

namespace App\Http\Controllers;
use App\Models\Workspace;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $workspaces = Workspace::with('reviews')  // Eager load reviews
    ->take(4)
    ->get()
    ->sortByDesc(function ($workspace) {
        // Sort by the average rating of the reviews
        return $workspace->reviews->avg('rating');
    });
        return view('index', compact('workspaces'));
    }
}
