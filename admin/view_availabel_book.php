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
		<div class="row">
			<div class="col-md-12">
				<h4>Available Books</h4>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Book Name</th>
							<th>Author</th>
							<th>Book Number</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($row = mysqli_fetch_assoc($result)) {
								echo "<tr>";
								echo "<td>".$row['book_name']."</td>";
								echo "<td>".$row['author']."</td>";
								echo "<td>".$row['book_no']."</td>";
								echo "<td><a href='issue_book.php?book_no=".$row['book_no']."'>Issue</a></td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	mysqli_close($connection);
?>
