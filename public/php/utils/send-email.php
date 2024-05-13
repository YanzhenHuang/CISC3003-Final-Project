<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

/**
 * Send an email to the target address.
 * @param string $targetAddr  The target address to send the email to.
 * @param string $subject  The subject of the email.
 * @param string $body  The body of the email.
 */

/**
 *  You need to add your own SMTP server credentials.
 */

function sendEmail($targetAddr, $subject, $body)
{
    if ($targetAddr == null) {
        return;
    }

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';   /* SMTP User Name */
    $mail->Password = '';   /* SMTP Password (Token) */

    if ($mail->Username == '' || $mail->Password == '') {
        return;
    }

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('');     /* SMTP Mail Address */
    $mail->addAddress($targetAddr);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;


    $mail->send();
}