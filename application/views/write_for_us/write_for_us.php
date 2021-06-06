<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pb-4 pl-3 pr-3">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                    <div class="pl-5">
                        <h4 class="pt-4">WRITE FOR US</h4>
                        <h6 class="pt-3 sub-description-dark">Would you like to share an interesting and relevant news or story with Victam. We are happy to receive guest's articles, interviews, news and contributions
                            under the following conditions:</h6>

                        <p class="sub-description-light m-0">The post should be related to processing technologies, ingredients & additives, rice & flour milling and the like</p>
                        <ul class="post-info-wrap">
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>Articles should be between 200-800 words.</span>
                            </li> 
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>All content must be in English and be 100% original.</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>The text should not be commercial and can not include links unless they are relevant.</span>
                            </li>
                            <li class="post-info">
                                <img class="mr-2" src="<?php echo base_url(); ?>application/assets/shared/img/icon/gamepad.png" height="12" width="12">
                                <span>All articles are reviewed and might be edited by our team before being published.</span>
                            </li>
                        </ul>
                        <h6 class="media-brochure pb-3">It is important that you provide accurate contact information so if need to we can contact you with questions related to your
                            news. </h6>

                        <?php
                        $attributes = array('id' => 'writeForUsForm');
                        echo form_open_multipart('e/WriteforusController/store', $attributes);
                        ?>
                        <div class="write-for-us-form">
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Name<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="name" name="name" class="form-control form-control-custom" placeholder="Enter Name"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Position<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="position" name="position" class="form-control form-control-custom" placeholder="Enter Position"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Company Name<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="companyName" name="companyName" class="form-control form-control-custom" placeholder="Enter Company Name"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Phone Number<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="phone" name="phone" class="form-control form-control-custom" onkeypress="return onlyNumberKey(event)" placeholder="Enter Phone Number"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Address Details<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="address" name="address" class="form-control form-control-custom" placeholder="Enter Address line 1"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "></div>
                                <div class="col-sm-9 "><input type="text" id="addressOne" name="addressOne" class="form-control form-control-custom" placeholder="Enter Address line 2"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">City<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" id="city" name="city" class="form-control form-control-custom" placeholder="Enter City">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 pl-0 pr-0">
                                                    <label class="m-0" for="usr">Zip Code <span class="text-danger">*</span> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" id="zipCode" name="zipCode" class="form-control form-control-custom" onkeypress="return onlyNumberKey(event)" placeholder="Enter Zip Code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Country <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                <!-- <input type="text" id="country" name="country" class="form-control form-control-custom" placeholder="Enter Country"> -->
                                    <select class="form-control form-control-custom" id="country" name="country" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select Country</option>
                                        <?php foreach ($countries as $country) : ?>
                                            <option class="dropdown-item" value="<?= $country->name ?>"><?= $country->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Type</label></div>
                                <div class="col-sm-9 pos-rel">
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="news">
                                        <label class="form-check-label" for="inlineRadio1">News</label>
                                    </div>
                                    <div class=" form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="interview">
                                        <label class="form-check-label" for="inlineRadio2">Interview</label>
                                    </div>
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="article">
                                        <label class="form-check-label" for="inlineRadio3">Article</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Category <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                    <div class="form-group mb-0">
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="" disabled selected hidden>Select Category</option>
                                            <option value="processing technology">Processing Technology</option>
                                            <option value="ingredients and additives"> Ingredients & Additives</option>
                                            <option value="rice and flour milling">Rice & Flour Milling</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Title <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="title" name="title" class="form-control form-control-custom" placeholder="Enter Title"></div>
                            </div>
                            <div class="row p-2 description">
                                <div class="col-sm-3"><label class="m-0" for="usr">Description </label></div>
                                <div class="col-sm-9"><textarea class="form-control form-control-custom" rows="3" id="description" name="description" placeholder="Write Description"></textarea></div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Keywords <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="keyword" name="keyword" class="form-control form-control-custom" placeholder="Enter Keywords"></div>
                            </div>
                            <div class="row p-2 upload-image">
                                <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Website URL</label></div>
                                <div class="col-sm-9  pos-rel">
                                    <input type="text" id="websiteurl" name="websiteurl" class="form-control form-control-custom" placeholder="Enter Website Url">
                                </div>
                            </div> 

                            <div class="video-type">

                            <div class="row">
                                <div class="col-sm-3 "><label class="ml-2" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="videoType" value="mp4"> MP4 Video
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="videoType" value="youTube"> YouTube URL
                                        </label>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row p-2 upload-mp4 display-none">
                                <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr"> </label></div>
                                <div class="col-sm-9  pos-rel">
                                    <div class="center-align-lable">
                                        <button type="button" id="upload-video-button" class="custom-file-upload">Upload</button>
                                        <span id="upload-video-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                                    </div>
                                    <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-video-file" name="uploadVideo" />
                                </div>
                            </div>

                            <div class="row p-2 you-tube-url display-none">
                                <div class="col-sm-3 "><label class="m-0" for="usr"> </label></div>
                                <div class="col-sm-9 "><input type="text" id="youtubeUrl" name="youtubeUrl" class="form-control form-control-custom" placeholder="Enter Embedded Youtube URL"></div>
                            </div>

                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Captcha</label></div>
                                <div class="col-sm-9 mt-2 " id="recaptcha">
                                    <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                                    <input type="text" class="form-control visibility-hidden" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                </div>
                            </div>
                            <div class=" row p-2  text-center ">
                                <div class="col-sm-12">
                                    <button type="submit" id="submit" class="btn btn-blue btn-sm pl-3 pr-3">Submit</button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
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

    </div>

    <?php if ($this->session->flashdata('flash_success')) { ?>
        <script>
            toastr["success"]("Your information updated successfully. It is under review now and will be posted soon!");
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('flash_error')) { ?>
        <script>
            toastr["error"]("Failed to updated information");
        </script>
    <?php } ?>
</body>