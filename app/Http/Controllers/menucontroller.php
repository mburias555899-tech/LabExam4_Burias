<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $menu = null;

        return view('menu', compact('menus', 'menu'));
    }

    public function edit($id)
    {
        $menus = Menu::all();
        $menu = Menu::findOrFail($id);

        return view('menu', compact('menus', 'menu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price_per_kilo' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0'
        ]);

        Menu::create([
            'name' => $request->name,
            'category' => $request->category,
            'price_per_kilo' => $request->price_per_kilo,
            'stock' => (int) $request->stock
        ]);

        return redirect()->route('menu.index')->with('success', 'Rice added');
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price_per_kilo' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0'
        ]);

        $menu->update([
            'name' => $request->name,
            'category' => $request->category,
            'price_per_kilo' => $request->price_per_kilo,
            'stock' => (int) $request->stock
        ]);

        return redirect()->route('menu.index')->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        Menu::destroy($id);

        return redirect()->route('menu.index')->with('success', 'Deleted successfully');
    }
}