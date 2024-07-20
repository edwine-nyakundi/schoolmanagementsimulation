<?php
session_start();

// Include database connection
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_account = $_POST['user_account']; // Selected role from login form

    if (!empty($username) && !empty($password) && !empty($user_account)) {
        // SQL injection prevention (not necessary with prepared statements)
        $username = mysqli_real_escape_string($database, $username);

        // Query to fetch user details
        $query = "SELECT * FROM myguests WHERE username = '$username' AND user_account = '$user_account'";
        $result = $database->query($query);

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['user_account'] = $user_account;

                // Redirect based on user role
                switch ($user_account) {
                    case 'admin':
                        header('Location: admin_home.php');
                        exit();
                    case 'lecturer':
                        header('Location: lecturer_home.php');
                        exit();
                    case 'student':
                        header('Location: student_home.php');
                        exit();
                    default:
                        // Handle unexpected cases
                        header('Location: login.php?error=Invalid user account');
                        exit();
                }
            } else {
                $error_message = "Error: Invalid username or password.";
            }
        } else {
            $error_message = "Error: Invalid username or password for the selected role.";
        }
    } else {
        $error_message = "Error: Please fill in all required fields.";
    }

    header('Location: login.php?error=' . urlencode($error_message));
    exit();
}
?>
