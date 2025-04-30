<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\Amenity;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index()
    {
        $workspaces = Workspace::where('user_id', auth()->id())->get();


        $pendingWorkspaces = Workspace::where('user_id', auth()->id())->where('status', 'pending')->get();
        $approvedWorkspaces = Workspace::where('user_id', auth()->id())->where('status', 'approved')->get();
        $removedWorkspaces = Workspace::where('user_id', auth()->id())->where('status', 'removed')->get();


        return view('lessor.workspaces.index', compact(
            'workspaces',
            'pendingWorkspaces',
            'approvedWorkspaces',
            'removedWorkspaces'
        ));
    }

    public function show(Workspace $workspace)
    {
        return view('lessor.workspaces.show', compact('workspace'));
    }

    public function create()
    {

        $amenities = Amenity::all();


        return view('lessor.workspaces.create', compact('amenities'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:Hourly,Daily,Monthly',
            'size' => 'required|numeric|min:0',
            'people_capacity' => 'required|integer|min:1',
            'category' => 'required|in:1,2,3',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:5120',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('workspaces', 'public')
            : null;

        $spaceTypes = [
            1 => 'Coworking space',
            2 => 'Meeting space',
            3 => 'Office space'
        ];

        $spaceType = $spaceTypes[$request->category];


        $workspaceData = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->address,
            'size' => $request->size,
            'people_capacity' => $request->people_capacity,
            'space_type' => $spaceType,
            'status' => 'available',
            'image' => $imagePath,
            'minimum_term' => 1,
            'minimum_term_unit' => 'hour',
        ];


        switch ($request->type) {
            case 'Hourly':
                $workspaceData['price_per_hour'] = $request->price;
                break;
            case 'Daily':
                $workspaceData['price_per_day'] = $request->price;
                break;
            case 'Monthly':
                $workspaceData['price_per_month'] = $request->price;
                break;
        }

        $workspace = Workspace::create($workspaceData);

        if ($request->has('amenities')) {
            $workspace->amenities()->attach($request->amenities);
        }

        return redirect()->route('lessor.workspaces.index')
            ->with('success', 'Workspace created successfully!');
    }
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
        ]);

        dd($request);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('workspaces', 'public');

            return response()->json([
                'success' => true,
                'path' => $path
            ]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
