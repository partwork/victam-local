<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = ( isset($_SESSION['plan_id']))? $_SESSION['plan_id']:'';?>
<?php $userId = ( isset($_SESSION['userId']))? $_SESSION['userId']:'';?>

<body>
    <!-- <div class="loader-wrapper">
        <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100" class="loader">
    </div> -->
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
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/market_banner.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">Market Information</h1>
                            <p class="carousel-sub-title">The latest news and exclusive market data for informed business analytics</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>

        <section class="pb-5 pl-5 pr-3 pt-5 ">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9 col-md-9 mt-4">
                    <!-- <h6 class="home-blue-text-heading pt-2">VICTAM International and VICTAM Asia are by far the world’s largest dedicated online events for the animal feed
                        processing, grain processing, ingredients & additives, aquafeed, pet food, and biomass pelleting industries.</h6> -->

                    <p class=" pt-2 pb-4 home-sub-text-heading">Here you can find news and interviews about the industry. To search for an article or interview please fill in a keyword or use the right filters. You can also add
                        news or an article by clicking on ‘Write for us’ in the right menu.</p>

                    <!-- <p class=" home-sub-text-heading">Each of the shows is complemented by a number of conferences on various current topics within the above-mentioned industries. </p> -->
                    <?php if ($plan_id != 3) { ?>
                    <p class="subscription-text text-center pt-3 pb-3 mt-4">To find the news of your segment please click at the corresponding image below. To publish news, articles, or interviews subscribe now - <a href="<?php echo base_url(); ?>e/PricingController" class="text-blue text-undeine">Click Here</a> </p>
                    <?php } ?>
                    <div class="market-details mt-5">
                        <div class="row pt-3">
                            <div class="offset-sm-2 col-sm-4 text-center pl-0">
                                <h5 class="nav-sub-menu-heading pos-rel">Processing Technology</h5>
                                <a href="<?php echo base_url(); ?>marketing_info/Processing-Technology">
                                <img class="market-info-img pt-3" src="<?php echo base_url(); ?>application/assets/shared/img/photos/13.png">
                                </a>
                               
                            </div>
                            <div class="col-sm-4 text-center pl-0">
                                <h5 class="nav-sub-menu-heading pos-rel">Ingredients and Additives</h5>
                                <a href="<?php echo base_url(); ?>marketing_info/Ingredients-and-Additives">
                                <img class="market-info-img pt-3" src="<?php echo base_url(); ?>application/assets/shared/img/photos/14.png">
                                </a>
                            </div>
                            <div class="offset-sm-4 col-sm-4 text-center pl-0 mt-4">
                                <h5 class="nav-sub-menu-heading pos-rel">Rice & Flour Milling</h5>
                                <a href="<?php echo base_url(); ?>marketing_info/Rice-and-Flour-Milling">
                                <img class="market-info-img pt-3" src="<?php echo base_url(); ?>application/assets/shared/img/photos/15.png">
                                </a>
                            </div>
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

        <section>
            <h3 class="pl-5 pb-3">MAGAZINES </h3>
            <div class="magazine-section pb-5">
                <h4 class="pb-2 pl-4 container text-white">DOWNLOAD SHOWTIME</h4>
                <div class="owl-carousel owl-carousel-mag owl-theme container">
                    <?php
                        $i=1;
                        if(isset($magzine_list) && !empty($magzine_list)):
                            foreach($magzine_list as $val):
                              $status=($i==1)? 'active' : '';
                              $i++;
                              $url=base_url()
                    ?>
                    <a target="_blank" href="<?php echo base_url('upload/marketing_info/'.$val->vic_bn_document_url);?>">
                    <div class="item text-center">
                        <img class="mb-3 custome-mg-img" src="<?php echo base_url('upload/marketing_info/'.$val->vic_bn_image); ?>">
                        <!-- <a  class="open_mag_mkt" data-url="<?php echo base_url($val->vic_bn_document_url);?>">
                            </a> -->
                        <span class="f-14 text-white"><b>Issue:</b><b><?php echo $val->vic_description;?></b></span>
                        <span class="f-14 text-white"><b>Volume:</b><b><?php echo $val->vic_bn_storytextdoc;?></b></span>
                        <span class="f-14 text-white"><b>Year:</b><b><?php echo $val->vic_bn_position;?></b></span>
                    </div>
                    </a>
                    <?php
                       endforeach;
                     endif;  
                    ?> 
                </div>

                <!-- <div id="magazine" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators visibility-hidden">
                        <li data-target="#magazine" data-slide-to="0" class="active"></li>
                        <li data-target="#magazine" data-slide-to="1"></li>
                        
                    </ul>
                    <div class="carousel-inner">
                        <?php
                         $i=1;
                         if(isset($magzine_list) && !empty($magzine_list)):
                            foreach($magzine_list as $val):
                                $status=($i==1)? 'active' : '';
                                $i++;
                       ?> 
                        <div class="carousel-item <?php echo $status;?>">
                            <a  class="open_mag_mkt" data-url="<?php echo base_url($val->vic_bn_document_url);?>">
                            <iframe
                                src="<?php echo base_url($val->vic_bn_document_url);?>#toolbar=0&scrollbar=0"
                                frameBorder="0"
                                class="carousel-img"
                                height="100%"
                                width="100%"
                                scrolling="no"
                                style="overflow: hidden;"
                            ></iframe></a>
                        </div>
                       <?php
                           endforeach;
                         endif;  
                       ?> 
                        
                    </div>
                    <a class="carousel-control-prev" href="#magazine" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#magazine" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div> -->
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.open_mag_mkt').click(function(){

                var url=$(this).data('url')
                window.location.href=url;
            })
        })
    </script>
    </div>
</body>