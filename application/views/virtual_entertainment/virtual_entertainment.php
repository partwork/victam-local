<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators visibility-hidden">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/virtual-banner.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Virtual Entertainment</h1>
                            <p class="carousel-sub-title">Let's entertain your senses</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>

        <section class="pb-4 pl-3 pr-3">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                    <section class="pb-5 pl-5 pr-3 mt-5">
                        <h6 class="home-blue-text-heading text-heading-padding ">Victam International provides a collection of entertainment related to the animal feed and grain processing
                            industries. These are categorised into Videos, Games, Meeting rooms, Jokes, and more!</h6>
                    </section>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                    <div class="pt-4">
                        <?php $this->load->view('shared/right_panel/right_panel'); ?>
                    </div>
                </div>
            </div>
        </section>

        <section class="img-section pt-5 pb-5 pl-4 pr-4 ">
            <div id="eventBanner" class="row"></div>
        </section>

        <section class="company-logo-section">
            <div class="owl-carousel owl-carousel-logo">
                <?php if ($company_logo) : ?>
                    <?php foreach ($company_logo as $logo) : ?>
                        <a href="<?php echo $logo->vic_logo_url; ?>" target="_blank"><img src="<?php echo base_url('upload/company/' . $logo->vic_logo_image_path); ?>" class="img-fluid partners-logo"></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>
</body>