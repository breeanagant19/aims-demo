<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Sign In</title>
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
        <h2>Sign In</h2>
      <p><h3><b>Please sign in with the credentials that were provided to your by the Technical Support Staff</b></h3></p>
      <?php include 'loggedin.php';?>
      <form action="" method="POST">
        <label for="username">Email:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button id="submit" type="submit" name="submit" onclick="manage_inventory.php">Login</button>
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