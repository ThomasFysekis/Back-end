<?php
                  
    include "db_connection.php";
    //check if the user is loged in
    session_start();
    if(!$_SESSION["Loginname"]){
        header("Location: login.php");
    }

    $loginname = $_SESSION['Loginname'];

    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;

    require './PHPMailer/Exception.php';
    require './PHPMailer/PHPMailer.php';
    require './PHPMailer/SMTP.php';

    
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
            $recipient = $data['Loginname'];

            $mail = new PHPMailer();
            // Settings
            $mail->IsSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host       = "mail.example.com";    // SMTP server example
            $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 25;                    // set the SMTP port for the GMAIL server
            $mail->Username   = "username";            // SMTP account username example
            $mail->Password   = "password";            // SMTP account password example
            // Content
            $mail->setFrom($loginname);   
            $mail->addAddress($recipient);              
            $mail->Subject = $sub;
            $mail->Body    = $text;

            //Send the mail
            try{
                $mail->send();
                $displayMessage = "Message Successfully Sent to Tutors";

            }catch(Exception $e){
                $displayMesasge = "Error!" . $e->errorMessage();
            } 
        }
    }
        
    
?>
<!DOCTYPE html>
<html lang="el">
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Επικοινωνία</title>
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
                            <input type="text" id="Αποστολέας" name="sender" required>
                            <label for="Θέμα">
                                Θέμα
                            </label>
                            <input type="text" id="Θέμα" name="sub" required>
                            <label for="Κείμενο" required>
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

                    <div style="display:flex; color:red; justify-content: center; text-align: center;font-size:x-large">
                            <?php echo $displayMessage ?>
                    </div>

                    <form action="logout.php" method="post">
                        <button type="submit" class="login-but" name="edit-users">Log out</button>
                    </form>
                </div>
                
            </div>
        </div>
    </body>
</html>