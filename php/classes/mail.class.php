<?php

class mail
{
    // Function to send emails using PHPMailer
    /**
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public static function sendEmail($to, $body) {
        // Load in necessary files from PHPMailer
//        require('./vendor/autoload.php');
        require('../vendor/autoload.php');
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // Add SMPT data
        $mail->isSMTP();
        $mail->Host         = ''; // vul in GVD
        $mail->SMTPAuth     = true;
        $mail->Username     = ''; // vul in GVD
//        $mail->Password     = '0Mmqu4oEMc'; // vul in GVD
        $mail->Password     = ''; // vul in GVD
        $mail->SMTPSecure   = 'tls';
        $mail->Port         = 587;
        // Add sender and reciever
        $mail->setFrom('');
        $mail->addAddress($to);

        // Allow HTML in the email
        $mail->isHTML(true);
        $mail->ContentType = 'text/html';
        // Add mail subject and body values
//        $mail->Subject      = $subject;
        $mail->Subject      = "";
        $mail->Body         = '<html><body>';
        $mail->Body         .= $body;
        $mail->Body         .= '</body></html>';

//         Send email

//        $mail->send();

//         if ($mail->send()) {
//             // Mail is sent
//             echo $to;
//         } else {
//             echo 'Er is een fout opgetreden, probeer het later opnieuw.';
//         }
    }
}