<?php
    if( !isset($_POST['FirstName']) || !isset($_POST['LastName']) || !isset($_POST['Email'])                || 
        !isset($_POST['Phone'])     || !isset($_POST['Message'])  || !isset($_POST['g-recaptcha-response']) ||
         empty($_POST['FirstName']) ||  empty($_POST['LastName']) ||  empty($_POST['Email'])                ||  
         empty($_POST['Phone'])     ||  empty($_POST['Message'])  ||  empty($_POST['g-recaptcha-response'])){
        
        http_response_code(400);
        echo("Invalid request");
        exit(0);
    }

    $firstName = trim(stripslashes(htmlspecialchars($_POST['FirstName'])));
    $lastName  = trim(stripslashes(htmlspecialchars($_POST['LastName' ])));
    $email     = trim(stripslashes(htmlspecialchars($_POST['Email'    ])));
    $phone     = trim(stripslashes(htmlspecialchars($_POST['Phone'    ])));
    $message   = trim(stripslashes(htmlspecialchars($_POST['Message'  ])));

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
        echo("Invalid captcha");
        exit(0);
    }

    $message  = "First Name: " . $firstName . "\n";
    $message .= "Last Name: "  . $lastName  . "\n";
    $message .= "Email: "      . $email     . "\n";
    $message .= "Phone: "      . $phone     . "\n\n";
    $message .= "Message: "    . $message   . "\n";

    // Send the estimate request to email
    mail("sidwil0790@students.ecpi.edu", 
        "Contact Form - " . $firstName . " " . $lastName, 
        $message, 
        'From: contact@cleanlineslawncare.com' . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-Type: text/plain; charset=utf-8' . "\r\n" .
            'X-Priority: 1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion() . "\r\n"
    );

    http_response_code(200);
    echo("Success!");
    exit(0);
?> 