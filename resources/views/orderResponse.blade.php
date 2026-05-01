@extends('layout.app')

@section('content')

<div class="container mt-4">

    <h3>Customer Orders</h3>

    @foreach($orders as $userId => $userOrders)

        <div class="card mb-3 p-3 shadow-sm">

            <!-- USER INFO -->
            <h5>
                {{ $userOrders->first()->user->firstname ?? 'User' }}
            </h5>

            <p>Total Orders: {{ $userOrders->count() }}</p>

            <!-- ORDERS LIST -->
            @php $grandTotal = 0; @endphp

<table class="table table-sm">
    <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Cost</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
    @foreach($userOrders as $order)

        @php $grandTotal += $order->total_price; @endphp

        <tr>
            <td>{{ $order->product->product_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>TZS {{ number_format($order->total_price) }}</td>
            <td>{{ $order->status }}</td>
        </tr>

    @endforeach
    </tbody>
</table>

<!-- TOTAL DISPLAY -->
<div style="font-weight:bold; margin-top:10px;">
    TOTAL COST: TZS {{ number_format($grandTotal) }}
</div>



            <!-- ACTION BUTTONS -->
            <button class="btn btn-success btn-sm"
                onclick="sendResponse({{ $userId }})">
                Send Response
            </button>

            <button class="btn btn-primary btn-sm"
                onclick="assignDelivery({{ $userId }})">
                Assign Delivery
            </button>

        </div>

    @endforeach

</div>
<script>
    function sendResponse(userId)
{
    fetch('/orders/send-response/' + userId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(() => {
        alert("Email sent to user!");
    });
}

function assignDelivery(userId)
{
    fetch('/orders/assign/' + userId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }).then(() => {
        alert("Assigned to delivery!");
    });
}
</script>
@endsection