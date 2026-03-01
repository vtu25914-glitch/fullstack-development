<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'student') {
    header("Location: ../dashboard/dashboard.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT courses.title, courses.description, courses.price
        FROM enrollments
        JOIN courses ON enrollments.course_id = courses.id
        WHERE enrollments.user_id='$user_id'";

$result = $conn->query($sql);
?>

<h2>My Enrollments</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
    </div>
<?php } ?>

<a href="../dashboard/dashboard.php">Back</a>