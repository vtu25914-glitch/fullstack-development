<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
?>

<h2>Welcome to Dashboard</h2>
<p>Your Role: <?php echo $_SESSION['role']; ?></p>

<?php if($_SESSION['role'] == 'instructor'): ?>
    <a href="../courses/add_course.php">Add Course</a><br>
    <a href="../courses/manage_courses.php">Manage My Courses</a><br>
    <a href="../courses/course_students.php">View Enrolled Students</a><br>
<?php endif; ?>

<?php if($_SESSION['role'] == 'student'): ?>
  <a href="../courses/my_enrollments.php">My Enrollments</a><br>
<?php endif; ?>

<a href="../auth/logout.php">Logout</a>