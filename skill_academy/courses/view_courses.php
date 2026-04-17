<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$result = $conn->query("SELECT * FROM courses");
?>
<link rel="stylesheet" href="../assets/style.css">
<h2>Available Courses</h2>

<?php while($row = $result->fetch_assoc()) { ?>
    <div class="card">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['description']; ?></p>
        <p>Price: ₹<?php echo $row['price']; ?></p>
        <form method="POST" action="enroll.php">
    <input type="hidden" name="course_id" value="<?php echo $row['id']; ?>">
    <button type="submit">Enroll</button>
</form>
    </div>
<?php } ?>

<a href="../dashboard/dashboard.php">Back to Dashboard</a>