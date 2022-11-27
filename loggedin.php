<?php

include "connect.php";
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
    	$data = trim($data);
    	$data = stripslashes($data);
    	$data = htmlspecialchars($data);
    	return $data;

    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);


    if (empty($username)) {
    	echo("User Name is required");


    } else if(empty($password)){
        echo("Password is required");

    } else{
        $sql = "SELECT * FROM backend WHERE EMAIL='$username' AND PASS='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['EMAIL'] === $username && $row['PASS'] === $password) {
                echo "Logged in!";
                session_start();
                	$_SESSION['email'] = $username;
                	$_SESSION['PID'] = $row['PID'];
                	$_SESSION['fname'] = $row['FNAME'];
                if (isset($_POST['submit'])){
                    header("Location: manage_inventory.php");
                }

            } else{
            	echo("There is an error". $conn->error);
            }
        }else{
            echo("Incorrect username or password. Please try again or use the Contact Form to get in touch with our Technical Support Staff.");
        }
       }
     }else{}

?>