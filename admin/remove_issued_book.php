<?php
	session_start();
	if (!isset($_SESSION['email'])) {
		header("Location: index.php");
		exit;
	}
	$connection = mysqli_connect("localhost:3307", "root", "", "lms");

	if(isset($_GET['id'])) {
		$issued_id = $_GET['id'];

		$query = "DELETE FROM issued_books WHERE s_no = ?";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, "i", $issued_id);

		if(mysqli_stmt_execute($stmt)) {
			header("Location: view_issued_book.php");
			exit();
		} else {
			echo "Error deleting record: " . mysqli_error($connection);
		}

		mysqli_stmt_close($stmt);
		mysqli_close($connection);
	} else {
		echo "No book ID provided.";
	}
?>
