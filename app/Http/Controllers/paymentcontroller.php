<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $payments = Payment::with('order')->latest()->get();

        return view('payment', compact('orders', 'payments'));
    }

    public function pay(Request $request, $order_id)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:0'
        ]);

        $order = Order::findOrFail($order_id);

        $totalPaid = Payment::where('order_id', $order->id)->sum('amount_paid');

        $newPayment = (float) $request->amount_paid;
        $total = (float) $order->total_cost;

        $totalPaid += $newPayment;

        $balance = max(0, $total - $totalPaid);
        $change = $totalPaid > $total ? $totalPaid - $total : 0;

        if ($totalPaid >= $total) {
            $status = 'Paid';
        } elseif ($totalPaid > 0) {
            $status = 'Partial';
        } else {
            $status = 'Unpaid';
        }

        Payment::create([
            'order_id' => $order->id,
            'amount_paid' => $newPayment,
            'balance' => $balance,
            'change' => $change,
            'status' => $status,
            'payment_date' => now()
        ]);

        $order->update([
            'status' => $status === 'Paid' ? 'Completed' : 'Pending'
        ]);

        return redirect()->back()->with('success', 'Payment successful');
    }
}