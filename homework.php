<?php
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
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
                <div class="border-bottom">
                    <h2>Εργασία 1</h2>
                    <div class="inner-text-for-hm">
                        <pa>Στόχοι:Οι στόχοι τις εργασίας είναι</pa>
                        <ul class="text-list">
                            <li>Εξάσκηση στον αλγόριθμο BFS</li>
                            <li>Εξάσκηση στον αλγόριθμο DFS</li>
                            <li>Εξάσκηση στον αλγόριθμο ID</li>
                        </ul>
                        <pa>Εκφώνηση:</pa>
                        <br>
                        <br>
                        <pa>Κατεβάστε την εκφώνηση της εργασίας από <a href="docs/ergasia1.doc" download="ergasia1.doc">εδώ</a>. </pa>
                        <br>
                        <br>
                        <pa>Παραδοτέα: </pa>
                        <ul class="text-list">
                            <li>Γραπτή αναφορά σε word</li>
                            <li>Παρουσίαση σε powerpoint</li>
                        </ul>
                        
                        <p style="color:red">Ημερομηνία παράδοσης: 1/09/2022</p>
                    </div>
                </div>
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
                <br>

                
            </div>
        </div>
    </body>
</html>