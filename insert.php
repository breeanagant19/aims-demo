
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Insert Into Inventory</title>
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

<?php
include 'connect.php';
include 'loggedin.php';


$IID = $_POST["IID"];
$PURCHASE_ITEM = $_POST["purchase"];
$CHECKED_OUT = 0;
if (empty($IID)) {
    echo("<h2>Item ID Required</h2>");
    echo "<form action='insert.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
}elseif (empty($PURCHASE_ITEM)){

            $sql = "SELECT *  FROM items WHERE IID='".$IID."'";

            //Insert statement
            $sql2 = "INSERT INTO items (IID, ITEM_NAME, ITEM_CATEGORY, ITEM_COLOR, QUANTITY, ADD_ON_NEEDED, CHECKED_OUT) VALUES('".$_POST["IID"]."','".$_POST["item_name"]."','".$_POST["item_color"]."','".$_POST["quantity"]."','".$_POST["add_on"]."','".$_POST["purchase"]."','".$CHECKED_OUT."')";

            $sql3 = "UPDATE items SET ITEM_NAME='".$_POST["item_name"]."', QUANTITY='".$_POST["quantity"]."', ITEM_COLOR='".$_POST["item_color"]."', ADD_ON_NEEDED='".$_POST["add_on"]."' WHERE IID='".$IID."'";

            $sql4 = "INSERT INTO manages(UPDATED, IID, PID) VALUES('".date('Y-m-d')."', '".$IID."','".$_SESSION['username']."')";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                if ($conn->query($sql3) === TRUE && $conn->query($sql4)){
                echo "Record successfully updated. Changes to the inventory list can be seen in the management log.";
                echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";


            }else{
                echo "Error updating record".$conn->error;
                echo "<form action='insert.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
            }
        }else{
            if ($conn->query($sql2) === TRUE){
                echo "New record created";
                echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";
            }else{
                echo $conn->error;
        }
    }
}else {

        $sql = "SELECT *  FROM items WHERE IID='".$IID."'";

        $sql2 = "INSERT INTO items (IID, ITEM_NAME, ITEM_CATEGORY, ITEM_COLOR, QUANTITY, ADD_ON_NEEDED, CHECKED_OUT) VALUES('".$_POST["IID"]."','".$_POST["item_name"]."','".$_POST["item_color"]."','".$_POST["quantity"]."','".$_POST["add_on"]."','".$_POST["purchase"]."','".$CHECKED_OUT."')";


        $sql3 = "UPDATE items SET ITEM_NAME='".$_POST['item_name']."', QUANTITY='".$_POST["quantity"]."', ITEM_COLOR'".$_POST['item_color']."', ADD_ON='".$_POST['add_on']."', PURCHASE_ITEM='".$_POST['purchase_item']."')";

        $sql4 =

        $result = $conn->query($sql);
        if($result->num_rows > 0){
                if ($conn->query($sql2)===TRUE){
                echo "Record successfully updated.";

            }elseif ($conn->query($sql3) === TRUE){
                echo "New record created";
            } else{
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