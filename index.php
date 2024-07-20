<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
    margin: 0;
    padding: 0;
    background-image: url('home page.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.header {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    padding: 10px;
    position: absolute;
    top: 0;
    right: 0;
}

.container {
    width: 50%;
    margin-top: 50px;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px #aaa;
    text-align: center;
    background: rgba(255, 255, 255, 0.8);
}

.btn {
    padding: 10px 20px;
    margin: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
    text-decoration: none;
}

.signup-btn {
    background-color: #28a745;
}

.login-btn {
    background-color: #007bff;
}

    </style>
</head>
<body>
    <div class="header">
        <a href="signup.php" class="btn signup-btn">Sign Up</a>
        <a href="login.php" class="btn login-btn">Login</a>
    </div>
  
</body>
</html>
