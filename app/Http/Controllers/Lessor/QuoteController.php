<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index()
    {
        // جلب جميع الاقتباسات للمؤجر الحالي مع تفاصيل المستخدم
        $quoteRequests = Quote::where('user_id', auth()->id())
        ->with('user')  // تحميل بيانات المستخدم المرتبطة
        ->get();
return view('lessor.request-quotes', compact('quoteRequests'));
    }

    public function store(Request $request)
    {
        // التحقق من صحة المدخلات
        $validated = $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'amount' => 'required|numeric',
            'availability_date' => 'required|date', // إضافة التحقق من تاريخ التوفر
        ]);

        // إنشاء اقتباس جديد مع تضمين تاريخ التوفر
        Quote::create([
            'user_id' => auth()->id(),
            'workspace_id' => $validated['workspace_id'],
            'amount' => $validated['amount'],
            'status' => 'pending', // وضع الحالة كـ pending بشكل افتراضي
            'availability_date' => $validated['availability_date'], // تضمين تاريخ التوفر
        ]);

        // إعادة توجيه إلى صفحة الاقتباسات
        return redirect()->route('lessor.request-quotes');
    }
}
