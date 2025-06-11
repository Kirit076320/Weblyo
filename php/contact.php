<?php
require_once __DIR__ . '/../PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = htmlspecialchars(trim($_POST["nom"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $message = htmlspecialchars(trim($_POST["message"]));

  $mail = new PHPMailer(true);

  try {
    // Configuration SMTP (exemple Gmail)
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pereiraroussignolmatteo@gmail.com';       // <== à remplacer par ton email
    $mail->Password   = 'Kirito';          // <== mot de passe ou mot de passe d’application Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom($email, $nom);
    $mail->addAddress('pereiraroussignolmatteo@gmail.com');        // <== à remplacer par ton email

    $mail->isHTML(false);
    $mail->Subject = 'Nouveau message depuis ton site freelance';
    $mail->Body    = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    echo 'Message envoyé avec succès.';
  } catch (Exception $e) {
    echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
  }
} else {
  echo "Méthode non autorisée.";
}
