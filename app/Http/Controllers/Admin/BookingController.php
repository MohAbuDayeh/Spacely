<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'workspace'])->latest();

        // Apply filters
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('user_id', $request->user_id);
        }

        if ($request->has('workspace_id') && $request->workspace_id != '') {
            $query->where('workspace_id', $request->workspace_id);
        }

        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('start_time', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('end_time', '<=', $request->date_to);
        }

        $bookings = $query->paginate(10);

        // For filter dropdowns
        $users = User::whereHas('bookings')->get();
        $workspaces = Workspace::whereHas('bookings')->get();

        return view('admin.bookings.index', compact('bookings', 'users', 'workspaces'));
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
