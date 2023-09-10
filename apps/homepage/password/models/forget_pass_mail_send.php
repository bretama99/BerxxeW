<?php
if (isset($_POST['send_mail'])) {
    $usersId = $_POST['usersId'];
    $email = $_POST['email'];
    function generateRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $randomValue = generateRandomString();
    $Random_s_query = "insert into passwordreset (randomValue,usersId) values('$randomValue','$usersId')";
    $stmtRS = $con->prepare($Random_s_query);
    $SuccessRS = $stmtRS->execute();
    if ($SuccessRS) {
        $serverName = $_SERVER['SERVER_NAME'];
        if ($serverName == 'localhost' || $serverName == '127.0.0.1') {
            $serverName = $serverName . '/erxHub/apps';
        }
        $link = "usersId=" . $usersId . '&randomValue=' . $randomValue;

        $bodyContent = '<h3>e-Prescription  confirmation link</h3>';
        $bodyContent = '<h3><b>eRx Ethiopia</b><br>Click the link below to change your password for e-Prescription</h3>';
        $bodyContent .= '<p><b><a href="' . $serverName . '/change_password.php?' . $link . '">click here to change password</a></b><br><br>
							<span style="color:red;">
							Please Do not reply to this email</span></p>';

        $email_send = new EmailSender();
        $email_send->sendMail($email, $bodyContent);

        if (!$email_send) {
            $message = 'Email sending failed ';
            $Error = $mail->ErrorInfo;
            $Error_message = $message . $Error;
            $_SESSION['error_user'] = $Error_message;
            header("http://localhost/erxHub/apps/");
        } else {
            $_SESSION['success_user'] = "Confirmation link is sent to your email. Check your email";
            header("location: http://localhost/erxHub/apps/");
        }
    }
}
