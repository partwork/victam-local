<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div id="demo" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="carousel-img" src="<?php echo base_url(); ?>application/assets/shared/img/banners/forums-banner.png" alt="Los Angeles" width="" height="500">
                    <div class="carousel-caption">
                        <div class="carousel-caption-copy">
                            <h1 class="carousel-title text-uppercase">FORUMS</h1>
                            <p class="carousel-sub-title"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo-center text-center">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/logo-img.png" width="100" height="100">
            </div>
        </div>

        <section class="pb-5 pl-5 pr-5 ">
            <div class="pl-3 pt-3 pr-3">
                <div class="row mt-4 mb-3">
                    <div class="col-sm-12">
                        <p class="home-blue-text-heading mt-5">Open or participate in a forum to discuss items in the feed and grain industries with your colleagues all around the world</p>
                    </div>
                    <div class="col-sm-6 pt-1">
                        <!-- <h4 class="text-title-small">FORUM</h4> -->
                    </div>
                    <div class="col-sm-6 text-right">
                        <button onclick="new_forum_click_handel(<?php echo $this->session->userdata('userId'); ?> )" class="btn btn-blue btn-sm pr-4 pl-4">Open A New Forum</button>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-7">
                        <div class="form-group pos-rel">
                            <input type="text" class="form-control form-control-custom" id="search_input" placeholder="Search for forum by keywords">
                            <i class="fa fa-search news-search-icon search_btn"></i>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="dropdown pos-rel row">
                            <label class="text-right mb-0 col-sm-2 col-form-label">Display</label>
                           
                            <div class="col-sm-10">
                                <select class="form-control" id="sector_dropdown" required>
                                    <!-- <option value="" disabled selected hidden class="placeholder-text">Select</option> -->
                                    <option value="">All Sectors</option>
                                    <?php
                                    if (isset($sector_list) && !empty($sector_list)) :
                                        foreach ($sector_list as $key => $value) :
                                    ?>
                                            <option value="<?php echo $value->vic_bn_sector_name; ?>"><?php echo $value->vic_bn_sector_name; ?></option>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="list_result">
                    <?php
                    echo $forum_list;
                    ?>
                </div>
            </div>
        </section>


        <?php $this->load->view('shared/footer/footer'); ?>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>


    </div>

</body>