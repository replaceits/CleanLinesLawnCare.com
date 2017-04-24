<?php
    session_start();

    $isAdmin = false;

    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        if( !isset($_POST['Name']) || !isset($_POST['Rating']) || !isset($_POST['Review']) || !isset($_POST['g-recaptcha-response'])  ||
             empty($_POST['Name']) ||  empty($_POST['Rating']) ||  empty($_POST['Review']) ||  empty($_POST['g-recaptcha-response'])  ||
            !is_numeric($_POST['Rating']) || floor(intval($_POST['Review'])) < 0 || floor(intval($_POST['Review'])) > 5 || strlen($_POST['Review']) > 5000 || strlen($_POST['Name']) > 255 ){

            http_response_code(400);
            echo("Invalid request");
            exit(0);
        }
    } else {
        $isAdmin = true;
        if( !isset($_POST['Name']) || !isset($_POST['Rating']) || !isset($_POST['Review']) ||
             empty($_POST['Name']) ||  empty($_POST['Rating']) ||  empty($_POST['Review']) ||
            !is_numeric($_POST['Rating'])        || floor(intval($_POST['Review'])) < 0 || 
             floor(intval($_POST['Review'])) > 5 || strlen($_POST['Review']) > 5000     || strlen($_POST['Name']) > 255 ){

            http_response_code(400);
            echo("Invalid request");
            exit(0);
        }
    }

    $Name   = trim( $_POST['Name'  ]);
    $Rating = floor($_POST['Rating']);
    $Review = trim( $_POST['Review']);

    if(!$isAdmin){
        $api_key = file_get_contents('/api-keys/invisiblerecaptcha.key');

        // Verify Captcha
        try {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $data = [ 
                'secret'   => $api_key,
                'response' => $_POST['g-recaptcha-response'],
                'remoteip' => $_SERVER['REMOTE_ADDR']
            ];

            $options = [
                'http' => [
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data) 
                ]
            ];

            $context = stream_context_create($options);
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
    }

    function contains($str, array $arr)
    {
        foreach($arr as $a) {
            if (stripos(strtolower($str),$a) !== false) {
                return true;
            }
        }
        return false;
    }

    $CensoredWords = array(
        "abortion",
        "ahole",
        "anal",
        "analplug",
        "analsex",
        "anus",
        "arse",
        "ash0le",
        "ash0les",
        "asholes",
        "ass",
        "assface",
        "assh0le",
        "assh0lez",
        "asshole",
        "asshole", 
        "assholes",
        "assholz",
        "assopedia",
        "asswipe",
        "azzhole",
        "bassterds",
        "bastard",
        "bastard", 
        "bastards",
        "bastardz",
        "basterds",
        "basterdz",
        "beastiality",
        "bestiality",
        "bewb",
        "biatch",
        "bimbo",
        "bitch",
        "bitch",  
        "bitch's",
        "bitches",
        "bitchs",
        "bloodyhell",
        "blow job",
        "blow jobs",
        "blow",
        "blowjob",
        "blumpkin",
        "bollocks",
        "boner",
        "boob",
        "boobies",
        "boobs",
        "bukkake",
        "bullshit",
        "butt-pirate",
        "butthole",
        "butthole", 
        "buttwipe",
        "c0ck",
        "c0cks",
        "c0k",
        "carpet muncher",
        "cawk",
        "cawks",
        "cheat", 
        "chink",
        "choad",
        "clit",
        "clit", 
        "clitoris",
        "cock gobbler",
        "cock",
        "cock", 
        "cock-head",
        "cock-sucker",
        "cockhead",
        "cocks",
        "cocksucker",
        "condom",
        "coon",
        "cooter",
        "cornhole",
        "crap",
        "cum dumpster",
        "cum",
        "cum", 
        "cumshot",
        "cunt",
        "cunt", 
        "cunts",
        "cuntz",
        "damm",
        "dammit",
        "damn",
        "dick head",
        "dick heads",
        "dick hole",
        "dick",
        "dick", 
        "dickhead",
        "dickheads",
        "dickhole",
        "dild0",
        "dild0s",
        "dildo",
        "dildos",
        "dilld0",
        "dilld0s",
        "dishonest", 
        "doggystyle",
        "dong",
        "douche",
        "dyke",
        "f u c k e r",
        "f u c k i n g",
        "f u c k",
        "f0ck",
        "fag",
        "fag1t",
        "faget",
        "fagg1t",
        "faggit",
        "faggot",
        "faggot", 
        "faggots",
        "fagit",
        "fags",
        "fagz",
        "faig",
        "faigs",
        "fart",
        "fat-ass",
        "fatass",
        "fck",
        "fcker",
        "fckr",
        "fcku",
        "fcuk",
        "foreskin",
        "fuck",
        "fuck", 
        "fucker",
        "fuckers",
        "fuckface",
        "fuckin",
        "fucking",
        "fuckr",
        "fucks",
        "fuct",
        "fudge packer",
        "fuk",
        "fukah",
        "fuken",
        "fuker",
        "fukin",
        "fukk",
        "fukker",
        "fukkin",
        "gangbang",
        "gay", 
        "genital",
        "genitalia",
        "genitals",
        "glory hole",
        "gloryhole",
        "gobshite",
        "god damn",
        "god damned",
        "god damnit",
        "godammet",
        "godammit",
        "goddammet",
        "goddammit",
        "goddamn",
        "gook",
        "gurgle monster",
        "gypo",
        "handjob",
        "hideous", 
        "hitler",
        "homo",
        "honkey",
        "hooker",
        "hore",
        "horny",
        "humping",
        "idiot", 
        "jackoff",
        "jerk-off",
        "jiz",
        "jizm",
        "jizz",
        "jizzum",
        "kaffir",
        "kike",
        "kill",
        "killer",
        "killin",
        "killing",
        "kunt",
        "labia",
        "lesbionic",
        "lesbo",
        "lick", 
        "masturbate",
        "milf",
        "molest",
        "moron",
        "motherfuck",
        "motherfucker",
        "mthrfckr",
        "muff",
        "nazi",
        "negro",
        "nigga",
        "niggah",
        "nigger",
        "nigger", 
        "niggers",
        "nonce",
        "nutsack",
        "nuttsack",
        "paedo",
        "paedophile",
        "paki",
        "pedo",
        "pedofile",
        "pedophile",
        "pen1s",
        "penis",
        "penis", 
        "phuk",
        "piss",
        "poon",
        "poop",
        "poop", 
        "porn",
        "prick",
        "prostitute",
        "punani",
        "pussy",
        "pussy", 
        "queef",
        "queer",
        "quim",
        "rape",
        "raped",
        "rapes",
        "rapist",
        "rectal",
        "rectum",
        "retard", 
        "rimjob",
        "schlong",
        "scrotum",
        "semen",
        "sex",
        "sex", 
        "shag",
        "shit",
        "shite",
        "shits",
        "shittiest",
        "shitty",
        "shiz",
        "slag",
        "slut",
        "slut", 
        "sluts",
        "slutty",
        "slutz",
        "spaz",
        "sperm",
        "spick",
        "spoo",
        "spooge",
        "spunk",
        "stripper",
        "stupid",
        "taint",
        "terrorist",
        "testicle",
        "tits",
        "titties",
        "titty",
        "tittyfuck",
        "twat",
        "vag",
        "vagina",
        "vagina", 
        "vaginal",
        "vibrator",
        "vulva",
        "wank",
        "wanker",
        "wetback",
        "whor",
        "whore",
        "wog",
        "wtf",
        "xxx"
    );

    if($isAdmin || !contains($Review, $CensoredWords) && !contains($Name, $CensoredWords)){
        // Store the review in the database
        $database_key = file_get_contents('/api-keys/database.key');
        $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
        $valid_database = false;

        if(!mysqli_connect_errno()){
            $valid_database = true;

            $sql = "INSERT IGNORE INTO reviews (review_name, review_rating, review_content, review_date, review_ip) VALUES ( ? , ? , ? ,'" . date("Y-m-d H:i:s") . "', ?);";

            if($stmt = $mysqli_con->prepare($sql)){
                $review_ip = ip2long($_SERVER['REMOTE_ADDR']);
                $stmt->bind_param('sisi', $Name, $Rating, $Review, $review_ip);
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
        }

        if(!$isAdmin){
            $message  = "Name: "   . $Name   . "\n";
            $message .= "Rating: " . $Rating . "\n";
            $message .= "Review: " . $Review . "\n";

            // Send the review to email
            mail("sidwil0790@students.ecpi.edu", 
                "New Review - " . $Name, 
                $message, 
                'From: contact@cleanlineslawncare.com' . "\r\n" .
                    "Reply-To: donotreply@cleanlineslawncare.com\r\n" .
                    'MIME-Version: 1.0' . "\r\n" .
                    'Content-Type: text/plain; charset=utf-8' . "\r\n" .
                    'X-Priority: 1' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion() . "\r\n"
            );
        }
    }

    http_response_code(200);
    echo("Success!");
    exit(0);
?>
