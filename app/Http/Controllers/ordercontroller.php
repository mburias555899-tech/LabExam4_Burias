<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('menu')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $menu = Menu::findOrFail($request->menu_id);

        $total = $menu->price_per_kg * $request->quantity;

        Order::create([
            'customer_name' => $request->customer_name,
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'total_cost' => $total,
            'status' => 'Pending',
        ]);

        return redirect()->route('orders.index');
    }
}