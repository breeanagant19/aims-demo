<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Rental Application</title>
</head>

<body>
    <div id="wrapper">
    <!-- Header -->
    <header>
        <h1>Activities Inventory Management System (AIMS)</h1>
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="rental.html">Rental Information</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="signon.php">Sign In</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="content">
    <main>
        <h2>Review Your Application</h2>
        <?php include 'connect.php';?>
        <?php
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $IID = $_POST['IID'];
        $pickup = $_POST['pickup'];
        $dropoff = $_POST['dropoff'];

        $sql = "SELECT * FROM items WHERE IID='".$IID."'";
        $sql2 = "INSERT INTO renter (FNAME, LNAME, EMAIL, PICKUP, DROPOFF, ITEM_COLOR, ITEM_NAME, IID) VALUES('".$fname."','".$lname."','".$email."','".$pickup."','".$dropoff."','".$IID."')";

        $result = $conn->query($sql);

        //Check to see if Item exists
        //Check to see if the CHECKED_OUT field = 0
        //Insert the rental app into renter table
        //Item table must update

        //If CHECKED_OUT =1, then item not available

        if ($result->num_rows>0){
            while ($row=$result->fetch_assoc()){
                if ($row["CHECKED_OUT"]==1){
                    echo "<h4>Sorry. That item is already checked out. See a list of available items <a href='inventory.php'>here.</a></h4>";
                    echo "<form action='rental.html' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";
                }else{
                    $sql2 = "INSERT INTO renter (FNAME, LNAME, EMAIL, PICKUP, DROPOFF, ITEM_COLOR, ITEM_NAME, IID) VALUES('".$fname."','".$lname."','".$email."','".$pickup."','".$dropoff."','".$row["ITEM_COLOR"]."','".$row["ITEM_NAME"]."','".$IID."')";

                    $sql3 = "UPDATE items SET CHECKED_OUT=1 WHERE IID='".$IID."'";
                    $result2 = $conn->query($sql3);

                    if ($conn->query($sql2)=== TRUE && $result2==TRUE){
                    echo "<h4>Your rental is complete!</h4>";
                    echo "<b>First Name: </b>".$fname."";
                    echo "<br>";
                    echo "<b>Last Name: </b>".$lname;
                    echo "<br>";
                    echo "<b>E-mail Address: </b>".$email;
                    echo "<br>";
                    echo "<b>Pickup Date: </b>".$pickup;
                    echo "<br>";
                    echo "<b>Dropoff Date: </b>".$dropoff;
                    echo "<br>";
                    echo "<b>Item IDD: </b>".$IID;
                    echo "<b><br></b>";
                    echo "<b>Item_Name: </b>".$row['ITEM_NAME'];
                    echo "<br>";
                    echo "<b>Item_Color: </b>".$row['ITEM_COLOR'];

                    //Potentially add a go-back function.
                    echo "<form action = 'index.html'>
                        <button type='submit' id='change' name='change'>Return to the Home Page</button>
                        </form>";
                    }else{
                    	echo "Sorry, something went wrong: ".$conn->error;
                }
            }
         }
     }
        ?>
    </main>
    </div>
    <!-- Footer -->
    <footer>
        Copyright &copy; 2022 Activities Inventory Management System
    </footer>
    </div>
</body>
</html>