<?php
    session_start();

    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        http_response_code(401);
        echo("Unauthorized");
        exit(0);
    }

    $database_key = file_get_contents('/api-keys/database.key');
    $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
    $valid_database = true;

    foreach($_POST as $key => $value) {
        if (strpos($key, 'order_') === 0) {
            
            $gallery_picture_id = str_replace("order_","",$key);
            if(!is_numeric($gallery_picture_id) || !is_numeric($value)){
                continue;
            }
            $gallery_picture_id = strval($gallery_picture_id);
            $gallery_picture_order = strval($value);

            if(!mysqli_connect_errno()){
                $sql = "UPDATE gallery_pictures SET gallery_picture_order=? where gallery_picture_id=?;";
                
                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('ii', $gallery_picture_order, $gallery_picture_id);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->close();
                } else {
                    $valid_database = false;
                }
            } else {
                $valid_database = false;
            }
        }
    }

    foreach($_POST as $key => $value) {
        if (strpos($key, 'delete_') === 0) {
            if($value != "1"){
                continue;
            }
            $gallery_picture_id = str_replace("delete_","",$key);
            if(!is_numeric($gallery_picture_id)){
                continue;
            }
            $gallery_picture_id = strval($gallery_picture_id);

            if(!mysqli_connect_errno()){
                $sql = "SELECT gallery_picture_location FROM gallery_pictures WHERE gallery_picture_id=?;";

                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('i', $gallery_picture_id);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($gallery_picture_location);

                    while( $stmt->fetch()){
                        unlink(__DIR__ . "/gallery/" . $gallery_picture_location);
                    }
                }

                $sql = "DELETE FROM gallery_pictures WHERE gallery_picture_id=?;";
                
                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('i', $gallery_picture_id);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->close();
                } else {
                    $valid_database = false;
                }
            } else {
                $valid_database = false;
            }
        }
    }

    $mysqli_con->close();

    if( !$valid_database ){
        http_response_code(500);
        echo("Invalid database");
        exit(0);
    }

    http_response_code(200);
    echo("Success!");
    exit(0);
?>
