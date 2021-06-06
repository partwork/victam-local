                <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = ( isset($_SESSION['plan_id']))? $_SESSION['plan_id']:'';?>
<?php $userId = ( isset($_SESSION['userId']))? $_SESSION['userId']:'';?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators ">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/event-banner-1.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">EVENTS</h1>
                            <p class="carousel-sub-title ">Industry-wide live conferences, events, training, workshops, and exhibitions provide professionals with unique
                                educational, networking, and business development opportunities</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/event-banner-2.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title">EVENTS</h1>
                            <p class="carousel-sub-title">Industry-wide live conferences, events, training, workshops, and exhibitions provide professionals with unique
                                educational, networking, and business development opportunities</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>

        <section class="pb-5 pl-5 pr-3 ">
            <section class="pl-3">
                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-lg-9 col-md-9 mt-1">
                        <p class="home-blue-text-heading mt-4">In this section of the portal you can find all digital and on-site events in the industries for the animal feed and grain processing industries.</p>
                        <!-- <h4 class="text-title-small mt-4">EVENTS</h4> -->
                        <p class="home-sub-text-heading">For all physical events please click on-site events and for all digital events click on on-line events.</p>
                        <p class="home-sub-text-heading">If you would like to add your event in the event calendar, please <a href="<?php echo base_url(); ?>events/add-event" class="text-blue">Click here.</a></p>
                        <?php if( $plan_id != 3 ){ ?>
                        <p class="subscription-text mt-5 mb-5 text-center">You can add the basic information of your event for free, if you would like to add more detailed information please <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">Click Here</a> to see your options.</p>
                        <?php } ?>
                        <div class="row">
                            <div class="col-sm-4 mt-5 text-center right-align-menu-banners">
                                <h5 class="nav-sub-menu-heading pos-rel">Event Calendar</h5>
                                <img onclick="events_menu_click_handel( 'calender' , '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/16.png" width="100%" />
                            </div>
                            <div class="col-sm-4 mt-5 text-center left-align-menu-banners">
                                <h5 class="nav-sub-menu-heading pos-rel">Online Events</h5>
                                <img onclick="events_menu_click_handel( 'online' , '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/17.png" width="100%" />
                            </div>
                            <div class="col-sm-4 mt-5 text-center left-align-menu-banners">
                                <h5 class="nav-sub-menu-heading pos-rel">Onsite Events</h5>
                                <img onclick="events_menu_click_handel( 'onsite' , '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/onsite.png" width="100%" />
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                        <div class="pt-4">
                            <?php $this->load->view('shared/right_panel/right_panel'); ?>
                        </div>
                    </div>
                </div>
            </section>
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