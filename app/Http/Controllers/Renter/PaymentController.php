<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display the payment form for the selected workspace.
     *
     * @param  int  $workspaceId
     * @return \Illuminate\View\View
     */
    public function show($workspaceId)
    {
        // جلب تفاصيل الحجز
        $workspace = \App\Models\Workspace::findOrFail($workspaceId);
        // dd($workspace->price_per_day);
        // التأكد من أن الحجز مخصص للمستأجر الحالي
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'workspace_id' => $workspace->id,
            'start_time' => now(), // يجب أن تحدد تاريخ البدء
            'end_time' => now()->addDays(1), // يجب أن تحدد تاريخ النهاية
            'total_price' => 
                isset($workspace->price_per_day) ? $workspace->price_per_day * 0.95 :
                (isset($workspace->price_per_hour) ? $workspace->price_per_hour * 0.95 :
                (isset($workspace->price_per_month) ? $workspace->price_per_month * 0.95 : null)),

        ]);

        return view('renter.payment', [
            'booking' => $booking
        ]);
    }

    /**
     * Handle the payment process.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // التحقق من صحة المدخلات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'expiry' => 'required|string|max:5',
            'cvv' => 'required|digits:3',
            'cardNumber' => 'required|digits:19',
            'booking_id' => 'required|exists:bookings,id',
        ]);

        // جلب تفاصيل الحجز
        $booking = Booking::findOrFail($validated['booking_id']);

        // التأكد من أن الحجز يخص المستأجر الحالي
        if ($booking->renter_id !== Auth::id()) {
            abort(403, 'You are not authorized to make a payment for this booking.');
        }

        // إنشاء رقم الفاتورة بشكل فريد
        $invoiceNumber = 'INV-' . strtoupper(Str::random(8));

        // إنشاء عملية الدفع
        $payment = Payment::create([
            'booking_id' => $validated['booking_id'],
            'payment_method' => 'Credit Card', // يمكن تعديلها لاحقًا لتشمل طرق أخرى
            'amount' => $booking->total_price,  // يجب أن يكون لديك قيمة السعر في الحجز
            'status' => 'pending',
            'lessor_id' => $booking->workspace->user_id, // id المؤجر
            'renter_id' => $booking->renter_id, // id المستأجر
            'invoice_number' => $invoiceNumber,

        ]);

        // تحديث حالة الدفع بعد إتمام الدفع عبر بوابة الدفع أو طرق الدفع المختارة
        // هنا تضع الكود الخاص بإتمام عملية الدفع (بمثال لبوابة الدفع)

        // بمجرد الدفع الناجح يمكن تحديث الحالة إلى 'paid'
        // في حال نجاح الدفع:
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(), // تاريخ الدفع
        ]);

        // بعد الدفع يمكن إعادة توجيه المستأجر إلى صفحة تأكيد الدفع
        return redirect()->route('renter.bookings.index')->with('success', 'Payment successful! Your booking is confirmed.');
    }
}
