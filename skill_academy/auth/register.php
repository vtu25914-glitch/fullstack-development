<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../config/db.php");

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name,email,password,role) 
            VALUES ('$name','$email','$password','$role')";

    if($conn->query($sql)){
        echo "<p style='color:green;'>Registration successful!</p>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h2>Register</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Role:
    <select name="role">
        <option value="student">Student</option>
        <option value="instructor">Instructor</option>
    </select><br><br>
    <button name="register">Register</button>
</form>