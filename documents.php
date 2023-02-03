<?php
    include "db_connection.php";
    //check if user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    //Get all the data from the table Documents
    $sql = "SELECT * FROM Documents";
    $data = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Έγραφα μαθήματος</title>
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
                            echo '<span style="font-size: 30px;"><a href="createDocument.php">Προσθήκη νέou εγγράφου</a></span>';
                        }
                    ?>

                    <?php
                        //while we have data,print them
                        while($row = mysqli_fetch_assoc($data)){
                    ?>
                    <div class="border-bottom">
                        <h2><?php echo $row['Title']?></h2>

                        <div class="inner-text">
                            <p><?php echo $row['Description']?></p>
                            <br>
                            
                            <?php echo '<a href="download.php?link=' . $row["Number"] . '">[Download File]</a>';?>

                            <a href="download.php?id=<?php echo $row['Number']; ?>">Download File</a>

                            <!--<a href="docs/file.doc" download="file1.doc">Download it!</a> -->
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
                    <button type="submit" class="here" name="log-out">Log out</button>
            </form>
            <br>
            <br>
        </div>
    </body>
</html>