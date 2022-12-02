<?php


include "connect.php"; //Includes connection 


//Check to see is username and password are submitted. 
if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data){
    	$data = trim($data);
    	$data = stripslashes($data);
    	$data = htmlspecialchars($data);
    	return $data;

    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

//Checks to see if the username is entered.
    if (empty($username)) {
    	echo("User Name is required");

//Checks to see if the password is entered.
    } else if(empty($password)){
        echo("Password is required");
//If both the password and username are entered
    } else{
    	//Find the record where they both match
        $sql = "SELECT * FROM backend WHERE EMAIL='$username' AND PASS='$password'"; 
        $result = mysqli_query($conn, $sql);
        //Records should equal exactly 1
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['EMAIL'] === $username && $row['PASS'] === $password) {
                echo "Logged in!";
                session_start();
                	$_SESSION['email'] = $username;
                	$_SESSION['PID'] = $row['PID'];
                	$_SESSION['fname'] = $row['FNAME'];
                //When the submit button is posted
                if (isset($_POST['submit'])){
                    header("Location: manage_inventory.php");
                    session_start();
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