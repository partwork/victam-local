<script src="<?php echo base_url(); ?>application/assets/admin/contentmanagement/events.js"></script>
<style type="text/css">
    .selected-option{
        color :black !important;
    }
</style>
<div class="container-fluid body-wrapper pl-24vw">
    <?php
    $attributes = array('id' => 'add_events');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Events</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/contentmanagement/events/events">Events</a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                        </ol>
                    </nav>
                </h4>
                <?php if (isset($event_data) && !empty($event_data)) : ?>
                    <a data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id('<?php echo $event_data->idvic_events; ?>')" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else : ?>
                    <a href="<?php echo base_url('admin/contentmanagement/events/events'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif; ?>
                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>
                <a href="#" onclick="preview_event()" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-wrapper">
                <input type="hidden" id="event_no" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                echo $event_data->idvic_events;
                                                            } ?>" name="id">
                <input type="hidden" name="user_type" id="user_type" value="<?php if (isset($event_data) && !empty($event_data)) : echo $user_type;
                                                                            endif; ?>">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Event Category<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="eventCategory" value="Online" <?php if (isset($event_data)) {
                                                                                                                        if ($event_data->vic_eventtype == 'virtual exhibition' || $event_data->vic_eventtype == 'Webinar' || $event_data->vic_eventtype == 'meeting') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?>> Online Events
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="eventCategory" value="Onsite" <?php if (isset($event_data)) {
                                                                                                                        if ($event_data->vic_eventtype == 'Exhibition' || $event_data->vic_eventtype == 'Conference' || $event_data->vic_eventtype == 'seminars') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?>> Onsite Events
                            </label>
                        </div>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Event Category<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="eventCategory" value="Online" 
                                <?php if (isset($event_data) && !empty($event_data)) {
                                    if (in_array($event_data->vic_eventtype, $online_event_type)) {
                                        echo 'checked';
                                    }
                                } ?>> Online Events
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="eventCategory" value="Onsite" <?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                        if (in_array($event_data->vic_eventtype, $offline_event_type)) {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?>> Onsite Events
                            </label>
                        </div>
                    </div>
                </div> -->
                <?php
                $display = 'display-none';
                $display1 = 'display-none';
                if (!empty($event_data) && ($event_data->vic_eventtype == 'virtual exhibition' || $event_data->vic_eventtype == 'Webinar' || $event_data->vic_eventtype == 'meeting')) $display = '';
                if (!empty($event_data) && ($event_data->vic_eventtype == 'Exhibition' || $event_data->vic_eventtype == 'Conference' || $event_data->vic_eventtype == 'seminars')) $display1 = '';
                ?>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Event Type<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select id="eventType" name="eventType" class="form-control form-control-custom selected-option">
                            <option selected disabled>Select Event Type</option>
                            <option class=" online-events <?= $display ?>" value="virtual exhibition" <?php if (!empty($event_data) && $event_data->vic_eventtype && $event_data->vic_eventtype == 'virtual exhibition') echo 'selected'; ?>>Virtual Exhibition</option>
                            <option class=" online-events <?= $display ?>" value="Webinar" <?php if (!empty($event_data) && $event_data->vic_eventtype && $event_data->vic_eventtype == 'Webinar') echo 'selected'; ?>>Webinar</option>
                            <option class=" online-events <?= $display ?>" value="meeting" <?php if (!empty($event_data) && $event_data->vic_eventtype && $event_data->vic_eventtype == 'Meeting') echo 'selected'; ?>>Meeting</option>
                            <option class=" onsite-events <?= $display1 ?>" value="Exhibition" <?php if (!empty($event_data) && $event_data->vic_eventtype && $event_data->vic_eventtype == 'Exhibition') echo 'selected'; ?>>Exhibition</option>
                            <option class=" onsite-events <?= $display1 ?>" value="Conference" <?php if (!empty($event_data) && $event_data->vic_eventtype && $event_data->vic_eventtype == 'Conference') echo 'selected'; ?>>Conference</option>
                            <option class=" onsite-events <?= $display1 ?>" value="seminars" <?php if (!empty($event_data) && $event_data->vic_eventtype && $event_data->vic_eventtype == 'seminars') echo 'selected'; ?>>Seminars</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Organizer Name<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="organizer" id="organizer" placeholder="Enter Organizer" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                            echo $event_data->vic_organizer;
                                                                                                                                        } ?>">
                    </div>
                </div>
                <!-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="evn_name" id="evn_name" placeholder="Enter Event Name" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                            echo $event_data->vic_eventname;
                                                                                                                                        } ?>">
                        </div>
                    </div> -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Event Name<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="title" name="title" class="form-control" placeholder="Enter Event Name" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                    echo $event_data->vic_eventtitle;
                                                                                                                                } ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sectors<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-control form-control-custom selected-option" id="sector" name="sector">
                            <option selected disabled> Select Sector </option>
                            <?php
                            if (isset($sector_list)) :
                                foreach ($sector_list as $value) :
                            ?>
                                    <option value="<?php echo $value->vic_bn_sector_id; ?>" <?php if (!empty($event_data) && $value->vic_bn_sector_id == $event_data->vic_sector_id) echo 'selected'; ?>><?php echo $value->vic_bn_sector_name; ?></option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-sm-3  col-form-label "><label class="m-0" for="usr">Date <span class="text-danger">*</span> </label></div>
                    <div class="col-sm-9 "> <input type="text" id="date" name="date" class="form-control form-control-custom" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                            echo date('Y-m-d', strtotime($event_data->vic_date));
                                                                                                                                        } ?>"></div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Frequency<span class="text-danger">*</span></label>

                    <div class="col-sm-3">
                        <div class="date-input-wrapper">
                            <label class="col-form-label ">Repeat</label>
                            <div class="form-group">
                                <select class="form-control selected-option" name="frequency" id="repeatType">
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Monthly">Monthly</option>
                                    <option value="Annually">Yearly</option>
                                    <option value="Biennially">Biennially</option>
                                    <option value="Every 3 years">Every 3 years</option>
                                    <option value="Every 4 years">Every 4 years</option>
                                    <option value="Custom">Custom</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="date-input-wrapper">
                            <label class="col-form-label">From</label>
                            <input type="text" class="form-control fromdate" name="eventFrom" id="eventFrom" placeholder="Enter Date" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                    echo date('Y-m-d', strtotime($event_data->vic_eventstartdate));
                                                                                                                                                } else {
                                                                                                                                                    echo '';
                                                                                                                                                } ?>">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="date-input-wrapper">
                            <label class="col-form-label">To</label>
                            <input type="text" class="form-control todate" name="eventTo" id="eventTo" placeholder="Enter Date" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                            echo date('Y-m-d', strtotime($event_data->vic_eventenddate));
                                                                                                                                        } else {
                                                                                                                                            echo '';
                                                                                                                                        } ?>">
                        </div>
                    </div>
                </div>
                <?php if ($user_type == 3 || $user_type == 2) : ?>
                    <div class="form-group row ">
                        <div class="col-sm-3  col-form-label "><label class="m-0" for="usr">Time <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9 "> <input type="time" id="eventTime" name="eventTime" class="form-control form-control-custom" value="<?php if (isset($event_data) && !empty($event_data)) {echo $event_data->vic_eventtime;} ?>"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Description<span class="text-danger">*</span></label>
                        <div class="col-sm-9 pos-rel">
                            <textarea class="form-control form-textarea" rows="4" id="evn_desc" name="evn_desc" placeholder="Enter Event Description"><?php if (isset($event_data) && !empty($event_data)) 
                                    { echo $event_data->vic_eventdesc;
                                    } ?></textarea>
                            
                        </div>
                    </div>
                <?php elseif ($user_type === '' ) : ?>
                    <div class="form-group row ">
                        <div class="col-sm-3  col-form-label "><label class="m-0" for="usr">Time <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9 "> <input type="time" id="eventTime" name="eventTime" class="form-control form-control-custom" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                        echo $event_data->vic_eventtime;
                                                                                                                                                    } ?>"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Description<span class="text-danger">*</span></label>
                        <div class="col-sm-9 pos-rel">
                            <textarea class="form-control form-textarea" rows="4" id="evn_desc" name="evn_desc" placeholder="Enter Event Description"><?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                    echo $event_data->vic_eventdesc;
                                                                                                                                                } ?></textarea>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($user_type == 3 || $user_type == 2) : ?>
                    <div class="form-group row online-events <?= $display ?>">

                        <label class="col-sm-3 col-form-label">Registration URL<span class="text-danger">*</span></label>
                        <div class="col-sm-9 "><input type="text" id="registrationURL" name="registrationURL" class="form-control form-control-custom" placeholder="Enter Registration URL" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                                                                        echo $event_data->vic_registration_url;
                                                                                                                                                                                                    } ?>"></div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Event Website URL<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="evn_url" name="evn_url" placeholder="Enter Event Website URL" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                    echo $event_data->vic_event_website_url;
                                                                                                                                                } ?>">
                        </div>
                    </div>
                    <div class="form-group row  onsite-events <?= $display1 ?>">
                        <label class="col-sm-3 col-form-label">Venue<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="evn_venue" id="evn_venue" placeholder="Enter Venue" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                            echo $event_data->vic_eventvenue;
                                                                                                                                        } ?>">
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Logo <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-logo-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-logo-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-logo-file" name="uploadLogo" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Banners <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-banner-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-banner-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-banner-file" name="uploadBanners[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Advertisement<span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-advertisement-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-advertisement-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-advertisement-file" name="uploadAdvertisement[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Conclusion Report </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-report-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-report-file-name" class="input-file-name">Allowed file extensions: PDF, DOCX, PPTX, maximum file size: 10MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-report-file" name="uploadReport[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Photos <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-photos-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-photos-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-photos-file" name="uploadPhotos[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-video-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-video-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-video-file" name="uploadVideo[]" multiple="" />
                        </div>
                    </div>
                <?php elseif ($user_type === '' ) : ?>
                    <div class="form-group row online-events <?= $display ?>">

                        <label class="col-sm-3 col-form-label">Registration URL<span class="text-danger">*</span></label>
                        <div class="col-sm-9 "><input type="text" id="registrationURL" name="registrationURL" class="form-control form-control-custom" placeholder="Enter Registration URL" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                                                                        echo $event_data->vic_registration_url;
                                                                                                                                                                                                    } ?>"></div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-sm-3 col-form-label">Event Website URL<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="evn_url" name="evn_url" placeholder="Enter Event Website URL" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                                    echo $event_data->vic_event_website_url;
                                                                                                                                                } ?>">
                        </div>
                    </div>
                    <div class="form-group row  onsite-events  <?= $display1 ?>">
                        <label class="col-sm-3 col-form-label">Venue<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="evn_venue" id="evn_venue" placeholder="Enter Venue" value="<?php if (isset($event_data) && !empty($event_data)) {
                                                                                                                                            echo $event_data->vic_eventvenue;
                                                                                                                                        } ?>">
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Logo <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-logo-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-logo-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-logo-file" name="uploadLogo" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Banners <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-banner-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-banner-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-banner-file" name="uploadBanners[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Advertisement<span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-advertisement-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-advertisement-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-advertisement-file" name="uploadAdvertisement[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Conclusion Report </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-report-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-report-file-name" class="input-file-name">Allowed file extensions: PDF, DOCX, PPTX, maximum file size: 10MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-report-file" name="uploadReport[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Photos <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-photos-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-photos-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-photos-file" name="uploadPhotos[]" multiple="" />
                        </div>
                    </div>
                    <div class="row pt-2 ">
                        <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-video-btn" class="custom-file-upload">Upload</button>
                                <span id="upload-video-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-video-file" name="uploadVideo[]" multiple="" />
                        </div>
                    </div>
                <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="preview" role="dialog" aria-labelledby="preview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-left">
                    <h6 class="pt-3 text-blue f-14 mb-3">
                        <span class="p_title"><?php if (isset($event_data) && !empty($event_data)) {
                                    echo $event_data->vic_eventtitle;
                                } ?></span>
                                <br>
                        <span class="text-title-small f-12 ml-3 fw-300"><div class="d-flex justify-content-start">
                            <p class="p_evtype"></p>&nbsp;|&nbsp;<p class="p_time"> 
                                <?php if (isset($event_data) && !empty($event_data)) {echo $event_data->vic_eventtime;} ?></p></div></span>
                    </h6>
                    <p class="text-title-small f-14 p_desc"><?php if (isset($event_data) && !empty($event_data)) {
                                                            echo $event_data->vic_eventdesc;
                                                        } ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Publish Modal -->
<div class="modal fade" id="publish" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <?php if ($this->session->userdata('usertype') == 'content moderator') : ?>
                        <?php $value = 'Saved'; ?>
                    <?php else : ?>
                        <?php $value = 'Published'; ?>
                    <?php endif; ?>
                    <p class="pt-3 modal-center-text fs-20"><?php echo $value; ?> successfully on Victam portal</p>
                    <div class="text-center">
                        <button type="button" onclick="window.history.back();" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <!-- <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Reject Confirmation Modal -->
<div class="modal fade" id="rejectConfirmationModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text fs-20">Confirm Reject </p>
                    <div class="text-center">
                        <button type="button" onclick="reject_event()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php if (isset($event_data) && !empty($event_data)) : ?>

        $('#eventType').val('<?php echo $event_data->vic_eventtype; ?>')
        $('#sector').val('<?php echo $event_data->vic_sector_id; ?>')
        $('#repeatType').val('<?php echo $event_data->vic_eventfrequency; ?>')


    <?php endif ?>

    $('input[type=radio][name=eventCategory]').change(function() {
        if (this.value == 'Online') {
            $(".onsite-events").addClass('display-none');
            $(".online-events").removeClass('display-none');
            $('#eventType').prop('selectedIndex', 0);
        } else if (this.value == 'Onsite') {
            $(".online-events").addClass('display-none');
            $(".onsite-events").removeClass('display-none');
            $('#eventType').prop('selectedIndex', 0);
        }
    });
</script>