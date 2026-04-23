<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::all();
        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $balance = $order->total_cost - $request->amount_paid;

        $status = $balance <= 0 ? 'Paid' : 'Partial';

        Payment::create([
            'order_id' => $request->order_id,
            'amount_paid' => $request->amount_paid,
            'balance' => $balance,
            'payment_method' => $request->payment_method,
            'status' => $status,
        ]);

        return redirect()->route('payments.index');
    }
}