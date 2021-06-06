<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
        <section class="pb-4 pl-3 pr-3">
            <section class="pb-5 pl-5 pr-3 pt-3 ">
                <h4>VIDEO GALLERY</h4>
                <div class="row pl-5 pr-5">
                    <?php
                        if(isset($list) && $list!=NULL):
                            foreach ($list as $key => $value):
                    ?>
                    <div class="col-sm-3 pt-3 pb-3 ">
                        <iframe width="100%" height="200px" src="<?php echo $value->vic_promoted_video_url;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    
                   <?php
                       endforeach;
                     endif;
                   ?> 
                    
                </div>
            </section>

        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>
    </div>

</body>