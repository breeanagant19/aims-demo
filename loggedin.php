<?php

session_start();


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
    	session_reset();


    } else if(empty($password)){
        echo("Password is required");
        session_reset();

    } else{
        $sql = "SELECT * FROM backend WHERE EMAIL='$username' AND PASS='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['EMAIL'] === $username && $row['PASS'] === $password) {
                echo "Logged in!";
                $name = $row['FNAME'];

                if (isset($_POST['submit'])){
                	// will need to change when uploading to global EC2 user

                    header("Location: manage_inventory.php");
                }
                $_SESSION['username'] = $row['PID'];

            } else{
            	echo("Incorrect");

            	session_reset();
            }
        }else{
            echo("Incorrect username or password");
        }
       }
     }else{}

?>