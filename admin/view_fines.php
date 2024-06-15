<?php
require("functions.php");
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fines</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
        </div>
        <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
        <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></font>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="view_profile.php">View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="change_password.php">Change Password</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav><br>
<span><marquee>This is library management system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
<div class="container">
    <h2>Fines</h2>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Email</th>
            <th>Fine Amount (Rupees)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $fines = get_fines();
        foreach ($fines as $fine) {
            echo "<tr>";
            echo "<td>".$fine['student_name']."</td>";
            echo "<td>".$fine['email']."</td>";
            echo "<td>".$fine['fine_amount']."</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
