<?php
     // Make sure all required fields are present and filled in
     if (!isset($_POST['FirstName']) || !isset($_POST['LastName']) || !isset($_POST['Email'    ]) || 
         !isset($_POST['Phone'    ]) || !isset($_POST['Address' ]) || !isset($_POST['City'     ]) ||
         !isset($_POST['State'    ]) || !isset($_POST['Zipcode' ]) || !isset($_POST['StartDate']) ||  
         !isset($_POST['Time'     ]) || !isset($_POST['g-recaptcha-response'])                    ||
          empty($_POST['FirstName']) ||  empty($_POST['LastName']) ||  empty($_POST['Email'    ]) || 
          empty($_POST['Phone'    ]) ||  empty($_POST['Address' ]) ||  empty($_POST['City'     ]) ||
          empty($_POST['State'    ]) ||  empty($_POST['Zipcode' ]) ||  empty($_POST['StartDate']) ||  
          empty($_POST['Time'     ]) ||  empty($_POST['g-recaptcha-response'])) {
        
        http_response_code(400);
        echo "Invalid request";
        exit(0);
    }

    $firstName = trim(stripslashes(htmlspecialchars($_POST['FirstName'])));
    $lastName  = trim(stripslashes(htmlspecialchars($_POST['LastName' ])));
    $email     = trim(stripslashes(htmlspecialchars($_POST['Email'    ])));
    $phone     = trim(stripslashes(htmlspecialchars($_POST['Phone'    ])));
    $address   = trim(stripslashes(htmlspecialchars($_POST['Address'  ])));
    $city      = trim(stripslashes(htmlspecialchars($_POST['City'     ])));
    $state     = trim(stripslashes(htmlspecialchars($_POST['State'    ])));
    $zipCode   = trim(stripslashes(htmlspecialchars($_POST['Zipcode'  ])));
    $startDate = trim(stripslashes(htmlspecialchars($_POST['StartDate'])));
    $time      = trim(stripslashes(htmlspecialchars($_POST['Time'     ])));
    $other     = null;
    $comments  = null;
    
    $services  = $_POST['ServicesList'];
    
    foreach ($services as &$service) {
        $service = trim(stripslashes(htmlspecialchars($service)));
        if ($service == "Other" && isset($_POST['Other'])) {
            $other = trim(stripslashes(htmlspecialchars($_POST['Other'])));
        }
    }

    if( isset($_POST['Comments']) ){
        trim(stripslashes(htmlspecialchars($_POST['Comments'])));
    }

    $api_key = file_get_contents('/api-keys/invisiblerecaptcha.key');

    // Verify Captcha
    try {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret'   => $api_key,
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data) 
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context); 
        $valid_captcha = json_decode($result)->success;
    }
    catch (Exception $e) {
        $valid_captcha = false;
    }

    if (!$valid_captcha) {
        http_response_code(400);
        echo "Invalid captcha";
        exit(0);
    }

    // Store the estimate in the database
    /*$database_key = file_get_contents('/api-keys/database.key');
    $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
    $valid_database = false;

    if(!mysqli_connect_errno()){
        $valid_database = true;

        $sql = "INSERT IGNORE INTO estimates (full_name, email_address, message, message_date) VALUES ( ? , ? , ? ,'" . date("Y-m-d H:i:s") . "');";

        if($stmt = $mysqli_con->prepare($sql)){
            $stmt->bind_param('sss', $name, $email, $message);
            $stmt->execute();
            $stmt->store_result();
            $stmt->close();
        } else {
            $valid_database = false;
        }
    }
    $mysqli_con->close();

    if( !$valid_database ){
        http_response_code(500);
        echo("Invalid database");
        exit(0);
    }*/

    // Format email to be sent
    $message  = "First Name: " . $firstName . "\n";
    $message .= "Last Name: " . $lastName  . "\n";
    $message .= "Email: " . $email     . "\n";
    $message .= "Phone: " . $phone  . "\n\n";

    $message .= $address  . "\n";
    $message .= $city . ", " . $state . " " . $zipCode . "\n\n";

    $message .= "Services: \n";  
      
    foreach ($services as &$service) {
        if( $service === "Other" ){
            $message .= "    " . $service . ": " . $other . "\n";
        } else {
            $message .= "    " . $service . "\n";
        }
    }

    $message .= "\nStart Date : " . $startDate  . "\n";
    $message .= "Time of Day: " . $time  . "\n";

    if ($comments != null && !empty($comments)) {
        $message .= "Comments   : " . $comments  . "\n";
    }

    // Send the estimate request to email
    mail("sidwil0790@students.ecpi.edu", 
        "Estimate Request - " . $firstName . " " . $lastName, 
        $message, 
        'From: contact@replaceits.me' . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-Type: text/plain; charset=utf-8' . "\r\n" .
            'X-Priority: 1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n"
    );

    echo $message;

    http_response_code(200);
    echo "Success!";
    exit(0);
?>