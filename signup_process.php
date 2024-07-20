<?php
session_start();

// Include database connection
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $user_account = $_POST['user_account'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input
    if (!empty($name) && !empty($user_account) && !empty($username) && !empty($password)) {
        $query = "SELECT * FROM myguests WHERE username = '$username'";
        $result = $database->query($query);

        if ($result && $result->num_rows > 0) {
            $error_message = "Error: Username already exists. Please choose a different username.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO myguests (name, user_account, username, password) VALUES ('$name', '$user_account', '$username', '$hashed_password')";

            if ($database->query($insert_query)) {
                $_SESSION['username'] = $username;
                $_SESSION['user_account'] = $user_account;
                header('Location: home.php');
                exit();
            } else {
                $error_message = "Error: Failed to register user. Please try again.";
            }
        }
    } else {
        $error_message = "Error: Please fill in all required fields.";
    }

    header('Location: signup.php?error=' . urlencode($error_message));
    exit();
}
?>
