<?php

    if(isset($_POST['from-email'])) {
        $email_to = 'sean.campbell13@gamil.com';
        $subject  = $_POST['e-subject'];
        $message  = $_POST['e-message'];
        $email    = $_POST['from-email'];

        function died($error) {
            echo "There was an error with you submission.<br><br>";
            echo $error;
            die();
        }

        if(!isset($_POST['e-message'])) {
            died("No email.");
        };

        $error_message = "";
        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        if(!preg_match($email_exp, $email_from)) {
          $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
        };
        if(strlen($message) < 2) {
           $error_message .= 'The message you entered is not long enough.<br />';
         };
        if(strlen($error_message) > 0) {
          died($error_message);
        };

        function clean_string($string) {
            $bad = array("content-type","bcc:","to:","cc:","href");
            return str_replace($bad,"",$string);
            }


        $headers = 'From: '.$email."\r\n".

        'Reply-To: '.$email."\r\n" .

        'X-Mailer: PHP/' . phpversion();

        @mail($email_to, $subject, $message, $headers);
    }
?>

