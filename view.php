<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Inventory</title>
</head>

<body>
    <div id="wrapper">
    <!-- Header -->
    <header>
        <h1>Activities Inventory Management System (AIMS)</h1>
        <?php include_once "loggedin.php"; ?>
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
        <!-- Style for PHP table -->
        <style>
            table {border: 1px solid;
                    width: 100%;}

            th{
                border: 1px solid;
                background-color: #0A2240;
                color: #ffffff;
                width: 10%;

            }
            td {
                border: 1px solid;
                padding: 15px;
                text-align: center;}

            .checkboxes {
              display: inline-table;
              width: .1em;
            }

button {background-color: #0A2240;
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          font-size: 16px;
          display: block;
          border: 1px solid white;
          align-self: center;
          margin-right: auto;
          margin-left: auto;}
#submit {background-color: #0A2240;
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          font-size: 16px;
          display: block;
          border: 1px solid white;
          align-self: center;
          margin-right: auto;
          margin-left: auto;}

input, textarea {margin-left: auto;
				margin-right: auto;
				margin-bottom: 1em;}
        </style>
<?php $sql = "DELETE FROM renter WHERE PICKUP < curdate()";
      $result = $conn->query($sql);
?>

    <h1><center>Current Inventory</center></h1>
    <table><tr>
        <th>RID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Pickup Time</th>
        <th>Drop Off</th>
        <th>Item ID</th>
        <th>Item Name</th>
        <th>Item Color</th>
        <th>Assigned Administrator</th>

    <form method="POST">
    	<p><center>Enter the RID you want to manage:</center></p>
    	<input type ="text" id="RID" name="RID">
    	<button type="submit" id="submit" name="submit">Select</button>
      <br>
	</form>

    </tr>
        <?php
        // Refer to connection file -- Connects to the database

        //Echo table headers


        //MySQL Select Statement & query
        $sql = "SELECT * FROM renter";
        $result = $conn->query($sql);

        //Determines if there is data in the tables
        //Checks to see if the number of rows from the query is more than 0
        //Fetches each row from the query



        if($result->num_rows > 0){
            while ($row=$result->fetch_assoc()) {

            //Prints each row in the table
            echo "<tr>";
            echo "<td>". $row['RID'] . "</td>";
            echo "<td>". $row['FNAME'] . "</td>";
            echo "<td>". $row["LNAME"]."</td>";
            echo "<td>". $row['PICKUP'] . "</td>";
            echo "<td>". $row['DROPOFF'] . "</td>";
            echo "<td>". $row["IID"] ."</td>";
            echo "<td>". $row["ITEM_NAME"]. "</td>";
            echo "<td>". $row['ITEM_COLOR'] . "</td>";
            echo "<td>". $row['PID'] . "</td>";
            echo "</tr>";

        }
    }

        ?>
    </table>


<!-- Used to update the renter table -->

<?php
if (isset($_POST['submit'])){
  $RID = $_POST['RID'];
  $sql = "SELECT * FROM backend";
  $result = $conn->query($sql);
  if ($result->num_rows > 0){
    while ($row=$result->fetch_assoc()){
      if($_SESSION['fname'] == $row['FNAME']){
        $PID = $row['PID'];
        $sql2 = "UPDATE renter SET PID = '".$PID."' WHERE RID = '".$RID."'";
        $result2 = $conn->query($sql2);
  }else{}
  }
		}
	}

?>

<!-- Go back button -->
<form action='manage_inventory.php' method='POST'>
    <button  id='go back' type='submit' name ='submit'>Go Back</button>
</form>


    </main>
    </div>
    <!-- Footer -->
    <footer>
        Copyright &copy; 2022 Activities Inventory Management System
    </footer>
    </div>
</body>
</html>