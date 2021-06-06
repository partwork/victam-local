<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/matchmaking_banner.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Matchmaking </h1>
                            <p class="carousel-sub-title">Take your relationship to next level</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>

        <div class="row mt-5 pl-5 pr-5">
            <div class="col-sm-9 ">
                <!-- <h4 class="text-title-small mt-2 mb-4">DESCRIPTION MATCHMAKING</h4> -->
                <div class="row">
                    <div class="col-sm-12">
                        <div id="accordion">
                            <div class="card">
                                <div id="headingOne" onclick="active_profile_accordion('headingOne')">
                                    <div class="d-flex accordian-btn bb-grey" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <p class="news-title f-16 fw-500 text-blue">What is it?</p>
                                        <!-- <img class="drop-down-arrow-accordion drop-down-arrow-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" src="<?php echo base_url(); ?>application/assets/shared/img/icon/drop-down-arrow.png" class="drp-arrow"> -->
                                        <i class="fa fa-angle-down drop-down-arrow-accordion" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body plr-15">
                                        <p class="text-title-small mb-0 f-14 pt-1 pb-3">This matchmaking tool is bringing together buyers and suppliers in the animal feed and grain, soy, beans processing industries based on a specified
                                            profile of technological expertise and needs.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div id="headingTwo" onclick="active_profile_accordion('headingTwo')">
                                    <div class="d-flex accordian-btn bb-grey" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <p class="news-title f-16 fw-500 text-blue">How does it work?</p>
                                        <!-- <img class="drop-down-arrow-accordion drop-down-arrow-2" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" src="<?php echo base_url(); ?>application/assets/shared/img/icon/drop-down-arrow.png" class="drp-arrow"> -->
                                        <i class="fa fa-angle-down drop-down-arrow-accordion" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body pt-1">
                                        <p class="text-title-small mb-0 f-14 pt-1 pb-3">After selecting being a buyer or supplier, a form should be filled in to determine your profile and needs. The program is free for buyers who will be
                                            informed about how many matches they have. Suppliers who receive the profiles and contact details of potential clients will be charged a small fee
                                            per contact.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div id="headingThree" onclick="active_profile_accordion('headingThree')">
                                    <div class="d-flex accordian-btn bb-grey" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <p class="news-title f-16 fw-500 text-blue">How to participate?</p>
                                        <!-- <img class="drop-down-arrow-accordion drop-down-arrow-3" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" src="<?php echo base_url(); ?>application/assets/shared/img/icon/drop-down-arrow.png" class="drp-arrow"> -->
                                        <i class="fa fa-angle-down drop-down-arrow-accordion" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body pt-1">
                                        <p class="text-title-small mb-0 f-14 pt-1 pb-3">List your business in our company guide to increase your discoverability and consult buyers for suggested suppliers, partners, and providers. Give
                                            them every chance to discover and pursue your organization by maximizing your visibility in our Matchmaking directories</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 mt-5 text-center right-align-menu-banners">
                        <h5 class="nav-sub-menu-heading pos-rel">Find Suppliers</h5>
                        <?php $plan_id = (isset($_SESSION['plan_id'])) ? $_SESSION['plan_id'] : ''; ?>
                        <?php $userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : ''; ?>
                        <?php $matchmaking = (isset($_SESSION['matchmaking_plan'])) ? $_SESSION['matchmaking_plan'] : ''; ?>
                        <img class="nav-sub-menu-img" onclick="match_making_clickHandel( 'suppliers'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $matchmaking ?>')" src="<?php echo base_url(); ?>application/assets/shared/img/photos/find_suppliers.png" />
                    </div>
                    <div class="col-sm-6 mt-5 text-center left-align-menu-banners">
                        <h5 class="nav-sub-menu-heading pos-rel">Find Buyers</h5>
                        <img class="nav-sub-menu-img" onclick="match_making_clickHandel( 'buyers'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $matchmaking ?>' )" src="<?php echo base_url(); ?>application/assets/shared/img/photos/find_buyers.png" />
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <?php $this->load->view('shared/right_panel/right_panel'); ?>
            </div>
        </div>

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