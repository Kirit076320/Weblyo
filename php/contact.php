<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/cdException.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nom = htmlspecialchars(trim($_POST["nom"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $message = htmlspecialchars(trim($_POST["message"]));

  $mail = new PHPMailer(true);

  try {
    // Config SMTP OVH
    $mail->isSMTP();
    $mail->Host = 'ssl0.ovh.net';
    $mail->SMTPAuth = true;
    $mail->Username = 'contact@tondomaine.fr'; // 🔁 Ton email OVH
    $mail->Password = 'mot_de_passe_email';    // 🔁 Son mot de passe
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('contact@tondomaine.fr', 'Ton Site Web'); // 🔁 Ton email OVH
    $mail->addAddress('contact@tondomaine.fr'); // 🔁 Récepteur (peut être le même)

    $mail->Subject = "Nouveau message depuis le formulaire de contact";
    $mail->Body = "Nom: $nom\nEmail: $email\n\nMessage:\n$message";

    $mail->send();
    echo "Message envoyé avec succès.";
  } catch (Exception $e) {
    echo "Erreur lors de l'envoi du message : {$mail->ErrorInfo}";
  }
} else {
  echo "Méthode non autorisée.";
}
?>
