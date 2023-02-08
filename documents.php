<?php
    include "functions.php";
    //database connect
    connected($conn);
    //check if user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    $_SESSION['Table'] = 'documents';

    //Get all the data from the table Documents
    $sql = "SELECT * FROM documents";
    $data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Έγραφα μαθήματος</title>
        <style>
            .login-but:hover {
                box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
            }

            .login-but {
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
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
            }

        </style>
    </head>
    <body>

        <header>
            <h1>Έγραφα μαθήματος</h1>
        </header>

        <div class="container">
            <div class="sidebar">
                <a href="index.php" class="button">Αρχική Σελίδα</a>
                <a href="announcements.php" class="button">Ανακοινώσεις</a>
                <a href="communication.php" class="button">Επικοινωνία</a>
                <a href="documents.php" class="button">Έγραφα μαθήματος</a>
                <a href="homework.php" class="button">Εργασίες</a>    
            </div>
            <div class="main-border">
                <div class="border-bottom">
                    <?php
                        //If the user is Tutor,he can create documents
                        if($_SESSION['Role'] === 'Tutor'){
                            echo '<span style="font-size: 30px;"><a href="editDocument.php">Προσθήκη νέou εγγράφου</a></span>';
                        }
                    ?>

                     <!---An error message when the Tutor is creating a doc with the same  id--->
                     <?php
                        //the message is from editDocuments.php
                        if ($_GET){
                    ?>

                    <p style="color:red;">You can't create a document with the same id (Number).</p>

                    <?php
                        }
                    ?>


                    <?php
                        //while we have data,print them
                        while($row = mysqli_fetch_assoc($data)){
                    ?>
                    <div class="border-bottom">
                        <h2>Έγραφο <?php echo $row["Number"];
                        
                            //If Tutor,delete or edit annnouncement
                            if($_SESSION['Role'] === 'Tutor'){
                                //Send the id to delete/edit
                                echo '<a href="delete.php?link=' . $row["Number"] . '">[Διαγραφή]</a>';
                                echo '<a href="editDocument.php?link=' . $row["Number"] . '">[Επεξεργασία]</a>';
                            }
                        
                        
                        ?></h2>

                        <h2><?php echo $row['Title'];?></h2>

                        <div class="inner-text">
                            <p><?php echo $row['Description']?></p>
                            <br>
                            
                            <a  href="./<?php echo $row['FileLocation']?>">Download</a>


                            <br>
                            <br>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
            </div>
            <br>
            <a href="#" class="top">top</a>
            <br>
            <form action="logout.php" method="post">
                    <button type="submit" class="login-but" name="edit-users">Log out</button>
            </form>
            <br>
            <br>
        </div>
    </body>
</html>