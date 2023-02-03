<?php
    include "db_connention.php";
    session_start();
    $sql = "SELECT * FROM Users";
    //$data = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style2.css">
    </head>

    <?php
        //row is an array with the table Users from the database
        //while($row = mysqli_fetch_array($data)){
    ?>
    <div class="container-for-editUser">
        <form action="" method="post">
            <input type="text" name="role" placeholder="Role">
            <input type="text" name="name" placeholder="Name">
            <input type="text" name="lastname" placeholder="Lastname">
            <input type="text" name="password" placeholder="Password">
            <input type="email" name="loginname" placeholder="Loginname">
        </form>
    </div>
    <?php
       // }
    ?>
</html>