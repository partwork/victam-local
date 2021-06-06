<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <input type="hidden" id="reqpage" value="Add your events form">
        <?php $this->load->view('shared/header/header'); ?>
    </div>

    <section class="pl-5">
        <section class="pl-4 pt-3">
            <h4>ADD YOUR EVENT </h4>
            <p class="home-sub-text-heading">Any event within the scope of this portal could be included in the list. To include your event for free please fill
                in the below form accurately.</p>

            <div class="row">
                <div class="col-sm-9">
                    <?php
                    if (($this->session->flashdata('error')) != NULL) {
                        echo '<p class="status-msg error">' . $this->session->flashdata('error') . '</p>';
                    }
                    ?>
                    <div class="add-event-form">
                        <?php
                        $attributes = array('id' => 'addEventForm', 'enctype' => 'multipart/form-data');
                        echo form_open_multipart('e/EventsController/add_event', $attributes);
                        ?>
                        <input type="hidden" id="userPlan" value="<?php echo $this->session->userdata('plan_id'); ?>"> 
                        <?php $event_data = $this->session->userdata('eventdata');   ?>
                        
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Event Category <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 ">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="eventCategory" value="Online" <?php if (!empty($event_data)) {
                                                                                                                        if ($event_data['vic_eventtype'] == 'virtual exhibition' || $event_data['vic_eventtype'] == 'Webinar' || $event_data['vic_eventtype'] == 'meeting') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?>> Online Events
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="eventCategory" value="Onsite" <?php if (isset($event_data)) {
                                                                                                                        if ($event_data['vic_eventtype'] == 'Exhibition' || $event_data['vic_eventtype'] == 'Conference' || $event_data['vic_eventtype'] == 'seminars') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    }?>> Onsite Events
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php
                        $display = 'display-none';$display1 = 'display-none'; 
                        if(!empty($event_data) && ($event_data['vic_eventtype'] == 'virtual exhibition' || $event_data['vic_eventtype'] == 'Webinar' || $event_data['vic_eventtype'] == 'meeting')) $display = '';
                        if(!empty($event_data) && ($event_data['vic_eventtype'] == 'Exhibition' || $event_data['vic_eventtype'] == 'Conference' || $event_data['vic_eventtype'] == 'seminars')) $display1 = '';
                    ?>  
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Event Type<span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 ">
                                <select id="eventType" name="eventType" class="form-control form-control-custom" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option class="<?=$display?> online-events" value="virtual exhibition" <?php if(!empty($event_data) && $event_data['vic_eventtype'] && $event_data['vic_eventtype']=='virtual exhibition') echo 'selected'; ?>>Virtual Exhibition</option>
                                    <option class="<?=$display?> online-events" value="Webinar" <?php if(!empty($event_data) && $event_data['vic_eventtype'] && $event_data['vic_eventtype']=='Webinar') echo 'selected'; ?>>Webinar</option>
                                    <option class="<?=$display?> online-events" value="meeting" <?php if(!empty($event_data) && $event_data['vic_eventtype'] && $event_data['vic_eventtype']=='Meeting') echo 'selected'; ?>>Meeting</option>
                                    <option class="<?=$display1?> onsite-events" value="Exhibition" <?php if(!empty($event_data) && $event_data['vic_eventtype'] && $event_data['vic_eventtype']=='Exhibition') echo 'selected'; ?>>Exhibition</option>
                                    <option class="<?=$display1?> onsite-events" value="Conference" <?php if(!empty($event_data) && $event_data['vic_eventtype'] && $event_data['vic_eventtype']=='Conference') echo 'selected'; ?>>Conference</option>
                                    <option class="<?=$display1?> onsite-events" value="seminars" <?php if(!empty($event_data) && $event_data['vic_eventtype'] && $event_data['vic_eventtype']=='seminars') echo 'selected'; ?>>Seminars</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Event Name <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><input type="text" id="title" name="title" class="form-control form-control-custom" placeholder="Enter Event Name" autocomplete="off" 
                            value="<?php if (!empty($event_data) && $event_data['vic_eventtitle']) { echo $event_data['vic_eventtitle']; } ?>"></div>
                        </div>
                        <!-- <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Organizer <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><input type="text" id="organizer" name="organizer" class="form-control form-control-custom" placeholder="Enter Organizer "></div>
                        </div> -->
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Organizer Name <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><input type="text" id="cName" name="cName" class="form-control form-control-custom" placeholder="Enter Organizer Name " value="<?php if (!empty($event_data) && $event_data['vic_organizer']) { echo $event_data['vic_organizer']; } ?>"></div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Sectors<span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 ">
                                <select id="sector2" name="sector" class="form-control form-control-custom" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <?php foreach ($sectors as $sector) : ?>
                                        <option value="<?= $sector->vic_bn_sector_id ?>" <?php if(!empty($event_data) && $sector->vic_bn_sector_id==$event_data['vic_sector_id']) echo 'selected';?>><?= $sector->vic_bn_sector_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Date <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "> <input type="text" id="date" name="date" class="form-control form-control-custom" autocomplete="off" value="<?php if (!empty($event_data) && $event_data['vic_date']) {
                                                                                                                                            echo date('Y-m-d', strtotime($event_data['vic_date']));
                                                                                                                                        } ?>"></div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Frequency </label></div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="m-0" for="usr">Repeat</label>
                                            <select class="form-control" name="frequency" id="repeatType" required>
                                                <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                                <!-- <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option> -->
                                                <option value="Monthly" <?php if(!empty($event_data) && $event_data['vic_eventfrequency']=='Monthly') echo 'selected';?>>Monthly</option>
                                                <option value="Annually" <?php if(!empty($event_data) && $event_data['vic_eventfrequency']=='Yearly') echo 'selected';?>>Yearly</option>
                                                <option value="Biennially" <?php if(!empty($event_data) && $event_data['vic_eventfrequency']=='Biennially') echo 'selected';?>>Biennially</option>
                                                <option value="Every 3 years" <?php if(!empty($event_data) && $event_data['vic_eventfrequency']=='Every 3 years') echo 'selected';?>>Every 3 years</option>
                                                <option value="Every 4 years" <?php if(!empty($event_data) && $event_data['vic_eventfrequency']=='Every 4 years') echo 'selected';?>>Every 4 years</option>
                                                <option value="Custom" <?php if(!empty($event_data) && $event_data['vic_eventfrequency']=='Custom') echo 'selected';?>>Custom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="m-0" for="usr">From</label>
                                        <input type="text" id="fromDate" name="fromDate"  class="form-control form-control-custom" autocomplete="off" value="<?php if (!empty($event_data) && $event_data['vic_eventstartdate']) {
                                                                                                                                        echo date('Y-m-d', strtotime($event_data['vic_eventstartdate']));
                                                                                                                                    }?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="m-0" for="usr">To</label>
                                        <input type="text" id="toDate" name="toDate"  class="form-control form-control-custom" autocomplete="off" value="<?php if (!empty($event_data) && $event_data['vic_eventenddate']) {
                                                                                                                                        echo date('Y-m-d', strtotime($event_data['vic_eventenddate']));
                                                                                                                                    }?>">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php if ($this->session->userdata('plan_id') == 3 || $this->session->userdata('plan_id') == 2) { ?>

                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Time <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-3 "> <input type="time" id="eventTime" name="eventTime" class="form-control form-control-custom" autocomplete="off" value="<?php if (!empty($event_data) && $event_data['vic_eventtime']) {
                                                                                                                                        echo $event_data['vic_eventtime'];
                                                                                                                                    }?>"></div>
                        </div>
                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Event Description <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><textarea id="description" name="description" class="form-control form-textarea" rows="4" placeholder="Event Description"><?php if (!empty($event_data) && $event_data['vic_eventdesc']) {
                                                                                                                                        echo $event_data['vic_eventdesc'];
                                                                                                                                    }?></textarea></div>
                        </div>

                        <?php } ?>

                        <?php if ($this->session->userdata('plan_id') == 3 || $this->session->userdata('plan_id') == 2) { ?>

                        <div class="row p-2">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Event Website URL <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><input type="text" id="websiteURL" name="websiteURL" class="form-control form-control-custom" placeholder="Enter Event Website URL" value="<?php if (!empty($event_data) && $event_data['vic_event_website_url']) {
                                                                                                                                        echo $event_data['vic_event_website_url'];
                                                                                                                                    }?>"></div>
                        </div>

                        
                        <div class="row p-2 display-none onsite-events">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Venue <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><input type="text" id="venue" name="venue" class="form-control form-control-custom" placeholder="Enter Venue" value="<?php if (!empty($event_data) && $event_data['vic_eventvenue']) {
                                                                                                                                        echo $event_data['vic_eventvenue'];
                                                                                                                                    }?>"></div>
                        </div>
                        <div class="row p-2 display-none online-events">
                            <div class="col-sm-3 "><label class="m-0" for="usr">Registration URL <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9 "><input type="text" id="registrationURL" name="registrationURL" class="form-control form-control-custom" placeholder="Enter Registration URL" value="<?php if (!empty($event_data) && $event_data['vic_registration_url']) {
                                                                                                                                        echo $event_data['vic_registration_url'];
                                                                                                                                    }?>"></div>
                        </div>
                        

                       
                        <div class="row p-2 ">
                            <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Logo <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9  pos-rel">
                                <div class="center-align-lable">
                                    <button type="button" id="upload-logo-btn" class="custom-file-upload">Upload</button>
                                    <span id="upload-logo-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                                </div>
                                <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-logo-file" name="uploadLogo" />
                            </div>
                        </div>

                        <div class="row p-2 ">
                            <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Banners <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9  pos-rel">
                                <div class="center-align-lable">
                                    <button type="button" id="upload-banner-btn" class="custom-file-upload">Upload</button>
                                    <span id="upload-banner-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                                </div>
                                <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-banner-file" name="uploadBanners[]" multiple/>
                            </div>
                        </div>
                        <div class="row p-2 ">
                            <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Advertisement<span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9  pos-rel">
                                <div class="center-align-lable">
                                    <button type="button" id="upload-advertisement-btn" class="custom-file-upload">Upload</button>
                                    <span id="upload-advertisement-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                                </div>
                                <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-advertisement-file" name="uploadAdvertisement[]" multiple />
                            </div>
                        </div>
                        <div class="row p-2 ">
                            <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Conclusion Report </label></div>
                            <div class="col-sm-9  pos-rel">
                                <div class="center-align-lable">
                                    <button type="button" id="upload-report-btn" class="custom-file-upload">Upload</button>
                                    <span id="upload-report-file-name" class="input-file-name">Allowed file extensions: PDF, DOCX, PPTX, maximum file size: 10MB</span>
                                </div>
                                <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-report-file" name="uploadReport[]" multiple />
                            </div>
                        </div>
                        <div class="row p-2 ">
                            <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Photos <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9  pos-rel">
                                <div class="center-align-lable">
                                    <button type="button" id="upload-photos-btn" class="custom-file-upload">Upload</button>
                                    <span id="upload-photos-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                                </div>
                                <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-photos-file" name="uploadPhotos[]" multiple />
                            </div>
                        </div>
                        <div class="row p-2 ">
                            <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                            <div class="col-sm-9  pos-rel">
                                <div class="center-align-lable">
                                    <button type="button" id="upload-video-btn" class="custom-file-upload">Upload</button>
                                    <span id="upload-video-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                                </div>
                                <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-video-file" name="uploadVideo[]" multiple />
                            </div>
                        </div>
                        
                        <?php } else{ ?>
                            <div class="row">
                            <div class="col-sm-3 visibility-hidden ">.</div>
                            <div class="col-sm-9 ">
                                <h6 class="media-brochure ml-1">To add more detailed event information upgrade your plan or buy this feature - <a href="<?php echo base_url(); ?>pricing"> Upgrade now! </a> </h6>
                            </div>
                        </div>

                            
                        <?php } ?>

                        <div class=" row p-2 text-center mt-4">
                            <div class="col-sm-12">
                                <!-- <?php if (!($this->session->userdata('userId'))) echo "disabled"; ?> -->
                                <button type="submit" id="submit" class="btn btn-blue btn-sm pl-5 pr-5">Submit</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="col-sm-3">
                    <section>
                        <h6 class="newsletters">Newsletters</h6>
                        <a href="https://victam.com/showtime-subscription-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Showtime subscription form</a>
                        <a href="https://victam.com/advertising-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Showtime advertisement form</a>
                        <a href="https://victam.com/admin/subscribe" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Newsletter subscription form</a>
                        <a href="https://victam.com/network-subscription-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Who-Is-Who subscription form</a>
                    </section>
                    <div class="" id="advertisment-list">
                </div>
                </div>
            </div>
        </section>
    </section>
</body>
<?php if ($this->session->flashdata('flash_success')) { ?>
    <script>
        toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
    </script>
<?php }
if ($this->session->flashdata('flash_error')) { ?>
    <script>
        toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
    </script>
<?php } ?>