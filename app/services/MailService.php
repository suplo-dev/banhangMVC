<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';

class MailService {

    const MAIL_USERNAME = 'hahip120303@gmail.com';
    const MAIL_PASSWORD = 'lsbl ropi vykk vysn';
    public static function send($to, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
            // Cấu hình SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = self::MAIL_USERNAME;  // Gmail
            $mail->Password   = self::MAIL_PASSWORD;      // App Password
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Thiết lập người gửi và người nhận
            $mail->setFrom('no-reply@hhstore.vn', 'HHStore');
            $mail->addAddress($to);

            // Nội dung
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body);

            $mail->send();
            return true;
        } catch (Exception $e) {
            var_dump($e);
            error_log('Mail error: ' . $mail->ErrorInfo);
            return false;
        }
    }
}
