<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("Location: index.php");
		exit;
	}

	function get_user_issue_book_count(){
		$connection = mysqli_connect("localhost:3307","root","");
		$db = mysqli_select_db($connection,"lms");
		$user_issue_book_count = 0;
		$query = "select count(*) as user_issue_book_count from issued_books where student_id = $_SESSION[id]";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_issue_book_count = $row['user_issue_book_count'];
		}
		return($user_issue_book_count);
	}

	function get_user_total_fine() {
		$connection = mysqli_connect("localhost:3307", "root", "");
		$db = mysqli_select_db($connection, "lms");
	
		$user_id = $_SESSION['id'];
		$query = "SELECT SUM(fine_amount) AS total_fine 
				  FROM fines 
				  WHERE user_id = $user_id";
	
		$query_run = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($query_run);
		$total_fine = $row['total_fine'];
		return $total_fine;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="user_dashboard.php">Dashboard</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
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
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee>This is library management system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
	<div class="row">
		<div class="col-md-3" style="margin: 25px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Book Issued</div>
				<div class="card-body">
					<p class="card-text">No of books issued: <?php echo get_user_issue_book_count();?></p>
					<a class="btn btn-success" href="view_issued_book.php">View Issued Books</a>
				</div>
			</div>
		</div>
		<div class="col-md-3" style="margin: 25px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header">Total Fines</div>
				<div class="card-body">
					<p class="card-text">Total fines: <?php echo get_user_total_fine();?> </p>
				</div>
			</div>
		</div>
		<div class="col-md-6" style="margin: 25px">
    <div class="card bg-light">
        <div class="card-header">Submit Query</div>
        <div class="card-body">
            <form action="submit_query.php" method="post">
                <div class="form-group">
                    <label for="query">Your Query:</label>
                    <textarea class="form-control" id="query" name="query" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
		<div class="col-md-3"></div>
	</div>
</body>
</html>
