<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
    
    try {
        // تحقق من المدخلات
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'governorate' => 'required|string',
            'price' => 'required|numeric|min:1',
            'type' => 'required|in:0,1,2',
            'size' => 'required|numeric|min:0',
            'people_capacity' => 'required|integer|min:1',
            'category' => 'required|in:1,2,3',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'video_link' => 'nullable|url'
        ]);

        // أنواع المساحات
        $spaceType = match((int)$request->category) {
            1 => 'Coworking space',
            2 => 'Meeting space',
            3 => 'Private Office',
            default => throw new \Exception('Invalid space type')
        };

        // البيانات الأساسية
        $workspaceData = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->address,
            'address' => $request->address,
            'governorate' => $request->governorate,
            'size' => $request->size,
            'people_capacity' => $request->people_capacity,
            'space_type' => $spaceType,
            'status' => 'available',
            'video_url' => $request->video_link // توحيد اسم الحقل
        ];

        // معالجة الصور
        if ($request->has('images') && count($request->images) > 0) {
            $imagesPaths = [];
            foreach ($request->images as $image) {
                $path = $image->store('workspaces', 'public');
                $imagesPaths[] = $path;
            }
            $workspaceData['images'] = json_encode($imagesPaths);
        }

        // معالجة الأسعار
        $workspaceData['price_per_hour'] = null;
        $workspaceData['price_per_day'] = null;
        $workspaceData['price_per_month'] = null;
        $workspaceData['minimum_term'] = 1;
        $workspaceData['minimum_term_unit'] = 'hour';

        switch ($request->type) {
            case '0': // Hourly
                $workspaceData['price_per_hour'] = $request->price;
                break;
            case '1': // Monthly
                $workspaceData['price_per_month'] = $request->price;
                $workspaceData['minimum_term_unit'] = 'month';
                break;
            case '2': // Daily
                $workspaceData['price_per_day'] = $request->price;
                $workspaceData['minimum_term_unit'] = 'day';
                break;
        }

        // إنشاء المساحة
        $workspace = Workspace::create($workspaceData);

        // إضافة المرافق
        if ($request->has('amenities')) {
            $workspace->amenities()->attach($request->amenities);
        }

        return redirect()->route('lessor.workspaces.index')
            ->with('success', 'Workspace created successfully!');

    } catch (\Exception $e) {

        Log::error('Workspace creation error: ' . $e->getMessage());
        return back()->withInput()->with('error', 'Error creating workspace: ' . $e->getMessage());
    }
}

    public function edit(Workspace $workspace)
    {
        $amenities = Amenity::all();
        $selectedAmenities = $workspace->amenities->pluck('id')->toArray();

        return view('lessor.workspaces.edit', compact('workspace', 'amenities', 'selectedAmenities'));
    }

    public function update(Request $request, Workspace $workspace)
    {
        try {
            if ($workspace->user_id !== auth()->id()) {
                return redirect()->route('lessor.workspaces.index')
                    ->with('error', 'Unauthorized access!');
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'address' => 'required|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'governorate' => 'required|string',
                'price' => 'required|numeric|min:1',
                'type' => 'required|in:0,1,2',
                'size' => 'required|numeric|min:0',
                'people_capacity' => 'required|integer|min:1',
                'category' => 'required|in:1,2,3',
                'amenities' => 'nullable|array',
                'amenities.*' => 'exists:amenities,id',
                'images' => 'nullable|array',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
                'video_link' => 'nullable|url'
            ]);

            $spaceType = match((int)$request->category) {
                1 => 'Coworking space',
                2 => 'Meeting space',
                3 => 'Private Office',
                default => throw new \Exception('Invalid space type')
            };

            $workspaceData = [
                'title' => $request->title,
                'description' => $request->description,
                'location' => $request->address,
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'governorate' => $request->governorate,
                'size' => $request->size,
                'people_capacity' => $request->people_capacity,
                'space_type' => $spaceType,
                'video_url' => $request->video_link
            ];

            // معالجة الأسعار
            $workspaceData['price_per_hour'] = null;
            $workspaceData['price_per_day'] = null;
            $workspaceData['price_per_month'] = null;
            $workspaceData['minimum_term'] = 1;
            $workspaceData['minimum_term_unit'] = 'hour';

            switch ($request->type) {
                case '0':
                    $workspaceData['price_per_hour'] = $request->price;
                    break;
                case '1':
                    $workspaceData['price_per_month'] = $request->price;
                    $workspaceData['minimum_term_unit'] = 'month';
                    break;
                case '2':
                    $workspaceData['price_per_day'] = $request->price;
                    $workspaceData['minimum_term_unit'] = 'day';
                    break;
            }

            // معالجة الصور
            $currentImages = $workspace->images ? json_decode($workspace->images, true) : [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('workspaces', 'public');
                    $currentImages[] = $path;
                }
            }

            $workspaceData['images'] = !empty($currentImages) ? json_encode($currentImages) : null;

            $workspace->update($workspaceData);

            // تحديث المرافق
            $workspace->amenities()->sync($request->amenities ?? []);

            return redirect()->route('lessor.workspaces.index')
                ->with('success', 'Workspace updated successfully!');

        } catch (\Exception $e) {
            Log::error('Workspace update error: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update workspace: ' . $e->getMessage());
        }
    }

    public function destroy(Workspace $workspace)
    {
        try {
            $workspace->amenities()->detach();

            if ($workspace->images) {
                $images = json_decode($workspace->images, true);
                foreach ($images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }

            $workspace->delete();

            return redirect()->route('lessor.workspaces.index')
                ->with('success', 'Workspace deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Workspace deletion error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete workspace: ' . $e->getMessage());
        }
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $path = $request->file('image')->store('workspaces', 'public');

        return response()->json([
            'success' => true,
            'path' => $path
        ]);
    }

    public function deleteImage(Request $request, Workspace $workspace)
    {
        $request->validate([
            'image' => 'required|string'
        ]);

        try {
            $imagePath = $request->image;
            Storage::disk('public')->delete($imagePath);

            $currentImages = $workspace->images ? json_decode($workspace->images, true) : [];
            $updatedImages = array_diff($currentImages, [$imagePath]);

            $workspace->update([
                'images' => !empty($updatedImages) ? json_encode(array_values($updatedImages)) : null
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            Log::error('Image deletion error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
