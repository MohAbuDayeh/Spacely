<?php

namespace App\Http\Controllers\Renter;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // جلب المراجعات الخاصة بالـ Renter فقط
        $reviews = Review::with('workspace') // جلب المراجعة مع المساحة
            ->where('user_id', auth()->id()) // جلب المراجعات الخاصة بالمستأجر
            ->get();

        // تمرير المراجعات إلى الـ View
        return view('renter.reviews.index', compact('reviews'));
    }

    // store function
    public function store(Request $request)
    {
        // dd($request->all());
        // التحقق من صحة المدخلات
        $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',

        ]);

        // إنشاء مراجعة جديدة
        Review::create([
            'user_id' => auth()->id(),
            'workspace_id' => $request->workspace_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Your review has been submitted!');
    }

    // إذا كنت بحاجة إلى إضافة وظيفة الرد، يمكنك إضافتها هنا
    public function respond(Request $request, Review $review)
    {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        // تحديث المراجعة بالرد
        $review->response = $request->response;
        $review->save();

        return redirect()->route('renter.reviews')->with('success', 'Your response has been saved!');
    }
}
