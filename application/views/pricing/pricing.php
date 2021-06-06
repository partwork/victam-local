<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <div class="nav-logo pl-3 pt-1 pb-2 mb-4">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png" width="180px">
        </a>
    </div>

    <div class="text-center pt-4">
        <h3 class="text-title-small fw-600">Our Services Have Friendly Packages</h3>
        <p class="choose-plan">Choose the plan that's right for you</p>
    </div>

    <div class="container-fluid">
        <section class="plr-12vw all-pricing-package-wrap">
            <img src="<?php echo base_url(); ?>application/assets/shared/img/top-left-ellipse.png" class="top-left-ellipse img-fluid" />
            <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="bottom-left-ellipse img-fluid" />
            <img src="<?php echo base_url(); ?>application/assets/shared/img/top-right-ellipse.png" class="top-right-ellipse img-fluid" />
            <div class="row pbw">
                <?php 
                    $n = 0;
                    foreach ($plans as $p) :
                    $n++;
                ?>
                    <div class="col-12 col-sm-4">
                        <div class="pricing-box-wrap">
                            <h5 class="pricing-title"><?= $p->vic_pricingplanname ?></h5>
                            <div class="plan-amt-tagline-wrap" >
                                <h1 class="pricing-amount" id="amt<?php echo $n++ ?>"><sup>€</sup><?php if ($p->vic_pricing_amount == 0) echo "Free";
                                                            else echo $p->vic_pricing_amount; ?>
                                                            <?php if($p->vic_pricing_amount == 0) : ?>
                                                                <sub>1 month</sub>
                                                            <?php else : ?>
                                                                <sub>/year</sub>
                                                            <?php endif; ?>
                                                            </h1>
                                <img src="<?php echo base_url() . $p->vic_pricing_plans_img_url; ?>" class="pricing-img" />
                                <p class="pricing-tagline"><?= $p->vic_pricing_description ?></p>
                                <?php
                                    if($p->vic_pricing_amount == 0){
                                        $paymentLink = 'e/PricingController/freePlan';
                                    }else{
                                        $paymentLink = 'e/PricingController/get_hosted_paymentpage/'.$p->idvic_pricing_plans;
                                    }

                                    $disabled='';
                                    if(($this->session->userdata('free_plan') == 'false' && $p->vic_pricing_amount == 0) || ($p->idvic_pricing_plans==$this->session->userdata('plan_id'))){
                                        $disabled='disabled';
                                    }
                                ?>
                                <a href="<?php echo base_url($paymentLink)?>">
                                    <button type="button" class="btn btn-buy" <?=$disabled?>>
                                        <?php if($p->vic_pricing_amount == 0) echo "TRY IT NOW"; else echo "BUY NOW";?>
                                    </button>
                                </a>
                            </div>
                            <div class="plan-feature-wrap">
                                <ul>
                                    <?php $features = explode('|', $p->vic_pricing_store_markup_description);
                                    foreach ($features as $fe) : ?>
                                        <li>
                                            <p><?= $fe ?></p>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                            <div class="more-button-wrap">
                                <button type="button" class="more-btn <?= trim($p->vic_pricingplanname) ?>-btn" data-text="Less -">More +</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row" id="basic-feature">
                <div class="col-sm-12 pos-rel">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="feature-bottom-left-ellipse" />

                    <div class="feature-detail-wrap">
                        <h3 class="feature-title">Basic Features</h3>
                        <ul>
                            <li>
                                <p>All news, interviews, researches, jobs, events, etc. are available. Also available is the uploading news feature.</p>
                            </li>
                            <!-- <li>
                                <p>In this package you can upload your events in the calendar. Uploading event photos, videos, reports, registration links etc.. is not included in the basic plan.</p>
                            </li> -->
                            <li>
                                <p>Matchmaking matches buyers with suppliers. In this package the Matchmaking for Buyers is Free - We provide a personal match making page displaying the total count of matches although you will not see the information of the supplier. The supplier is informed about interested buyers to contact them for further info.</p>
                            </li>
                            <li>
                                <p>Matchmaking for Suppliers is not included in this package. To receive information with matched potential clients, upgrade your plan or opt for the plans provided at the match-making a page on a ‘Pay as you use’ base.</p>
                            </li>
                            <li>
                                <p>Although you can see and react to all posted job vacancies, including your job vacancies is not included in this package. You can avail of this service by paying for it on a ‘pay as you use base’ or by upgrading your plan.</p>
                            </li>
                            <li>
                                <p>Basic membership cannot be extended after 1 month and/or reactivated if accidentally cancelled.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row" id="promo-feature">
                <div class="col-sm-12 pos-rel">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="feature-bottom-left-ellipse" />

                    <div class="feature-detail-wrap">
                        <h3 class="feature-title">Promotional Features</h3>
                        <ul>
                            <li>
                                <p> In this package, you can upload your events in the calendar including uploading event photos, videos, reports, registration links and links to your website.</p>
                            </li>
                            <li>
                                <p>You can post an unlimited number of job vacancies to reach out to the best professionals in the industry.</p>
                            </li>
                            <li>
                                <p>Adding your company name and details in the industry ‘Who is Who’ buyers guide is an ideal way to be found by your customers.</p>
                            </li>
                            <li>
                                <p>Matchmaking matches buyers with suppliers. In this package the Matchmaking for Buyers is Free - We provide a personal match-making page displaying the total count of matches although you will not see the information of the supplier. The supplier is informed about interested buyers to contact them for further info.</p>
                            </li>
                            <li>
                                <p>Matchmaking for Suppliers is included on a limited level. You will receive the information of one potential client who is looking for the products you supply. To have unlimited access to all matches, upgrade your plan or opt for the plans provided at the match-making page on a ‘Pay as you use’ base.</p>
                            </li>
                            <li>
                                <p>To be visible at this portal with this package you will have a rotating banner for 12 months. The place and the appearance time of the banner are depending on the available position and number of active banners.</p>
                            </li>
                        </ul>
                        <!-- <ul>
                            <li>
                                <p>Can post more than 1 rotating banner by Pay as you go</p>
                            </li>
                            <li class="ml-feature">
                                <p>Matchmaking for Suppliers: To receive more than 1 match of potential client, opt for anyone plan provided in matchmaking page
                                    <br><span class="f-14 fw-400">A. Fee per match: Euro 1,000 / match Every time there is a match, the supplier receives a message that there is a match and they can do the payment before receiving the lead</span>
                                    <br><span class="f-14 fw-400">B. Prepaid number of matches: Up to 10 matches – Euro 5,000 Up to 25 matches – Euro 10,000</span>
                                    <br><span class="f-14 fw-400">C. Fixed Fee: Euro 10,000/ year Unlimited # of matches for the participation year</span>
                                    <br><span class="f-14"><b>Note - As soon as there are matches, list of buyers will be emailed as well as the supplier can find the matches with contact info at their personal matchmaking page </b></span>
                                </p>
                            </li>
                            <li>
                                <p>Matchmaking for Buyers is Free - We provide a personal match making page displaying the total count of matches. The supplier is informed about interested buyers to contact them for further info.</p>
                            </li>
                            <li>
                                <p>Pay As You Go: You can avail other services by paying for it before using to customize your plan</p>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>

            <div class="row" id="market-feature">
                <div class="col-sm-12 pos-rel">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="feature-bottom-left-ellipse" />

                    <div class="feature-detail-wrap">
                        <h3 class="feature-title">Market Leader Features</h3>

                        <ul>
                            <li>
                                <p>Matchmaking matches buyers with suppliers. In this promotional package both the Matchmaking for Buyers and for Suppliers is Free and can generate an unlimited number of matches. You will receive the information of all potential clients who match the products or services that you provide.</p>
                            </li>
                            <li>
                                <p>With a banner that does not rotate with other banners at a prominent location, you position your company as a leading company for the coming 12 months.</p>
                            </li>
                            <li>
                                <p>In this package, an advertisement is included for a year. The place and specs of the advertisement will be in consultation with the editor and are depending on the goals of your marketing campaign.</p>
                            </li>
                            <li>
                                <p>Adding your company logo to your name and company details in the industry ‘Who is Who’ buyers guide is an ideal way to be found by your customers.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <div class="modal fade" id="congrats" role="dialog" aria-labelledby="congrats" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                
                <div class="modal-body p-5">
                    <div class="text-center">
                    <img class="mb-4" src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                   

                        <div id="basicText">
                        <span>
                        <h3 class="text-red f-14">Thank you for subscribing!</h3>
                        <p class="mb-0">You have successfully subscribed to our basic plan.</p>
                        <p class="mb-0 f-14">To avail more features you can upgrade to promotional or market leader plan.</p>
                        </span></div>
                        <div class="text-center mt-4">
                            <a class="td-none" href="<?php echo base_url(); ?>">
                                <span class="red-btn">Start Exploring</span>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($this->session->flashdata('flash_success') ) { ?>
    <script>
        $('#congrats').modal('toggle');
    </script>
<?php } ?>
</body>