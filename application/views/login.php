<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - LurnSuite</title>
    <style>
        body {
            min-height: 100vh;
            background: url('https://i.postimg.cc/Z5MCcrqh/teacherimg.png') no-repeat top center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Arial, sans-serif;
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.55);
            z-index: 0;
        }
        .login-glass {
            position: relative;
            z-index: 1;
            background: rgba(255,255,255,0.85);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 18px;
            padding: 40px 32px 24px 32px;
            max-width: 370px;
            width: 100%;
            margin: 40px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow: hidden;
        }
        .login-glass .lock-icon {
            background: #ede9fe;
            color: #7c3aed;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 18px;
        }
        .login-glass h2 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #22223b;
            text-align: center;
        }
        .login-glass .subtitle {
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 22px;
            text-align: center;
        }
        .login-glass label {
            font-weight: 500;
            color: #22223b;
            margin-bottom: 4px;
            display: block;
        }
        .login-glass .input-group {
            width: 100%;
            margin-bottom: 18px;
        }
        .login-glass .input-wrapper {
            position: relative;
            width: 100%;
        }
        .login-glass input[type="email"],
        .login-glass input[type="text"],
        .login-glass input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 12px 14px 12px 38px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            background: #f9fafb;
            font-size: 1rem;
            color: #22223b;
            outline: none;
            transition: border 0.2s;
            display: block;
        }
        .login-glass .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a1a1aa;
            font-size: 1.1rem;
            pointer-events: none;
        }
        .login-glass button[type="submit"] {
            width: 100%;
            background: #7c3aed;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-size: 1.1rem;
            font-weight: 600;
            margin-top: 8px;
            margin-bottom: 18px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .login-glass button[type="submit"]:hover {
            background: #5b21b6;
        }
        .login-glass .terms {
            font-size: 0.95rem;
            color: #6b7280;
            text-align: center;
            margin-top: 10px;
        }
        .login-glass .terms a {
            color: #7c3aed;
            text-decoration: none;
        }
        @media (max-width: 500px) {
            .login-glass {
                padding: 24px 8px 16px 8px;
            }
        }
    </style>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    <form class="login-glass" action="<?php echo site_url('login/validate_login'); ?>" method="post" novalidate onsubmit="return validateLoginForm();">
        <div class="lock-icon">
            <i class="fa fa-lock"></i>
        </div>
        <?php if ($this->session->flashdata('error_message')): ?>
            <div style="background:#fee2e2;color:#b91c1c;padding:12px 18px;border-radius:8px;font-size:1rem;text-align:center;border:1px solid #fca5a5;margin-bottom:12px;">
                <?php echo $this->session->flashdata('error_message'); ?>
            </div>
        <?php endif; ?>
        <h2>Welcome back</h2>
        <div class="subtitle">Sign in to your account to continue</div>
        <div class="input-group">
            <label for="emailaddress">Email or Username</label>
            <div class="input-wrapper">
                <span class="input-icon"><ion-icon name="mail-outline"></ion-icon></span>
                <input type="email" name="email" id="emailaddress" required placeholder="Enter your email or username" autocomplete="username" />
                <span class="input-error" id="email-error" style="display:none;color:#b91c1c;font-size:0.95em;margin-top:2px;"></span>
            </div>
        </div>
        <div class="input-group">
            <label for="phonenumber">Phone No.</label>
            <div class="input-wrapper">
                <span class="input-icon"><ion-icon name="call-outline"></ion-icon></span>
                <input type="text" name="phone" id="phonenumber" required pattern="[0-9]{11}" placeholder="e.g. 08123456789" autocomplete="tel" />
                <span class="input-error" id="phone-error" style="display:none;color:#b91c1c;font-size:0.95em;margin-top:2px;"></span>
            </div>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <div class="input-wrapper">
                <span class="input-icon"><ion-icon name="person-outline"></ion-icon></span>
                <input type="password" name="password" id="password" required placeholder="Enter your password" autocomplete="current-password" />
                <span class="input-error" id="password-error" style="display:none;color:#b91c1c;font-size:0.95em;margin-top:2px;"></span>
            </div>
        </div>
        <button type="submit">Sign in</button>
        <div class="terms">
            By continuing, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
        </div>
    </form>
    <script>
    function validateLoginForm() {
        let valid = true;
        // Email
        const email = document.getElementById('emailaddress');
        const emailError = document.getElementById('email-error');
        if (!email.value) {
            emailError.textContent = 'Email is required.';
            emailError.style.display = 'block';
            valid = false;
        } else {
            emailError.style.display = 'none';
        }
        // Phone
        const phone = document.getElementById('phonenumber');
        const phoneError = document.getElementById('phone-error');
        const phonePattern = /^[0-9]{11}$/;
        if (!phone.value) {
            phoneError.textContent = 'Phone number is required.';
            phoneError.style.display = 'block';
            valid = false;
        } else if (!phonePattern.test(phone.value)) {
            phoneError.textContent = 'Phone must be 11 digits (e.g. 08123456789).';
            phoneError.style.display = 'block';
            valid = false;
        } else {
            phoneError.style.display = 'none';
        }
        // Password
        const password = document.getElementById('password');
        const passwordError = document.getElementById('password-error');
        if (!password.value) {
            passwordError.textContent = 'Password is required.';
            passwordError.style.display = 'block';
            valid = false;
        } else {
            passwordError.style.display = 'none';
        }
        return valid;
    }
    </script>
</body>
</html>
