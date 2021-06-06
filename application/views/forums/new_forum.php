<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
    </div>

    <section class="pl-5">
        <section class="pl-4 pt-3">

            <input type="hidden" id="reqpage" class="reqpagevalue" value="Open A New Forum Form">
            <div class="row">
                <div class="col-sm-9">
                    <h4>OPEN A NEW FORUM</h4>
                    <p class="home-sub-text-heading">The form below will allow you to create a forum. Please note that the forum has to be relevant for the industry and that moderation
                        and post controls are set via forum permissions. In case of abusive or intolerant content or language, the user could be blocked to
                        use the portal.</p>
                    <div class="add-forum-form mt-4">


                        <form id="addForumForm" method="POST">
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Forum Name<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="forumName" name="forumName" class="form-control form-control-custom" placeholder="Enter Forum Name"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Add Sector <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                    <select class="form-control" id="sector" name="sector" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
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
                            <div class="row p-2 mb-3">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Forum Description<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                    <!-- <textarea class="form-control" rows="3" id="forumDescription" name="forumDescription"></textarea> -->
                                   <!--  <div id="editor">
                                        
                                        
                                    </div> -->
                                    <textarea class="form-control" rows="3" id="forumDescription" name="forumDescription"></textarea>
                                </div>
                            </div>

                            <div class=" row p-2  text-center ">
                                <div class="col-sm-12 mt-5">
                                    <button type="submit" id="submit" class="btn btn-blue btn-sm pl-5 pr-5">Submit</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <div class="col-sm-3 mt-5">
                    <section>
                        <h6 class="newsletters">Newsletters</h6>
                        <a href="https://victam.com/showtime-subscription-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Showtime subscription form</a>
                        <a href="https://victam.com/advertising-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Showtime advertisement form</a>
                        <a href="https://victam.com/admin/subscribe" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Newsletter subscription form</a>
                        <a href="https://victam.com/network-subscription-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Who-Is-Who subscription form</a>
                    </section>
                    <div class="" id="advertisment-list">
                
                    </div>
                    <!-- <img class="advertis-img pl-0" src="<?php echo base_url(); ?>application/assets/shared/img/photos/group_891.png" height="200px">
                    <img class="advertis-img pl-0" src="<?php echo base_url(); ?>application/assets/shared/img/photos/group_889.png" height="300px">
                    <img class="advertis-img pl-0" src="<?php echo base_url(); ?>application/assets/shared/img/photos/group_892.png" height="150px"> -->
                </div>
            </div>
        </section>
    </section>
    <?php if ($this->session->flashdata('category_success')) { ?>
        <script>
            toastr["success"]("<?= $this->session->flashdata('category_success') ?>");
        </script>
    <?php } ?>
    <?php if ($this->session->flashdata('category_error')) { ?>
        <script>
            toastr["error"]("<?= $this->session->flashdata('category_error') ?>");
        </script>
    <?php } ?>
</body>