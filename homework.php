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

    function deleteHomework($value){
        
    }
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Εργασίες</title>
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
                        echo '<span style="font-size: 30px;"><a href="homeworkSettings.php">Προσθήκη νέας Εργασίας</a></span>';
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
                            echo '<a href="homeworkSettings.php?link=' . $row["Number"] . '">[Επεξεργασία]</a>';
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
                        <pa><?php echo $row["Subject"];?></a>. </pa>
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
                    <!--
                <div class="border-bottom">
                    <h2>Εργασία 2</h2>
                    <div class="inner-text-for-hm">
                        <pa>Στόχοι:Οι στόχοι τις εργασίας είναι</pa>
                        <ul class="text-list">
                            <li>Εξάσκηση στις γνώσεις που λάβατε</li>
                            <li>Η εργασία είναι bonus</li>
                        </ul>
                        <pa>Εκφώνηση:</pa>
                        <br>
                        <br>
                        <pa>Κατεβάστε την εκφώνηση της εργασίας από <a href="docs/ergasia2.doc" download="ergasia1.doc">εδώ</a>. </pa>
                        <br>
                        <br>
                        <pa>Παραδοτέα: </pa>
                        <ul class="text-list">
                            <li>Γραπτή αναφορά σε word</li>
                            <li>Παρουσίαση σε powerpoint</li>
                        </ul>
                        
                        <p style="color:red">Ημερομηνία παράδοσης: 1/10/2022</p>
                    </div>
                </div>
                <br>
                <a href="#" class="top">top</a>
                <br>

                <form action="logout.php" method="post">
                    <button type="submit" class="here" name="log-out">Log out</button>
                </form>
                <br>
                <br>--->

                
            </div>
        </div>
    </body>
</html>