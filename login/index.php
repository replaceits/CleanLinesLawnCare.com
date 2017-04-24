<?php
    session_start();

    if(isset($_SESSION['email']) && !empty($_SESSION['email'])){
        header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/admin/");
        exit(0);
    }

    $logging_in = false;
    $valid_login = false;

    if(isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['email']) && !empty($_POST['email'])){
        $logging_in = true;
        $valid_database = false;
        $database_key = file_get_contents('/api-keys/database.key');

        $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");

        if(!mysqli_connect_errno()){
            $valid_database = true;

            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT user_password_hash FROM users WHERE user_email = ?;";

            if($stmt = $mysqli_con->prepare($sql)){
                $stmt->bind_param('s',$email);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($password_hash);
                
                if($stmt->num_rows == 1){
                    $stmt->fetch();
                    if(password_verify($password,$password_hash)){
                        $valid_login = true;
                        $_SESSION['email'] = $email;
                    }
                }
                $stmt->close();
            } else {
                $valid_database = false;
            }
        } else {
            $valid_database = false;
        }
        $mysqli_con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <base href="https://www.cleanlineslawncare.com/">

        <title>Clean Lines Lawn Care - Login</title>

        <link rel="stylesheet" href="css/CleanLinesLawnCare.com.css?v=1">

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png?v=1">
        <link rel="icon" type="image/png" href="favicon-32x32.png?v=12" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png?v=12" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg?v=1" color="#169113">
        <meta name="theme-color" content="#ffffff">

        <script defer type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script defer type="text/javascript" src="js/bootstrap.min.js"></script>
        <script async defer src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body style="background-image: url(images/covergrass.jpeg);background-size: cover;background-color: #57975e;">
        <main class="container">
            <div class="panel panel-default" id="Login">
                <header class="panel-heading">
                    <h3 class="panel-title">
                        <?php
                            if($logging_in){
                                if($valid_login){
                                    echo("You have logged in!");
                                } else {
                                    echo("Invalid email and/or password!");
                                }
                            } else {
                                echo("Log in");
                            }
                        ?>
                    </h3>
                </header>
                <section class="panel-body">
                    <?php
                        if(!$logging_in){
                    ?>
                            <form class="form form-login" id="form-login" action="login/" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
</span>
                                            <input class="form-control" id="input-email" name="email" type="text" placeholder="Email" aria-describedby="sizing-addon2">
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
</span>
                                            <input class="form-control" id="input-password" name="password" type="password" placeholder="Password" aria-describedby="sizing-addon3">
                                        </div>
                                        <br>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <input class="btn btn-primary button button-submit" id="button-submit" type="submit" value="Submit">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <div id='recaptcha' class="g-recaptcha" data-sitekey="6Le-hxgUAAAAAGu_SqKn29-j4SCIivLanTOLR-tZ" data-callback="captchaSubmit" data-size="invisible"></div>
                                    </div>
                                </div>
                            </form>
                    <?php
                        } else {
                    ?>
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <p>
                                        You will be automatically redirected in <span id="redirect-counter" class="counter">10</span> seconds.
                                        <br>
                                        Please <a href="<?php echo(dirname($_SERVER['REQUEST_URI']) . ($valid_login ? "/admin/" : "/login/") );?>">click here</a> if you are not automatically redirected.
                                        <script type="text/javascript">function timer(){if(count-=1,document.getElementById("redirect-counter").innerHTML=count,count<=0)return clearInterval(counter),void(window.location=document.URL.substr(0,document.URL.lastIndexOf("/")) + "<?php echo(($valid_login ? "/admin/" : "/login/")); ?>" )}var count=10,counter=setInterval(timer,1e3);</script>
                                    </p>
                                </div>
                            </div>
                    <?php
                        }
                    ?>
                </section>
            </div>
        </main>
    </body>
</html>
