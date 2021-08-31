<?php

// declare regex array
$regex = [
    'disc_title' => '/^[A-Za-z0-9\s\-_,\.;:()]+$/',
    'artist_id' => '/^[0-9]+$/',
    'disc_year' => '/^\d{4}$/',
    'disc_label' => '/^[A-Za-z0-9\s\-_,\.;:()]+$/',
    'disc_genre' => '/^[A-Za-z0-9\s\-_,\.;:()]+$/',
    'disc_price' => '/\d{1,3}(?:[.,]\d{3})*(?:[.,]\d{2})?/'
];
$inputFiles = [
    'disc_picture' => array ("image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff")
];
if(isset($_POST['submit'])){
    // call valiForm function
    $formError = validForm($regex , $_POST);

    $fileError = sizeof($_FILES)>0 ? validFile($inputFiles, $_FILES) : false ;
}
