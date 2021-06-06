<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
    <input type="hidden" id="reqpage" class="reqpagevalue" value="Add your case study form">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pb-4 pl-3 pr-3">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                    <div class="col-sm-12 p-0">
                        <div class="pl-5 pr-5">
                            <h4 class="pt-4 text-title-small">ADD YOUR CASE STUDY</h4>
                            <h5 class="sub-description-dark fs-16 mt-4">Note:</h5>
                            <ul class="news-letter-wrap note-wrap">
                                <li><span class="pl-3">The post should be related to processing technologies, ingredients and additives, rice & flour milling.</span></li>
                                <li><span class="pl-3">Articles should be between 200-800 words and all content must be in English</span></li>
                                <li><span class="pl-3">Newsletter subscription form</span></li>
                                <li><span class="pl-3">All articles are reviewed and might be edited by our moderator team before being published</span></li>
                            </ul>
                            <p class="text-title-small mt-5 mb-2 fw-500">
                                Please complete the below form accurately to enlist your case study with us
                            </p>
                        </div>
                    </div>
                    <div class="pl-5">
                        <div class="write-for-us-form">

                            <form action="<?php echo base_url('store_resource') ?>" method="post" id="add_resource_frm" enctype="multipart/form-data">
                                <input type="hidden" name="type" value="case_study" />
                                <div class="row p-2">
                                    <input type="hidden" name="<?= $name; ?>" value="<?= $hash; ?>" />
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Case Study Title <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9 "><input type="text" name="title" id="title" class="form-control form-control-custom" placeholder="Enter Case Study Title "></div>
                                </div>
                                <div class="row p-2">
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Description <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9 "><textarea class="form-control form-control-custom" name="description" id="description" rows="3" placeholder="Write Description "></textarea></div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Industry Sector <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9 ">
                                        <!-- <input type="text" name="industry" id="industry" class="form-control form-control-custom" placeholder="Enter Industry Sector" > -->
                                        <select class="form-control" name="industry" id="industry" required>
                                            <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                            <?php
                                            if (isset($sector_list)) :
                                                foreach ($sector_list as $row) :

                                            ?>
                                                    <option value="<?php echo $row->vic_bn_sector_name; ?>"><?php echo $row->vic_bn_sector_name; ?></option>
                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Publisher <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9 "><input type="text" name="publisher" id="publisher" class="form-control form-control-custom" placeholder="Enter Publisher"></div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Region <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9 ">
                                        <!--  <input type="text" name="region" id="region" class="form-control form-control-custom" placeholder="Enter Publisher" > -->
                                        <select class="form-control" name="region" id="region" required>
                                            <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                            <?php
                                            if (isset($country_list)) :
                                                foreach ($country_list as $row) :

                                            ?>
                                                    <option value="<?php echo $row->Name; ?>"><?php echo $row->Name; ?></option>


                                            <?php
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Email Id <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control form-control-custom" name="email" id="email" placeholder="Enter Email Id">
                                        <small class="form-text text-light-grey">Contact fields will not be visible to the site visitors. Interested visitors requesting for additional information
                                            about your uploaded resource will be notified by an e-mail</small>
                                    </div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 "><label class="m-0" for="usr">Date <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9 "><input name="date" id="date" type="date" class="form-control form-control-custom" placeholder="Enter Date"></div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Presentation <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9  pos-rel">
                                        <div class="center-align-lable">
                                            <button type="button" id="upload-Presentation-button" class="custom-file-upload">Upload</button>
                                            <span id="upload-Presentation-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                                        </div>
                                        <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-Presentation-file" name="prentation_file" />
                                    </div>
                                </div>
                                <div class="row p-2 ">
                                    <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Attachment <span class="text-danger">*</span> </label></div>
                                    <div class="col-sm-9  pos-rel">
                                        <div class="center-align-lable">
                                            <button type="button" id="upload-Document-button" class="custom-file-upload">Upload</button>
                                            <span id="upload-Document-file-name" class="input-file-name">Allowed file extensions: PDF, DOCX, PPTX, maximum file size: 10MB</span>
                                        </div>
                                        <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-Document-file" name="doc_file" />
                                    </div>
                                </div>
                                <div class=" row p-2  text-center ">
                                    <div class="col-sm-12">
                                        <button type="submit" id="submit" class="btn btn-blue pl-5 pr-5 mt-4">Submit</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 col-md-3 pr-5">
                    <h5 class="pt-4 text-title-small">Newsletters</h5>
                    <ul class="news-letter-wrap">
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/showtime-subscription-form">Showtime subscription form</a></li>
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/advertising-form">Showtime advertisement form</a></li>
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/admin/subscribe">Newsletter subscription form</a></li>
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/network-subscription-form">Network subscription form</a></li>
                    </ul>
                    <div id="advertisment-list">
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
    </div>
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