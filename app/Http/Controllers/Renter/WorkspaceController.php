<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\Amenity;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of available workspaces.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Workspace::where('status', 'available')
            ->with(['amenities', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');


        if ($request->has('governorate') && !empty($request->governorate)) {

            $query->where('location', $request->governorate);
        }


        if ($request->has('capacity_range') && !empty($request->capacity_range)) {
            switch ($request->capacity_range) {
                case '1':
                    $query->where('people_capacity', 1);
                    break;
                case '2-5':
                    $query->whereBetween('people_capacity', [2, 5]);
                    break;
                case '5-10':
                    $query->whereBetween('people_capacity', [5, 10]);
                    break;
                case '10-15':
                    $query->whereBetween('people_capacity', [10, 15]);
                    break;
                case '15+':
                    $query->where('people_capacity', '>=', 15);
                    break;
            }
        }


        if ($request->has('space_type') && !empty($request->space_type)) {
            $query->where('space_type', $request->space_type);
        }


        if ($request->has('sort') && !empty($request->sort)) {
            switch ($request->sort) {

                case 'price_low':

                    $query->orderBy('price_per_month', 'asc');
                    break;

                case 'price_high':
                    $query->orderBy('price_per_month', 'desc');
                    break;

                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'rating':
                    $query->orderBy('reviews_avg_rating', 'desc');
                    break;

                default:
                    $query->orderBy('reviews_avg_rating', 'desc');
                    break;
            }
        } else {

            $query->orderBy('reviews_avg_rating', 'desc');
        }

        $workspaces = $query->paginate(9)->withQueryString();


        $spaceTypes = [
            'Coworking Space' => Workspace::where('space_type', 'Coworking Space')->count(),
            'Meeting Space' => Workspace::where('space_type', 'Meeting Space')->count(),
            'Private Office' => Workspace::where('space_type', 'Private Office')->count(),
        ];

        return view('renter.workspaces.index', compact('workspaces', 'spaceTypes'));
    }

    /**
     * Display the specified workspace.
     *
     * @param  \App\Models\Workspace  $workspace
     * @return \Illuminate\View\View
     */
    public function show(Workspace $workspace)
    {
        if ($workspace->status !== 'available') {
            abort(404, 'This workspace is not currently available');
        }

        $similarWorkspaces = Workspace::where('space_type', $workspace->space_type)
            ->where('id', '!=', $workspace->id)
            ->where('status', 'available')
            ->withAvg('reviews', 'rating')
            ->orderBy('reviews_avg_rating', 'desc')
            ->limit(4)
            ->get();


        $workspace->image_url = $workspace->image ? asset('storage/' . $workspace->image) : asset('assets/images/default-image.jpg');

        return view('renter.workspaces.show', [
            'workspace' => $workspace->load(['amenities', 'reviews']),
            'similarWorkspaces' => $similarWorkspaces
        ]);
    }

    /**
     * Show the form for creating a new workspace.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $amenities = Amenity::all();
        return view('renter.workspaces.create', compact('amenities'));
    }

    /**
     * Store a newly created workspace in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'space_type' => 'required|in:Coworking Space,Meeting Space,Private Office',
            'price_per_month' => 'required|numeric|min:0',
            'size' => 'required|numeric|min:0',
            'people_capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'amenities' => 'sometimes|array',
            'amenities.*' => 'exists:amenities,id',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $workspaceData = $validated;

        if ($request->hasFile('image')) {
            $workspaceData['image'] = $request->file('image')->store('workspaces', 'public');
        }

        $workspace = Workspace::create($workspaceData);

        if ($request->has('amenities')) {
            $workspace->amenities()->sync($validated['amenities']);
        }

        return redirect()->route('renter.workspaces.show', $workspace)
            ->with('success', 'Workspace created successfully!');
    }
}
