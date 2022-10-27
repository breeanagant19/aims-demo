<?php
        // Setting up connection

        $servername = "aims-demo1.cjiww4oiz41u.us-east-1.rds.amazonaws.com";
        $username   = "admin";
        $password   = "Tiff1tre2maddy3";
        $dbname     = "aims";

        // Connectiong to AWS RDS
        $conn = new mysqli($servername, $username, $password, $dbname);
        if($conn->connect_error){
            die("connection failed: ". $conn->connect_error);
        }