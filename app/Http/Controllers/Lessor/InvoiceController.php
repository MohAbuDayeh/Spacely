<?php

namespace App\Http\Controllers\Lessor;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * عرض جميع الفواتير الخاصة بالمؤجر الحالي
     */
    public function index()
    {
        $payments = Payment::where('lessor_id', Auth::id())
            ->with(['booking', 'renter'])
            ->latest()
            ->get();

        return view('lessor.invoices.index', compact('payments'));
    }

    /**
     * عرض تفاصيل فاتورة واحدة خاصة بالمؤجر الحالي
     */
    public function show($id)
    {
        $payment = Payment::where('lessor_id', Auth::id())
            ->with(['booking', 'renter'])
            ->findOrFail($id);

        return view('lessor.invoices.show', compact('payment'));
    }

    /**
     * تحميل الفاتورة كـ PDF
     */
    public function download($id)
    {
        $payment = Payment::where('lessor_id', Auth::id())
            ->with(['booking', 'renter'])
            ->findOrFail($id);

        $pdf = Pdf::loadView('lessor.invoices.pdf', compact('payment'));

        return $pdf->download('Invoice_' . $payment->invoice_number . '.pdf');
    }
}
