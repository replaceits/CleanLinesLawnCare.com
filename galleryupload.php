<?php
    session_start();

    if(
       !isset($_FILES['gallerypicture']) || empty($_FILES['gallerypicture'])){
        http_response_code(401);
        echo("Unauthorized");
        exit(0);
    }

    $target_dir = __DIR__ . "/gallery/";
    $target_file = $target_dir . basename($_FILES["gallerypicture"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
    $check = getimagesize($_FILES["gallerypicture"]["tmp_name"]);
    if(!($check !== false)) {
        http_response_code(400);
        echo("File is not an image");
        exit(0);
    }

    if (file_exists($target_file)) {
        http_response_code(400);
        echo("File already exists");
        exit(0);
    }

    if($imageFileType != "jpg"  && $imageFileType != "png" && 
       $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        http_response_code(400);
        echo("Incorrect file type");
        exit(0);
    }

    if (move_uploaded_file($_FILES["gallerypicture"]["tmp_name"], $target_file)) {
        http_response_code(200);
        echo("Success!");
        exit(0);
    } else {
        http_response_code(400);
        echo("There was an error uploading");
        exit(0);
    }
?>