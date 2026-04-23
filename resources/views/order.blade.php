<h2>Create Order (POS)</h2>

<a href="{{ route('dashboard') }}">
    <button type="button">⬅ Back to Dashboard</button>
</a>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<hr>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div style="display:flex; gap:10px; align-items:center;">

        <select name="menu_id" required style="padding:5px;">
            <option value="">-- Select Rice --</option>

            @foreach($menus as $menu)
                <option value="{{ $menu->id }}">
                    {{ $menu->name }} - ₱{{ $menu->price_per_kilo }}
                </option>
            @endforeach
        </select>

        <input type="number"
               name="quantity"
               placeholder="Qty"
               min="1"
               required
               style="width:80px; padding:5px;">

        <span>kg</span>

        <button type="submit">Place Order</button>
    </div>
</form>

<hr>

<h3>Orders List</h3>

<table border="1" cellpadding="8">
<tr>
    <th>Order Code</th>
    <th>Rice</th>
    <th>Qty</th>
    <th>Total</th>
    <th>Status</th>
</tr>

@foreach($orders as $order)
<tr>
    <td>ORD-{{ $order->id }}</td>
    <td>{{ $order->menu->name }}</td>
    <td>{{ $order->quantity }} kg</td>
    <td>₱{{ $order->total_cost }}</td>
    <td>{{ $order->status }}</td>
</tr>
@endforeach
</table>