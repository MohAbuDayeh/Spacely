<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Workspace; // تأكد من استيراد الـ Workspace
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
    public function index()
    {
        // جلب جميع الاقتباسات للمؤجر الحالي مع تفاصيل المستخدم
        $quoteRequests = Quote::whereHas('workspace', function ($query) {
            $query->where('user_id', auth()->id());
            })
            ->with(['user', 'workspace'])
            ->get();
        // dd(Auth::user()->id);
        // عرض الصفحة مع الاقتباسات
        return view('lessor.request-quotes', compact('quoteRequests'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // التحقق من صحة المدخلات
        $validated = $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',  // تأكد أن العمل مساحة موجودة
            'amount' => 'required|numeric',
            'availability' => 'required|date', // إضافة التحقق من تاريخ التوفر
        ]);

        // التحقق من وجود العمل مساحة (اختياري لكن يضمن السلامة)
        $workspace = Workspace::find($validated['workspace_id']);
        if (!$workspace) {
            return redirect()->back()->with('error', 'Workspace not found.');
        }

        // إنشاء اقتباس جديد مع تضمين تاريخ التوفر
        Quote::create([
            'user_id' => auth()->id(),
            'workspace_id' => $validated['workspace_id'],
            'amount' => $validated['amount'],
            'status' => 'pending', // وضع الحالة كـ pending بشكل افتراضي
            'availability_date' => $validated['availability'], // تضمين تاريخ التوفر
        ]);

        // إعادة توجيه إلى صفحة الاقتباسات مع رسالة نجاح
        return redirect()->route('lessor.request-quotes')->with('success', 'Quote request successfully submitted!');
    }
}
