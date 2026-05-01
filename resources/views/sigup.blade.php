<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #0a8754, #0fbc78);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        width: 500px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #0a8754;
    }

    .form-row {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    label {
        font-size: 14px;
        margin-bottom: 5px;
    }

    input, select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        outline: none;
        transition: 0.3s;
    }

    input:focus, select:focus {
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
        transition: 0.3s;
    }

    .btn:hover {
        background: #086644;
    }

    /* 🔴 Disabled button style */
    .btn:disabled {
        background: #b5b5b5;
        cursor: not-allowed;
        opacity: 0.7;
    }

    .login-link {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .login-link a {
        color: #0a8754;
        text-decoration: none;
        font-weight: bold;
    }

    @media (max-width: 600px) {
        .form-row {
            flex-direction: column;
        }

        .form-container {
            width: 90%;
        }
    }
</style>
</head>

<body>

<div class="form-container">
    <h2>Zanzibar Online Marketing System</h2>
    <h2>Create Account</h2><br>
    @if(session('success'))
    <span style="color: green;text-align: center;margin-bottom: 3px;">{{ session('success') }}</span>

    @endif

    <form action="{{ route('buyers.store') }}" id="signupForm" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" id="firstName" name="firstname" required placeholder="Enter first name">
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" id="lastName" name="middlename" required placeholder="Enter last name">
            </div>

            
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="lastName" name="lastname" required placeholder="Enter last name">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter email">
            </div>

            
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="">Select Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" id="phone" name="mobile" required placeholder="Enter phone">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter password">
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="confirmPassword" required placeholder="Confirm password">
                <small id="passwordError" style="color:red; display:none;">Password does not match</small>
            </div>
        </div>
        <div class="form-group" style="display: none;">
                <label>role</label>
                <input type="hidden"  name="role" value="customer">
            </div>

        <button type="submit" id="signupBtn" class="btn" disabled>Sign Up</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="{{ route('login') }}">Login</a>
    </div>
</div>

<script>
    const form = document.getElementById("signupForm");
    const inputs = form.querySelectorAll("input, select");
    const signupBtn = document.getElementById("signupBtn");

    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");
    const passwordError = document.getElementById("passwordError");

    function checkForm() {
        let allFilled = true;

        inputs.forEach(input => {
            if (input.value.trim() === "") {
                allFilled = false;
            }
        });

       
        if (confirmPassword.value.length > 0) {
            if (password.value !== confirmPassword.value) {
                passwordError.style.display = "block";
                signupBtn.disabled = true;
                return;
            } else {
                passwordError.style.display = "none";
            }
        } else {
            passwordError.style.display = "none";
        }

        signupBtn.disabled = !allFilled;
    }


    inputs.forEach(input => {
        input.addEventListener("input", checkForm);
    });

   
    confirmPassword.addEventListener("input", checkForm);
</script>

</body>
</html>