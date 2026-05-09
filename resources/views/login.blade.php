<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #0a8754, #0fbc78);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 400px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #0a8754;
    }

    .form-group {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 14px;
        margin-bottom: 5px;
    }

    input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input:focus {
        border-color: #0a8754;
        box-shadow: 0 0 5px rgba(10,135,84,0.4);
    }

    .btn {
        width: 100%;
        padding: 12px;
        border: none;
        background: #0a8754;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn:hover {
        background: #086644;
    }

    .extra {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        margin-top: 10px;
    }

    .extra a {
        text-decoration: none;
        color: #0a8754;
    }

    .signup-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .signup-link a {
        color: #0a8754;
        font-weight: bold;
        text-decoration: none;
    }

    /* RESPONSIVE */
    @media (max-width: 500px) {
        .login-container {
            width: 90%;
        }
    }
</style>
</head>

<body>

<div class="login-container">
    <h2>Login</h2>

    <form action="{{ route('login1') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Enter a Username</label>
            <input type="email" name="email" placeholder="Enter your email">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password">
        </div>

        <button class="btn">Login</button>
    </form>

   

    <div class="signup-link">
        Don't have an account? <a href="{{ route('homepage') }}">home</a>
    </div>
</div>

</body>
</html>