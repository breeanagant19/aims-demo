
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Delete From Inventory</title>
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


$IID = $_POST["IID"];
if (empty($IID)) {
    echo("<h2>Item ID Required</h2>");
    echo "<form action='insert.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
}else{
    $sql = "SELECT *  FROM items WHERE IID='".$IID;
    $sql2 = "DELETE FROM items WHERE IID='".$IID."'";
    $result = $conn->query($sql);
    if (!empty($result) && $result->num_rows>0){
        if ($conn->query($sql2)===True){
            echo "<h2>Record deleted.</h2>";
            echo "<form action='manage_inventory.php' method='POST'><button  id='go back' type='submit' name ='submit'>Go Back</button></form>";
            //Insert into manages table

        }else{
            echo"<h2>Issue deleting record:</h2>".$conn->error;
            echo "<form action='delete.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
            //Insert into manages table
        }
    }else{
        echo "<h2>No records matching ID: ".$IID."</h2>";
        echo "<form action='delete.html' method='POST'><button  id='go back' type='submit' name ='submit'>Try Again</button></form>";
    }
}

    ?>
</main>
</div>
</div>
</body>
</html>