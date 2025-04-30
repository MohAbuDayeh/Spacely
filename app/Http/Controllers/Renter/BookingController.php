<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Workspace;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Workspace $workspace)
    {
        return view('renter.bookings.create', compact('workspace'));
    }

    public function store(Request $request, Workspace $workspace)
    {
        $request->validate([
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'total_price' => 'required|numeric',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'workspace_id' => $workspace->id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'total_price' => $request->total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('renter.bookings.index')->with('success', 'Booking created successfully');
    }
}
