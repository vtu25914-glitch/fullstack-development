<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");   // go back one folder
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "student_db", 3307);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$order = "";
$where = "";

if (isset($_GET['sort'])) {
    if ($_GET['sort'] == "name") {
        $order = "ORDER BY name ASC";
    } elseif ($_GET['sort'] == "dob") {
        $order = "ORDER BY dob ASC";
    }
}

if (isset($_GET['department']) && $_GET['department'] != "") {
    $dept = $_GET['department'];
    $where = "WHERE department='$dept'";
}

$sql = "SELECT * FROM students $where $order";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .logout {
            text-align: right;
            margin: 10px 20px;
        }

        .logout a {
            text-decoration: none;
            padding: 8px 15px;
            background: red;
            color: white;
            border-radius: 5px;
        }

        .controls {
            text-align: center;
            margin-bottom: 20px;
        }

        .controls a {
            text-decoration: none;
            padding: 8px 15px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
        }

        .controls a:hover {
            background: #0056b3;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        select, button {
            padding: 8px 12px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background: #28a745;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1e7e34;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th {
            background: #343a40;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .count-box {
            margin-top: 30px;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="logout">
    <a href="../logout.php">Logout</a>
</div>

<h2>Student Dashboard</h2>

<div class="controls">
    <a href="dashboard.php">Show All</a>
    <a href="dashboard.php?sort=name">Sort by Name</a>
    <a href="dashboard.php?sort=dob">Sort by DOB</a>
</div>

<form method="GET">
    <select name="department">
        <option value="">Filter by Department</option>
        <option>CSE</option>
        <option>ECE</option>
        <option>EEE</option>
        <option>MECH</option>
    </select>
    <button type="submit">Filter</button>
</form>

<br>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>DOB</th>
    <th>Department</th>
    <th>Phone</th>
</tr>

<?php
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['dob']}</td>
            <td>{$row['department']}</td>
            <td>{$row['phone']}</td>
          </tr>";
}
?>

</table>

<br>

<h3 style="text-align:center;">Department Wise Count</h3>

<div class="count-box">
<?php
$count_sql = "SELECT department, COUNT(*) as total FROM students GROUP BY department";
$count_result = mysqli_query($conn, $count_sql);

while ($row = mysqli_fetch_assoc($count_result)) {
    echo $row['department'] . " : " . $row['total'] . "<br>";
}

mysqli_close($conn);
?>
</div>

</body>
</html>