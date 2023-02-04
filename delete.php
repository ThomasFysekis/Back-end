<?php
    include "db_connection.php";
    session_start();

    //check if user is loged in
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    //Delete data from the table that is saved into SESSION

    if($_SESSION['Table'] === 'Announcements'){
         //Get the id variable
        $id = $_GET['link'];
        //Find the announcement
        $query = "DELETE FROM Announcements WHERE Number = '$id'";
        //Execute delete
        $result = mysqli_query($conn, $query);
        header("Location: announcements.php");
    }else if ($_SESSION['Table'] === 'Users'){
        //get the email from the user(key)
        $id = $_GET['link'];
        if(!$_SESSION["Loginname"] === $id){
            //Find the user
            $query = "DELETE FROM Users WHERE Loginname = '$id'";
            //Execute delete
            $result = mysqli_query($conn, $query);
            header("Location: editUser.php");
        }else{
            $value = 0;
            header("Location: editUser.php?value = .$value");
        }
    }else if ($_SESSION['Table'] === 'Homework'){
        //Get the id variable
        $id = $_GET['link'];
        //find the homework
        $query = "DELETE FROM Homework WHERE Number = '$id'";
        //Execute delete
        $result = mysqli_query($conn, $query);
        header("Location: homework.php");
    }else if ($_SESSION['Table'] === 'Documents'){
        //Get the id variable
        $id = $_GET['link'];
        //find the doc
        $query = "DELETE FROM Documents WHERE Number = '$id'";
        //Execute delete
        $result = mysqli_query($conn, $query);
        header("Location: documents.php");
    }
?>