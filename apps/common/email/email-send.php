<?php
include('send/PHPMailerAutoload.php');
class EmailSender
{
    public function sendMail($email, $message, $cc=null)
    {


        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'belay.hadush22@gmail.com';
        $mail->Password = 'tmlzhvljaovokmee';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('belay.hadush22@gmail.com', 'eRX Ethiopia');
        $mail->addAddress($email);
        if($cc!=null){
                    $mail->addCC($cc);
        }
        else{
          $mail->addCC('cc@example.com');

        }
        $mail->addBCC('bcc@example.com');

        $mail->isHTML(true);
        $mail->Subject = 'e-Prescription';
        $mail->Body    = $message;

        if (!$mail->send()) {
            $Error = $mail->ErrorInfo;
            $Error_message = $Error;
            return  ' Signed up successfully. <br>But confirmation not sent to your email '; // inform that email is not sent 
            //header("location: index.php");
        } else {
            return 'Signed up successfully. <br> confirmation link is sent to your email please confirm your email'; // inform that email is sent 
            // header("location: index.php");
        }
    }
}
