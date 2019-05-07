<?php
include 'bootstrap.php';

$sender = 'victoirecretal@hotmail.com';
$recipient = 'rabillervictoire@gmail.com';

$subject = "php mail test";
$message = "php test message";
$headers = 'From:' . $sender;
if (!empty($_POST['submit'])) {
  if (mail($recipient, $subject, $message, $headers))
  {
      echo "Message accepted";
  }
  else
  {
      echo "Error: Message not accepted";
  }
}

include "../views/contact2.phtml";

