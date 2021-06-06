<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = ( isset($_SESSION['plan_id']))? $_SESSION['plan_id']:'';?>
<?php $userId = ( isset($_SESSION['userId']))? $_SESSION['userId']:'';?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/Resource_Library.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Resource Library</h1>
                            <p class="carousel-sub-title">Requisite knowledge and resources to enrich your mind</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>

        <div class="row mt-5 pl-5 pr-5">
            <div class="col-sm-9 mt-3">
                <p class="home-blue-text-heading">Here you can find a collection of resources, innovations and case studies, including international developments in the animal feed and related industries!
                </p>
                <!-- <h4 class="text-title-small mt-4">RESOURCE LIBRARY</h4> -->
                <p class="home-sub-text-heading">Search the Victam’s Resource Library by resource type and topic. If you have trouble finding a resource, please contact us <a href="https://victam.com/contact-forms" class="text-blue text-undeine" target="_blank">here</a>.
                </p>
                <!-- <p class="subscription-text mt-5 mb-5 text-center">Only subscribed members have the access to our resource library. To publish your resources subscribe now - <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">Click Here</a></p> -->
                <?php if ($plan_id != 3) { ?>
                <p class="subscription-text mt-5 mb-5 text-center">If you would like to contribute to this resource library with posting your innovation, study, research or any other resource, please <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">Click Here</a> and post your resource for free.</p>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-6 mt-5 text-center right-align-menu-banners">
                        <h5 class="nav-sub-menu-heading pos-rel">Research & Innovation</h5>
                        <img onclick="resource_menu_clickHandel( 'research'  , <?php echo $this->session->userdata('userId'); ?> )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/Research_Innovation1.png" />
                    </div>
                    <div class="col-sm-6 mt-5 text-center left-align-menu-banners">
                        <h5 class="nav-sub-menu-heading pos-rel">Case Studies</h5>
                        <img onclick="resource_menu_clickHandel( 'caseStudies'  , <?php echo $this->session->userdata('userId'); ?> )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/CaseStudies.png" />
                    </div>
                    <div class="col-sm-6 mt-5 text-center right-align-menu-banners">
                        <h5 class="nav-sub-menu-heading pos-rel">Whitepapers</h5>
                        <img onclick="resource_menu_clickHandel( 'whitepapers'  , <?php echo $this->session->userdata('userId'); ?> )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/Whitepapers.png" />
                    </div>
                    <div class="col-sm-6 mt-5 text-center left-align-menu-banners">
                        <h5 class="nav-sub-menu-heading pos-rel">Publications</h5>
                       <img onclick="resource_menu_clickHandel( 'publications'  , <?php echo $this->session->userdata('userId'); ?> )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/Publications.png" />
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