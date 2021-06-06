<script src="<?php echo base_url(); ?>application/assets/admin/contentmanagement/virtualent.js"></script>
<div class="container-fluid body-wrapper pl-24vw">
    <?php
        $attributes = array('id' => 'add_video');
        echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Video</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"></li>
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/virtual-entertainment/video">Video</a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                        </ol>
                    </nav>
                </h4>
                <?php if(isset($video_data) && !empty($video_data)):?>
                <a data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id('<?php echo $video_data->idvic_promoted_video;?>')" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else: ?>
                <a href="<?php echo base_url('admin/content-management/virtual-entertainment/video');?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif;?>
                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>
                <a href="#" onclick="preive_virtual_vid()" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-wrapper">
                <input type="hidden" value="<?php if(isset($video_data) && !empty($video_data)){echo $video_data->idvic_promoted_video;}?>" name="id">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Video Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vname" id="vname" placeholder="Enter Video Name" value="<?php if(isset($video_data) && !empty($video_data)){echo $video_data->vic_promoted_video_title;}?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Description<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" placeholder="Enter Description" id="vdesc" name="vdesc" rows="4"><?php if(isset($video_data) && !empty($video_data)){echo $video_data->vic_promoted_video_position;}?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">YouTube URL<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="vfile" name="vfile" placeholder="Enter Embed YouTube URL" value="<?php if(isset($video_data) && !empty($video_data)){echo $video_data->vic_promoted_video_url;}?>">
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="vdate" id="forumDate" placeholder="Enter Date" value="<?php if(isset($video_data) && !empty($video_data)){echo date('Y-m-d',strtotime($video_data->vic_created_at));}?>">
                        </div>
                    </div>
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
                <div class="text-center">
                    <h6 class="pt-3 text-blue fs-18 mb-3" id="title">Video Title</h6>
                    <!-- <video width="100%" height="240" controls>
                        <source src="<?php if(isset($video_data) && !empty($video_data)){echo $video_data->vic_promoted_video_url;}?>" type="video/mp4">
                    </video> -->
                    <div class="ifram_div">
                        
                    </div>

                    
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
                        <button type="button"  onclick="reject_video()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Publish Modal -->
<div class="modal fade" id="publishvirtaul" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text">Published successfully on Victam portal</p>
                    <div class="text-center">
                        <a href="<?php echo base_url(); ?>admin/content-management/virtual-entertainment/video" type="button" class="add-company-details">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>