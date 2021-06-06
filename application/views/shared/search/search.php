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

 
    <section class="pb-5 pl-5 pr-3 container">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="pl-3 pt-3">
                    <div class="row loader_div" id="loader_div">
                        <div class="col-sm-12">
                            <div class="form-group pos-rel mt-4">
                                <input type="text" class="form-control form-control-custom mr-inf-search"
                                    placeholder="Search" id="searchparam">
                                <i class="fa fa-search news-search-icon mr_inf_sarch_btn" data-page='news' id="searchresult"></i>
                            </div>
                        </div> 
                    </div>
                    <div class="row mt-4" id="foreachresult">
                    <?php if ($this->session->userdata('userId')) : ?>
                        <?php if(isset($result)) :  ?>
                            <?php if($result) : ?>
                                <?php foreach($result as $list) : ?>
                                    <div class="col-sm-12 mt-3">
                                        <div class="news-card">
                                            <h6 class="text-blue fs-16"><?php echo $list->vic_bn_title; ?></h6>
                                            <p class="f4-14 mb-3"><?php echo word_limiter($list->vic_bn_storytext, 40); ?></p>
                                            <a href="<?php echo base_url('news/'.$list->idvic_blogs_news); ?>" class="read-more text-blue"> Read More </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="alert alert-danger">No data Found</div>
                            <?php endif; ?>
                        <?php else : ?>
                        <div class="alert alert-danger">No data Found</div>
                        <?php endif; ?>
                    <?php else :  ?>
                        <div class="alert alert-danger">You Need to Login to search the content</div>
                    <?php endif; ?>
                    </div>

                    <div class="row mt-4" id="ajaxresult">
                    </div>
                    
                    <!-- <div class="row mt-4">
                        <div class="col-sm-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid p-0">
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
    </div>

    <?php $this->load->view('shared/footer/footer'); ?>
    <!-- Chatbot -->
    <?php $this->load->view('shared/chatbot/chatbot'); ?>

    <script type="text/javascript">
    <?php
        if (isset($id) && $id != NULL) :
        ?>
    //readmore('<?php echo $id; ?>');
    $('#collapse<?php echo $id; ?>').collapse();


    <?php endif; ?>
    </script>
</body>