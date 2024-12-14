<?php

$awardspaceEmail = "cjzarsuelo@meganetportal.atwebpages.com";
$recipientEmail = "cyrusjames.cjz@gmail.com";

$from = "From: Mail Contact Form <" . $awardspaceEmail . ">";
$to = $recipientEmail;

$subject = "PHP mail() Test";

$body = "This is a test message sent with the PHP mail function!";

if(mail($to,$subject,$body,$from)){
    echo 'E-mail message sent!';
} else {
    echo 'E-mail delivery failure!';
}

?>