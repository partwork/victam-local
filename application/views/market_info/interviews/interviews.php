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
                    <h4>INTERVIEWS</h4>

                    <div class="row loader_div" id="loader_div">
                        <div class="col-sm-7">
                            <div class="form-group pos-rel m-0">
                                <input type="text" class="form-control form-control-custom mr-inf-search" placeholder="Search for interviews by keywords">
                                <i class="fa fa-search news-search-icon mr_inf_sarch_btn" data-page="interview"></i>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="dropdown row pos-rel center-align-lable">
                                <label class="text-right col-sm-4 f-14 mb-0">Industry sector</label>
                                <div class="col-sm-8">
                                    <select class="form-control function-drp-list" id="industry_drop" required>
                                        <!-- <option value="" disabled selected hidden class="placeholder-text">Select</option> -->
                                        <option value="">All Sectors</option>
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
                        </div>
                    </div>

                    <div class="row" id="accordion">

                        <?php
                        if (isset($interview_data)) :
                            $i = 0;
                            foreach ($interview_data as $key => $value) :
                        ?>

                                <div class="col-sm-3 pt-3 pb-3">
                                    <div class="card">
                                        <?php if(isset($value->vic_bn_youtubeURL) && $value->vic_bn_youtubeURL!=''): ?>
                                        <iframe width="100%" height="166" src="<?php echo $value->vic_bn_youtubeURL; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        <?php elseif(isset($value->vic_blogs_news_video) && $value->vic_blogs_news_video!=''): ?>
                                            <video controls width="100%" height="166">
                                              <source src="<?php echo base_url('upload/interviews/'.$value->vic_blogs_news_video);?>" type="video/mp4">
                                              Your browser does not support the video tag.
                                            </video>
                                        <?php endif; ?>
                                        <div class="text-center p-2 interview-title">
                                            <a href="javascript:void(0)"> <?php echo $value->vic_bn_title; ?></a>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            endforeach;
                          endif;
                        ?>
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