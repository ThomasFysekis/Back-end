<?php

    include "db_connection.php";
    //$id = $_GET['Number'];
    //echo $id;
    $query = "SELECT FileLocation FROM Documents WHERE Number = '312'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    $file_data = $row['FileLocation'];
    $file_size = strlen($FileLocation);


    header("Content-Type: application/octet-stream");
    header("Content-Length: $file_size");
    header("Content-Disposition: attachment; filename=download.png");
    
    echo $file_data;

?>