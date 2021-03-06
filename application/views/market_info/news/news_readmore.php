<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
    </div>


    <section class="pb-5 pl-5 pr-3 ">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-9 col-md-9">

                <div class="pl-3 pt-3">
                    <h4 class="text-title-small mt-3 mb-3">NEWS</h4>
                    <div class="row loader_div" id="loader_div">
                        <div class="col-sm-12 center-align-dropdown">
                            <div class="form-group pos-rel w-60 m-0">
                                <input type="text" class="form-control form-control-custom mr-inf-search" placeholder="Search for news by keywords">
                                <i class="fa fa-search news-search-icon mr_inf_sarch_btn" data-page='news'></i>
                            </div>
                            <!-- <div class="center-align-lable"> -->
                            <div class="dropdown w-40 center-align-dropdown pos-rel">
                                <label class="text-right mr-3 mb-0">Industry sector</label>
                                <!-- <button class="btn select-group w-60" type="button" id="SelectFunction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="selected-option">Industry sector</span>
                                    <img class="drop-down-arrow" src="<?php echo base_url(); ?>application/assets/shared/img/icon/drop-down-arrow.png" class="drp-arrow">
                                </button>
                                <div class="dropdown-menu dropdown-menu-width function-drp-list w-60" id="industry_drop" aria-labelledby="SelectFunction">
                                    <a class="dropdown-item" href="javascript:void(0)">Processing Technology</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Ingredients and Additives </a>
                                    <a class="dropdown-item" href="javascript:void(0)">Rice & Flour Milling</a>
                                </div> -->
                                <select class="form-control function-drp-list" id="industry_drop">
                                    <option value="">Select</option>
                                    <?php 
                                      if(isset($sector_list) && !empty($sector_list)):
                                        foreach ($sector_list as $key => $value):
                                    ?>
                                     <option value="<?php echo $value->vic_bn_sector_name?>"><?php echo $value->vic_bn_sector_name;?></option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                </select>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <h6 class="accordian-title">Listed news based on filter</h6>
                            <div id="accordion">
                                <?php
                                $show = '';
                                if (isset($news_data)) {
                                    $i = 0;
                                    foreach ($news_data as $key => $value) {
                                        $show = ( $i == 0 ) ? 'show': '';
                                        $i++;
                                ?>
                                        <div class="card">
                                            <div id="heading<?php echo $i; ?>">
                                                <div class="d-flex accordian-btn" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                                    <p class=" news-title text-blue f-14" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>"><?php echo $value->vic_bn_title; ?></p>
                                                    <!-- <img class="drop-down-arrow-accordion drop-down-arrow-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" src="<?php echo base_url(); ?>application/assets/shared/img/icon/drop-down-arrow.png" class="drp-arrow"> -->
                                                    <i class="fa fa-angle-down drop-down-arrow-accordion" aria-hidden="true"></i>
                                                </div>
                                            </div>

                                            <div id="collapse<?php echo $i; ?>" class="collapse <?php echo $show; ?> " aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordion">
                                                <div class="card-body plr-15">
                                                    <p class="text-justify mb-0 f-14"> <?php echo $i; ?> <?php echo $value->vic_bn_storytext; ?></p>
                                                    <div class="news-footer">
                                                        <span class="float-right news-date"><?php echo date('M d Y', strtotime($value->vic_bn_createdat)); ?></span>
                                                        <span class="float-left">
                                                            <!-- <span><a href="<?php echo base_url('news_readmore/'.$value->idvic_blogs_news);?>" target="_blank" class="visit-website text-blue"> Read More </a></span> -->
                                                            <span><a href="<?php echo $value->vic_visit_website;?>" target="_blank" class="visit-website text-blue"> Visit website </a></span>
                                                            <span><a href="<?php echo base_url('source_download'.$value->idvic_blogs_news);?>" class="download text-blue"> Download </a></span>
                                                            <a href="https://www.facebook.com/dialog/share?app_id=<?php echo $this->config->item('facebook_app_id'); ?>&href=http://dev.victam.com/e/CommonController/get_news_details_by_id/<?php echo $newsdata->idvic_blogs_news ?>&display=popup" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/facebook.png" height="11" width="11"></span>
                                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=http://dev.victam.com&title=<?php echo $value->vic_bn_title .' - '.$value->vic_bn_storytext; ?>" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/linkedin.png" height="11" width="11"></span></a>
                                                            <a href="https://twitter.com/intent/tweet?text=<?php echo $value->vic_bn_title .' - '.$value->vic_bn_storytext; ?>" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/twitter.png" height="11" width="11"></span></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
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

    <?php $this->load->view('shared/footer/footer'); ?>

</body>