<?php
	$connection = mysqli_connect("localhost:3307", "root", "", "lms");

	function get_author_count(){
		global $connection;
		$author_count = 0;
		$query = "SELECT COUNT(*) AS author_count FROM authors";
		$query_run = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$author_count = $row['author_count'];
		}
		return $author_count;
	}

	function get_user_count(){
		global $connection;
		$user_count = 0;
		$query = "SELECT COUNT(*) AS user_count FROM users";
		$query_run = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_count = $row['user_count'];
		}
		return $user_count;
	}

	function get_book_count(){
		global $connection;
		$book_count = 0;
		$query = "SELECT COUNT(*) AS book_count FROM books";
		$query_run = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$book_count = $row['book_count'];
		}
		return $book_count;
	}

	function get_issue_book_count(){
		global $connection;
		$issue_book_count = 0;
		$query = "SELECT COUNT(*) AS issue_book_count FROM issued_books";
		$query_run = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$issue_book_count = $row['issue_book_count'];
		}
		return $issue_book_count;
	}

	function get_category_count(){
		global $connection;
		$cat_count = 0;
		$query = "SELECT COUNT(*) AS cat_count FROM category";
		$query_run = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$cat_count = $row['cat_count'];
		}
		return $cat_count;
	}

	function get_available_book_count() {
		global $connection;
		$query = "SELECT COUNT(*) AS count FROM books WHERE book_no NOT IN (SELECT book_no FROM issued_books)"; 
		$query_run = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($query_run);
		return $row['count'];
	}

	function get_author_name($author_id) {
		global $connection;
		$query = "SELECT author_name FROM authors WHERE author_id = '$author_id'";
		$query_run = mysqli_query($connection, $query);
		$author_name = "";
	
		if ($query_run) {
			$row = mysqli_fetch_assoc($query_run);
			$author_name = $row['author_name'];
		}
	
		return $author_name;
	}

	function calculate_fine($book_no, $issue_date) {
		$due_date = date('Y-m-d', strtotime($issue_date. ' + 7 days'));
		$current_date = date('Y-m-d');
		$days_late = (strtotime($current_date) - strtotime($due_date)) / (60 * 60 * 24);
		
		$fine_amount = max(0, $days_late * 5);
	
		return $fine_amount;
	}

	function insert_fine($student_id, $fine_amount) {
		global $connection;
		$fine_date = date('Y-m-d');
		$query = "INSERT INTO fines (student_id, fine_amount, fine_date) VALUES ('$student_id', '$fine_amount', '$fine_date')";
		$result = mysqli_query($connection, $query);
		return $result;
	}

	function get_fines() {
		global $connection;
		$query = "SELECT u.name AS user_name, u.email, f.fine_amount 
				  FROM fines f
				  INNER JOIN users u ON f.user_id = u.id";
		$result = mysqli_query($connection, $query);
		$fines = [];
		while($row = mysqli_fetch_assoc($result)) {
			$fines[] = $row;
		}
		return $fines;
	}

	function get_all_queries() {
		$connection = mysqli_connect("localhost:3307", "root", "", "lms");
		$query = "SELECT * FROM user_queries";
		$result = mysqli_query($connection, $query);
		$queries = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$queries[] = $row;
		}
		return $queries;
	}

	function get_all_user_queries() {
		$connection = mysqli_connect("localhost:3307", "root", "");
		$db = mysqli_select_db($connection, "lms");
	
		$query = "SELECT * FROM user_queries";
		$query_run = mysqli_query($connection, $query);
	
		$queries = [];
		while ($row = mysqli_fetch_assoc($query_run)) {
			$queries[] = $row;
		}
	
		return $queries;
	}
	
?>
