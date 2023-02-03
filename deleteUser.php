<?php
    include "db_connection.php";    
    //get the email from the user(key)
    $id = $_GET['link'];
    //Find the user
    $query = "DELETE FROM Users WHERE Loginname = '$id'";
    //Execute delete
    $result = mysqli_query($conn, $query);
    header("Location: editUser.php");
?>