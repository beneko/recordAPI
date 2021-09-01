<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-Width");

require '../config.php';

// on récupère les données du post
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->disc_id)
) {
    $disc_id = htmlspecialchars($data->disc_id);

    // call addDisc method to add new disc to database
    $delete = $crud->deleteDisc($disc_id);
    if ($delete) {
        //on envoie le code 201
        http_response_code(201);

        // on averti l'utilisateur
        echo json_encode(array("message" => "disc deleted!"));

    } else {
        // on envoie le code 503
        http_response_code(503);
        // on averti l'utilisateur
        echo json_encode(["message" => "delete failed! there is an error!"]);
    }
}
else
{
    // on envoie le code 400 - bad request
    http_response_code(400);
    // on averti l'utilisateur
    echo json_encode(["message" => "delete failed! missing information!"]);
}

//test information
//{
//    "disc_id" : "29"
//}