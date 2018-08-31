
<?php
  if(isset($_POST['email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "info@businessdconsulting.co.uk";
    $email_subject = "BDC - Business D Consulting | User Enquiry...";

    function died($error) {
        // your error code can go here
        echo "We are very sorry, there seems some issue, please visit after some time. ";
        //echo "These errors appear below.<br /><br />";
        //echo $error."<br /><br />";
        //echo "Please go back and fix these errors.<br /><br />";
        die();
    }

/*
    // validation expected data exists
    if(!isset($_POST['name_u']) ||
        !isset($_POST['subject_u']) ||
        !isset($_POST['email_u'])  ||
        !isset($_POST['message_u'])) {
        died('We are sorry, there appears to be a problem with the form you submitted(2).');
    }
*/


    $first_name = $_POST['name_u']; // required
    $subject = $_POST['subject_u']; // required
    $email_from = $_POST['email_u']; // required
    //$telephone = $_POST['telephone']; // not required
    $comments = $_POST['message_u']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$email_from)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if(!preg_match($string_exp,$first_name)) {
        $error_message .= 'The First Name you entered does not appear to be valid.<br />';
    }

    /*
    if(!preg_match($string_exp,$subject)) {
        $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
    }*/

    if(strlen($comments) < 2) {
        $error_message .= 'The Comments you entered do not appear to be valid.<br />';
    }

    if(strlen($error_message) > 0) {
        died($error_message);
    }

    $email_message = "Please find below the submission details from contact form.\n\n";


    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }


    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    //$email_message .= "Contact Number: ".clean_string($telephone)."\n";
    $email_message .= "URL: ".clean_string($subject)."\n";
    $email_message .= "Message: ".clean_string($comments)."\n";

// create email headers
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);

    //header('Location: index.html');

    ?>

<script type="text/javascript">location.href = 'http://businessdconsulting.co.uk';</script>

    <?php

}
?>

