<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = ( isset($_SESSION['plan_id']))? $_SESSION['plan_id']:'';?>
<?php $userId = ( isset($_SESSION['userId']))? $_SESSION['userId']:'';?>
<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- <ul class="carousel-indicators ">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
            </ul> -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/jobs-banner.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">JOBS</h1>
                            <p class="carousel-sub-title">Stuck in the wrong job? Visit our vacancies page to find the right job for you.</p>
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
                    <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                        <p class="home-blue-text-heading mt-4">Use all experience with finding a job or candidate within the industry</p>
                        <!-- <h4 class="text-title-small mt-4 mb-3">JOBS</h4> -->
                        <p class="f-16"><span class="job-type">For Employers</span> - Find the latest job opportunities in your industry to take the next step in your carrier. </p>
                        <p class="f-16"><span class="job-type">For Job Seekers</span> - Place your vacancies in this focussed industry portal to find skilled resourced with the right experience. </p>
                        <?php if( $plan_id != 3 ){ ?>
                        <p class="subscription-text mt-5 mb-5 text-center">If you do not have a paid registration please <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">click here </a> to discover the possibilities of how to place your vacancies </p>
                        <?php } ?>
                        <div class="row">
                            <div class="col-sm-6 mt-5 text-center right-align-menu-banners">
                                <h5 class="nav-sub-menu-heading pos-rel">Place a Job</h5>
                                <img onclick="job_menu_clickHandel( 'placeJob'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $this->session->userdata('job_plan')?>' )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/jobs.png" />
                            </div>
                            <div class="col-sm-6 mt-5 text-center left-align-menu-banners">
                                <h5 class="nav-sub-menu-heading pos-rel">Vacancies</h5>
                                <img onclick="job_menu_clickHandel( 'vacancies'  , '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $this->session->userdata('job_plan')?>' )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/vacancies.png" />
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