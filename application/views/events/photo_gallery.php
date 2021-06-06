<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/photo-gallery-banner.png" height="200">
                    <div class="carousel-caption" style="bottom: 20px;">
                        <div class="carousel-caption">
                            <h1 class="carousel-title">PHOTO GALLERY</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3 mb-5 pl-5 pr-5">
        <div class="row">
            <div class="col-sm-12 pt-3 pb-5">
                <h3 class="mb-0 text-title-small float-left">Photos</h3>
                <a href="<?php echo base_url(); ?>events/video_gallery/<?=$evntId?>" class="float-right text-blue text-undeine see-link">Visit Our Video Gallery</a>
            </div>

            <div class="col-sm-12 pl-5 ">
                <h5 class="mb-3 text-title-small">VICTAM</h5>

                <div class="row m-0 photo-gallery-wrap">
                    <?php 
                        if($event->vic_photos != null) :
                        $imagegallery = explode(",",$event->vic_photos); 
                        foreach($imagegallery as $mg) : ?>
                        <div class="col-sm-2 pl-1 pr-1 mb-2">
                            <img class="img-section" src="<?php echo base_url() ."upload/event/". $mg; ?>">
                        </div>
                    <?php endforeach;endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('shared/footer/footer'); ?>
</body>