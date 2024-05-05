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

function sendEmail($targetAddr, $subject, $body)
{
    if ($targetAddr == null) {
        return;
    }
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'huangyanzhen0108@gmail.com';
    $mail->Password = 'tuxpjsscuffdzcxb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('huangyanzhen0108@gmail.com');
    $mail->addAddress($targetAddr);
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
}