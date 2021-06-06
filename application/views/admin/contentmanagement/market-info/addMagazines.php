<script type="text/javascript">
    var ajax_url = $('#ajax_url').val();
</script>
<div class="container-fluid body-wrapper pl-24vw">

    <?php
    $attributes = array('id' => 'magzine_form');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Magazines</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/market-info/magazines">Magazines</a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php if ($activePage == 'addMagazines') { ?> Edit Magazines <?php } else { ?> Add Magazines <?php } ?> </li>
                        </ol>
                    </nav>
                </h4>
                <?php if (isset($mkt_data) && !empty($mkt_data)) : ?>

                    <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id(<?php if (isset($mkt_data)) : ?><?php echo $mkt_data->idvic_blogs_news ?><?php endif; ?>)" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else : ?>
                    <a href="<?php echo base_url('admin/content-management/market-info/magazines'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif; ?>

                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>

                <a href="#" onclick="preview_magazine()" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-wrapper">
                <input type="hidden" value="<?php if (isset($type)) {
                                                echo $type;
                                            } else {
                                                echo 'magzine';
                                            } ?>" name="type">
                <input type="hidden" id="isempty_magzin" name="id" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->idvic_blogs_news; ?>" <?php endif; ?>>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Magazine Title<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter Magazine Title" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_bn_title; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Issue<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="issue" id="issue" placeholder="Enter Issue" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_description; ?>" <?php endif; ?>>
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Volume<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="volume" id="volume" placeholder="Enter Volume" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_bn_storytextdoc; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Year<span class="text-danger">*</span></label>
                    <div class="col-sm-9 pos-rel">
                        <input type="text" name="year" id="year" class="form-control" placeholder="Enter Year" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_bn_position; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row upload-image-wrapper-outer">
                    <label class="col-sm-3 col-form-label">Upload PDF Thumbnail<span class="text-danger">*</span></label>
                    <div class="col-sm-9  pos-rel">
                        <div class="center-align-lable">
                            <button type="button" id="upload-presentation-button" class="custom-file-upload">Upload</button>
                            <span id="upload-presentation-file-name" class="input-file-name">Allowed file extensions: jpg,png,jpeg maximum file size: 5MB</span>
                        </div>
                        <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-presentation-file" name="upload_pdf_thumb" />
                    </div>
                    
                </div>
                <div class="form-group row upload-image-wrapper-outer">
                    <label class="col-sm-3 col-form-label">Upload PDF<span class="text-danger">*</span></label>
                    <div class="col-sm-9  pos-rel">
                        <div class="center-align-lable">
                            <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                            <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: PDF maximum file size: 15MB</span>
                        </div>
                        <input onchange="readURL(this);" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="mkt_file" id="mkt_file" />
                        
                        <input id="media_data" name="media_data" type="hidden" <?php if (isset($mkt_data)) : ?> value="<?php echo base_url('upload/marketing_info/'.$mkt_data->vic_bn_document_url); ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <label class="switch">
                            <input type="checkbox" name="status" id="status" value="active" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> <?php if ($mkt_data->vic_bn_status == 'active'): echo 'checked'; endif; endif; ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>
 
<!-- Preview Modal -->
<div class="modal fade" id="preview" role="dialog" aria-labelledby="preview" aria-hidden="true" style="height:100%;">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="height:100%;max-width:90%;margin:0 auto;">
        <div class="modal-content" style="height:100%;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="top:0;right:2px;">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body" style="height:100%;">
               <div id="preview_div"></div>
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
                        <button type="button" onclick="reject_mkt()" class="add-company-details">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
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
                        <button type="button" onclick="window.location.href=ajax_url+'admin/content-management/market-info/magazines';" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <!-- <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>