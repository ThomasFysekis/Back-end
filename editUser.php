<?php

    include "functions.php";
    //database connect
    connected($conn);
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    $_SESSION['Table'] = 'users';

    //select everything from the table Users
    $sql = "SELECT * FROM users";
    //Make the connection
    $data = mysqli_query($conn, $sql);

    //if the user press add user he creates a user
    if(isset($_POST['add-button'])) {
        //Get the info from the form
        $role  = $_POST['select-user'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $loginname = $_POST['loginname'];
        $pw = $_POST['password'];

        //insert the user
        $sql = "INSERT INTO users (Role, Name, Lastname, Loginname, Password)
            VALUES ('$role', '$name', '$lastname', '$loginname', '$pw')";
        mysqli_query($conn, $sql);
        header("Location: editUser.php");
    }

?>

<!DOCTYPE html>
<html lang="el">
    <head>
    </head>
    <body>

    <style>

        #users-table td, #users-table th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #users-table tr:nth-child(even){background-color: #f2f2f2;}

        #users-table tr:hover {background-color: #ddd;}

        #users-table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
        
        .index{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .container-for-editUser{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: absolute;
            width: 100%;
            height: 100%;
            font-size:large
        }

  

        .button {
        font-size: 1em;
        padding: 10px;
        color: #fff;
        background-color: #333;
        border: 2px solid #06D85F;
        border-radius: 20px/50px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease-out;
        }

        .button:hover {
            background: #06D85F;
        }

        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 60%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .popup .close:hover {
            color: #06D85F;
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }


    </style>

    <div class="container-for-editUser">
        <div class="box">
            <form action="#" method="post">
            <?php
                //if user tries to delete himself he gets an error message
                if ($_GET){
                    echo "<font color='red'>You can't delete yourself!</font>";
                }
            ?>
                <table id="users-table">
                    <tr>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Loginname(Email)</th>
                        <th>Password</th>
                        <th>Επεξεργασία</th>
                        <th>Διαγραφή</th>
                        <th><a class="button" href="#popup1">Προσθήκη</a></th>
                    </tr>
                    <?php
                        //row is an array with the data of the table Users
                        while($row = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?php echo$row["Role"]?></td>
                        <td><?php echo$row["Name"]?></td>
                        <td><?php echo$row["Lastname"]?></td>
                        <td><?php echo$row["Loginname"]?></td>
                        <td><?php echo$row["Password"]?></td>
                        <td><a href="updateUser.php?link=<?php echo $row["Loginname"] ?>" class="button" type="submit" name="insert-button">Επεξεργασία</a></td>
                        <td><a href="delete.php?email=<?php echo $row["Loginname"] ?>" class="button" type="submit" name="delete-button">Διαγραφή</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
        
                    

        </div>

        <div id="popup1" class="overlay">
            <div class="popup">
                <h2>Add a user!</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                <table id="users-table">
                    <tr>
                        <th>Role</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Loginname(Email)</th>
                        <th>Password</th>
                    </tr>
                        <td> <input type="radio" id="admin" name="select-user" value="Tutor" required>
                            <label for="admin">Tutor</label><br>
                            <input type="radio" id="not-admin" name="select-user" value="Student" required>
                        <label for="not-admin">Student</label><br></td>
                        <td><input type="text" placeholder="Name" name="name" required></td>
                        <td><input type="text" placeholder="Lastname" name="lastname" required></td>
                        <td><input type="text" placeholder="Login name (Email)" name="loginname" required></td>
                        <td><input type="text" placeholder="Password" name="password" required></td>
                    </tr>
                </table>
                <button type="submit" class="add" name="add-button">Προσθήκη</button>
                </div>
            </div>
        </div>
        </form>
        
        <hr>

        <form action="index.php">
            <input type="submit" class="index" value="Go to index" />
        </form>
    </div>
    </body>
</html>