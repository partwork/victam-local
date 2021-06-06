<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/conclusion_report.png" height="200">
                    <div class="carousel-caption" style="bottom: 20px;">
                        <div class="carousel-caption">
                            <h1 class="carousel-title">CONCLUSION REPORT</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3 mb-5 pl-5 pr-5">
        <div class="row">
            <div class="col-sm-12 pt-3 pb-5">
                <h3 class="mb-0 text-title-small float-left">Conclusion Report</h3>
                <a href="<?php echo base_url(); ?>events/logo_ads_banner/<?=$evntId?>" class="float-right text-blue text-undeine see-link">See Downloads for Logo-Ads-Banners</a>
            </div>
            <?php
            if(count($event) > 0) : 
            foreach($event as $e) : ?>
            <div class="col-sm-3">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top" src="<?php echo base_url(); ?>upload/event/event_default_logo.png" height="265">
                    <div class="card-body text-center">
                        <a href="<?php echo base_url().'upload/event/report/'.$e; ?>" class="btn btn-blue" download>Download</a>
                        <!-- <a href="<?php echo base_url('source_download/' . $e); ?>" class="btn btn-blue">Download</a> -->
                    </div>
                </div>
            </div>
            <?php endforeach ; endif; ?>
        </div>
    </div>

    <?php $this->load->view('shared/footer/footer'); ?>

</body>