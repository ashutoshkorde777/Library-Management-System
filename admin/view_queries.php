<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("Location: index.php");
		exit;
	}
	$connection = mysqli_connect("localhost:3307", "root", "", "lms");

	$query = "SELECT * FROM books WHERE book_no NOT IN (SELECT book_no FROM issued_books WHERE status = 1)";
	$result = mysqli_query($connection, $query);
?>


<?php
require("functions.php");
$queries = get_all_user_queries(); // Assuming you have a function to retrieve all queries from the user_queries table
?>

<!DOCTYPE html>
<html>
<head>
	<title>Available Books</title>
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
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="#">View Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="#">Edit Profile</a>
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
        <h2>All Queries</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Query</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php foreach ($queries as $query): ?>
                    <tr>
                        <td><?php echo $query['id']; ?></td>
                        <td><?php echo $query['user_id']; ?></td>
                        <td><?php echo $query['query']; ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
	mysqli_close($connection);
?>
