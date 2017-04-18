<?php
    session_start();

    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/");
        exit(0);
    }
    $database_key = file_get_contents('/api-keys/database.key');
    $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
    $images = glob(__DIR__ . "/../gallery/*.{jpg,jpeg,gif,png}", GLOB_BRACE);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <base href="https://replaceits.com/CleanLinesLawnCare.com/build/CleanLinesLawnCare.com/">

        <title>Clean Lines Lawn Care - Admin</title>

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
            <section class="row admin-section admin-panel">
                <div class="col-xs-12">
                    <div class="row">
                        <header class="col-xs-12 text-center">
                            <h3>Welcome <?php echo(strtok($_SESSION['email'],"@")); ?></h3>
                        </header>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="spacer"></div>
                        </div>
                    </div>

                    <div class="row">
                        <section class="col-md-6 col-sm-6 col-xs-12">
                            <div class="row">
                                <header class="col-xs-12 text-center">
                                    <h3>Gallery</h3>
                                </header>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-xs-12 text-center" style="margin-bottom: 10px;">
                                    <button class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>&nbsp;Upload</button>
                                    <input name="upload" type="file" id="fileinput">
                                </div>
                                <div class="col-md-6 col-xs-12 text-center" style="margin-bottom: 10px;">
                                    <button class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;Modify</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <ul class="list-group" style="max-width: 75%;margin:auto;">
                                        <li class="list-group-item">
                                            <span class="badge"><?php echo(count($images)); ?></span>
                                            Total Pictures
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <div class="row hidden-md hidden-sm hidden-lg hidden-xl">
                            <div class="hidden-lg hidden-xl hidden-md hidden-sm col-xs-12">
                                <hr>
                                <div class="spacer"></div>
                            </div>
                        </div>

                        <section class="col-md-6 col-sm-6 col-xs-12" style="border-left: 1px solid #eee">
                            <div class="row">
                                <header class="col-xs-12 text-center">
                                    <h3>Reviews</h3>
                                </header>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-xs-12 text-center" style="margin-bottom: 10px;">
                                    <button class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Add Review</button>
                                </div>
                                <div class="col-md-6 col-xs-12 text-center" style="margin-bottom: 10px;">
                                    <button class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;Modify</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <ul class="list-group" style="max-width: 75%;margin:auto;">
                                        <li class="list-group-item">
                                            <span class="badge"><?php
                                                if(!mysqli_connect_errno()){
                                                    $sql = "SELECT COUNT(*) FROM reviews";
                                            
                                                    if($stmt = $mysqli_con->prepare($sql)){
                                                        $stmt->execute();
                                                        $stmt->store_result();
                                                        $stmt->bind_result($review_count);

                                                        if($stmt->num_rows === 1){
                                                            while( $stmt->fetch()){
                                                                echo($review_count);
                                                            }
                                                        }
                                                        $stmt->close();
                                                    }
                                                }
                                            ?></span>
                                            Total Reviews
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge"><?php
                                                if(!mysqli_connect_errno()){
                                                    $sql = "SELECT review_date FROM reviews ORDER BY review_date DESC LIMIT 1";
                                                    if($stmt = $mysqli_con->prepare($sql)){
                                                        $stmt->execute();
                                                        $stmt->store_result();
                                                        $stmt->bind_result($review_date);

                                                        if($stmt->num_rows === 1){
                                                            while( $stmt->fetch()){
                                                                echo($review_date);
                                                            }
                                                        }
                                                        $stmt->close();
                                                    }
                                                }
                                            ?></span>
                                            Last Review
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge"><?php
                                                if(!mysqli_connect_errno()){
                                                    $sql = "SELECT AVG(review_rating) FROM reviews";
                                                    if($stmt = $mysqli_con->prepare($sql)){
                                                        $stmt->execute();
                                                        $stmt->store_result();
                                                        $stmt->bind_result($review_rating_avg);

                                                        if($stmt->num_rows === 1){
                                                            while( $stmt->fetch()){
                                                                echo(number_format($review_rating_avg,1));
                                                            }
                                                        }
                                                        $stmt->close();
                                                    }
                                                }
                                            ?>/5.0</span>
                                            Average Rating
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <a href="logout" class="btn btn-default"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Logout</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="row gallery-section admin-panel hidden">
                <div class="col-xs-12">

                </div>
            </section>

            <section class="row review-section admin-panel hidden">
                <div class="col-xs-12">

                </div>
            </section>
        </main>
    </body>
</html>
<?php
    $mysqli_con->close();
?>
