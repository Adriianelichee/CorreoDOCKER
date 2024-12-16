<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/db/config.php';
include_once __DIR__ . '/models/user.php';

// ... (resto del archivo)

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$stmt = $user->read();

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mailhog';
    $mail->Port = 1025;
    $mail->SMTPAuth = false;

    $mail->setFrom('from@example.com', 'Mailer');
    $mail->isHTML(true);
    $mail->Subject = 'Test email';
    $mail->Body    = 'This is a test email <b>in bold!</b>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mail->addAddress($row['email']);
        $mail->send();
        echo "Email enviado a " . $row['email'] . "<br>";
        $mail->clearAddresses();
    }

    echo "All emails sent successfully";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}