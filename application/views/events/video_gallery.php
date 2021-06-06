<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/video-gallery-banner.png" height="200">
                    <div class="carousel-caption" style="bottom: 20px;">
                        <div class="carousel-caption">
                            <h1 class="carousel-title">VIDEO GALLERY</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3 mb-5 pl-5 pr-5">
        <div class="row">
            <div class="col-sm-12 pt-3 pb-5">
                <h3 class="mb-0 text-title-small float-left">Videos</h3>
                <a href="<?php echo base_url(); ?>events/photo_gallery/<?=$evntId?>" class="float-right text-blue text-undeine see-link">Visit Our Photo Gallery</a>
            </div>

            <div class="col-sm-12">
                <h5 class="mb-3 text-title-small">Victam International Expo Videos</h5>

                <div class="row m-0">
                    <?php 
                        if($event->vic_video != null) :
                        $videogallery = explode(",",$event->vic_video); 
                        foreach($videogallery as $vg) : ?>
                    <div class="col-sm-3 pl-1 pr-1">
                        <iframe width="100%" height="200" src="<?php echo base_url() ."upload/event/video/". $vg ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <?php endforeach; endif;?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('shared/footer/footer'); ?>
</body>