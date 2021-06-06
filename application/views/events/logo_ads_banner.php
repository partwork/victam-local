<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/logo-ad-banner.png" height="200">
                    <div class="carousel-caption" style="bottom: 20px;">
                        <div class="carousel-caption">
                            <h1 class="carousel-title">LOGO - ADS - BANNERS</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3 mb-5 pl-5 pr-5">
        <div class="row">
            <div class="col-sm-12 pt-3 pb-5">
                <h3 class="mb-0 text-title-small float-left">Logo - Ads - Banners</h3>
                <a href="<?php echo base_url(); ?>events/conclusion_report/<?=$evntId?>" class="float-right text-blue text-undeine see-link">See Downloads for Conclusion Report</a>
            </div>
            <div class="col-sm-6 pr-5">
                <h5 class="mb-3 text-title-small">Logo</h5>
                <?php if(!empty($event) && $event->vic_logo != null) : ?>
                <div class="row m-0">
                    <div class="col-sm-6 pl-1 pr-1">
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top" src="<?php echo base_url().'upload/event/'.$event->vic_logo ?>" height="265">
                            <div class="card-body text-center">
                                <a href="<?php echo base_url().'upload/event/'.$event->vic_logo ?>" class="btn btn-blue" download>Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6 pr-5">
                <h5 class="mb-3 text-title-small">Advertisement</h5>
                <?php if(!empty($event) && $event->vic_advertisement != null) : ?>
                <div class="row m-0">
                    <div class="col-sm-6 pl-1 pr-1">
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top" src="<?php echo base_url().'upload/event/'.$event->vic_advertisement ?>" height="265">
                            <div class="card-body text-center">
                                <a href="<?php echo base_url().'upload/event/'.$event->vic_advertisement ?>" class="btn btn-blue" download>Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-6 ">
                <h5 class="mb-3 mt-4 text-title-small">Banners</h5>
                <div class="row m-0">
                    <?php 
                    if(!empty($event) && $event->vic_banners != null) :
                    $imagegallery = explode(",",$event->vic_banners); 
                    foreach($imagegallery as $mg) : ?>
                    <div class="col-sm-6 pl-1 pr-1">
                        <div class="card" style="width: 100%;">
                            <img class="card-img-top" src="<?php echo base_url().'upload/event/'.$mg; ?>" height="265">
                            <div class="card-body text-center">
                                <a href="<?php echo base_url().'upload/event/'.$mg; ?>" class="btn btn-blue" download>Download</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            
        </div>
    </div>

    <?php $this->load->view('shared/footer/footer'); ?>
    <!-- Chatbot -->
    <?php $this->load->view('shared/chatbot/chatbot'); ?>

</body>