<?php
    //Include the connection for the database
    include "functions.php";
    connected($conn);

    session_start();
    
    if(isset($_REQUEST['login-button'])){
        //Get the strings from the form
        $email = $_POST['email'];
        $password = $_POST['psw'];
        $role;
        //Search the database
        $select_query = mysqli_query($conn, "SELECT * FROM users WHERE Loginname = '$email' AND Password = '$password'");
        $row  = mysqli_fetch_array($select_query);
        //If we found the correct data,log in,else try again.
        if(is_array($row)) {
            //Save them as sessions
            $_SESSION["Loginname"] = $row['Loginname'];
            $_SESSION["Password"] = $row['Password'];
            //find the role of the user
            $_SESSION['Role'] = $row['Role'];
            if ($row['Role'] === 'Student' or $row['Role'] === 'Tutor'){
                //Log in for Tutor or Student
                header("Location: index.php");
                //Do extra stuff if the user is Tutor
                if ($row['Role' === 'Tutor']){
                    //header("Location: announcements.php");
                }
            }
        }else {
            header("Location: login.php?error=Incorect User name or Password");
        }
    }
    //if the user is loged in,we direct him to index.
    if($_SESSION["Loginname"]){
        header("Location: index.php");
    }

?>



<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="style.css">
    <title>Πιστοποίηση Χρήστη</title>
    <body>

        <form method="POST" action="#">
            <div class="container-for-login">
                <?php  if (isset($_GET['error'])) {  ?>
                        <p class="error"><?php echo $_GET['error'];?></p>       
                <?php } ?>
                <label for="email"><b>Email</b></label>
                
                <input type="text" placeholder="Enter Email" name="email" required>
                
                <label for="psw"><b>Password</b></label>
                
                <input type="password" placeholder="Enter Password" name="psw" required>
                
                <button type="submit" name="login-button">Login</button>
            
            </div>
        </form>
        
    </body>
</html>
