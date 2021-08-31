<?php

// les headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require '../config.php';

// Récupérons l'id de l'objet à lire
$id = isset($_GET['disc_id']) ? $_GET['disc_id'] : die();
$result = $crud->getDiscDetails($id);

if($result != null) {
    // on envoie la réponse http à 200 OK
    http_response_code(200);

    // on renvoie la réponse en Json
    echo json_encode($result);
}
else
{
    // on renvoie le code 404 Not found
    http_response_code(404);

    // On averti l'utilisateur
    echo json_encode(array("message"=> "disc not exist!"));

}