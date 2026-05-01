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
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

/* Tablet */
@media (max-width: 992px) {
    .products {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile */
@media (max-width: 576px) {
    .products {
        grid-template-columns: repeat(1, 1fr);
    }
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
            <a href="{{ route('order.history') }}">Order history</a>
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

    <!-- HERO SECTION -->
    <section class="hero">
    <div>
        <h2><span id="typingText"></span><span class="cursor">|</span></h2>
    </div>
</section>

    <!-- PRODUCTS -->
    <div class="container">
        <h2>Bidhaa Maarufu</h2>

        <div class="products">

        @forelse($products as $product)

           <div class="product" style="position:relative;">

    <!-- MORE INFO ICON -->
    <span style="cursor:pointer; position:absolute; top:10px; right:10px; 
                 font-size:20px; color:#0a8754;"
          onclick="showInfo(
            '{{ $product->product_name }}',
            '{{ $product->user->firstname ?? "Seller" }}',
            '{{ $product->stock_quantity }}'
          )">
        ℹ
    </span>

    <!-- IMAGE -->
    <img src="{{ asset($product->image) }}" alt="Product" height="400px">

    <!-- NAME -->
    <h3>{{ $product->product_name }}</h3>

    <!-- DESCRIPTION -->
    <p>{{ $product->description }}</p>

    <!-- PRICE -->
    <div class="price">
        TZS {{ number_format($product->price) }}
    </div>

    <!-- BUY BUTTON -->
   @if(Auth::check())
    <button class="btn"
        onclick="addToCart({{ $product->id }}, '{{ $product->product_name }}', {{ $product->price }})">
        Nunua Sasa
    </button>
@endif

</div>

        @empty

            <p>No products available</p>

        @endforelse

        </div>
        <br><br>
        
    </div>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 Zanzibar Online Market | All Rights Reserved</p>
    </footer>
            @if(Auth::check())

<div class="cart-box">
    <h3>Cart</h3>

    <div id="cartItems"></div>

    <p><b>Total:</b> TZS <span id="total">0</span></p>

    <button class="btn" onclick="openCheckout()">Checkout</button>
</div>
@endif
    <div class="checkout" id="checkout">
    <div class="checkout-box">
        <span class="close" onclick="closeCheckout()">X</span>
        <h3>Checkout</h3>
        <div id="checkoutItems"></div>
        <p><b>Total:</b> TZS <span id="checkoutTotal"></span></p>
        <button class="btn" onclick="confirmOrder()">Confirm Order</button>
    </div>
</div>
<div id="infoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.6); justify-content:center; align-items:center;">

    <div style="background:white; padding:20px; width:300px; border-radius:10px;">
        
        <h3>Product Info</h3>

        <p><b>Name:</b> <span id="infoName"></span></p>
        <p><b>Seller:</b> <span id="infoSeller"></span></p>
        <p><b>Stock:</b> <span id="infoStock"></span> items left</p>

        <button class="btn" onclick="closeInfo()">Close</button>
    </div>

</div>

<script>
let cart = [];
function showInfo(name, seller, stock)
{
    document.getElementById("infoName").innerText = name;
    document.getElementById("infoSeller").innerText = seller;
    document.getElementById("infoStock").innerText = stock;

    document.getElementById("infoModal").style.display = "flex";
}

function closeInfo()
{
    document.getElementById("infoModal").style.display = "none";
}
function addToCart(id, name, price) {

    // check kama product ipo tayari
    let existing = cart.find(item => item.id === id);

    if (existing) {
        existing.quantity += 1;
        existing.total = existing.quantity * existing.price;
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1,
            total: price
        });
    }

    renderCart();
}

function renderCart() {
    let html = "";
    let total = 0;

    cart.forEach(item => {
        html += `
            <div>
                ${item.name} 
                | Qty: ${item.quantity} 
                | TZS ${item.total}
            </div>
        `;
        total += item.total;
    });

    document.getElementById("cartItems").innerHTML = html;
    document.getElementById("total").innerText = total;
}

function openCheckout() {

    document.getElementById("checkout").style.display = "flex";

    let html = "";
    let total = 0;

    cart.forEach(item => {
        html += `<p>${item.name} x ${item.quantity} = TZS ${item.total}</p>`;
        total += item.total;
    });

    document.getElementById("checkoutItems").innerHTML = html;
    document.getElementById("checkoutTotal").innerText = total;
}

function closeCheckout() {
    document.getElementById("checkout").style.display = "none";
}
function confirmOrder() {

    fetch("/checkout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            cart: cart
        })
    })
    .then(res => res.json())
    .then(data => {
        alert("Order imefanikiwa!");
        cart = [];
        renderCart();
        closeCheckout();
    });

}
</script>
<script>
    const texts = [
        "Nunua & Uuze Bidhaa Mtandaoni Zanzibar",
        "Haraka  Salama  Rahisi kwa matumizi",
        "Bei zetu ni nafuu na Bidhaa zenye ubora",
        "Tunapatikana kote Zanzibar",
        "Jisajili tukuhudumie",
        "Nyote mnakaribishwa"
    ];

    let index = 0;
    let charIndex = 0;
    let isDeleting = false;

    const typingElement = document.getElementById("typingText");

    function typeEffect() {
        let currentText = texts[index];

        if (!isDeleting) {
            typingElement.textContent = currentText.substring(0, charIndex + 1);
            charIndex++;

            if (charIndex === currentText.length) {
                isDeleting = true;
                setTimeout(typeEffect, 1500); // pause kabla ya kufuta
                return;
            }
        } else {
            typingElement.textContent = currentText.substring(0, charIndex - 1);
            charIndex--;

            if (charIndex === 0) {
                isDeleting = false;
                index = (index + 1) % texts.length; // loop
            }
        }

        setTimeout(typeEffect, isDeleting ? 40 : 60);
    }

    // anza animation
    window.onload = typeEffect;
</script>
</body>
</html>
