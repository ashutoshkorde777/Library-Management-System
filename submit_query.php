<?php
    session_start();
    if(isset($_POST['query'])) {
        $query = $_POST['query'];
        // Perform any necessary validation on the query

        // Add code to store the query in the database, along with the user's ID
        $user_id = $_SESSION['id'];
        $connection = mysqli_connect("localhost:3307", "root", "");
        $db = mysqli_select_db($connection, "lms");
        $insert_query = "INSERT INTO user_queries (user_id, query) VALUES ('$user_id', '$query')";
        $query_run = mysqli_query($connection, $insert_query);

        if($query_run) {
            echo '<script>alert("Query submitted successfully!")</script>';
            echo '<script>window.location.replace("user_dashboard.php")</script>';
        } else {
            echo '<script>alert("Failed to submit query. Please try again.")</script>';
            echo '<script>window.location.replace("user_dashboard.php")</script>';
        }
    }
?>
