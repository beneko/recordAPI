<?php
// Les headers dont nous avons besoin
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../config.php';
$result= $crud->getDiscList();

if(sizeof($result)>0) {

    // tableau de produits
    $discs = array();
    $discs["records"] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        $disc = array(
            "disc_id" => $disc_id,
            "artist_name" => $artist_name,
            "disc_title" => $disc_title,
            "disc_label" => $disc_label,
            "disc_year" => $disc_year,
            "disc_genre" => $disc_genre,
            "disc_picture" => $disc_picture
        );

        array_push($discs["records"], $disc);
    }
    // on envoie la réponse http à 200 OK
    http_response_code(200);

    // on renvoie la réponse en Json
    echo json_encode($discs);

}
else
{
    // on renvoie le code 404 Not found
    http_response_code(404);

    // On averti l'utilisateur
    echo json_encode(array("message"=> "Aucun produits trouvés."));
}