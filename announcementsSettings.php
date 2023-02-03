<?php
    //check if user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    //if the user press the add-button call createAnnouncement
    if(isset($_POST['add-button'])) {
        createAnnouncement();
    }

    

    //This function can create or edit the announcement that the user selected
    function createAnnouncement(){
        //inculde connection for adding data to the database
        include "db_connection.php";

        //Get the info from the form
        $number = $_POST['number'];
        $date = $_POST['date'];
        $sub = $_POST['subject'];
        $text = $_POST['main-text'];

        //If the user wants to edit/update the announcement he gets the ID variable
        if ($_GET['link'] == true){
            $id = $_GET['link'];
            $update = "UPDATE Announcements SET Date ='".$date."', Subject ='".$sub."', MainText = '".$text."', Number = '".$number."' WHERE Number = '".$id."'";
            mysqli_query($conn, $update);
       }
       //Create the announcement
       else{
            $sql = "INSERT INTO Announcements (Number, Date, Subject, MainText) 
                VALUES ('$number', '$date', '$sub', '$text')";
            mysqli_query($conn, $sql);
            $createThread = true;
        }
        //Go back to announcements
        header("Location: announcements.php");
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

            <label for="number"><b>Αριθμός</b></label>
            <input type="text" placeholder="Εισαγωγή Αριθμού" name="number" required>

            <hr>

            <label for="date"><b>Ημερομηνία</b></label>
            <input type="date" name="date" required>

            <hr>

            <label for="subject"><b>Θέμα</b></label>
            <input type="text" placeholder="Εισαγωγή θέματος" name="subject" required>

            <hr>

            <label for="main-text"><b>Κείμενο</b></label>
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
