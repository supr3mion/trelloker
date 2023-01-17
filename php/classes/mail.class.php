<?php

class mail
{
    // Function to send emails using PHPMailer
    public static function sendEmail($to, $body) {
        // Load in necessary files from PHPMailer
        require('./vendor/autoload.php');
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // Add SMPT data
        $mail->isSMTP();
        $mail->Host         = 'mail.antagonist.nl';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'jmail van de boer';
        $mail->Password     = 'jouw ww';
        $mail->SMTPSecure   = 'tls';
        $mail->Port         = 587;
        // Add sender and reciever
        $mail->setFrom('mail van de boer');
        $mail->addAddress($to);

        // Allow HTML in the email
        $mail->isHTML(true);
        $mail->ContentType = 'text/html';
        // Add mail subject and body values
//        $mail->Subject      = $subject;
        $mail->Subject      = "uitnodiging Trelloker";
        $mail->Body         = '<html><body>';
        $mail->Body         .= $body;
        $mail->Body         .= '</body></html>';

        // Send email
        // if ($mail->send()) {
        //     // Mail is sent
        // } else {
        //     echo 'Er is een fout opgetreden, probeer het later opnieuw.';
        // }
    }
}