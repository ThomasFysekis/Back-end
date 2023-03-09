<?php

    //connection to database
    function connected(&$conn){
        $DB_HOST = 'localhost';
        $DB_USER = 'root'; 
        $DB_PASS = '';
        $DB_NAME = 'student3770'; 
        $conn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASS,$DB_NAME);
        return $conn;   
    }

    //a fuction that is checking if the ID from the tables are unique or not
    //its working for: annoucements, documents and homework
    function checkForValidID($id){
        connected($conn);
        //User can't create an annoucmements that already exist(with the same ID==number)
        $table = $_SESSION['Table'];
        $query = "SELECT Number FROM $table";
        $result = mysqli_query($conn, $query);
        $flag = false;
        //Search if the id exists in the table
        while ( $array = mysqli_fetch_assoc($result)){
            if ($array["Number"] == $id){
                $flag = true;
            }
        }
        if ($flag){
            return true;
        }else{
            return false;
        }
    }

    //the procces for moving the file into the folder and finding the path
    function uploadFile($pwd){
        $path_filename_ext = "";
        if (($_FILES[$pwd]['name'] != "")) {
            // Where the file is going to be stored
            $target_dir = "./uploads/";
            $file = $_FILES[$pwd]['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES[$pwd]['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;
            
            //upload file
            move_uploaded_file($temp_name, $path_filename_ext);
        }
        return $path_filename_ext;
    }

?>