<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/contact.png" height="200">
                    <div class="carousel-caption" style="bottom: 20px;">
                        <div class="carousel-caption">
                            <h1 class="carousel-title">CONTACT</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3 mb-5 pl-5 pr-5">
        <div class="row">
            <div class="col-sm-7 d-flex align-items-center">
                <img class="w-100" src="<?php echo base_url(); ?>application/assets/shared/img/contact-page.png">
            </div>
            <div class="col-sm-5">
                <div class="form-froup">
                    <div class="card contact-card">
                        <h3 class="text-center">CONTACT PARANTEZ</h3>
                        <div class="contact-info-wrap">
                            <p>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span><?php if(!empty($company) && $company->vic_phonenumber) echo $company->vic_phonenumber ?></span>
                            </p>
                            <p>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <span><a href="<?php if(!empty($company) && $company->vic_companyemail) echo $company->vic_companyemail ?>" target="_blank"><?php if(!empty($company) && $company->vic_companyemail) echo $company->vic_companyemail ?></a> </span>
                            </p>
                            <p>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span><a href="<?php if(!empty($company) && $company->vic_companywebsite) echo $company->vic_companywebsite ?>" target="_blank"><?php if(!empty($company) && $company->vic_companywebsite) echo $company->vic_companywebsite ?></a></span>
                            </p>
                            <p>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>Office: <?php if(!empty($company) && $company->vic_address_details) echo $company->vic_address_details ?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="form-froup mt-5">
                    <div class="card contact-card">
                        <h3 class="text-center">CONTACT VICTAM</h3>
                        <div class="contact-info-wrap">
                            <p>
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>+31 33 246 4404</span>
                            </p>
                            <p>
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                <span><a href="info@idmavictam.com" target="_blank">info@idmavictam.com</a></span>
                            </p>
                            <p>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                <span><a href="https://www.idmavictam.com/" target="_blank">www.idmavictam.com</a></span>
                            </p>
                            <p>
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>Office: Victam Corporation, Maliebaan 24 – 26, 3581 CP Utrecht, The Netherlands</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <div class="card contact-card">
                    <h3 class="text-center">CONTACT VICTAM</h3>
                    <div class="contact-info-wrap">
                        <p>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span>+31 33 246 4404</span>
                        </p>
                        <p>
                            <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            <span>info@idmavictam.com</span>
                        </p>
                        <p>
                            <i class="fa fa-globe" aria-hidden="true"></i>
                            <span>www.idmavictam.com</span>
                        </p>
                        <p>
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>Office: Victam Corporation P.O. Box 197, 3860 AD Nijkerk - THE NETHERLANDS</span>
                        </p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <?php $this->load->view('shared/footer/footer'); ?>

</body>