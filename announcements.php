<?php
    include "db_connection.php";

    //check if the user is loged in 
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }
    //Get all the data from the tabel Announcements
    $sql = "SELECT * FROM Announcements";
    $all_data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Ανακοινώσεις</title>
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
                            echo '<span style="font-size: 30px;"><a href="announcementsSettings.php">Προσθήκη νέας ανακοίνωσεις</a></span>';
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
                                echo '<a href="deleteAnnouncement.php?link=' . $row["Number"] . '">[Διαγραφή]</a>';
                                echo '<a href="announcementsSettings.php?link=' . $row["Number"] . '">[Επεξεργασία]</a>';
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
                    <button type="submit" class="here" name="log-out">Log out</button>
                </form>
                <br>
                <br>
                
            </div>
        </div>
    </body>
</html>