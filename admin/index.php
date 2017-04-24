<?php
    session_start();

    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header('Location: ' . dirname($_SERVER['REQUEST_URI']) . "/login/");
        exit(0);
    }
    $database_key = file_get_contents('/api-keys/database.key');
    $mysqli_con = new mysqli("localhost","http",$database_key,"cleanlineslawncare");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <base href="https://www.cleanlineslawncare.com/">

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
                                    <button id="gallery-upload" class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span>&nbsp;Upload</button>
                                </div>
                                <div class="col-md-6 col-xs-12 text-center" style="margin-bottom: 10px;">
                                    <button id="gallery-modify" class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;Modify</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <ul class="list-group" style="max-width: 75%;margin:auto;">
                                        <li class="list-group-item">
                                            <span class="badge"><?php 
                                                if(!mysqli_connect_errno()){
                                                    $sql = "SELECT COUNT(*) FROM gallery_pictures";
                                            
                                                    if($stmt = $mysqli_con->prepare($sql)){
                                                        $stmt->execute();
                                                        $stmt->store_result();
                                                        $stmt->bind_result($gallery_count);

                                                        if($stmt->num_rows === 1){
                                                            while( $stmt->fetch()){
                                                                echo($gallery_count);
                                                            }
                                                        }
                                                        $stmt->close();
                                                    }
                                                }
                                            ?></span>
                                            Total Pictures
                                        </li>
                                        <li class="list-group-item">
                                            <span class="badge"><?php
                                                if(!mysqli_connect_errno()){
                                                    $sql = "SELECT gallery_picture_date FROM gallery_pictures ORDER BY gallery_picture_date DESC LIMIT 1";
                                                    if($stmt = $mysqli_con->prepare($sql)){
                                                        $stmt->execute();
                                                        $stmt->store_result();
                                                        $stmt->bind_result($gallery_picture_date);

                                                        if($stmt->num_rows === 1){
                                                            while( $stmt->fetch()){
                                                                echo($gallery_picture_date);
                                                            }
                                                        }
                                                        $stmt->close();
                                                    }
                                                }
                                            ?></span>
                                            Last Upload
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
                                    <button id="review-add" class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Add Review</button>
                                </div>
                                <div class="col-md-6 col-xs-12 text-center" style="margin-bottom: 10px;">
                                    <button id="review-modify" class="btn btn-default" style="min-width: 75%;"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>&nbsp;Modify</button>
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

            <!-- Modals -->
            <form id="upload-form">
                <input id="gallerypicture" name="gallerypicture" type="file" id="fileinput" accept="image/*" style="width: 0px;height: 0px;overflow: hidden;">
                <div id="uploadModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document" style="min-width:0px;width:auto;display: table;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"></h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img id="modal-image" class="img-responsive" style="margin: auto;">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success submit-button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form id="modify-gallery-form">
                <div id="modifyGalleryModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Gallery</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                        <?php
                                    if(!mysqli_connect_errno()){
                                        $sql = "SELECT gallery_picture_id, gallery_picture_order, gallery_picture_location FROM gallery_pictures ORDER BY gallery_picture_order";
                                        if($stmt = $mysqli_con->prepare($sql)){
                                            $stmt->execute();
                                            $stmt->store_result();
                                            $stmt->bind_result($gallery_picture_id, $gallery_picture_order, $gallery_picture_location);

                                            while( $stmt->fetch()){
                        ?>
                                                <div class="col-md-3 col-sm-4 col-xs-6 gallery-picture-column">
                                                    <div class="thumbnail" style="overflow: hidden;">
                                                        <div class="gallery-image" imageLocation="gallery/<?php echo(htmlspecialchars($gallery_picture_location)); ?>" style="background: url('gallery/<?php echo(htmlspecialchars($gallery_picture_location)); ?>') no-repeat center;min-height: 144px; max-height: 144px; overflow: hidden; background-size: cover;">
                                                        </div>
                                                        <div class="caption">
                                                            <input class="input-order"  type="hidden" name="order_<?php echo($gallery_picture_id); ?>" value="<?php echo($gallery_picture_order); ?>">
                                                            <input class="input-delete" type="hidden" name="delete_<?php echo($gallery_picture_id); ?>" value="0">

                                                            <div class="btn-group btn-group-justified" role="group" aria-label="Modify options">
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-default move-left"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
</button>
                                                                </div>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-default delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
</button>
                                                                </div>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-default move-right"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
</button>
                                                                </div>
                                                            </div>
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
                            </div>
                            <div class="modal-footer">
                                <button id="gallery-cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success submit-button">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form id="review-form">
                <div id="reviewModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Add Review</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="LastName">Name</label>
                                                    <input maxlength="255" type="text" class="form-control" id="Name" name="Name" placeholder="Name" required>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="Rating">Rating</label>
                                                    <input value="0" type="hidden" class="form-control" id="Rating" name="Rating" required>
                                                    <div class="row">
                                                        <div class="col-xs-12 text-center" style="font-size: 2.5rem;">
                                                            <span class="glyphicon glyphicon-star-empty star-rating" aria-hidden="true"></span>
                                                            <span class="glyphicon glyphicon-star-empty star-rating" aria-hidden="true"></span>
                                                            <span class="glyphicon glyphicon-star-empty star-rating" aria-hidden="true"></span>
                                                            <span class="glyphicon glyphicon-star-empty star-rating" aria-hidden="true"></span>
                                                            <span class="glyphicon glyphicon-star-empty star-rating" aria-hidden="true"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group">
                                                    <label for="Review">Write your review</label>
                                                    <textarea id="Review" name="Review" class="form-control" rows="6" placeholder="Write your review" maxlength="5000"></textarea>
                                                </div>
                                                <div class="text-right">
                                                    <span id="textareaLen">0</span>/5000
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success submit-button">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form id="modify-review-form">
                <div id="modifyReviewModal" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Reviews</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php
                        if(!mysqli_connect_errno()){
                            $sql = "SELECT review_id, review_rating, review_name, review_content, review_date, review_ip FROM reviews ORDER BY review_id DESC";
                                        
                            if($stmt = $mysqli_con->prepare($sql)){
                                $stmt->execute();
                                $stmt->store_result();
                                $stmt->bind_result($review_id, $review_rating, $review_name, $review_content, $review_date, $review_ip);
                                $firstPass = true;

                                if($stmt->num_rows > 0){
                                    while( $stmt->fetch()){
                                        if($firstPass){
                                            $firstPass = false;
                                        } else {
                    ?>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <hr>
                                                    <div class="spacer"></div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                        <section class="row col-xs-12 review-row">
                                            <div class="col-xs-12">
                                                <blockquote>
                                                    <p style="word-wrap: break-word;overflow:hidden;">
                                                        <?php
                                                            //Remove redundant new lines
                                                            $review_content = str_replace("\r\n","<br>",htmlspecialchars($review_content));
                                                            $review_content = str_replace("\n\r","<br>",$review_content);
                                                            $review_content = str_replace("\r",  "<br>",$review_content);
                                                            $review_content = str_replace("\n",  "<br>",$review_content);

                                                            while(strpos($review_content, "<br><br><br>") !== false){
                                                                $review_content = str_replace("<br><br><br>","<br><br>",$review_content);
                                                            }

                                                            echo($review_content);
                                                        ?>
                                                    </p>
                                                    <footer>
                                                        <em>
                                                            <?php
                                                                echo(htmlspecialchars($review_name));
                                                            ?>
                                                            &nbsp;&nbsp;&nbsp;
                                                        </em>
                                                        <?php
                                                            for($i = 0; $i < $review_rating; $i++){
                                                        ?>
                                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                                        <?php
                                                            }
                                                            for($i = 0; $i < 5 - $review_rating; $i++){
                                                        ?>
                                                                <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                                                        <?php
                                                            }
                                                        ?>
                                                    </footer>
                                                </blockquote>
                                            </div>
                                            <div class="col-xs-9 text-left">
                                                <em>Posted: <?php echo($review_date); ?> From: <?php echo(long2ip($review_ip)); ?></em>
                                            </div>
                                            <div class="col-xs-3 text-right">
                                                <input class="input-delete" type="hidden" name="delete_<?php echo($review_id); ?>" value="0">
                                                <button type="button" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;Delete</button>
                                            </div>
                                        </section>
                    <?php
                                    }
                                }
                                $stmt->close();
                            }
                        }
                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="review-cancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success submit-button">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div id="backup-gallery" class="hidden"></div>
            <div id="backup-reviews" class="hidden"></div>

        </main>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                $('#reviewModal .alert').hide();
                $('#uploadModal .alert').hide();
                $('#modifyGalleryModal .alert').hide();
                $('#modifyReviewModal .alert').hide();

                $('.alert').on('close.bs.alert',function(){
                    $(this).clone(true,false).appendTo($(this).parent());
                    $(this).parent().find('.alert').hide();
                });

                $('#review-modify').click(function(){
                    $('#modifyGalleryModal .alert').hide();
                    $('#reviewModal').modal('hide');
                    $('#uploadModal').modal('hide');
                    $('#modifyGalleryModal').modal('hide');
                    $('#modifyReviewModal').modal('show');
                });

                $('#review-cancel').click(function(){
                    $('#modifyReviewModal .modal-body').remove();
                    $('#backup-reviews').clone(true,true).children().insertAfter('#modifyReviewModal .modal-header');
                });

                $('#modifyReviewModal .submit-button').click(function(){
                    $.ajax({
                        method: 'POST',
                        url: 'modifyreview.php',
                        cache: false,
                        data: $('#modify-review-form').serialize()
                    }).done( function( msg ){
                        let dismissButton = $('#modifyReviewModal .alert').find('button');
                        $('#modifyReviewModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-success').text('Your changes have been saved!').append(dismissButton).show();
                        $('#modifyReviewModal').animate({ scrollTop: 0 }, 'slow');
                    }).fail( function( jqXHR, textStatus ){
                        let dismissButton = $('#modifyReviewModal .alert').find('button');
                        $('#modifyReviewModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger').text('We\'re sorry but something wen\'t wrong :( Please try again later.').append(dismissButton).show();
                        $('#modifyReviewModal').animate({ scrollTop: 0 }, 'slow');
                    });
                });

                $('#modifyReviewModal .review-row .delete').click(function(){
                    $(this).parent().find('.input-delete').val('1');
                    $(this).parent().parent().next('div.row').hide();
                    $(this).parent().parent().hide();
                });

                $('#gallery-modify').click(function(){
                    $('#modifyGalleryModal .alert').hide();
                    $('#reviewModal').modal('hide');
                    $('#uploadModal').modal('hide');
                    $('#modifyGalleryModal').modal('show');
                });

                $('#gallery-cancel').click(function(){
                    $('#modifyGalleryModal .modal-body').remove();
                    $('#modifyGalleryModal .gallery-picture-column').remove();
                    $('#backup-gallery').clone(true,true).children().insertAfter('#modifyGalleryModal .modal-header');
                });

                $('#modifyGalleryModal .gallery-picture-column .delete').click(function(){
                    $(this).parent().parent().parent().find('.input-order').val('0');
                    $(this).parent().parent().parent().find('.input-delete').val('1');
                    $(this).parent().parent().parent().parent().parent().nextAll().each(function(){
                        $(this).find('.input-order').val(
                            parseInt($(this).find('.input-order').val())-1
                        );
                    });
                    $(this).parent().parent().parent().parent().parent().parent().parent().before(
                        $(this).parent().parent().parent().parent().parent()
                    );
                    $(this).parent().parent().parent().parent().parent().hide();
                });

                $('#modifyGalleryModal .gallery-picture-column .move-left').click(function(){
                    if($(this).parent().parent().parent().find('.input-order').val() != '1'){
                        $(this).parent().parent().parent().find('.input-order').val(
                            parseInt($(this).parent().parent().parent().find('.input-order').val())-1
                        );
                        $(this).parent().parent().parent().parent().parent().prev().find('.input-order').val(
                            parseInt($(this).parent().parent().parent().parent().parent().prev().find('.input-order').val())+1
                        );
                    }
                    $(this).parent().parent().parent().parent().parent().prev().before(
                        $(this).parent().parent().parent().parent().parent()
                    );
                });

                $('#modifyGalleryModal .gallery-picture-column .move-right').click(function(){
                    if(!$(this).parent().parent().parent().parent().parent().is(':last-child')){
                        $(this).parent().parent().parent().find('.input-order').val(
                            parseInt($(this).parent().parent().parent().find('.input-order').val())+1
                        );
                        $(this).parent().parent().parent().parent().parent().next().find('.input-order').val(
                            parseInt($(this).parent().parent().parent().parent().parent().next().find('.input-order').val())-1
                        );
                    }
                    $(this).parent().parent().parent().parent().parent().next().after(
                        $(this).parent().parent().parent().parent().parent()
                    );
                });

                $('#modifyGalleryModal .submit-button').click(function(){
                    $.ajax({
                        method: 'POST',
                        url: 'modifygallery.php',
                        cache: false,
                        data: $('#modify-gallery-form').serialize()
                    }).done( function( msg ){
                        let dismissButton = $('#modifyGalleryModal .alert').find('button');
                        $('#modifyGalleryModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-success').text('Your changes have been saved!').append(dismissButton).show();
                    }).fail( function( jqXHR, textStatus ){
                        let dismissButton = $('#modifyGalleryModal .alert').find('button');
                        $('#modifyGalleryModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger').text('We\'re sorry but something wen\'t wrong :( Please try again later.').append(dismissButton).show();
                    });
                });

                $('#gallery-upload').click(function(){
                    $('#gallerypicture').focus().trigger('click');
                });

                $('#gallerypicture').change(function(){
                    $('#uploadModal .alert').hide();
                    $('#uploadModal .submit-button').show();
                    $('#uploadModal .modal-title').text($(this).val().split('\\').pop());

                    let reader = new FileReader();
                    reader.onload = function (e) {
                        $('#uploadModal #modal-image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);

                    $('#reviewModal').modal('hide');
                    $('#modifyGalleryModal').modal('hide');
                    $('#uploadModal').modal('show');
                });

                $('#review-add').click(function(){
                    $('#reviewModal .alert').hide();
                    $('#Name').val("").parent().removeClass('has-error').removeClass('has-success');
                    $('.star-rating').css('color','#333').removeClass('glyphicon-star-empty').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    $('#Rating').val(0);
                    $('textarea').val("").parent().removeClass('has-error').removeClass('has-success');

                    $('#uploadModal').modal('hide');
                    $('#modifyGalleryModal').modal('hide');
                    $('#reviewModal').modal('show'); 
                });

                $('#uploadModal .submit-button').click(function(){
                    let fd = new FormData();    
                    fd.append( 'gallerypicture', $('#gallerypicture').get(0).files[0] );

                    $.ajax({
                        method: 'POST',
                        url: 'galleryupload.php',
                        cache: false,
                        data: fd,
                        processData: false,
                        type: 'POST',
                        contentType: false

                    }).done( function( msg ){
                        $('#upload-form')[0].reset();
                        $('#uploadModal #modal-image').attr('src', '');
                        $('#uploadModal').modal('hide');
                    }).fail( function( jqXHR, textStatus ){
                        $('#upload-form')[0].reset();
                        $('#uploadModal #modal-image').attr('src', '');
                        let dismissButton = $('#uploadModal .alert').find('button');
                        $('#uploadModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger').text('Your image couldn\'t be uploaded :(').append(dismissButton).show();
                        $('#uploadModal .submit-button').hide();
                    });
                });

                $('#reviewModal .submit-button').click(function(){
                    $('#reviewModal .alert').hide();

                    let valid = true;
                    let invalidElement = null;

                    $('#Name').each( function(){
                        if( $(this).val().length <= 0 ){
                            valid = false;
                            if (invalidElement == null) {
                                invalidElement = $(this);
                                $(window).delay(1000).scrollTop($(this).offset().top - 80);
                            }
                            $(this).parent().removeClass('has-error').removeClass('has-success').addClass('has-error');
                        } else {
                            $(this).parent().removeClass('has-error').removeClass('has-success').addClass('has-success');
                        }
                    });
                    $('#Rating').each( function(){
                        if( $(this).val() == 0 ){
                            valid = false;
                            if (invalidElement == null) {
                                invalidElement = $(this);
                                $(window).delay(1000).scrollTop($('#Name').offset().top - 80);
                            }
                            $('.star-rating').css('color','#a94442');
                        } else {
                            $('.star-rating').css('color','#3c763d');
                        }
                    });
                    if($('textarea').val().length <= 0){
                        valid = false;
                        $('textarea').parent().removeClass('has-error').removeClass('has-success').addClass('has-error');
                    } else {
                        $('textarea').parent().removeClass('has-error').removeClass('has-success').addClass('has-success');
                    }

                    invalidElement = null;

                    if (valid) {
                        $.ajax({
                            method: 'POST',
                            url: 'review.php',
                            cache: false,
                            data: $('#review-form').serialize()
                        }).done( function( msg ){
                            $('#Name').val("").parent().removeClass('has-error').removeClass('has-success');
                            $('.star-rating').css('color','#333').removeClass('glyphicon-star-empty').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                            $('#Rating').val(0);
                            $('textarea').val("").parent().removeClass('has-error').removeClass('has-success');
                            let dismissButton = $('#reviewModal .alert').find('button');
                            $('#reviewModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-success').text('Your review has been left!').append(dismissButton).show();
                        }).fail( function( jqXHR, textStatus ){
                            let dismissButton = $('#reviewModal .alert').find('button');
                            $('#reviewModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger').text('We\'re sorry but something wen\'t wrong :( Please try again later.').append(dismissButton).show();
                        });
                    } else {
                        let dismissButton = $('#reviewModal .alert').find('button');
                        $('#reviewModal .alert').removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger').text('You must fill in all of the required fields.').append(dismissButton).show();
                    }
                });

                $('.star-rating').hover(function(){
                    if(!$(this).hasClass('star-checked')){
                        $(this).removeClass('glyphicon-star-empty').removeClass('glyphicon-star').addClass('glyphicon-star');
                    }
                    $(this).prevAll().each(function(){
                        if(!$(this).hasClass('star-checked')){
                            $(this).removeClass('glyphicon-star-empty').removeClass('glyphicon-star').addClass('glyphicon-star');
                        }
                    });
                    $(this).nextAll().removeClass('glyphicon-star-empty').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }, function(){
                    if(!$(this).hasClass('star-checked')){
                        $(this).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    }
                    $(this).prevAll().each(function(){
                        if(!$(this).hasClass('star-checked')){
                            $(this).removeClass('glyphicon-star').removeClass('glyphicon-star-empty').addClass('glyphicon-star-empty');
                        } else {
                            $(this).removeClass('glyphicon-star').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                        }
                    });
                    $(this).nextAll().each(function(){
                        if(!$(this).hasClass('star-checked')){
                            $(this).removeClass('glyphicon-star').removeClass('glyphicon-star-empty').addClass('glyphicon-star-empty');
                        } else {
                            $(this).removeClass('glyphicon-star').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                        }
                    });
                }).click(function(){
                    $('.star-rating').css('color','#3c763d');
                    $(this).removeClass('glyphicon-star-empty').removeClass('glyphicon-star').removeClass('star-checked').addClass('glyphicon-star').addClass('star-checked').prevAll().removeClass('glyphicon-star').removeClass('glyphicon-star-empty').removeClass('glyphicon-star').addClass('glyphicon-star').addClass('star-checked');
                    $(this).nextAll().removeClass('glyphicon-star-empty').removeClass('glyphicon-star').removeClass('star-checked').addClass('glyphicon-star-empty');

                    $('#Rating').val(($(this).prevAll().length+1));
                });

                $('input:required').on("change paste keyup", function(){
                    if($(this).val().length > 0 && $(this).val().length < 255){
                        $(this).parent().removeClass('has-error').removeClass('has-success').addClass('has-success');
                    } else {
                        $(this).parent().removeClass('has-error').removeClass('has-success').addClass('has-error');
                    }
                });
                
                $('textarea').on("change paste keyup", function(){
                    $("#textareaLen").text($(this).val().length);
                    if($(this).val().length > 0 && $(this).val().length <= 5000){
                        $(this).parent().removeClass('has-error').removeClass('has-success').addClass('has-success');
                    } else {
                        $(this).parent().removeClass('has-error').removeClass('has-success').addClass('has-error');
                    }
                });

                // Back up both the reviews and gallery in case user cancels
                // Must be after all events are hooked so we properly inherit
                $('#modifyGalleryModal .modal-body').clone(true,true).appendTo('#backup-gallery');
                $('#modifyReviewModal  .modal-body').clone(true,true).appendTo('#backup-reviews');
            });
        </script>
    </body>
</html>
<?php
    $mysqli_con->close();
?>
