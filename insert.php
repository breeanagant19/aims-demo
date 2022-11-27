
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Homepage</title>
</head>

<body>
    <div id="wrapper">
    <!-- Header -->
    <header>
        <h1>Activities Inventory Management System (AIMS)</h1>
        <?php include_once "loggedin.php"; ?>
        <?php include_once "authorize.php"; ?>
        <?php include "connect.php"; ?>
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

<?php
$IID = $_POST["IID"];
$PURCHASE_ITEM = $_POST["purchase"];
$CHECKED_OUT = 0;

// Checks to see if the IID is empty. IID is required
if (empty($IID)) {
    echo("<h2>Item ID Required</h2>");
    echo "<form action='insert.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
}elseif (empty($_POST['purchase'])){

            $sql = "SELECT *  FROM items WHERE IID='".$IID."'";

            //Insert statement
            $sql2 = "INSERT INTO items (IID, ITEM_NAME, ITEM_CATEGORY, ITEM_COLOR, QUANTITY, ADD_ON_NEEDED, CHECKED_OUT) VALUES('".$_POST["IID"]."','".$_POST["item_name"]."','".$_POST["item_color"]."','".$_POST["quantity"]."','".$_POST["add_on"]."','".$CHECKED_OUT."')";

            $sql3 = "UPDATE items SET ITEM_NAME='".$_POST["item_name"]."', QUANTITY='".$_POST["quantity"]."', ITEM_COLOR='".$_POST["item_color"]."', ADD_ON_NEEDED='".$_POST["add_on"]."' WHERE IID='".$IID."'";

            $sql4 = "INSERT INTO manages(UPDATED, IID, PID) VALUES('".date('Y-m-d')."', '".$IID."','".$_SESSION['PID']."')";

            $result = $conn->query($sql);
            if($result->num_rows > 0){
                if ($conn->query($sql3) === TRUE){
                echo "<h2>Record successfully updated.</h2>";
                $result2 = $conn->query($sql4);
                echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";

            }else{
                echo "<h2>Error updating record<h2><br>".$conn->error;
                $result2 = $conn->query($sql4);
                echo "<form action='insert.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
            }
        }else{
            if ($conn->query($sql2) === TRUE){
                echo "<h2>New record created</h2>";
                $result2 = $conn->query($sql4);
                echo $result2;
                echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";
            }else{
                echo $conn->error;
        }
    }
}else {

        $sql = "SELECT *  FROM items WHERE IID='".$IID."'";

        $sql2 = "INSERT INTO items (IID, ITEM_NAME, ITEM_CATEGORY, ITEM_COLOR, QUANTITY, ADD_ON_NEEDED, PURCHASE_ITEM, CHECKED_OUT) VALUES('".$_POST['IID']."','".$_POST['item_name']."','".$_POST['item_color']."','".$_POST['quantity']."','".$_POST['add_on']."','".$_POST['purchase']."','".$CHECKED_OUT."')";


        $sql3 = "UPDATE items SET ITEM_NAME='".$_POST['item_name']."', QUANTITY='".$_POST['quantity']."', ITEM_COLOR='".$_POST['item_color']."', ADD_ON_NEEDED='".$_POST['add_on']."', PURCHASE_ITEM='".$_POST['purchase']."' WHERE IID ='".$IID."'";

        $sql4 = "INSERT INTO manages(UPDATED, IID, PID) VALUES('".date('Y-m-d')."', '".$IID."','".$_SESSION['PID']."')";

        $result = $conn->query($sql);
        if($result->num_rows > 0){
                if ($conn->query($sql2)===TRUE){
                echo "<h2>Record successfully inserted.</h2>";
                $result2 = $conn->query($sql4);
                echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";
            }elseif ($conn->query($sql3) === TRUE){
                echo "<h2>Record successfully updated.</h2>";
                $result2 = $conn->query($sql4);
                echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";
            } else{
                echo "Error Here!";
                echo $conn->error;
        }
    }
}

    ?>
</main>
</div>
</div>
</body>
</html>