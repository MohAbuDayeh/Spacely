<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Workspace;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function store(Workspace $workspace)
    {
        Favorite::create([
            'user_id' => auth()->id(),
            'workspace_id' => $workspace->id,
        ]);

        return redirect()->route('renter.workspaces.index')->with('success', 'Workspace added to favorites');
    }

    public function destroy(Workspace $workspace)
    {
        $favorite = Favorite::where('user_id', auth()->id())->where('workspace_id', $workspace->id)->first();
        $favorite->delete();

        return redirect()->route('renter.workspaces.index')->with('success', 'Workspace removed from favorites');
    }
}
