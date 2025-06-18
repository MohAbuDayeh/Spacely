<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured workspaces
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get featured workspaces
        $workspaces = Workspace::where('status', 'available')
            ->with(['reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(6)
            ->get();

        return view('index', compact('workspaces'));
    }

    /**
     * Display a single workspace
     *
     * @param  Workspace  $workspace
     * @return \Illuminate\View\View
     */
    public function showWorkspace(Workspace $workspace)
    {
        $similarWorkspaces = Workspace::where('space_type', $workspace->space_type)
            ->where('id', '!=', $workspace->id)
            ->where('status', 'available')
            ->withAvg('reviews', 'rating')
            ->take(4)
            ->get();



        return view('renter.workspaces.show', [
            'workspace' => $workspace,
            'similarWorkspaces' => $similarWorkspaces
        ]);
    }
}
