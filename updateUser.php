<?php
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }
    include "db_connection.php";    
    //get the email from the user(key)
    $id = $_GET['link'];

    //Selecet all the data from user with the right  id
    $sql = "SELECT * FROM Users WHERE Loginname = '$id'";
    $data =  mysqli_query($conn, $sql);
    //row is a array with the data of our user,we can play the data
    //into the placeholder so the user can what he changes
    $row = mysqli_fetch_assoc($data);

    if(isset($_POST['add-button'])) {
        //Get what user wants to change
        $role = $_POST['role'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $loginname = $_POST['loginname'];
        $pw = $_POST['password'];

        if($role == 'Student' or $role == 'Tutor'){
        
            //update user data
            $update = "UPDATE Users SET Role ='".$role."',Name ='".$name."',Lastname ='".$lastname."',Loginname ='".$loginname."',Password ='".$pw."' WHERE Loginname = '".$id."'";
            //Execute update
            mysqli_query($conn, $update);
            header("Location: editUser.php");
        }else{
            echo '<span style="color:#FF0000;text-align:center;"> The Role section must be Tutor or Student!</span>';
        }
    }
?>




<!DOCTYPE html>
<html>
    <style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box}

    /* Full-width input fields */
    input[type=text], input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
    background-color: #ddd;
    outline: none;
    }

    hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
    }

    /* Set a style for all buttons */
    button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
    }

    button:hover {
    opacity:1;
    }

    /* Extra styles for the cancel button */
    .cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
    }

    /* Float cancel and add buttons and add an equal width */
    .cancelbtn, .add {
    float: left;
    width: 50%;
    }

    /* Add padding to container elements */
    .container {
    padding: 16px;
    }

    /* Clear floats */
    .clearfix::after {
    content: "";
    clear: both;
    display: table;
    }

    /* Change styles for cancel button and add button on extra small screens */
    @media screen and (max-width: 300px) {
    .cancelbtn, .add {
        width: 100%;
    }
    }
    </style>
    <body>

    <form action="" method="post" style="border:1px solid #ccc">
        <div class="container">
            <h1>Επεξεργασία χρήστη</h1>

            <hr>

            <label for="role"><b>Role</b></label>
            <?php echo $row["Role"]?>
            <input type="text" placeholder="new Role" name="role" required>

            <hr>

            <label for="name"><b>Name</b></label>
            <?php echo $row["Name"]?>
            <input type="text" name="name"  placeholder="new name" required>

            <hr>

            <label for="lastname"><b>Lastname</b></label>
            <?php echo $row["Lastname"]?>
            <input type="text" placeholder="new lastname" name="lastname" required>

            <hr>

            <label for="loginname"><b>Loginname</b></label>
            <?php echo $row["Loginname"]?>
            <input type="text" placeholder="new loginnname" name="loginname" required>

            <hr>

            <label for="password"><b>Password</b></label>
            <?php echo $row["Password"]?>
            <input type="text" placeholder="new password" name="password" required>

            <hr>


            <div class="clearfix">
                <a href="editUser.php">
                    <button type="button" class="cancelbtn">Ακύρωση</button>
                
                <button type="submit" class="add" name="add-button">Προσθήκη</button>
            </div>
        </div>
    </form>

    </body>
</html>
