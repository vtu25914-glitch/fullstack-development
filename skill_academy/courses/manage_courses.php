<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../dashboard/dashboard.php");
    exit();
}

$instructor_id = $_SESSION['user_id'];

$sql = "SELECT * FROM courses WHERE instructor_id='$instructor_id'";
$result = $conn->query($sql);
?>

<h2>My Courses</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div style="border:1px solid black; padding:10px; margin-bottom:10px;">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
    </div>
<?php } ?>

<a href="../dashboard/dashboard.php">Back</a>