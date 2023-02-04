<?php
    //check if user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }


    if(isset($_POST['add-button'])) {
        createDocument();
    }

    


    function createDocument(){
        //inculde connection for adding data to the database
        include "db_connection.php";
        //Get the info from the form
    
        $number = $_POST['number'];
        $title = $_POST['title'];
        $sub = $_POST['subject'];


        // File properties
        $file = $_FILES['file']['tmp_name'];
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_type = $_FILES['file']['type'];
        $file_error = $_FILES['file']['error'];

        
        // Working with the file
        if ($file_error === 0) {
            $file_store = "upload/".$file_name;
            move_uploaded_file($file, $file_store);
            // Insert into database
            $sql = "INSERT INTO Documents (Number, Title, Description, FileLocation) 
                VALUES ( '$number', '$title', '$sub', '$file_store' )";
            mysqli_query($conn, $sql);
            header("Location: documents.php");
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

    <form action="#" method="post" enctype="multipart/form-data" style="border:1px solid #ccc">
        <div class="container">
            <h1>Προσθήκη νέου εγγράφου</h1>

            <hr>

            <label for="number"><b>Αριθμός(id)</b></label>
            <input type="text" placeholder="Εισαγωγή Αριθμού" name="number" required>

            <hr>

            <label for="title"><b>Τίτλος εγγράφου</b></label>
            <input type="text" name="title" required>

            <hr>

            <label for="subject"><b>Περιγραφή</b></label>
            <input type="text" placeholder="Εισαγωγή θέματος" name="subject" required>

            <hr>
            <label for="file"><b>Θεση αρχείου</b></label>
            <input type="file" name="file" required>

            <hr>

            <div class="clearfix">
                <a href="documents.php">
                    <button type="button" class="cancelbtn">Ακύρωση</button>
                </a>
                <button type="submit" class="add" name="add-button">Προσθήκη</button>
            </div>
        </div>
    </form>

    </body>
</html>
