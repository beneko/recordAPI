<?php
// function to validate our form inputs
function validForm(array $regex , array $data): array {
    //declare an array to keep form errors
    $formError = [];
    foreach($regex as $inputName => $regexValue){
        // if the form input isn't empty
        if(!empty($data[$inputName])) {
            // if the form input doesn't match with regex
            if(!preg_match($regexValue, $data[$inputName])) {
                $formError[$inputName] = 'Caractère non valide!';
            }
        }
        else {
            $formError[$inputName] = 'Champs vide!';
        }
    }
    return $formError;
}
// function to validate type of inputed files with upload obligation
function validFile(array $inputFiles , array $data): array {
    //declare an array to keep file errors
    $fileError = [];
    foreach($inputFiles as $inputFile => $validTypes){
        // if there isn't any error on uploading the file
        if($_FILES[$inputFile]['error'] === 0){
            //get the type of uploaded file
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $fileType = finfo_file($finfo, $_FILES[$inputFile]['tmp_name']);
            finfo_close($finfo);
            // if the type of uploaded file is not in the autorised file types
            if(!in_array($fileType, $validTypes)){
                $fileError[$inputFile] = "Le type de fichier n'est pas autorisé!";
            }
        }
        else {
            switch ($_FILES[$inputFile]['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $fileError[$inputFile] = "Le fichier téléchargé dépasse la taille maximale du fichier!";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $fileError[$inputFile] = "Le fichier téléchargé dépasse la taille maximale du fichier!";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $fileError[$inputFile] = "Le fichier téléversé n'a été téléversé que partiellement!";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $fileError[$inputFile] = "Aucun fichier n'a été téléversé!";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $fileError[$inputFile] = "Absence d'un dossier temporaire!";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $fileError[$inputFile] = "Échec de l'écriture du fichier sur le disque!";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $fileError[$inputFile] = "Téléchargement de fichier arrêté par extension!";
                    break;
            }
        }
    }
    return $fileError;
}
// function to validate type of inputed files without upload obligation
function validFileOptional(array $inputFiles , array $data): array {
    //declare an array to keep file errors
    $fileError = [];
    foreach($inputFiles as $inputFile => $validTypes){
        // if there isn't any error on uploading the file
        if($_FILES[$inputFile]['error'] === 0){
            //get the type of uploaded file
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $fileType = finfo_file($finfo, $_FILES[$inputFile]['tmp_name']);
            finfo_close($finfo);
            // if the type of uploaded file is not in the autorised file types
            if(!in_array($fileType, $validTypes)){
                $fileError[$inputFile] = "Le type de fichier n'est pas autorisé!";
            }
        }
        else {
            switch ($_FILES[$inputFile]['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $fileError[$inputFile] = "Le fichier téléchargé dépasse la taille maximale du fichier!";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $fileError[$inputFile] = "Le fichier téléchargé dépasse la taille maximale du fichier!";
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $fileError[$inputFile] = "Le fichier téléversé n'a été téléversé que partiellement!";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    // $fileError[$inputFile] = "Aucun fichier n'a été téléversé!";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $fileError[$inputFile] = "Absence d'un dossier temporaire!";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $fileError[$inputFile] = "Échec de l'écriture du fichier sur le disque!";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $fileError[$inputFile] = "Téléchargement de fichier arrêté par extension!";
                    break;
            }
        }
    }
    return $fileError;
}