<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../dashboard/dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $instructor_id = $_SESSION['user_id'];

    $sql = "INSERT INTO courses (title, description, price, instructor_id, created_at)
            VALUES ('$title', '$description', '$price', '$instructor_id', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Course added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Add Course</h2>

<form method="POST">
    Title: <input type="text" name="title" required><br><br>
    Description: <textarea name="description" required></textarea><br><br>
    Price: <input type="number" name="price" required><br><br>
    <button type="submit">Add Course</button>
</form>

<br>
<a href="../dashboard/dashboard.php">Back to Dashboard</a>