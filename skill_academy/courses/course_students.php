
<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../dashboard/dashboard.php");
    exit();
}

$instructor_id = $_SESSION['user_id'];

$sql = "SELECT users.name, users.email, courses.title
        FROM enrollments
        JOIN users ON enrollments.user_id = users.id
        JOIN courses ON enrollments.course_id = courses.id
        WHERE courses.instructor_id = '$instructor_id'";

$result = $conn->query($sql);
?>
<link rel="stylesheet" href="../assets/style.css">

<h2>Students Enrolled in Your Courses</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div class="card">
        <h3><?php echo $row['title']; ?></h3>
        <p>Student: <?php echo $row['name']; ?></p>
        <p>Email: <?php echo $row['email']; ?></p>
    </div>
<?php } ?>

<a href="../dashboard/dashboard.php">Back</a>