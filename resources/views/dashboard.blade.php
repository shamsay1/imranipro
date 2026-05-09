@extends('layout.app')

@section('content')

<style>
    body {
        background-color: #ffffff !important;
    }
    .no-radius {
        border-radius: 0 !important;
        border: 1px solid #e5e5e5;
        box-shadow: none;
        padding: 0;
    }
    .top-cards .col {
        padding: 20px;
        border-right: 1px solid #e5e5e5;
    }

    /* Ondoa border ya mwisho */
    .top-cards .col:last-child {
        border-right: none;
    }

    /* Cards za chini */
    .card-custom {
        border-radius: 10px;
        border: 1px solid #e5e5e5;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }

    .user {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .user img {
        border-radius: 50%;
        margin-right: 10px;
    }
</style>

<div class="container mt-4">
    <div class="card no-radius mb-4">
        <div class="row text-center top-cards m-0">
            @if(Auth::user()->role=="admin")
            <div class="col"Users>
                <h6>Registered Customer </h6>
                <h4>{{ $customer }}</h4>
            </div>

            <div class="col">
                <h6>Orders</h6>
                <h4>{{ $total_request }}</h4>
            </div>

            <div class="col">
                <h6>Revenue</h6>
                <h4>0 tzs</h4>
            </div>

            <div class="col">
                <h6>Registered Deliver</h6>
                <h4 class="text-success">0</h4>
            </div>
            @elseif(Auth::user()->role=="seller")
            <div class="col">
                <h6>Customer Orders</h6>
                <h4>{{ $total_request }}</h4>
            </div>
            <div class="col">
                <h6>Registered Products</h6>
                <h4>{{ $total_products }}</h4>
            </div>
            <div class="col">
                <h6>Todays Revenue</h6>
                <h4>0</h4>
            </div>
            {{-- <div class="col">
                <h6>Orders</h6>
                <h4>{{ $total_request }}</h4>
            </div> --}}

            @endif

        </div>
    </div>

    <div class="row">

        <!-- GRAPH -->
        <div class="col-md-8">
            <div class="card card-custom p-3">
                <h5>Statistics</h5>
                <canvas id="chart"></canvas>
            </div>
        </div>

        <!-- USERS -->
       <div class="col-md-4">
    <div class="card card-custom border-0 shadow-lg rounded-4 p-4 h-100">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-bag-check-fill text-primary me-2"></i>
                Recent Orders
            </h5>
        </div>

        @foreach ($orders as $order)

            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">

                <!-- User Info -->
                <div class="d-flex align-items-center gap-3">

                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-person-fill text-primary"></i>
                    </div>

                    <div>
                        <h6 class="mb-1 fw-bold">
                            {{ $order->user->firstname }}
                        </h6>

                        <small class="text-muted">
                            {{ $order->product->product_name }}
                        </small>
                    </div>

                </div>

                <!-- Quantity -->
                <div>
                    <span class="badge bg-success rounded-pill px-3 py-2">
                        Qty: {{ $order->quantity }}
                    </span>
                </div>

            </div>

        @endforeach

    </div>
</div>

    </div>

</div>

<script>
    const ctx = document.getElementById('chart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
            datasets: [{
                label: 'Users',
                data: [12, 19, 8, 15, 22],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

@endsection