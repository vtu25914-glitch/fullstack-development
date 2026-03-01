<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../dashboard/dashboard.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$course_id = $_POST['course_id'];

$sql = "INSERT INTO enrollments (user_id, course_id, status)
        VALUES ('$user_id', '$course_id', 'enrolled')";

if ($conn->query($sql) === TRUE) {
    echo "Enrollment successful!";
} else {
    echo "Error: " . $conn->error;
}

echo "<br><a href='view_courses.php'>Back to Courses</a>";
?>