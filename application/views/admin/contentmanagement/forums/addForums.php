<div class="container-fluid body-wrapper pl-24vw">
    <?php
    $attributes = array('id' => 'forum_frm');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Forums</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <!-- <li class="breadcrumb-item" aria-current="page">Forums</li> -->
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/forums/forums">Forums</a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                        </ol>
                    </nav>
                </h4>
                <?php if (isset($fdata) && !empty($fdata)) : ?>
                    <a data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id('<?php echo $fdata->idvic_forum; ?>')" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else : ?>
                    <a href="<?php echo base_url('admin/content-management/forums/forums'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif; ?>
                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>
                <a href="#" onclick="preive_forum()" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-wrapper height-50">

                <input type="hidden" value="<?php if (isset($fdata) && !empty($fdata)) {
                                                echo $fdata->idvic_forum;
                                            } ?>" name="id">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Forum Name<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter Forum Name" value="<?php if (isset($fdata) && !empty($fdata)) {
                                                                                                                                    echo $fdata->vic_forumname;
                                                                                                                                } ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sector<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <!-- <input type="text" class="form-control" name="sector" id="sector" placeholder="Enter Sector" value="<?php if (isset($fdata) && !empty($fdata)) {
                                                                                                                                        echo $fdata->vic_forumsectorname;
                                                                                                                                    } ?>"> -->
                        <select class="form-control" name="sector" id="sector" required="">
                            <option value="" disabled="" selected="" hidden="" class="placeholder-text">Select</option>
                            <option value="Additives &amp; raw materials">Additives &amp; raw materials</option>
                            <option value="Automation &amp; control">Automation &amp; control</option>
                            <option value="Logistics">Logistics</option>
                            <option value="Machinery &amp; equipments">Machinery &amp; equipments</option>
                            <option value="Quality control">Quality control</option>
                            <option value="Safety &amp; environment">Safety &amp; environment</option>
                            <option value="Services">Services</option>
                            <option value="Additives">Additives</option>
                            <option value="All about feeds">All about feeds</option>
                            <option value="Animal feed">Animal feed</option>
                            <option value="Animal nutrition">Animal nutrition</option>
                            <option value="Aqua feed">Aqua feed</option>
                            <option value="Biomass">Biomass</option>
                            <option value="De molenaar">De molenaar</option>
                            <option value="Far eastern agriculture">Far eastern agriculture</option>
                            <option value="Milling">Milling</option>
                            <option value="Pet foods">Pet foods</option>
                            <option value="Rice milling">Rice milling</option>
                            <option value="Wooden pellets">Wooden pellets</option>
                            <option value="World grain">World grain</option>
                            <option value="Processing Technology">Processing Technology</option>
                            <option value="Ingredients and Additives">Ingredients and Additives</option>
                            <option value="Rice and Flour Milling">Rice and Flour Milling</option>
                            <option value="Food">Food</option>
                            <option value="Grain &amp; Rice ">Grain &amp; Rice </option>
                            <option value="Animal Health">Animal Health</option>
                            <option value="Farming">Farming</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Submit Your Response<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                         <textarea class="form-control" rows="4" name="response" id="response"><?php if (isset($fdata) && !empty($fdata)): echo $fdata->vic_forumdescription; endif; ?></textarea> 
                         <!-- <div id="editor"><?php if (isset($fdata) && !empty($fdata)): echo $fdata->vic_forumdescription; endif; ?></div>     -->
                    </div>
                </div>
                <!-- <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="forumDate"  name="date" placeholder="Enter Date" <?php if (isset($fdata) && !empty($fdata)) : ?> value="<?php echo $fdata->vic_created_at;
                                                                                                                                                                            endif; ?>">
                        </div>
                    </div> -->
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
                    <h6 class="pt-3 text-blue f-14 mb-3" id="title">
                        <?php if (isset($fdata) && !empty($fdata)) {
                            echo $fdata->vic_forumname;
                        } ?>
                    </h6>
                    <p class="text-title-small f-14" id="p_sector">
                        <?php if (isset($fdata) && !empty($fdata)) {
                            echo $fdata->vic_forumsectorname;
                        } ?>
                    </p>
                    <p class="text-title-small f-14" id="desc">
                        <?php if (isset($fdata) && !empty($fdata)) {
                            echo $fdata->vic_forumdescription;
                        } ?>
                    </p>
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
                        <button type="button" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
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
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text fs-20">Confirm Reject </p>
                    <div class="text-center">
                        <button type="button" onclick="reject_forum()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Publish Modal -->
<div class="modal fade" id="publishForum" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                    <p class="pt-3 modal-center-text"><?php echo $value; ?> successfully on Victam portal</p>
                    <div class="text-center">
                        <a href="<?php echo base_url(); ?>admin/content-management/forums/forums" type="button" class="add-company-details">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
 <?php if (isset($fdata) && !empty($fdata)): ?>
     $('#sector').val('<?php echo $fdata->vic_forumsectorname; ?>');
             
 <?php endif;?>
 
</script>