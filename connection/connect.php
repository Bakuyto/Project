<?php
    

    $servername = "192.168.99.253";
    $username = "root";
    $password = "Admin_Pacific_219";
    $dbname = "inventorymanagement";

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "inventorymanagement";

    //create connection

    $conn = new mysqli($servername, $username, $password, $dbname);

    //check connection 

    if($conn->connect_error){
        echo "connection successfully";
    }

    ?>