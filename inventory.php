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
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="signon.html">Sign In</a></li>
        </ul>
    </nav>

    <!-- Main -->
    <div id="content">
    <main>
        <h2> Current Inventory</h2>
        <? php
            $username = "admin";
            $password = "Tiff1tre2maddy3";
            $host = "aims-demo1.cjiww4oiz41u.us-east-1.rds.amazonaws.com";
            $database = "aims";

            $mysqli = new mysqli($host, $username, $password, $database);
            $query = "SELECT * FROM inventory";
            if ($result = $mysqli->query($query)) {

                while ($row = $result->fetch_assoc()) {
                    $field1name = $row["IID"];
                    $field2name = $row["IIEM_NAME"];


                    echo '<b>'.$field1name.$field2name.'</b><br />';
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