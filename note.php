<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclure les fichiers PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Récupération des données du formulaire
$nomprenom = $_POST['nomprenom'];
$type = $_POST['inlineRadioOptions'];
$association = !empty($_POST['association']) ? $_POST['association'] : 'N/A';
$societe = !empty($_POST['societe']) ? $_POST['societe'] : 'N/A';
$email = $_POST['email'];
$telephone = $_POST['telephone'];
$adresse = $_POST['adresse'];
$type_projet = $_POST['typ'];
$description = $_POST['descript'];

// Instancier PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuration du serveur SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'anidedev229@gmail.com'; // Votre adresse email Gmail
    $mail->Password = 'dqek wavs ghbl bksh';   // Votre mot de passe Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinataires pour l'email principal
    $mail->setFrom('anidesupreme61@gmail.com', 'Demande de Devis');
    $mail->addAddress('anidesupreme61@gmail.com'); 
    $mail->addAddress('anidedev229@gmail.com'); 
    $mail->addReplyTo($email, $nomprenom);
    $mail->addCC('anidesupreme61@gmail.com');
    $mail->addBCC('anidesupreme61@gmail.com');

    // Contenu de l'email principal
    $mail->isHTML(true);
    $mail->Subject = 'Nouvelle demande de devis';
    $mail->Body = "
    <html>
    <body style='font-family: Arial, sans-serif; color: #333;'>
        <h2 style='color: #0056b3;'>Nouvelle demande de devis</h2>
        <p><strong>Nom et Prénom:</strong> {$nomprenom}</p>
        <p><strong>Type:</strong> {$type}</p>
        <p><strong>Association:</strong> {$association}</p>
        <p><strong>Société:</strong> {$societe}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Téléphone:</strong> {$telephone}</p>
        <p><strong>Adresse:</strong> {$adresse}</p>
        <p><strong>Type de projet:</strong> {$type_projet}</p>
        <p><strong>Description:</strong></p>
        <p>{$description}</p>
    </body>
    </html>";

    // Envoi de l'email principal
    $mail->send();

    // Préparer l'email de confirmation à l'utilisateur
    $mail->clearAddresses();
    $mail->clearCCs();
    $mail->clearBCCs();
    $mail->addAddress($email);
    $mail->Subject = 'Confirmation de reception de votre demande de devis';
    $mail->Body = "
   <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #F4F4F4;
                color: #333;
            }
            .container {
                background-color: #FFFFFF;
                padding: 20px;
                max-width: 600px;
                margin: 0 auto;
                border-radius: 8px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            }
            .header {
                background-color: #ff0000;
                color: #FFFFFF;
                padding: 10px;
                text-align: center;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }
            .footer {
                text-align: center;
                margin-top: 20px;
                padding: 10px;
                font-size: 0.9em;
                color: #777;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #ff0000;
                color: #FFFFFF;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                Confirmation de Demande de Devis
            </div>
            <p>Bonjour {$nomprenom},</p>
            <p>Nous avons bien reçu votre demande de devis et nous sommes ravis que vous nous ayez choisis.</p>
            <p>Notre équipe s'engage à traiter votre demande dans les plus brefs délais, habituellement dans un délai de 72 heures.</p>
            <p>Si vous avez des questions supplémentaires ou avez besoin d'une assistance immédiate, n'hésitez pas à nous contacter.</p>
            <div class='footer'>
                Merci pour votre confiance,<br>Anide_DEV
            </div>
        </div>
    </body>
    </html>";

    // Envoi de l'email de confirmation
    $mail->send();

    // Redirection vers la page de confirmation
    header('Location: confirmation.php');
} catch (Exception $e) {
    echo "Votre demande de devis n'a pas pu être envoyée. Erreur: {$mail->ErrorInfo}";
}
?>
