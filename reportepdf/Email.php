<?php

// Esto es de PHPMailer 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Hasta aqui las llamadas a las librerias y funciones de PHPMailer
// Evio de email
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    //$mail->SMTPDebug = 0;                      //Enable verbose debug output	
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    //$mail->Host       = 'smtp.live.com';                     //Set the SMTP server to send through
	//$mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
	//$mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
	$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	//$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->addAddress('analistabigdatasc@gmail.com');     //Add a recipient
    $mail->Username   = 'cristiantorresh14@gmail.com';                     //SMTP username
	$mail->Password   = 'loraines1988';                               //SMTP password
	//$mail->Username   = 'coordtecnologia@sigpeconsultores.com.co';                     //SMTP username
    //$mail->Password   = 'Coj74350Coj7';                               //SMTP password

    //Recipients
    //$mail->setFrom('cristiantorresh14@gmail.com');
	//$mail->setFrom('coordtecnologia@sigpeconsultores.com.co', 'Cristian');
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('sistemas@sigpeconsultores.com.co');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Correo desde php sin adjunto';
    $mail->Body    = 'Este es un correo de prueba <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
// Hasta aqui envio de email.

?>