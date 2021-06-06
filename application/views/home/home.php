<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = ( isset($_SESSION['plan_id']))? $_SESSION['plan_id']:'';?>
<?php $userId = ( isset($_SESSION['userId']))? $_SESSION['userId']:'';?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
        <div id="demo" class="carousel slide" data-ride="carousel">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
                <li data-target="#demo" data-slide-to="3"></li>
            </ul>
            <div class="carousel-inner top-banner-carousel">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/home-banner-1.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">VICTAM</h1>
                            <p class="carousel-sub-title">Making a better world for cattle. Explore live events, conferences, exhibitions, and more.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/home-banner-2.png" alt="Chicago" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Aqua Feed</h1>
                            <p class="carousel-sub-title">Because nothing grows faster than a fish. Check out our exclusive news and interviews.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/home-banner-3.png" alt="Chicago" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Additives & Ingredients</h1>
                            <p class="carousel-sub-title">Find the best-suited suppliers for ingredients and additives here.</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/home-banner-4.png" alt="Chicago" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Rice & Flour Milling</h1>
                            <p class="carousel-sub-title ">Forums for grain storage, preservation and transportation.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>
    </div>
    <div class="container-fluid pr-0 pl-0">
        <section class="intro-section pl-5 pt-5">
            <section class="pb-4 pl-3 pr-3 pt-3">
                <div class="row mb-5">
                    <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                        <section class="home-question-wrap">
                            <h4 class="text-title"><b>What is the Victam Digital Portal?</b></h4>
                            <p>The VICTAM digital portal is the 24/7 start page for all people active in the animal feed and grain and flour processing industries. All information at the portal is
                                free to use. Users can find the latest and high-quality content or technology and can participate in forums, find jobs, or participate in the dynamic online
                                marketplace. The portal is an interactive page used and filled by users what makes it a unique place for the industry.</p>
                            <h4 class="text-title mt-4"><b>How to participate actively?</b></h4>
                            <p>If you visit this portal for the first time you are asked to register yourself. After your registration you choose the package which fits best for you, starting from a
                                basic package for free with access to all information at the portal, or a package for companies who would like to use the portal in a more interactive way as a
                                marketing tool or to position their company in the industry.</p>
                            <p>Returning users of the portal can easily login with their credentials.</p>
                            <p>All information at the portal is neutral information for the mentioned industries and is not linked with the Victam events. For information about Victam or
                                Victam events please click on the links Victam Events at the upper right menu.</p>
                            <!-- <p class="subscription-text mt-5 mb-5 text-center">Get unlimited access to all the features by subscribing to our premium membership. To best suit your needs, explore the plans <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">here</a></p> -->
                            <?php if ($plan_id != 3) { ?>
                                <p class="subscription-text mt-5 mb-5 text-center">Get unlimited access to news, forums and search functions by subscribing to our free basic package. Or get access to all interactive features by subscribing to a premium
                                    membership. To best suit your needs, explore the plans <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">here</a></p>
                            <?php } ?>
                        </section>
                        <section class="pt-3">
                            <h4 class="text-title-small">LATEST NEWS</h4>
                            <div class="row news-section">
                                <?php if ($news) : ?>
                                    <?php foreach ($news as $newsdata) : ?>
                                        <div class="col-sm-6 mb-20 pl-10">
                                            <div class="news-card">
                                                <h6 class="text-blue f-14"><?php echo $newsdata->vic_bn_title; ?></h6>
                                                <p class="f-14"><?php echo word_limiter($newsdata->vic_description, 40); ?> </p>
                                                <div class="news-footer">
                                                    <span class="text-left news-date"><?php echo date('Y-m-d', strtotime($newsdata->vic_bn_createdat)); ?></span>
                                                    <span class="float-right">
                                                        <span><a href="<?php echo base_url('news/' . $newsdata->idvic_blogs_news); ?>" class="read-more text-blue"> Read More </a> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/line.png"> </span>
                                                        <span><a href="<?php echo $newsdata->vic_blogs_website_url; ?>" target="_blank" class="visit-website text-blue"> Visit website </a> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/line.png"> </span>
                                                        <span><a href="<?php echo base_url('source_download/' . $newsdata->idvic_blogs_news); ?>" class="download text-blue"> Download </a> <img src="<?php echo base_url(); ?>application/assets/shared/img/icon/line.png"> </span>
                                                        <a href="https://www.facebook.com/dialog/share?app_id=<?php echo $this->config->item('facebook_app_id'); ?>&href=http://dev.victam.com/e/CommonController/get_news_by_id/<?php echo $newsdata->idvic_blogs_news ?>&display=popup" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/facebook.png" height="11" width="11"></span>
                                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_news_by_id/<?php echo $newsdata->idvic_blogs_news ?>" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/linkedin.png" height="11" width="11"></span></a>
                                                        <a href="https://twitter.com/intent/tweet?text=<?php echo $newsdata->vic_bn_title .' - '.$newsdata->vic_description; ?>" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/twitter.png" height="11" width="11"></span></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="alert alert-danger">There is no news as of now</div>
                                <?php endif; ?>

                            </div>
                            <div class="text-center">
                                <a href="<?php echo base_url(); ?>news" class="btn btn-sm pl-3 pr-3 btn-blue-border">More</a>
                            </div>
                        </section>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                        <?php $this->load->view('shared/right_panel/right_panel'); ?>
                    </div>
                </div>
                <div class="row pr-5 mt-5">
                    <div class="col-sm-12">
                        <h4 class="text-title-small pb-2 mb-3">LATEST INTERVIEWS</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="owl-carousel owl-carousel-interviews">
                        </div>
                    </div>
                </div>
                <div class="row pr-5 mt-5">
                    <div class="col-sm-12">
                        <h4 class="text-title-small mb-3">EVENTS</h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="owl-carousel owl-carousel-events">
                        </div>
                    </div>
                </div>
            </section>
        </section>

        <section class="img-section pt-5 pb-5 pl-4 pr-4 mt-5">
            <div id="eventBanner" class="row"></div>
        </section>

        <section class="company-logo-section">
            <div class="owl-carousel owl-carousel-logo">
                <?php if ($company_logo) : ?>
                    <?php foreach ($company_logo as $logo) : ?>
                        <a href="<?php echo $logo->vic_logo_url; ?>" target="_blank"><img src="<?php echo base_url('upload/company/' . $logo->vic_logo_image_path); ?>" class=" partners-logo"></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>

        <div class="disclaimer-wrap">
            <p class="text-blue">
                No rights can be derived from the information on this website and Victam accepts no liability for damage resulting from inaccuracies or incompleteness in
                the information provided.
            </p>
        </div>

        <?php $this->load->view('shared/footer/footer'); ?>

        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>
</body>