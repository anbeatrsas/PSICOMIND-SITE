<?php
 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
 
 
    function EnviarEmail($to, $from, $assunto, $mensagem){
 
       
            require 'vendor/autoload.php';
 
            $mail = new PHPMailer();
            $mail->CharSet = "UTF-8";
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
 
            $mail->isSMTP();
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
 
            // Set the hostname of the mail server
           
            //Username to use for SMTP AUTHENTICATION
            $mail->isHTML(true);
            $mail->Username = 'anabeatrizalmeida004@gmail.com';
            $mail->Password = 'sznz htna krdw sscs';
            $mail->setFrom($from, $from);
            $mail->addAddress($to, $to);
            $mail->addReplyTo('replyto@example.com', 'First Last');
 
            // Assunto e mensagem de email
            $mail->Subject = $assunto;
            $mail->Body = $mensagem;
 
 
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message sent!';
 
            }
 
 
    }
 
 
   
 
?>