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
        <img src="images/AIMSLOGO.png" alt="AIMS Logo">
        <h1>Activities Inventory Management System (AIMS)</h1>
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="rental.html">Rental Information</a></li>
            <li><a href="inventory.html">Inventory</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="signon.html">Sign In</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="content">
    <main>
        <!-- Style for PHP table -->
        <style>
            table {border: 1px solid;}

            th{
                border: 1px solid;
                background-color: #0A2240;
                color: #ffffff;

            }
            td {
                border: 1px solid;
                padding: 15px;
                text-align: center;
                width: 500px;
        </style>

    <h1>Current Inventory</h1>
    <br>

    <table><tr>
        <th>IID</th>
        <th>Item Name</th>
        <th>Item Category</th>
        <th>Item Color</th>
        <th>Quantity</th>
        <th>Add On Needed?</th>
        <th>Purchase Item</th>
    </tr>
        <?php
        // Refer to connection file -- Connects to the database
        include 'connect.php';

        //Echo table headers


        //MySQL Select Statement & query
        $sql = "SELECT * FROM items WHERE CHECKED_OUT = 0";
        $result = $conn->query($sql);

        //Determines if there is data in the tables
        //Checks to see if the number of rows from the query is more than 0
        //Fetches each row from the query
        if($result->num_rows > 0){
            while ($row=$result->fetch_assoc()) {
            //Prints each row in the table
            echo "<tr>";
            echo "<td>". $row['IID'] . "</td>";
            echo "<td>". $row['ITEM_NAME'] . "</td>";
            echo "<td>". $row["ITEM_CATEGORY"]."</td>";
            echo "<td>". $row['ITEM_COLOR'] . "</td>";
            echo "<td>". $row['QUANTITY'] . "</td>";
            echo "<td>". $row['ADD_ON_NEEDED'] . "</td>";
            echo "<td>". $row['PURCHASE_ITEM'] . "</td>";
            echo "</tr>";
        }
        } else{
                echo "Nothing here :(";
        }

        ?>
    </table>
    </main>
    </div>
    <!-- Footer -->
    <footer>
        Copyright &copy; 2022 Activities Inventory Management System
    </footer>
    </div>
</body>
</html>