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
        if (strpos($key, 'delete_') === 0) {
            if($value != "1"){
                continue;
            }
            $review_id = str_replace("delete_","",$key);
            if(!is_numeric($review_id)){
                continue;
            }
            $review_id = strval($review_id);

            if(!mysqli_connect_errno()){
                $sql = "DELETE FROM reviews WHERE review_id=?;";
                
                if($stmt = $mysqli_con->prepare($sql)){
                    $stmt->bind_param('i', $review_id);
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