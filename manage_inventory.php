<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS:: Admin/Tech Support</title>
</head>

<body>
    <div id="wrapper">
    <!-- Header -->
    <header>      
        <?php include "loggedin.php"; ?>
        <?php include "connect.php"; ?>
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
    <div id="content">
        <style>
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


        .adminform {float: center;
            display: block;
            width: 100%;}

        form {padding: 1em; }

        </style>

    <main>
      <?php session_start();?>
    <h2> <center>Welcome <?php echo $_SESSION['fname'];?>!</center></h2>
    <h3><center>Please choose an option:</center></h3>
    <form class = "adminform" action = "insert.html" method = "POST">
        <button name="insert" type="submit">Add to Current Inventory</button>
    </form>
    <form class="adminform" action="delete.html" method="POST">
        <button name="delete" type = "submit">Delete from Current Inventory</button>
    </form>
    <form class="adminform" action = "view.php" method="POST">
        <button name="view" type = "submit">View current rental applications</button>
    </form>
    <form class = "adminform" action ="index.html" method="POST">
      <button name="logout" type="submit">Logout</button>
    </form>
      <p><center>If you are having issues accessing the form, <a href="contact.php">Please contact Technical Support Staff.</a></center></p>
    </main>
    </div>
    <!-- Footer -->
    <footer>
        Copyright &copy; 2022 Activities Inventory Management System
    </footer>
    </div>
</body>
</html>