<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .container {
            width: 50%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #aaa;
        }
        .input-text {
            width: calc(100% - 40px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            position: relative;
        }
        .login-btn {
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
        }
        .register-link {
            display: block;
            margin-top: 20px;
            text-align: center;
        }
        .error {
            color: red;
            text-align: center;
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
        }
        img{
           width: 150px;
            height: 150px;
        } 
    </style>
</head>
<body style="background-image: url('path_to_your_background_image.jpg'); background-size: cover;">

    <div class="container">
        <h1><img src="Account login.jpg">Login</h1>

        <form action="login_process.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" class="input-text" required>

            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" name="password" class="input-text" id="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
            </div>
            
            <label for="user_account">User Account:</label>
            <select name="user_account" class="input-text" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select>

            <input type="submit" value="Login" class="login-btn">
        </form>
        <div class="register-link">
            Don't have an account? <a href="signup.php">Register here</a>
        </div>
        <?php if(isset($_GET['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var passwordToggle = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.textContent = "🙈";
            } else {
                passwordField.type = "password";
                passwordToggle.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
