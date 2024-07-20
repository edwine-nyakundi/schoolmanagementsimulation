<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        .container {
            width: 50%;
            margin: auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px #aaa;
        }
        .input-text, .select-dropdown {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .signup-btn {
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
        }
        .error {
            color: red;
            text-align: center;
        }
        .password-container {
            position: relative;
            width: 100%;
        }
        .password-input {
            width: calc(100% - 40px); /* Adjust width for the eye icon */
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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
<body>
    <div class="container">
        <h1><img src="Account creation.jpg">Sign Up</h1>
        <form action="signup_process.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" class="input-text" required>

            <label for="user_account">User Account:</label>
            <select name="user_account" class="select-dropdown" required>
                <option value="" disabled selected>Select your role</option>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            
            <label for="username">Username:</label>
            <input type="text" name="username" class="input-text" required>

            <label for="password">Password:</label>
            <div class="password-container">
                <input type="password" name="password" class="input-text password-input" id="password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">👁️</span>
            </div>

            <input type="submit" value="Sign Up" class="signup-btn">
            <input type="reset" value="Clear" class="signup-btn">
        </form>
        
        <!-- Link to Login -->
        <div style="text-align: center; margin-top: 10px;">
            Already have an account? <a href="login.php">Login here</a>
        </div>

        <!-- Error Display -->
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
