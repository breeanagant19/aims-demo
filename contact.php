<!DOCTYPE html>
<html lang="en">
<?php include 'email.php'; ?>
<head>
    <meta charset="UTF-8">
    <link href="aims.css" rel="stylesheet">
    <title>AIMS::Contact Us</title>
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
        <h2> Contact Form </h2>
        <p> Please fill out the form below and we will get back to you as soon as possible.</p>
        <form action="" method="post">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname">

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname">

            <label for="myEmail">Email:</label>
            <input type="email" name="myEmail" id="myEmail">

            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject">

            <br>
            <br>

            <label for="message">Please leave us a message:</label>
            <textarea id="message" name="message" rows="4" cols="50">Enter your message here...</textarea>

            <p><?php echo $success;?>
            <br>
            <br>
            <button type="submit" name="submit">Submit</button>
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