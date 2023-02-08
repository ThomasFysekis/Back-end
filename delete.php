<?php
    include "functions.php";
    //database connect
    connected($conn);
    session_start();

    //check if user is loged in
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    //Delete data from the table that is saved into SESSION

    if(isset($_GET['link'])){
        $table = $_SESSION['Table'];
        //Get the id variable
        $id = $_GET['link'];
        //Find in the table what to delete with the ID
        $query = "DELETE FROM $table WHERE Number = '$id'";
        //Execute delete
        $result = mysqli_query($conn, $query);
        header("Location: $table.php");
        exit;
    }else{
        //If the user is trying delete himself,send him an error message
        $id = $_GET['email'];
        if(($_SESSION["Loginname"] == $id)){
            //send an error message to editUser because he is trying to delete himself
            $value = 0;
            header("Location: editUser.php?value = .$value");
            exit;
        }else{
            $table = $_SESSION['Table'];
            //Get the email variable
            $id = $_GET['email'];
            $query = "DELETE FROM $table WHERE Loginname = '$id'";
            //Execute delete
            $result = mysqli_query($conn, $query);
            header("Location: editUser.php");
            exit;
        }
    }


?>