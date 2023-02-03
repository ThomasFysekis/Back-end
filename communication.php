<?php
                  
    include "db_connection.php";
    //check if the user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    
    if(isset($_REQUEST['submit'])){
        //Collect the data from the form
        $sender = $_POST['sender'];
        $sub = $_POST['sub'];
        $text = $_POST['text'];
        //Find all the Tutor users
        $sql = "SELECT Loginname FROM Users WHERE Role = 'Tutor'";
        //Execute
        $row = mysqli_query($conn, $sql);
        //data is an array of Tutor users.
        while($data = mysqli_fetch_assoc($row)){
            //Send the email
            mail($data['Loginname'], $sub, $text);
        }
        
    }
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Επικοινωνία</title>
    </head>
    <body>

        <header>
            <h1>Επικοινωνία</h1>
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
                    <h2>Αποστολή e-mail μέσω web φόρμας:</h2>
                        <form class="submission-form" method="POST" action="#">
                            <label for="Αποστολέας">
                                Αποστολέας
                            </label>
                            <input type="text" id="Αποστολέας" name="sender">
                            <label for="Θέμα">
                                Θέμα
                            </label>
                            <input type="text" id="Θέμα" name="sub">
                            <label for="Κείμενο">
                                Κείμενο
                            </label>
                            <textarea name="text"></textarea>
                            <br>
                            <input type="submit" name="submit" value="Αποστολή">
                            <br>
                        </form>
                    </div>
                    <div class="inner-text-left">
                        <br><br>
                        <h2>Αποστολή e-mail με χρήση e-mail διεύθυνσης</h2>
                        <h4>Εναλλακτικά μπορείτε να αποστείλετε e-mail στην παρακάτω διεύθυνση ηλεκτρονικού ταχυδρομείου <a href = "mailto: tutor@csd.auth.test.gr">tutor@csd.auth.test.gr</a></h4>
                    </div>
                    <form action="logout.php" method="post">
                        <button type="submit" class="here" name="log-out">Log out</button>
                    </form>
                </div>
                
            </div>
        </div>
    </body>
</html>