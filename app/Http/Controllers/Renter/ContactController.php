<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('renter.contact');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20|min:10',
            'message' => 'nullable|string|max:2000',
        ]);

        // هنا ممكن ترسل رسالة بريد، أو تخزن في قاعدة البيانات، حسب المطلوب

        return back()->with('success', 'Your message has been sent!');
    }
}
