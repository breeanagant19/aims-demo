<?php

if(isset($_POST['submit'])) {
 $mailto = 'breeana.gant.19@cnu.edu';  //My email address

 //Getting submission data
 $fname = $_POST['fname'];
 $lname = $_POST['lname'];
 $fromEmail = $_POST['myEmail'];
 $message = $_POST['message'];
 $subject = $_POST['subject']; //getting subject line from client
 $subject2 = "Confirmation: Message was submitted successfully";

 //Email body I will receive
 $emessage = "Client Name: " . $fname . "\n"
 . "Client Message: " . "\n\n" . $_POST['message'];

 //Message for client confirmation
 $emessage2 = "Dear " . $fname . "\n"
 . "Thank you for contacting us. We will get back to you shortly!" . "\n\n"
 . "You submitted the following message: " . "\n" . $_POST['message'] . "\n\n"
 . "Regards," . "\n" . "Technical Support Staff";

 //Email headers
 $headers = "From: " . $fromEmail; // Technical Support Staff receives this message
 $headers2 = "From: " . $mailto; // Renter receives this message

 //PHP mailer function

$result1 = mail($mailto, $subject, $emessage, $headers); // Email sent to Technical Support Staff
$result2 = mail($fromEmail, $subject2, $emessage2, $headers2); // Email sent to Renter

if ($result1 && $result2){
	$success = "Your email was sent successfully!";
} else {
	$failure = "Failed. :(";
}

$_POST = array();

}




?>