<?php
    //check if user is loged in
    session_start();
    include "functions.php";
    //database connect
    connected($conn);

    
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }
    
    

    //if user wants to edit/update the announcemnt
    //get all the data from the table and print them into placeholders
    if ($_GET['link'] == true){
        $id = $_GET['link'];
        $sql = "SELECT * FROM announcements WHERE Number = '$id'";
        $data = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($data);
   }

   

   
   
    //create/update announcement 
    if(isset($_POST['add-button'])) {
        //Get the info from the form
        $number = $_POST['number'];
        $date = $_POST['date'];
        $sub = $_POST['subject'];
        $text = $_POST['main-text'];

        //This is the case that the user is editing the anouncement and he doesn't change the uique ID
        if($_GET['link'] == true){
            $id = $_GET['link'];
            if($id == $number){
                $update = "UPDATE announcements SET Date ='".$date."', Subject ='".$sub."', MainText = '".$text."' WHERE Number = '".$id."'";
                mysqli_query($conn, $update);
                //Go back to announcements
                header("Location: announcements.php");
                exit;
            }
        }

        //check if the id is unique or not
        if(checkForValidID($number) == false){
            //If the user wants to edit/update the announcement he gets the ID variable
            if ($_GET['link'] == true){
                $id = $_GET['link'];
                $update = "UPDATE announcements SET Date ='".$date."', Subject ='".$sub."', MainText = '".$text."', Number = '".$number."' WHERE Number = '".$id."'";
                mysqli_query($conn, $update);
                //Go back to announcements
                header("Location: announcements.php");
            }
            //Create the announcement
            else{
                $sql = "INSERT INTO announcements (Number, Date, Subject, MainText) 
                    VALUES ('$number', '$date', '$sub', '$text')";
                mysqli_query($conn, $sql);
                //Go back to announcements
                header("Location: announcements.php");
            }
        }else{
            //Send a warning to annnouncement that the user is trying to create a anouncnement with the same id
            $value = 0;
            header("Location: announcements.php?value = .$value");
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
            <h1>Προσθήκη νέας ανακοίνωσεις</h1>

            <hr>

            <label for="number"><b>Αριθμός <?php echo $row["Number"];?></b></label>
            <input type="text" placeholder="Εισαγωγή Αριθμού" name="number" required>

            <hr>

            <label for="date"><b>Ημερομηνία <?php echo $row["Date"];?></b></label>
            <input type="date" name="date" required>

            <hr>

            <label for="subject"><b>Θέμα <?php echo $row["Subject"];?></b></label>
            <input type="text" placeholder="Εισαγωγή θέματος" name="subject" required>

            <hr>

            <label for="main-text"><b>Κείμενο <?php echo $row["MainText"];?></b></label>
            <input type="text" placeholder="Εισαγωγή κειμένου" name="main-text" required>

            <hr>


            <div class="clearfix">
                <a href="announcements.php">
                    <button type="button" class="cancelbtn">Ακύρωση</button>
                
                <button type="submit" class="add" name="add-button">Προσθήκη</button>
            </div>
        </div>
    </form>

    </body>
</html>
