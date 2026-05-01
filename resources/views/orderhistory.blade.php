<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zanzibar Online Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f8;
            color: #333;
        }

        /* Cursor animation */
.cursor {
    display: inline-block;
    margin-left: 5px;
    animation: blink 0.7s infinite;
}
 .cart-box {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 250px;
        }

        .cart-box h3 {
            margin-bottom: 10px;
        }

        .cart-item {
            font-size: 14px;
            margin-bottom: 5px;
        }
         .checkout {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .checkout-box {
            background: white;
            padding: 20px;
            width: 300px;
            border-radius: 10px;
        }

        .close {
            float: right;
            cursor: pointer;
            color: red;
        }

        @keyframes blink {
            0% { opacity: 1; }
            50% { opacity: 0; }
            100% { opacity: 1; }
        }
        /* HEADER */
        header {
            background-color: #0a8754;
            color: white;
            padding: 20px;
        }

        header h1 {
            text-align: center;
            font-size: 28px;
        }

        nav {
            margin-top: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        /* HERO */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                        url('https://images.unsplash.com/photo-1542838132-92c53300491e');
            background-size: cover;
            background-position: center;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .hero h2 {
            font-size: 32px;
        }

        /* PRODUCTS */
        .container {
            width: 90%;
            margin: 40px auto;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0a8754;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .product {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .product img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 6px;
        }

        .product h3 {
            margin: 10px 0;
        }

        .product p {
            font-size: 14px;
            color: #666;
        }

        .price {
            font-weight: bold;
            margin: 10px 0;
            color: #0a8754;
        }

        .btn {
            background-color: #0a8754;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #086644;
        }

        /* FOOTER */
        footer {
            background-color: #222;
            color: #ccc;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }

        footer p {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <header>
        <h1>Zanzibar Online Market</h1>
        <nav>
            @if(Auth::check())

            <a href="{{ route('homepage') }}">Home</a>
            <a href="{{ route('homepage') }}">Payment</a>
            <a href="{{ route('homepage') }}">Order history</a>
             <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa fa-gear"></i> Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
            @else
            <a href="{{ route('homepage') }}">Home</a>
            
            <a href="{{ route('signUp') }}">Sign up</a>
            <a href="{{ route('login') }}">Login</a>
            @endif

        </nav>
    </header>
    <div class="container mt-4">

    <h2>My Order History</h2>

    @php $allTotal = 0; @endphp

    @forelse($orders as $date => $dayOrders)

        <h4 style="margin-top:30px; color:#0a8754;text-align: center;marging-bottom: 6px">
            Date of Requesting orders {{ $date }}
        </h4>

        <div class="products">

            @php $dayTotal = 0; @endphp

            @foreach($dayOrders as $order)

                @php
                    $dayTotal += $order->total_price;
                    $allTotal += $order->total_price;
                @endphp

                <div class="product" style="position:relative;">

                    <!-- INFO ICON -->
                    <span style="cursor:pointer; position:absolute; top:10px; right:10px;
                                 font-size:20px; color:#0a8754;"
                          onclick="showInfo(
                            '{{ $order->product->product_name }}',
                            '{{ $order->product->user->firstname ?? "Seller" }}',
                            '{{ $order->product->stock_quantity }}'
                          )">
                        ℹ
                    </span>

                    <!-- IMAGE -->
                    <img src="{{ asset($order->product->image) }}" alt="Product" height="400px">

                    <!-- NAME -->
                    <h3>{{ $order->product->product_name }}</h3>

                    <!-- DESCRIPTION -->
                    <p>{{ $order->product->description }}</p>

                    <!-- PRICE -->
                    <div class="price">
                        TZS {{ number_format($order->total_price) }}
                    </div>

                    <!-- QUANTITY -->
                    <p><b>Qty:</b> {{ $order->quantity }}</p>

                    <!-- STATUS -->
                    @if($order->status == 'pending')
                        <span style="color: red">Pending</span>
                    @elseif($order->status == 'assigned')
                        <span class="badge bg-primary">Assigned</span>
                    @elseif($order->status == 'confirmed')
                        <span class="badge bg-success" style="color: rgb(145, 120, 213)">Onprogress</span>
                    @endif

                </div>

            @endforeach

        </div>

        

    @empty

        <p>No orders found</p>

    @endforelse

 

</div>


   



</body>
</html>
