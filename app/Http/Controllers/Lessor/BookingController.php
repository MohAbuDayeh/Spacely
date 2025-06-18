<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Workspace;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\BookingsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::with(['workspace', 'user'])
            ->whereHas('workspace', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest();

        // Apply filters
        if ($request->filled('workspace')) {
            $bookings->where('workspace_id', $request->workspace);
        }

        if ($request->filled('status')) {
            $bookings->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $dates = explode(' - ', $request->date);
            $bookings->whereBetween('start_date', [$dates[0], $dates[1]]);
        }

        $workspaces = Workspace::where('user_id', Auth::id())->get();

        return view('lessor.bookings.index', [
            'bookings' => $bookings->paginate(10),
            'workspaces' => $workspaces
        ]);
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed,cancelled'
        ]);

        // Create status history
        $booking->statusHistory()->create([
            'status' => $request->status,
            'changed_by' => Auth::id()
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Booking status updated successfully');
    }

    public function sendMessage(Request $request, Booking $booking)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Here you would typically send an email or notification
        // For now we'll just store it in the database
        $booking->messages()->create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $booking->user_id,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return back()->with('success', 'Message sent successfully');
    }

    // public function export(Request $request)
    // {
    //     $bookings = Booking::with(['workspace', 'user'])
    //         ->whereHas('workspace', function($query) {
    //             $query->where('user_id', Auth::id());
    //         });

    //     if ($request->filled('workspace')) {
    //         $bookings->where('workspace_id', $request->workspace);
    //     }

    //     return Excel::download(new BookingsExport($bookings->get()), 'bookings-'.now()->format('Y-m-d').'.xlsx');
    // }
}
