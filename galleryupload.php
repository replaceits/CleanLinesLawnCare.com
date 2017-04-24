<?php
    session_start();

    if(!isset($_SESSION['email'])        || empty($_SESSION['email']) ||
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
        $database_key = file_get_contents('/api-keys/database.key');
        $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
        $valid_database = false;

        if(!mysqli_connect_errno()){
            $valid_database = true;
            $gallery_picture_order = 1;

            $sql = "UPDATE gallery_pictures SET gallery_picture_order=gallery_picture_order+1;";

            if($stmt = $mysqli_con->prepare($sql)){
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            } else {
                $valid_database = false;
            }

            $sql = "INSERT IGNORE INTO gallery_pictures (gallery_picture_location, gallery_picture_order, gallery_picture_date) VALUES ( ? , ? ,'" . date("Y-m-d H:i:s") . "');";

            if($stmt = $mysqli_con->prepare($sql)){
                $gallery_picture_location = basename($_FILES["gallerypicture"]["name"]);
                $stmt->bind_param('si', $gallery_picture_location, $gallery_picture_order);
                $stmt->execute();
                $stmt->store_result();
                $stmt->close();
            } else {
                $valid_database = false;
            }
        }
        $mysqli_con->close();

        if( !$valid_database ){
            unlink($target_file);
            http_response_code(500);
            echo("Invalid database");
            exit(0);
        }

        http_response_code(200);
        echo("Success!");
        exit(0);
    } else {
        http_response_code(400);
        echo(": " . $_FILES["gallerypicture"]["error"]);
        exit(0);
    }
?>