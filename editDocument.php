<?php
    //check if user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    include "db_connection.php";
    
    //if user wants to edit/update the announcemnt
    //get all the data from the table and print them into placeholders
    if ($_GET['link'] == true){
        $id = $_GET['link'];
        $sql = "SELECT * FROM Documents WHERE Number = '$id'";
        $data = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($data);
    }
    
        function checkForValidID($id){
            include "db_connection.php";
            //User can't create an homework that already exist(with the same ID==number)
            $query = "SELECT Number FROM Documents";
            $result = mysqli_query($conn, $query);
            $flag = false;
            //Search if the id exists in the table
            while ( $array = mysqli_fetch_assoc($result)){
                if ($array["Number"] == $id){
                    $flag = true;
                }
            }
            if ($flag){
                return true;
            }else{
                return false;
            }
        }
    
    function uploadFile($pwd){
        $path_filename_ext = "";
        if (($_FILES[$pwd]['name'] != "")) {
            // Where the file is going to be stored
            $target_dir = "./uploads/";
            $file = $_FILES[$pwd]['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES[$pwd]['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;
            

            move_uploaded_file($temp_name, $path_filename_ext);
        }
        return $path_filename_ext;
    }


    //create/update document
    if(isset($_POST['add-button'])) {
        //Get the info from the form
        $number = $_POST['number'];
        $title = $_POST['title'];
        $sub = $_POST['subject'];
        $location = uploadFile("documentToUpload");

        //check if the id is unique or not
        if(checkForValidID($number) == false){
            //If the user wants to edit/update the document he gets the ID variable
            if ($_GET['link'] == true){
                $id = $_GET['link'];
                $update = "UPDATE Documents SET Number ='".$number."', Title ='".$title."', Description = '".$sub."', FileLocation = '".$location."' WHERE Number = '".$id."'";
                mysqli_query($conn, $update);
                //Go back to doc
                header("Location: documents.php");
            }
            //create the document
            else{
                $sql = "INSERT INTO Documents (Number, Title, Description, FileLocation) 
                    VALUES ( '$number', '$title', '$sub', '$location' )";
                mysqli_query($conn, $sql);   
                //Go back to documents
                header("Location: documents.php");
            }
        }else{
            //Send a warning to documents that the user is trying to create a anouncnement with the same id
            $value = 0;
            header("Location: documents.php?value = .$value");
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

    <form action="" method="post" enctype="multipart/form-data" style="border:1px solid #ccc">
        <div class="container">
            <h1>Προσθήκη νέου εγγράφου</h1>

            <hr>

            <label for="number"><b>Αριθμός(id) <?php echo $row["Number"];?></b></label>
            <input type="text" placeholder="Εισαγωγή Αριθμού" name="number" required>

            <hr>

            <label for="title"><b>Τίτλος εγγράφου <?php echo $row["Title"];?></b></label>
            <input type="text" placeholder="Εισαγωγή τίτλου" name="title" required>

            <hr>

            <label for="subject"><b>Περιγραφή <?php echo $row["Description"];?></b></label>
            <input type="text" placeholder="Εισαγωγή θέματος" name="subject" required>

            <hr>

            <label for="file"><b>Θεση αρχείου</b></label>
            <input type="file" name="documentToUpload" id="fileToUpload" required>

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
