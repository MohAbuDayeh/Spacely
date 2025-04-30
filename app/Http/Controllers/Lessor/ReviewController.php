<?php

namespace App\Http\Controllers\Lessor;

use App\Models\Review;
use App\Models\Workspace;
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
        // جلب المراجعات المرتبطة بالـ Lessor فقط
        $reviews = Review::with(['user', 'workspace'])
            ->whereHas('workspace', function ($query) {
                $query->where('user_id', auth()->id()); // جلب المراجعات للمؤجر الحالي
            })
            ->get();

        return view('lessor.reviews.index', compact('reviews'));
    }

    /**
     * Respond to a review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function respond(Request $request, Review $review)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'response' => 'required|string|max:1000', // تحقق من الرد
        ]);

        // إضافة الرد إلى المراجعة
        $review->response = $request->response;
        $review->save();

        // إعادة التوجيه إلى صفحة المراجعات مع رسالة نجاح
        return redirect()->route('lessor.reviews')->with('success', 'Your response has been saved!');
    }
}
