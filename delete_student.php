<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_account'] != 'admin') {
    header('Location: login.php');
    exit();
}

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $student_id = $_POST['id'];

    // Delete student
    $delete_query = "DELETE FROM myguests WHERE id = $student_id AND user_account = 'student'";

    if ($database->query($delete_query) === TRUE) {
        header('Location: admin_home.php');
        exit();
    } else {
        echo "Error deleting record: " . $database->error;
    }
} else {
    echo "Invalid request.";
    exit();
}
?>
