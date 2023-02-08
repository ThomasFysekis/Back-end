<?php
    include "functions.php";
    //database connect
    connected($conn);
    //check if the user is loged in 
    session_start();

    $_SESSION['Table'] = 'announcements';
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }
    //Get all the data from the tabel Announcements
    $sql = "SELECT * FROM announcements";
    $all_data = mysqli_query($conn, $sql);
    
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Ανακοινώσεις</title>
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
            <h1>Ανακοινώσεις</h1>
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
                        //If the user is Tutor,he can create announcments
                        if($_SESSION['Role'] === 'Tutor'){
                            echo '<span style="font-size: 30px;"><a href="editAnnouncements.php">Προσθήκη νέας ανακοίνωσεις</a></span>';
                        }
                    ?>
                    <!---An error message when the Tutor is creating an announcement with the same  id--->
                    <?php
                        //the message is from editAnnouncements.php
                        if ($_GET){
                    ?>

                    <p style="color:red;">You can't create an announcement with the same id (Number).</p>

                    <?php
                        }
                    ?>

                    <?php
                        //while we have announcements,print them
                        while($row = mysqli_fetch_assoc($all_data)){    
                    ?>
                    <div class="border-bottom">
                        <h2>Ανακοίνωση 
                            <?php echo $row["Number"];
                            //If Tutor,delete or edit annnouncement
                            if($_SESSION['Role'] === 'Tutor'){
                                //Send the id to delete/edit
                                echo '<a href="delete.php?link=' . $row["Number"] . '">[Διαγραφή]</a>';
                                echo '<a href="editAnnouncements.php?link=' . $row["Number"] . '">[Επεξεργασία]</a>';
                            }
                        ?>
                        </h2>
                        <div class="inner-text">
                            <h4>Ημερομηνία: <?php echo $row["Date"];?></h4>
                            <br>
                            <h4>Θέμα: <?php echo $row["Subject"]; ?></h4>
                            <br>
                        </div>
                        <div class="inner-text">
                            <h4> <?php echo $row["MainText"]; ?><a href="homework.html"></a></h4>
                        </div>
                    </div>
                    <?php
                        //end of while
                        }
                    ?>
                </div>
                <br>
                <a href="#" class="top">top</a>
                <br>
                <form action="logout.php" method="post">
                    <button type="submit" class="login-but" name="log-out">Log out</button>
                </form>
                <br>
                <br>
                
            </div>
        </div>
    </body>
</html>