<?php
    include "db_connection.php";
    //check if user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    //if the user press the add-button call createHomework
    if(isset($_POST['add-button'])) {
        createHomework();
    }

    //Get data from table homework if Tutor wants to edit/update
    if($_GET['link'] == true){
        
        $id = $_GET['link'];
        $sql = "SELECT * FROM Homework WHERE Number = '$id'";
        $data = mysqli_query($conn, $sql);
        //row is an array with the data of our user,we can play the data
        //into the placeholder so the user can change waht he wants
        $row = mysqli_fetch_assoc($data);
    }

    //This function can create or edit the announcement that the user selected
    function createHomework(){
        //inculde connection for adding data to the table homework
        include "db_connection.php";

        //Get the info from the form
        $number = $_POST['number'];
        $goal = $_POST['goal'];
        $sub = $_POST['subject'];
        $delivered = $_POST['delivered'];
        $date = $_POST['date'];

        //if the user wants to edit/update the homework
        if($_GET['link'] == true){
            $id = $_GET['link'];
            $update = "UPDATE Homework SET Number ='".$number."', Goal ='".$goal."', Subject = '".$sub."', Delivered = '".$delivered."', Date = '".$date."' WHERE Number = '".$id."'";
            mysqli_query($conn, $update);
        }
        //Create homework
        else{
            $sql = "INSERT INTO Homework (Number, Goal, Subject, Delivered, Date)
                VALUES('$number', '$goal', '$sub', '$delivered', '$date')";
            mysqli_query($conn, $sql);
        }
        header("Location: homework.php");
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
            <h1>Προσθήκη νέας Εργασίας</h1>

            <hr>

            <label for="number"><b>Αριθμός <?php echo $row["Number"];?></b></label>
            <input type="text" placeholder="Εισαγωγή Αριθμού" name="number" required>

            <hr>

            <label for="goal"><b>Στόχοι </b><?php echo $row["Goal"];?></label>
            <input type="text" name="goal" placeholder="Εισαγωγή στόχου" required>

            <hr>

            <label for="subject"><b>Θέμα <?php echo $row["Subject"];?></b></label>
            <input type="text" placeholder="Εισαγωγή θέματος" name="subject" required>

            <hr>

            <label for="delivered"><b>Παραδοτέα <?php echo $row["Delivered"];?></b></label>
            <input type="text" placeholder="Εισαγωγή κειμένου" name="delivered" required>

            <hr>

            <label for="date"><b>Ημερομηνία Παράδοσης  <?php echo $row["Date"];?></b></label>
            <input type="date" placeholder="Εισαγωγή κειμένου" name="date" required>

            <hr>


            <div class="clearfix">
                <a href="homework.php">
                    <button type="button" class="cancelbtn">Ακύρωση</button>
                
                <button type="submit" class="add" name="add-button">Προσθήκη</button>
            </div>
        </div>
    </form>

    </body>
</html>
