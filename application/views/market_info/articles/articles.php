<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    .more {
        display: none;
    }
</style>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
    </div>


    <section class="pb-5 pl-5 pr-3 ">
        <div class="row">
            <div class="col-12 col-sm-12 col-lg-9 col-md-9">

                <div class="pl-3 pt-3">
                    <h4 class="text-title-small mt-3 mb-3">ARTICLES</h4>

                    <div class="row loader_div" id="loader_div">
                        <div class="col-sm-4">
                            <div class="form-group pos-rel m-0">
                                <input type="text" class="form-control form-control-custom mr-inf-search" placeholder="Search for news by keywords">
                                <i class="fa fa-search news-search-icon mr_inf_sarch_btn" data-page="article"></i>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="dropdowns center-align-dropdown pos-rel row">
                                <label class="text-right col-sm-3 mb-0 pr-0">Publisher</label>
                                <div class="col-sm-9">
                                    <select class="form-control publisher_drop" id="publisher_drop" required>
                                        <!-- <option value="" disabled selected hidden class="placeholder-text">Select</option> -->
                                        <option value="">All Publishers</option>
                                        <?php
                                        if (isset($publisher_list) && !empty($publisher_list)) :
                                            foreach ($publisher_list as $key => $value) :
                                        ?>
                                                <option value="<?php echo $value->vic_bn_firstname ?>"><?php echo $value->vic_bn_firstname; ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="dropdowns center-align-dropdown pos-rel row">
                                <label class="text-right col-sm-4 mb-0 pr-0">Industry sector</label>
                                <div class="col-sm-8">
                                    <select class="form-control function-drp-list" id="industry_drop" required>
                                        <!-- <option value="" disabled selected hidden class="placeholder-text">Select</option> -->
                                        <option value="">All Sectors</option>
                                        <?php
                                        // if (isset($sector_list) && !empty($sector_list)) :
                                        //     foreach ($sector_list as $key => $value) :
                                        ?>
                                        <?php
                                        if (isset($sector_list) && !empty($sector_list)) :
                                            foreach ($sector_list as $key => $value) :
                                                $text='';
                                                switch ($value->vic_bn_sector_name) {
                                                    case 'Ingredients and Additives':
                                                        $text='Ingredients & Additives';
                                                        break;
                                                    case 'Rice and Flour Milling':
                                                        $text='Rice & Flour Milling';
                                                        break;
                                                    default:
                                                        $text=$value->vic_bn_sector_name;
                                                        break;
                                                }
                                               
                                        ?>
                                                <option value="<?php echo $value->vic_bn_sector_name ?>"><?php echo $text; ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12">
                            <h6 class="accordian-title">Listed article based on filter</h6>
                            <div id="accordion">
                                <?php
                                $show = '';
                                if (isset($article_data)) {
                                    $i = 0;
                                    foreach ($article_data as $key => $value) {
                                        $urlMatch = $_SERVER['REQUEST_URI'];
                                        $pattern = '/[0-9]/';
                                        if (preg_match($pattern, $urlMatch)) {
                                            $show = '';
                                        }else{
                                            $show = ($i == 0) ? 'show' : '';
                                        }
                                        $i=$value->idvic_blogs_news;
                                        $original_string = ($value->vic_bn_storytext=='') ? $value->vic_description : $value->vic_bn_storytext;
                                        $limited_string = word_limiter($original_string, 30, '');
                                        $rest_of_string = trim(str_replace($limited_string, "", $original_string));
                                ?>
                                        <div class="card">
                                            <div id="heading<?php echo $i; ?>">
                                                <div class="d-flex accordian-btn" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse<?php echo $i; ?>">
                                                    <p class="news-title text-blue f-14"><?php echo $value->vic_bn_title; ?></p>
                                                    <i class="fa fa-angle-down drop-down-arrow-accordion" aria-hidden="true"></i>
                                                </div>
                                            </div>

                                            <div id="collapse<?php echo $i; ?>" class="collapse <?php echo $show; ?>" aria-labelledby="heading<?php echo $i; ?>" data-parent="#accordion">
                                                <div class="card-body plr-15">
                                                    <p class="text-justify mb-0 f-14"> <?php echo $limited_string; ?>
                                                    <span id="dots<?php echo $value->idvic_blogs_news; ?>">...</span><span id="more<?php echo $i;?>" class='more'><?php echo $rest_of_string; ?></span></p>

                                                    <div class="news-footer">
                                                        <span class="float-right news-date"><?php echo date('M d Y', strtotime($value->vic_bn_createdat)); ?></span>
                                                        <span class="float-left">
                                                             <span><a href="javascript:void(0)" class="visit-website text-blue" onclick="readmore(<?php echo $value->idvic_blogs_news; ?>)" id="myBtn<?php echo $i; ?>"> Read More </a></span>
                                                            <span><a href="<?php echo $value->vic_blogs_website_url; ?>" target="_blank" class="visit-website text-blue"> Visit website </a></span>
                                                            <span><a target="_blank" href="<?php echo base_url('source_download/' . $value->idvic_blogs_news); ?>" class="download text-blue"> Download </a></span>
                                                            <a href="https://www.facebook.com/dialog/share?app_id=<?php echo $this->config->item('facebook_app_id'); ?>&href=http://dev.victam.com/e/CommonController/get_articles_by_id/<?php echo $value->idvic_blogs_news ?>&display=popup" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/facebook.png" height="11" width="11"></span>
                                                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_articles_by_id/<?php echo $value->idvic_blogs_news ?>" target="__blank"><span class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/linkedin.png" height="11" width="11"></span></a>
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
    <!-- Chatbot -->
    <?php $this->load->view('shared/chatbot/chatbot'); ?>


</body>