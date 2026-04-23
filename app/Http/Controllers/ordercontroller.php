<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('menu')->latest()->get();
        $menus = Menu::all();

        return view('order', compact('orders', 'menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $quantity = (int) $request->quantity;
        $price = (float) $menu->price_per_kilo;

        if ($quantity > (int) $menu->stock) {
            return redirect()->back()->with('error', 'Not enough stock');
        }

        $total = $quantity * $price;

        Order::create([
            'user_id' => auth()->id(),
            'menu_id' => $menu->id,
            'quantity' => $quantity,
            'total_cost' => $total,
            'status' => 'Pending'
        ]);

        $menu->stock = (int) $menu->stock - $quantity;
        $menu->save();

        return redirect()->back()->with('success', 'Order created successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Processing,Completed'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status updated');
    }
}