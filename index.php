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
        
        echo "<h2>Detalles del correo para: " . htmlspecialchars($row['email']) . "</h2>";
        echo "<p><strong>De:</strong> " . htmlspecialchars($mail->From) . " (" . htmlspecialchars($mail->FromName) . ")</p>";
        echo "<p><strong>Para:</strong> " . htmlspecialchars($row['email']) . "</p>";
        echo "<p><strong>Asunto:</strong> " . htmlspecialchars($mail->Subject) . "</p>";
        echo "<p><strong>Contenido:</strong></p>";
        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
        echo $mail->Body;
        echo "</div>";

        $mail->send();
        echo "<p style='color: green;'>Correo enviado exitosamente a " . htmlspecialchars($row['email']) . "</p>";
        echo "<hr>";

        $mail->clearAddresses();
    }

    echo "<h3>Todos los correos han sido enviados y mostrados.</h3>";
} catch (Exception $e) {
    echo "<p style='color: red;'>No se pudo enviar el mensaje. Error de PHPMailer: {$mail->ErrorInfo}</p>";
}