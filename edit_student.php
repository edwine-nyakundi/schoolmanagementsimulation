<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_account'] != 'admin') {
    header('Location: login.php');
    exit();
}

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $student_id = $_POST['id'];

    // Fetch student details
    $student_query = "SELECT * FROM myguests WHERE id = $student_id AND user_account = 'student'";
    $student_result = $database->query($student_query);

    if ($student_result->num_rows > 0) {
        $student = $student_result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $student_id = $_POST['id'];
    $new_name = $_POST['name'];

    // Update student's name
    $update_query = "UPDATE myguests SET name = '$new_name' WHERE id = $student_id";

    if ($database->query($update_query) === TRUE) {
        header('Location: admin_home.php');
        exit();
    } else {
        echo "Error updating record: " . $database->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($student['name']); ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <a href="admin_home.php">Cancel</a>
</body>
</html>
