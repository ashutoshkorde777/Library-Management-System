<?php
require("functions.php");

$query = "SELECT book_no, issue_date FROM issued_books WHERE DATEDIFF(NOW(), issue_date) > 7";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $book_no = $row['book_no'];
    $issue_date = $row['issue_date'];
    $fine_amount = calculate_fine($book_no, $issue_date);
    insert_fine($student_id, $fine_amount);
}
?>
