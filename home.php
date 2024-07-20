<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$user_account = $_SESSION['user_account'];

if ($user_account == 'admin') {
    header('Location: admin_home.php');
} elseif ($user_account == 'lecturer') {
    header('Location: lecturer_home.php');
} else {
    header('Location: student_home.php');
}
exit();
?>
