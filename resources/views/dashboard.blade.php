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
                <h4>10,000 tzs</h4>
            </div>

            <div class="col">
                <h6>Growth</h6>
                <h4 class="text-success">+12%</h4>
            </div>

        </div>
    </div>

    <!-- 🔥 CHINI -->
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
            <div class="card card-custom p-3">
                <h5>Recent Users</h5>

                <div class="user">
                    <img src="https://i.pravatar.cc/40?img=1">
                    <span>John Doe</span>
                </div>

                <div class="user">
                    <img src="https://i.pravatar.cc/40?img=2">
                    <span>Jane Smith</span>
                </div>

                <div class="user">
                    <img src="https://i.pravatar.cc/40?img=3">
                    <span>Michael</span>
                </div>

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