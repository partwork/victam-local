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
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/who_is_who_banner.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">WHO IS WHO</h1>
                            <p class="carousel-sub-title">Find companies in the feed and grain processing industries</p>
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
                <p class="home-blue-text-heading">Victam's online business directory lists a wide variety of suppliers and contractors to the animal feed, pet food, and grain and rice processing industries.
                    All users of this portal can browse the online directories by industry, geography, category, or search by company name.
                </p>
                <p class="home-sub-text-heading">If you are a supplier in these industries, enlist your company to this directory to increase your discoverability and give buyers every chance to find your organization. </p>
                <?php if( $plan_id != 3 && $plan_id != 2 ){ ?>
                <p class="home-sub-text-heading mb-1 mt-4 pb-0">If you have paid registration you can include your company in this directory, otherwise please <a href="javascript:vois(0)" class="text-blue" onclick="add_company_clickHandel( '<?php echo $plan_id ?>', '<?php echo $userId ?>' )"> click here </a>  to discover the possibilities of how to include your company.</p>
                <?php } ?>
                <?php if( $plan_id != 3 ){ ?>
                <p class="subscription-text text-center mt-5 mb-5"><a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">Click here</a> to discover the possibilities to include your company in the guide. </p>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-12 mt-3 text-center">
                        <h5 class="nav-sub-menu-heading pos-rel">Company Directory</h5>
                        <a href="<?php echo base_url(); ?>e/WhoIsWhoController/load_Company_Directory_View" class="text-blue text-undeine"><img class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/CompanyDirectory.png" /></a>
                        <!-- <img onclick="directory_clickHandel( '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="nav-sub-menu-img" src="<?php echo base_url(); ?>application/assets/shared/img/photos/CompanyDirectory.png" /> -->
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