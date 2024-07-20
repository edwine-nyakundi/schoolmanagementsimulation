<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_account'] != 'lecturer') {
    header('Location: login.php');
    exit();
}

// Include database connection
include("connection.php");

// Function to fetch all students
function fetchStudents($database) {
    $students_query = "SELECT * FROM myguests WHERE user_account = 'student'";
    $students_result = $database->query($students_query);
    return $students_result;
}

// Fetch all  students

$students_result = fetchStudents($database);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Home</title>
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
        
        .credentials {
            background: #f0f0f0;
            padding: 10px;
            border-left: 4px solid #4CAF50;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Welcome lecturer</h1>

    <!-- Form for registering new lecturer or student -->
   

   
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
                        <form method="post" action="edit_student2.php">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <button type="submit">Edit</button>
                        </form>
                        <form method="post" action="delete_student2.php" onsubmit="return confirm('Are you sure you want to delete this student?');">
                            <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

 
    <div class="credentials">
        <h2>Managing Student Credentials</h2>
        <p>As a Lecture, ensuring student credentials are handled securely is crucial. Here are some best practices:</p>
        <ul>
            <li><strong>Create Strong Password Policies:</strong> Require students to create complex passwords and periodically update them.</li>
            <li><strong>Implement Multi-Factor Authentication (MFA):</strong> Add an extra layer of security by requiring students to verify their identity using MFA.</li>
            <li><strong>Regularly Audit User Accounts:</strong> Review student accounts periodically to identify and disable inactive or outdated accounts.</li>
            <li><strong>Encrypt Sensitive Information:</strong> Ensure that any stored student data, such as personal details or grades, is encrypted to protect against unauthorized access.</li>
            <li><strong>Train Staff and Students:</strong> Educate faculty and students about security best practices, including recognizing phishing attempts and safeguarding their login credentials.</li>
            <li><strong>Respond to Security Incidents:</strong> Have protocols in place to quickly respond to and mitigate any security breaches or unauthorized access incidents.</li>
        </ul>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>

