<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("Location: index.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Issue Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		function alertMsg(){
  			alert('Book added successfully...');
  			window.location.href = "admin_dashboard.php";
  		}
  	</script>
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
	        		<a class="dropdown-item" href="">View Profile</a>
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
	<span><marquee>This is library management system. Library opens at 8:00 AM and closes at 8:00 PM</marquee></span><br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<div class="card">
					<div class="card-header bg-primary text-white">
						<h3 class="card-title">Issue Book</h3>
					</div>
					<div class="card-body">
						<form action="" method="post">
							<div class="form-group">
								<label for="book_name">Book Name:</label>
								<input type="text" name="book_name" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="book_author">Author Name:</label>
								<input type="text" name="book_author" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="book_no">Book Number:</label>
								<input type="text" name="book_no" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="student_id">Student ID:</label>
								<input type="text" name="student_id" class="form-control" required>
							</div>
							<div class="form-group">
								<label for="issue_date">Issue Date:</label>
								<input type="text" name="issue_date" class="form-control" value="<?php echo date("yy-m-d");?>" required>
							</div>
							<button type="submit" name="issue_book" class="btn btn-primary">Issue Book</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['issue_book']))
	{
		$connection = mysqli_connect("localhost:3307","root","");
		$db = mysqli_select_db($connection,"lms");

		// Prepare and bind
		$query = "INSERT INTO issued_books (book_no, book_name, book_author, student_id, status, issue_date) VALUES (?, ?, ?, ?, 1, ?)";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "issis", $_POST['book_no'], $_POST['book_name'], $_POST['book_author'], $_POST['student_id'], $_POST['issue_date']);

		// Execute the statement
		$result = mysqli_stmt_execute($stmt);
		
		if ($result) {
			echo '<script type="text/javascript">alertMsg();</script>';
		} else {
			echo "Error: " . $query . "<br>" . mysqli_error($connection);
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}
?>

