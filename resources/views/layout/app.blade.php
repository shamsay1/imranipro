<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modern Dashboard</title>

<!-- LIBRARIES -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', sans-serif;
    background: #f4f6fb;
    display: flex;
    min-height: 100vh;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    background: #0a8754;
    color: white;
    transition: 0.3s;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.sidebar.collapsed {
    width: 70px;
}

.sidebar h2 {
    text-align: center;
    padding: 10px;
    background: #065f46;
}

.toggle-btn {
    position: absolute;
    top: 15px;
    right: 10px;
    cursor: pointer;
    font-size: 18px;
}

.menu-title {
    font-size: 11px;
    color: #a7f3d0;
    padding: 10px 20px 5px;
}

/* MENU */
.sidebar ul {
    list-style: none;
    padding-left: 0;
}

.sidebar ul li {
    padding: 12px 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.sidebar ul li:hover {
    background: rgba(255,255,255,0.2);
}

.sidebar a {
    color: white;
    text-decoration: none;
}

/* MAIN */
.main {
    margin-left: 220px;
    width: calc(100% - 220px);
    transition: 0.3s;
}

/* collapsed */
.sidebar.collapsed + .main {
    margin-left: 70px;
    width: calc(100% - 70px);
}

/* NAVBAR */
.navbar {
    background: white;
    padding: 10px 20px;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* CONTENT */
.content {
    padding: 3px;
}

/* CARDS */
.cards {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

/* RESPONSIVE FIX */
@media(max-width: 992px) {
    .cards {
        grid-template-columns: repeat(2, 1fr);
    }

    .grid {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 600px) {
    .sidebar {
        position: absolute;
        z-index: 1000;
        left: -220px;
    }

    .sidebar.show {
        left: 0;
    }

    .main {
        margin-left: 0;
        width: 100%;
    }
}
</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">

    <!-- Toggle Button -->
    <span class="toggle-btn" onclick="toggleSidebar()">
        <i class="fa fa-bars"></i>
    </span>

    <!-- Profile Section -->
    <div class="text-center mb-4">

       

        @if(Auth::user()->role=="admin")
            <h2 style="font-family:'Times New Roman', Times, serif;">
                Admin
            </h2>

        @elseif(Auth::user()->role=="seller")
            <h2 style="font-family:'Times New Roman', Times, serif;">
                Seller
            </h2>
        @endif

    </div>

    <ul>

        @if(Auth::user()->role=="admin")

            <!-- MAIN -->
            <p class="menu-title">MAIN</p>

            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-gauge-high"></i>
                    Dashboard
                </a>
            </li>

            <!-- MANAGEMENT -->
            <p class="menu-title">MANAGEMENT</p>

            <li>
                <a href="{{ route('buyers.index') }}">
                    <i class="fa fa-users"></i>
                    Manage Users
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-box-open"></i>
                    Manage Products
                </a>
            </li>

            <li>
                <a href="{{ route('orders') }}">
                    <i class="fa fa-cart-shopping"></i>
                    Manage Orders
                </a>
            </li>

            <!-- REPORT -->
            <p class="menu-title">REPORT</p>

            <li>
                <a href="#">
                    <i class="fa fa-chart-column"></i>
                    Analytics
                </a>
            </li>

        @elseif(Auth::user()->role=="seller")

            <!-- MAIN -->
            <p class="menu-title">MAIN</p>

            <li>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-gauge-high"></i>
                    Dashboard
                </a>
            </li>

            <!-- MANAGEMENT -->
            <p class="menu-title">MANAGEMENT</p>

            <li>
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-box"></i>
                    Manage Products
                </a>
            </li>

            <li>
                <a href="{{ route('orders') }}">
                    <i class="fa fa-receipt"></i>
                    Users Orders
                </a>
            </li>

            <!-- PAYMENT -->
            <p class="menu-title">PAYMENT</p>

            <li>
                <a href="#">
                    <i class="fa fa-money-check-dollar"></i>
                    Verify Payments
                </a>
            </li>

        @endif

        <!-- SETTINGS -->
        <p class="menu-title">SETTINGS</p>

        <li>
            <a href="#">
                <i class="fa fa-gear"></i>
                Settings
            </a>
        </li>

        <!-- LOGOUT -->
        <li>
            <a href="#"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">

                <i class="fa fa-right-from-bracket"></i>
                Logout
            </a>

            <form id="logout-form"
                  action="{{ route('logout') }}"
                  method="POST"
                  style="display:none;">
                @csrf
            </form>
        </li>

    </ul>

</div>
<!-- MAIN -->
<div class="main">

    <!-- NAVBAR -->
   <div class="navbar" style="height: 60px">
     <h2 style="font-family: 'Times New Roman', Times, serif;color: green;font-size: 25px;">Zanzibar Online marketing System</h2>

 
    <div style="position:relative; margin-left:auto; cursor:pointer;">

        <i class="fa-solid fa-bell" style="font-size:20px;"></i>

        <!-- BADGE -->
        <span style="
            position:absolute;
            top:-5px;
            right:-8px;
            background:red;
            color:white;
            font-size:11px;
            padding:2px 6px;
            border-radius:50%;
        ">
            5
        </span>

    </div>

</div>

    <!-- CONTENT -->
    <div class="content">

        @yield('content')

    </div>
</div>

<script>
function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("collapsed");
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>