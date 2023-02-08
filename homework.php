<?php
    include "db_connection.php";
    //check if the user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    $_SESSION['Table'] = 'Homework';

    
    //Get all the data from the table
    $sql = "SELECT * FROM Homework";
    $result = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Εργασίες</title>
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
            <h1>Εργασίες</h1>
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
                <?php
                    //If the user is Tutor,he can create announcments
                    if($_SESSION['Role'] === 'Tutor'){
                        echo '<span style="font-size: 30px;"><a href="editHomework.php">Προσθήκη νέας Εργασίας</a></span>';
                    }
                ?>

                <!---An error message when the Tutor is creating an announcement with the same  id--->
                <?php
                    //the message is from editAnnouncements.php
                    if ($_GET){
                ?>

                <p style="color:red;">You can't create a homework with the same id (Number).</p>

                <?php
                    }
                ?>
                                    


                <?php
                    //while we have data,print them
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="border-bottom">

                    <h2>Εργασία <?php echo $row["Number"]; 
                        //If Tutor,delete or edit annnouncement
                        if($_SESSION['Role'] === 'Tutor'){
                            //Send the id to delete/edit
                            echo '<a href=delete.php?link=' .$row["Number"] .'>[Διαγραφή] </a>';
                            echo '<a href="editHomework.php?link=' . $row["Number"] . '">[Επεξεργασία]</a>';
                        }
                    
                    ?></h2>
                    <div class="inner-text-for-hm">
                        <pa>Στόχοι:Οι στόχοι τις εργασίας είναι</pa>
                        <ul class="text-list">
                            <li><?php echo $row["Goal"];?></li>
                        </ul>
                        <pa>Εκφώνηση:</pa>
                        <br>
                        <br>
                        <pa> Κατεβάστε την εκφώνηση της εργασίας από <a  href="./<?php echo $row['Subject']?>">εδώ.</a> </pa>
                        <br>
                        <br>
                        <pa>Παραδοτέα: </pa>
                        <ul class="text-list">
                            <li><?php echo $row["Delivered"];?></li>
                        </ul>
                        
                        <p style="color:red">Ημερομηνία παράδοσης: <?php echo $row["Date"];?></p>
                    </div>
                </div>
                <?php
                    }
                ?>
                <form action="logout.php" method="post">
                    <button type="submit" class="login-but" name="edit-users">Log Out</button>
                </form>
                
            </div>
        </div>
    </body>
</html>