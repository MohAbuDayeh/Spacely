<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use App\Models\Review;
use App\Models\Quote;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // جلب عدد المساحات (workspaces)
        $workspacesCount = Workspace::where('user_id', auth()->id())->count();

        // جلب عدد المراجعات (reviews)
        $reviewsCount = Review::whereHas('workspace', function ($query) {
            $query->where('user_id', auth()->id());
        })->count();

        // جلب عدد طلبات الاقتباس (quotes)
        $quotesCount = Quote::whereHas('workspace', function ($query) {
            $query->where('user_id', auth()->id());
        })->count();

        // جلب المراجعات الأخيرة
        $recentReviews = Review::with('workspace')
            ->whereHas('workspace', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->latest()
            ->take(5)
            ->get();

        // جلب طلبات الاقتباس الأخيرة
        $recentQuotes = Quote::whereHas('workspace', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->latest()
            ->take(5)
            ->get();

        // تمرير البيانات إلى الـ view
        return view('lessor.dashboard', compact(
            'workspacesCount', 'reviewsCount', 'quotesCount', 'recentReviews', 'recentQuotes'
        ));
    }

    public function reviews()
    {
        // هنا يمكنك إضافة الكود الخاص بعرض المراجعات الخاصة بـ Lessor
        return view('lessor.reviews.index'); // صفحة المراجعات
    }

    public function requestQuotes()
    {
        // هنا يمكنك إضافة الكود الخاص بعرض طلبات الاقتباس الخاصة بـ Lessor
        return view('lessor.request-quotes'); // صفحة طلبات الاقتباس
    }
}
