<?php
// On charge notre fichier secret contenant la clé API
require_once 'config.php';

// On vérifie que le formulaire a bien été envoyé en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // On récupère les données envoyées par le formulaire
    $nom = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // On prépare les données à envoyer à Brevo
    $donnees = [
        "sender" => [
            "name" => "Never Too Late",
            "email" => "touriayoussef4@gmail.com" // ton adresse personnelle vérifiée sur Brevo
        ],
        "to" => [
            [
                "email" => "touriayoussef4@gmail.com", // où TU reçois le message
                "name" => "Equipe Never Too Late"
            ]
        ],
        "subject" => "Nouveau message de $nom",
        "htmlContent" => "<p>Nom : $nom</p><p>Email : $email</p><p>Message : $message</p>"
    ];

    // On envoie la requête à Brevo via cURL
    $ch = curl_init("https://api.brevo.com/v3/smtp/email");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($donnees));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "accept: application/json",
        "api-key: " . BREVO_API_KEY,
        "content-type: application/json"
    ]);

    $reponse = curl_exec($ch);
    curl_close($ch);

    // On redirige vers la page d'accueil avec un message de succès
    header("Location: index.html?envoi=succes");
    exit;
}