<?php

            $DB_HOST = 'localhost';
            $DB_USER = 'root'; 
            $DB_PASS = ''; 
            //Log in into phpmyadmin

            //$connn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS);

            //Creating a database called University_DB

            $DB_NAME = 'University_DB';

            //$sql = "CREATE DATABASE $DB_NAME";
            
            //Connection to database University_DB

            $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);

            if (!$conn) {

                //echo "Connection failed!";
            
            }else{
                //echo "Connection Succeded";
            }

            /*function isLoggedIn()
            {
                if (isset($_SESSION['user'])) {
                    return true;
                }else{
                    return false;
                }
            }*/
    
            //Creatig a table for users
            //Tutor,Student

            /*
            $sql = "CREATE TABLE Users(
                Role VARCHAR(30) NOT NULL,
                Name VARCHAR(30) NOT NULL,
                Lastname VARCHAR(30) NOT NULL,
                Loginname VARCHAR(30) NOT NULL PRIMARY KEY,
                Password VARCHAR(30) NOT NULL
            )";*/

            //$result = mysqli_query($conn,$sql);
            
            //Insert info into Users table
/*
            $sql = "INSERT INTO Users (Role, Name, Lastname, Loginname, Password)
            VALUES ('Student', 'Stergios', 'Moumtzis', 'stergios@gmail.com', '123123')";

            $sql = "INSERT INTO Users (Role, Name, Lastname, Loginname, Password)
            VALUES ('Tutor', 'Thomas', 'Fysekis', 'thwmas321@gmail.com', '321321')";

            mysqli_query($conn,$sql);
            */
        ?>