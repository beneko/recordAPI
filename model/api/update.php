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
    !empty($data->disc_id) &&
    !empty($data->disc_title) &&
    !empty($data->disc_year) &&
    !empty($data->disc_label) &&
    !empty($data->disc_genre) &&
    !empty($data->disc_price) &&
    !empty($data->artist_id)
) {
    $_POST['submit'] = true;
    $_POST['disc_id'] = $data->disc_id;
    $_POST['disc_title'] = $data->disc_title;
    $_POST['disc_year'] = $data->disc_year;
    $_POST['disc_label'] = $data->disc_label;
    $_POST['disc_genre'] = $data->disc_genre;
    $_POST['disc_price'] = $data->disc_price;
    $_POST['artist_id'] = $data->artist_id;

    include '../../function/functions.php';
    include '../../controlers/add_script.php';


    if (isset($formError) && sizeof($formError) === 0) {
        // if there is no error
        // declare some variables to take the input values
        $disc_id = htmlspecialchars($_POST['disc_id']);
        $disc_title = htmlspecialchars($_POST['disc_title']);
        $disc_year = htmlspecialchars($_POST['disc_year']);
        $disc_label = htmlspecialchars($_POST['disc_label']);
        $disc_genre = htmlspecialchars($_POST['disc_genre']);
        $disc_price = htmlspecialchars($_POST['disc_price']);
        $artist_id = htmlspecialchars($_POST['artist_id']);

        // call addDisc method to add new disc to database
        $insert = $crud->updateDisc($disc_id, $disc_title, $disc_year, $data->disc_picture, $disc_label, $disc_genre, $disc_price, $artist_id);
        if ($insert) {
            //on envoie le code 201
            http_response_code(201);

            // on averti l'utilisateur
            echo json_encode(array("message" => "disc updated!"));

        } else {
            // on envoie le code 503
            http_response_code(503);
            // on averti l'utilisateur
            echo json_encode(["message" => "adding failed! there is an error!"]);
        }
    } else {
        // on envoie le code 400 - bad request
        http_response_code(400);
        // on averti l'utilisateur
        echo json_encode(["Error" => $formError]);
    }
}
else{
    // on envoie le code 400 - bad request
    http_response_code(400);
    // on averti l'utilisateur
    echo json_encode(["message" => "adding failed! missing information!"]);
}

//test information
//{
//    "disc_id" : "29",
//    "disc_title" : "Fugazi2",
//    "disc_year" : "1984",
//    "disc_picture" : "Fugazi.jpeg",
//    "disc_label" : "EMI",
//    "disc_genre" : 2,
//    "disc_price" : "111",
//    "artist_id" : "1"
//}