<?php
    include "db_connection.php";
    //Get the id variable
    $id = $_GET['link'];
    //Find the announcement
    $query = "DELETE FROM Announcements WHERE Number = '$id'";
    //Execute delete
    $result = mysqli_query($conn, $query);
    header("Location: announcements.php");
?>