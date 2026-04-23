<h2>Payments</h2>

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


<table border="1" cellpadding="8">
<tr>
    <th>Order Code</th>
    <th>Total</th>
    <th>Pay</th>
</tr>

@foreach($orders as $order)
<tr>
    <td>ORD-{{ $order->id }}</td>
    <td>₱{{ $order->total_cost }}</td>
    <td>
        <form action="{{ route('payments.pay', $order->id) }}" method="POST">
            @csrf

            <input type="number" name="amount_paid" placeholder="Enter payment" min="0" required>

            <button type="submit">Pay</button>
        </form>
    </td>
</tr>
@endforeach
</table>

<hr>

<h3>Payment History</h3>

<table border="1" cellpadding="8">
<tr>
    <th>Order Code</th>
    <th>Paid</th>
    <th>Balance</th>
    <th>Change</th>
    <th>Status</th>
    <th>Date</th> 
</tr>

@foreach($payments as $payment)
<tr>
    <td>ORD-{{ $payment->order_id }}</td>
    <td>₱{{ $payment->amount_paid }}</td>
    <td>₱{{ $payment->balance }}</td>
    <td>₱{{ $payment->change }}</td>
    <td>{{ $payment->status }}</td>
    <td>{{ $payment->payment_date }}</td>
</tr>
@endforeach
</table>