<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../dashboard/dashboard.php");
    exit();
}

$sql = "SELECT courses.*, users.name AS instructor_name 
        FROM courses 
        JOIN users ON courses.instructor_id = users.id";

$result = $conn->query($sql);
?>

<h2>Available Courses</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
        <p>Instructor: <?php echo $row['instructor_name']; ?></p>

        <form method="POST" action="enroll.php">
            <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Enroll</button>
        </form>
    </div>
<?php } ?>

<a href="../dashboard/dashboard.php">Back</a>