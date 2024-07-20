<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_account'] != 'student') {
    header('Location: login.php');
    exit();
}

// Include database connection
include("connection.php");

// Fetch student details
$username = $_SESSION['username'];
$student_query = "SELECT * FROM myguests WHERE username = '$username'";
$student_result = $database->query($student_query);
$student = $student_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .advice {
            background: #f0f0f0;
            padding: 10px;
            border-left: 4px solid #4CAF50;
            margin-bottom: 20px;
        }
        .advice h2 {
            margin-top: 0;
        }
        .advice ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
        .advice li {
            margin-bottom: 10px;
        }
        .links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .links a {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .navigation {
            margin-top: 20px;
            display: flex;
            justify-content: space-around;
            background-color: #ddd;
            padding: 10px;
            border-radius: 5px;
        }
        .navigation a {
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .navigation a:hover {
            background-color: #4CAF50;
            color: white;
        }
        img{
           width: 150px;
            height: 150px;
        } 
    </style>
</head>
<body>
    <div class="container">
        <div>
        <h1> <img src="Account login.jpg">Welcome, <?php echo htmlspecialchars($student['name']); ?></h1>
<div>
        <div class="navigation">
            <a href="#">Notes</a>
            <a href="#">Grades</a>
            <a href="#">CATS</a>
            <a href="#">Additional Notes</a>
        </div>

        <div class="advice">
            <h2>Student Advice</h2>
            <p>As you embark on your university journey, here are some tips to help you succeed:</p>
            <ul>
                <li><strong>Attend Classes Regularly:</strong> Attendance is crucial for understanding lectures and participating in discussions.</li>
                <li><strong>Manage Your Time:</strong> Create a schedule to balance study, assignments, and personal activities.</li>
                <li><strong>Engage with Professors:</strong> Don't hesitate to ask questions and seek clarification during office hours.</li>
                <li><strong>Join Student Organizations:</strong> Participate in clubs and societies to enrich your university experience and network.</li>
                <li><strong>Use University Resources:</strong> Utilize libraries, labs, and online resources for research and study purposes.</li>
                <li><strong>Stay Organized:</strong> Keep track of deadlines, assignments, and exams to avoid last-minute stress.</li>
                <li><strong>Seek Support:</strong> Reach out to counselors, advisors, or peers for academic and personal support when needed.</li>
            </ul>
            <p><strong>Dealing with Exam Irregularities:</strong></p>
            <p>It's essential to maintain academic integrity and honesty during exams. Here's how to handle exam irregularities:</p>
            <ul>
                <li><strong>Understand the Rules:</strong> Familiarize yourself with the university's policies on exams, including rules against cheating, plagiarism, and unauthorized assistance.</li>
                <li><strong>Prepare Thoroughly:</strong> Study well in advance to reduce the temptation to cheat or rely on unfair means during exams.</li>
                <li><strong>Report Suspected Irregularities:</strong> If you witness or suspect any exam misconduct, report it to the appropriate authorities or your professor immediately.</li>
                <li><strong>Stay Honest:</strong> Uphold academic honesty and personal integrity at all times, as violating exam rules can have serious consequences for your academic record and future career.</li>
                <li><strong>Seek Guidance:</strong> If you're uncertain about exam procedures or have concerns about academic conduct, seek guidance from your professors or university support services.</li>
            </ul>
        </div>

        <p>Your Username: <?php echo htmlspecialchars($student['username']); ?></p>

        <div class="links">
            <a href="home.php">Go to Home page</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
