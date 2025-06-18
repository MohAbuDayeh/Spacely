<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the renter dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user(); // جلب بيانات المستخدم الحالي

        // جلب جميع المساحات بغض النظر عن حالة الحجز
        $workspaces = Workspace::withAvg('reviews', 'rating') // حساب متوسط التقييم
            ->orderBy('reviews_avg_rating', 'desc')
            ->take(6) // ترتيب المساحات حسب التقييم
            ->get();

        // تمرير المتغيرات إلى العرض
        return view('renter.dashboard', compact('user', 'workspaces'));
    }
}
