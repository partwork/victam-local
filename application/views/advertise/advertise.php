<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pb-4 pl-3 pr-3">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                    <div class="advertise">
                        <h4 class="pt-4">ADVERTISE WITH US</h4>
                        <p class="sub-description-light-400">The VICTAM digital portal is the 24/7 start page for all people working or active in the animal feed and grain processing industries. Users can find the latest and
                            high-quality content or technology and can participate at forums, find jobs or participate in the dynamic online marketplace. The portal is an interactive page
                            used and filled by users what makes it a unique place for the industry.
                        </p>
                        <p class="sub-description-light-400 mb-1">With an interactive multimedia platform VICTAM connects suppliers and buyers of products or services in specific markets, like:</p>
                        <ul class="post-info-wrap">
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Processing Technologies</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Ingredients and Additives</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Rice & Flour Milling</span>
                            </li>
                        </ul>

                        <h4 class="pt-1 fs-22">FOR DECISION MAKERS</h4>
                        <p class="sub-description-light">Decision makers choose VICTAM for its trusted and high-quality content, up-to-date industry news, latest global events, and dynamic online marketplace of
                            manufacturers or suppliers</p>

                        <h4 class="pt-1 fs-20">Market Smartly, Take a Leap!</h4>
                        <p class="sub-description-light mb-2">Create an ad with VICTAM just in minutes. Advertising with us delivers you the most cost effective and efficient form of advertising.</p>
                        <p class="sub-description-light mb-2">There are various advertising options available to maximize traction and generate more enquiries.</p>
                        <p class="sub-description-light">Our registered visitors are comprised of exactly the types of buyers you wish to reach. For example:</p>

                        <ul class="post-info-wrap">
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Design engineers</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Maintenance managers</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>General managers</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Research scientists</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Plant managers</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Project managers</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Technical buyers, etc.</span>
                            </li>
                        </ul>
                        <h4 class="pt-1 fs-20">Native Advertising</h4>
                        <p class="sub-description-light mb-2">By advertising alongside Victam’s trusted editorial content, companies can build brand awareness, position themselves as thought leaders in the industry,
                            and reach more potential customers.</p>
                        <p class="sub-description-light mb-2">Reach qualified professionals and realize your business goals with our integrated marketing and advertising solutions</p>
                        <p class="sub-description-light mb-2">Readers can engage at a deeper level with magazines and specialty ads with interactive enhancements that extend beyond the limits of print – such as
                            video, audio, hyperlinks, and more – while they consume content on any digital device.</p>
                        <p class="sub-description-light mb-2 text-blue"><i>Email us at the below address a copy of your magazine or share the advert specifications including banner image, its size (x, xx, xxx pixels), and type
                                (png, jpeg, pdf) to be posted on our editorial space</i></p>

                        <h6 class="media-brochure ">To Request our Media Brochure/ Planner in PDF format, please email sales@victam.com or call us on +31(0) XXXXXXXXX</h6>
                    </div>



                    <!-- <div class="sales-contact-section pt-5 pb-5">
                        <div class="sales-contact">
                            <h4 class="text-center">CONTACT INFORMATION</h4>
                            <div class="p-3">
                                <h6 class="pl-5"><i class="fa fa-star text-theme-red pr-2"></i>Manager : <span class="text-theme-red">Patricia Heimgartner</span></h6>
                                <h6 class="pl-5"><i class="fa fa-star text-theme-red pr-2"></i>Email : <span class="text-theme-red">patriciaheimgartner@victam.com</span></h6>
                            </div>
                        </div>
                    </div> -->


                    <?php if ($this->session->userdata('plan_id') == 3) { ?>
                        <div class="sales-contact-section pt-5 pb-5">
                            <div class="sales-contact">
                                <h4 class="text-center">CONTACT INFORMATION</h4>
                                <div class="p-3">
                                    <h6 class="pl-5"><i class="fa fa-star text-theme-red pr-2"></i>Manager : <span class="text-theme-red">Patricia Heimgartner</span></h6>
                                    <h6 class="pl-5"><i class="fa fa-star text-theme-red pr-2"></i>Email : <span class="text-theme-red">patriciaheimgartner@victam.com</span></h6>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <p class="subscription-text mt-5 mb-5 text-center">Upgrade your plan to access the contact information for publishing your ads or magazines - <a href="<?php echo base_url(); ?>pricing" class="text-blue text-undeine">Upgrade now!</a></p>
                    <?php } ?>

                </div>
                <div class="col-12 col-sm-12 col-lg-3 col-md-3">
                    <div class="pt-4">
                        <?php $this->load->view('shared/right_panel/right_panel'); ?>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>
</body>