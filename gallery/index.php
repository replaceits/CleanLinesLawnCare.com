<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="We are a full service Lawn care and Landscape company located in Scottsville serving all surrounding counties since 2013.">
		<meta name="subject" content="Lawn Care">
		<meta name="author" content="Clean Lines Lawn Care">
		<meta name="url" content="https://www.cleanlineslawncare.com/">
        <meta name="rating" content="General">
        <meta name="format-detection" content="telephone=no">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="Clean Lines Lawn Care">
		<meta property="og:description" content="We are a full service Lawn care and Landscape company located in Scottsville serving all surrounding counties since 2013.">
		<meta property="og:locale" content="en_US">
		<meta property="og:type" content="website">
		<meta property="og:url" content="https://www.cleanlineslawncare.com/">
		<meta property="og:image" content="https://www.cleanlineslawncare.com/images/logo-small.png">
		<meta property="og:image:type" content="image/png">
		<meta property="og:image:height" content="225">
		<meta property="og:image:width" content="225">

		<meta name="twitter:card" content="summary">
		<meta name="twitter:title" content="Clean Lines Lawn Care">
		<meta name="twitter:description" content="We are a full service Lawn care and Landscape company located in Scottsville serving all surrounding counties since 2013.">
		<meta name="twitter:image" content="https://www.cleanlineslawncare.com/images/logo-small.png">
		<meta name="twitter:image:alt" content="Clean Lines Lawn Care">

        <base href="https://replaceits.com/CleanLinesLawnCare.com/build/CleanLinesLawnCare.com/">

        <title>Clean Lines Lawn Care</title>

        <link rel="stylesheet" href="css/CleanLinesLawnCare.com.css">

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="manifest.json">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#169113">
        <meta name="theme-color" content="#ffffff">

        <script defer type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script defer type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>

    <body>
        <!-- Header bar -->
        <nav class="navbar navbar-default navbar-fixed-top shadow-bottom">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Clean Lines Lawn Care</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="">Home</a></li>
                        <li><a href="reviews">Reviews</a></li>
                        <li class="active"><a href="gallery">Gallery <span class="sr-only">(current)</span></a></li>
                        <li><a href="contact">Contact Us</a></li>
                        <li><a href="estimate">Free Estimate</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="services">All Services</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="services#NewInstallation">New Installation</a></li>
                            <li><a href="services#SeeingFertilizing">Seeding &amp; Fertilizing</a></li>
                            <li><a href="services#LawnAeration">Lawn Aeration</a></li>
                            <li><a href="services#Mowing">Mowing</a></li>
                            <li><a href="services#Mulching">Mulching</a></li>
                            <li><a href="services#GutterCleaning">Gutter Cleaning</a></li>
                            <li><a href="services#LeafRemoval">Leaf Removal</a></li>
                            <li><a href="services#ShrubberyCare">Shrubbery Care</a></li>
                            <li><a href="services#Pruning">Pruning</a></li>
                            <li><a href="services#WeedControl">Weed Control</a></li>
                            <li><a href="services#CompleteLawnService">Complete Lawn Service</a></li>
                            <li><a href="services#SnowRemoval">Snow Removal</a></li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End header bar -->
        
        <!-- Logo display -->
        <div class="parallax shadow-in-bottom" id="parallax-grass">
            <div class="logo"></div>
        </div>
        <!-- End logo -->

        <main class="container">
            <div class="row">
                <!-- Side bar for tablets and computers -->
                <aside class="col-md-2 sidebar hidden-xs computer-sidebar">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;<a href="https://www.facebook.com/Clean-Lines-Lawn-Care-412959632223355/" target="_blank">Facebook</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spacer"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>&nbsp;(434) 981-9705
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spacer"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="hoursOpen" class="col-md-12">
                            <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;7:30AM - 6:00PM
                        </div>
                        <script type="text/javascript">
                            var hoursOpen = document.getElementById('hoursOpen');
                            var time = new Date();
                            if(time.getHours() >= 7 && time.getMinutes() >= 30 && time.getHours() < 18){
                                hoursOpen.className += " hours-open";
                            } else {
                                hoursOpen.className += " hours-closed";
                            }
                        </script>
                    </div>
                </aside>
                <!-- End side bar -->

                <!-- Main content of the page -->
                <section class="col-md-10 col-xs-12 col-xs-offset-0 col-md-offset-0 main-content" style="margin-right: -10px;">
                    <section class="row">
                        <header class="col-md-12 text-center">
                            <h3>Gallery</h3>
                        </header>
                    </section>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="spacer"></div>
                            <div class="spacer"></div>
                            <hr>
                            <div class="spacer"></div>
                            <div class="spacer"></div>
                        </div>
                    </div>

                    <section>
                        <div class="row">
                        <?php
                            $database_key = file_get_contents('/api-keys/database.key');
                            $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
                            if(!mysqli_connect_errno()){
                                $sql = "SELECT gallery_picture_location FROM gallery_pictures ORDER BY gallery_picture_order";
                                if($stmt = $mysqli_con->prepare($sql)){
                                    $stmt->execute();
                                    $stmt->store_result();
                                    $stmt->bind_result($gallery_picture_location);

                                    while( $stmt->fetch()){
                        ?>
                                        <div class="col-md-3 col-sm-4 col-xs-6">
                                            <div class="thumbnail" style="max-height: 154px;overflow: hidden;">
                                                <div class="gallery-image" imageLocation="gallery/<?php echo(htmlspecialchars($gallery_picture_location)); ?>" style="background: url('gallery/<?php echo(htmlspecialchars($gallery_picture_location)); ?>') no-repeat center;min-height: 144px; max-height: 144px; overflow: hidden; background-size: cover;">
                                                </div>
                                            </div>
                                        </div>
                        <?php
                                    }
                                    $stmt->close();
                                }
                            }
                        ?>
                        </div>
                    </section>
                </section>
                <!-- End main content -->

                <div id="imageModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document" style="min-width:0px;width:auto;display: table;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img id="modal-image" src="" class="img-responsive" style="margin: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <!-- Side bar on mobile goes to the bottom of the page -->
                <aside class="col-md-2 col-xs-12 sidebar visible-xs-block">
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>&nbsp;<a href="https://www.facebook.com/Clean-Lines-Lawn-Care-412959632223355/" target="_blank">Facebook</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spacer"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>&nbsp;(434) 981-9705
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spacer"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="hoursOpenSecond" class="col-md-12 text-center">
                            <span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;7:30AM - 6:00PM
                        </div>
                        <script type="text/javascript">
                            hoursOpen = document.getElementById('hoursOpenSecond');
                            time = new Date();
                            if(time.getHours() >= 7 && time.getMinutes() >= 30 && time.getHours() < 18){
                                hoursOpen.className += " hours-open";
                            } else {
                                hoursOpen.className += " hours-closed";
                            }
                        </script>
                    </div>
                </aside>
                <!-- End side bar -->
            </div>
        </main>

        <!-- Footer -->
        <footer class="container-fluid footer">
            <div class="footer-item footer-item-left">
                © 2017 Clean Lines Lawn Care
            </div>
            <div class="footer-item footer-item-right">
                Site by <a href="https://www.replaceits.me">Sidney Williams</a>
            </div>
        </footer>
        <!-- End footer -->
        <script type="text/javascript">
            window.addEventListener('DOMContentLoaded', function() {
                $('.main-content .gallery-image').click(function(){
                    $('#modal-image').attr('src',$(this).attr('imageLocation'));
                    $('#imageModal').modal('show');
                }).css('cursor', 'pointer');
            });
        </script>
    </body>
</html>
