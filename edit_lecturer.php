<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_account'] != 'admin') {
    header('Location: login.php');
    exit();
}

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $lecturer_id = $_POST['id'];

    // Fetch lecturer details
    $lecturer_query = "SELECT * FROM myguests WHERE id = $lecturer_id AND user_account = 'lecturer'";
    $lecturer_result = $database->query($lecturer_query);

    if ($lecturer_result->num_rows > 0) {
        $lecturer = $lecturer_result->fetch_assoc();
    } else {
        echo "Lecturer not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $lecturer_id = $_POST['id'];
    $new_name = $_POST['name'];

    // Update lecturer's name
    $update_query = "UPDATE myguests SET name = '$new_name' WHERE id = $lecturer_id";

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
    <title>Edit Lecturer</title>
</head>
<body>
    <h2>Edit Lecturer</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $lecturer['id']; ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($lecturer['name']); ?>" required>
        <button type="submit" name="update">Update</button>
    </form>
    <a href="admin_home.php">Cancel</a>
</body>
</html>
