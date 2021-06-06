<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Victam Portal">
    <meta name="description" content="Making a better world for cattle. Explore live events, conferences, exhibitions, and more.">
    <meta name="keywords" content="vitcam,victamportal,Netherland,idma,aquatic feed,animal feed manufacturers,animal feed mills,additive manufacturing expo,animal feed exhibition,Rice & Flour Milling,Matchmaking,Processing Technologies,Find Suppliers,Find Buyers,Aqua Feed,Additives & Ingredients,Victam Digital Portal,IDMA and Victam,Events,Victam foundations,Victam Jobs,Jobs,Virtual Entertainment,Forums,Victam Forum">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <?php 
        if(file_exists('meta_hepler.php')){
            include 'meta_hepler.php';
        }
    ?>
    <title>VICTAM</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/owl.theme.default.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/site_specific/site_specific.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/assets/shared/css/select2.min.css" rel="stylesheet" />
    <!-- calendar -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/simple-calendar.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/demo.css">

    <!-- Datatable -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/shared/css/toastr.min.css">

    <script src="<?php echo base_url(); ?>application/assets/shared/bootstrap/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/shared/bootstrap/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/shared/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/shared/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/shared/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>application/assets/shared/js/additional-methods.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/shared/site_specific/site_specific.js"></script>
    <!-- <script src="<?php echo base_url(); ?>application/assets/shared/js/api.js" async defer></script> -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script src="<?php echo base_url(); ?>application/assets/shared/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>application/assets/shared/js/select2.min.js"></script>
    <!-- calendar -->
    <script src="<?php echo base_url(); ?>application/assets/shared/js/jquery.simple-calendar.js"></script>
    <!-- Datatable -->
    <script src="<?php echo base_url(); ?>application/assets/shared/js/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>application/assets/shared/js/toastr.min.js"></script>
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.828.0.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-93491517-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-93491517-4');
    </script>
</head>

<input type="hidden" name="ajax_url" id="ajax_url" value="<?php echo base_url(); ?>">
<input type="hidden" name="fb_id" id="fb_id" value="<?php echo $this->config->item('facebook_app_id'); ?>">
<script type="text/javascript">
    var base_url = '<?php echo base_url(); ?>';
</script>


<div class="modal fade" id="myModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text" id="alertMsg"> </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mactchmakingAlert" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text" id="buyerMsg"> </p>
                </div>
            </div>
        </div>
    </div>
</div>