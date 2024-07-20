<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_account'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Include database connection
include("connection.php");

// Function to fetch all lecturers
function fetchLecturers($database) {
    $lecturers_query = "SELECT * FROM myguests WHERE user_account = 'lecturer'";
    $lecturers_result = $database->query($lecturers_query);
    return $lecturers_result;
}

// Function to fetch all students
function fetchStudents($database) {
    $students_query = "SELECT * FROM myguests WHERE user_account = 'student'";
    $students_result = $database->query($students_query);
    return $students_result;
}

// Check if form submitted for new lecturer or student registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $user_account = $_POST['user_account']; // Should be either 'lecturer' or 'student'

        // Insert new user into database
        $insert_query = "INSERT INTO myguests (name, user_account) VALUES ('$name', '$user_account')";
        if ($database->query($insert_query) === TRUE) {
            // Redirect to avoid form resubmission on refresh
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $database->error;
        }
    }
}

// Fetch all lecturers and students
$lecturers_result = fetchLecturers($database);
$students_result = fetchStudents($database);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <style>
        table {
            width: 30%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .edit-delete {
            display: flex;
            gap: 10px;
        }
        .edit-delete button {
            padding: 5px 10px;
            cursor: pointer;
        }
        .register-form {
            margin: 20px auto;
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .register-form input, .register-form select, .register-form button {
            margin: 5px;
            padding: 8px;
            width: calc(100% - 18px);
            box-sizing: border-box;
        }
        .register-form button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Welcome Admin</h1>

    <!-- Form for registering new lecturer or student -->
    <div class="register-form">
        <h2>Register New User</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label>Name:</label>
            <input type="text" name="name" required>
            <label>User Account:</label>
            <select name="user_account" required>
                <option value="lecturer">Lecturer</option>
                <option value="student">Student</option>
            </select>
            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <!-- Display Lecturers -->
    <table>
        <caption>Lecturers</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $lecturerCount = 0; ?>
            <?php while ($lecturer = $lecturers_result->fetch_assoc()): ?>
                <?php $lecturerCount++; ?>
                <tr>
                    <td><?php echo $lecturerCount; ?></td>
                    <td><?php echo htmlspecialchars($lecturer['name']); ?></td>
                    <td class="edit-delete">
                        <form method="post" action="edit_lecturer.php">
                            <input type="hidden" name="id" value="<?php echo $lecturer['id']; ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form method="post" action="delete_lecturer.php" onsubmit="return confirm('Are you sure you want to delete this lecturer?');">
                            <input type="hidden" name="id" value="<?php echo $lecturer['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Display Students -->
    <table>
        <caption>Students</caption>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $studentCount = 0; ?>
            <?php while ($student = $students_result->fetch_assoc()): ?>
                <?php $studentCount++; ?>
                <tr>
                    <td><?php echo $studentCount; ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td class="edit-delete">
                        <form method="post" action="edit_student.php">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form method="post" action="delete_student.php" onsubmit="return confirm('Are you sure you want to delete this student?');">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="logout.php">Logout</a>
</body>
</html>
