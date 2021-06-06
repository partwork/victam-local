<div class="container-fluid body-wrapper pl-24vw">

    <?php
    $attributes = array('id' => 'whitepaper-form');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>White Paper</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Resource Library</li>
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/resource-library/whitePaper">White Paper</a> </li>
                            <?php if ($activePage ==  'Edit') { ?>
                                <li class="breadcrumb-item active" aria-current="page">Edit White Paper</li>
                            <?php } else { ?>
                                <li class="breadcrumb-item active" aria-current="page">Add White Paper</li>
                            <?php } ?>
                        </ol>
                    </nav>
                </h4>
                <?php if (isset($inv_data) && !empty($inv_data)) : ?>
                    <a data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id('<?php echo $inv_data->idvic_resource_library; ?>')" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else : ?>
                    <a href="<?php echo base_url('admin/content-management/resource-library/whitePaper'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif; ?>
                <!-- <a href="#" data-toggle="modal" data-target="#publish" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4">Publish</a> -->
                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>
                <a href="#" onclick="resource_preview()" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-wrapper">
                <input type="hidden" value="<?php if (isset($type)) {
                                                echo $type;
                                            } else {
                                                echo 'whitepapers';
                                            } ?>" name="r_type">
                <input type="hidden" value="<?php if (isset($inv_data) && !empty($inv_data)) {
                                                echo $inv_data->idvic_resource_library;
                                            } ?>" name="id">
                <input type="hidden" value="<?php if (isset($inv_data) && !empty($inv_data)) {
                                                echo $inv_data->idvic_resource_library;
                                            }else{echo '';} ?>" id="inv_id">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">White Paper Title<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control inn_name" <?php if (isset($inv_data) && !empty($inv_data)) : ?> value="<?php echo $inv_data->vic_resource_title; ?>" <?php endif; ?> name="inn_name" id="inn_name" placeholder="Enter White Paper Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Description<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <textarea class="form-control inn_desc" name="inn_desc" id="inn_desc" rows="4" placeholder="Enter Description"><?php if (isset($inv_data) && !empty($inv_data)) : ?> <?php echo trim($inv_data->vic_resource_desc); ?> <?php endif; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Industry Sector<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <select class="form-control inn_industry" name="inn_industry" id="inn_industry">
                            <option value="" disabled selected hidden class="placeholder-text">Select Industry Sector</option>
                            <?php
                            if (isset($sector_list) && !empty($sector_list)) :
                                foreach ($sector_list as $value) :
                            ?>
                                    <option value="<?php echo $value->vic_bn_sector_name; ?>"><?php echo $value->vic_bn_sector_name; ?></option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Publisher<span class="text-danger">*</span></label>
                    <div class="col-sm-8 pos-rel">
                        <input type="text" class="form-control inn_publisher" placeholder="Enter Publisher Name" name="inn_publisher" id="inn_publisher" <?php if (isset($inv_data) && !empty($inv_data)) : ?> value="<?php echo $inv_data->vic_resource_publisher; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Region<span class="text-danger">*</span></label>
                    <div class="col-sm-8 pos-rel">
                        
                       <select class="form-control inn_region" name="inn_region" id="inn_region" required>
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
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Email<span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control inn_email" placeholder="Enter Email" name="inn_email" id="inn_email" <?php if (isset($inv_data) && !empty($inv_data)) : ?> value="<?php echo $inv_data->vic_resource_email; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Date<span class="text-danger">*</span></label>
                    <div class="col-sm-8 pos-rel">
                        <input type="text" class="form-control ridatepicker" id="ridatepicker" placeholder="Enter Date" name="inn_date" <?php if (isset($inv_data) && !empty($inv_data)) : ?> value="<?php echo date('Y-m-d', strtotime($inv_data->vic_resource_date)); ?>" <?php endif; ?>>
                        <!-- <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/datepicker.png" class="calender-icon"/> -->
                    </div>
                </div>

                <div class="form-group row upload-image-wrapper-outer">
                    <label class="col-sm-4 col-form-label">Case Study Attachment <span class="text-danger">*</span></label>
                    <!-- <div class="col-sm-8 center-align-lable">
                            <input type="file" id="upload-attachment-file" hidden="hidden" name="inn_doc" />
                            <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                            <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: MP4, maximum file size: 50MB</span>
                        </div> -->
                    <div class="col-sm-8  pos-rel">
                        <div class="center-align-lable">
                            <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                            <span id="upload-video-file-name" class="input-file-name">Allowed file extensions: PDF maximum file size: 15MB</span>
                        </div>
                        <input class="form-control visibility-hidden" onchange="readURL(this,'inv_file');" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="inn_doc" />
                        <input type="hidden" value="<?php if(isset($inv_data) && $inv_data->vic_resource_thumbnail!=''){echo base_url('upload/resource_library/'.$inv_data->vic_resource_thumbnail);}?>" id="inv_file">
                    </div>
                </div>
                <div class="form-group row upload-image-wrapper-outer">
                    <label class="col-sm-4 col-form-label">Presentation <span class="text-danger">*</span></label>
                    <!-- <div class="col-sm-8 center-align-lable">
                            <input type="file" id="upload-presentation-file" hidden="hidden" name="inn_presentation" />
                            <button type="button" id="upload-presentation-button" class="custom-file-upload">Upload</button>
                            <span id="upload-presentation-file-name" class="input-file-name">Allowed file extensions: MP4, maximum file size: 50MB</span>
                        </div> -->
                    <div class="col-sm-8  pos-rel">
                        <div class="center-align-lable">
                            <button type="button" id="upload-presentation-button" class="custom-file-upload">Upload</button>
                            <span id="upload-presentation-file-name" class="input-file-name">Allowed file extensions: MP4, maximum file size: 50MB</span>
                        </div>
                        <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-presentation-file" name="inn_presentation" onchange="readURL(this,'inv_video');" />
                        <input type="hidden" value="<?php if(isset($inv_data) && $inv_data->vic_resource_presentation!=''){echo base_url('upload/resource_library/'.$inv_data->vic_resource_presentation);}?>" id="inv_video">

                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-sm-4 col-form-label">YouTube URL</label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="Enter YouTube URL" class="form-control" value="<?php if (isset($inv_data) && !empty($inv_data)) {
                                                                                                            echo $inv_data->vic_resource_youtube_url;
                                                                                                        } ?>" name="inn_url" id="inn_url">
                    </div>
                </div> -->
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<!-- <div class="modal fade" id="preview" role="dialog" aria-labelledby="preview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-left">
                    <h6 class="pt-3 text-blue f-14 mb-3"><?php if (isset($inv_data) && !empty($inv_data)) : echo $inv_data->vic_resource_title;
                                                            endif; ?></h6>
                     <iframe width="600" height="400" src="<?php if (isset($inv_data) && !empty($inv_data)) : echo base_url('upload/resource_library/' . $inv_data->vic_resource_docs);
                                                            endif; ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="preview" role="dialog" aria-labelledby="preview" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-left">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-5 text-center">
                            <a href="javascript:void(0)" class="view_doc_model p_file" data-url="<?php if (isset($inv_data) && !empty($inv_data)): echo base_url('upload/resource_library/'.$inv_data->vic_resource_docs); endif;?>">
                                    <img src="https://banner2.cleanpng.com/20180428/gie/kisspng-computer-icons-data-file-document-file-format-5ae44cd0f26028.4611855915249113129928.jpg" width="140" height="100"> 
                                </a>
                                <!-- <h6 class="pt-1 text-blue f-14 mb-3 p_title">
                                    <?php if (isset($inv_data) && !empty($inv_data)) : ?> <?php echo $inv_data->vic_resource_title; ?><?php endif; ?>
                                </h6> -->
                            </div>
                            <div class="col-sm-7 mt-3 preview-comp-details">
                                <p class="text-title-small fs-12 mb-1"><span>Name </span>- <span class="p_title">
                                        <?php if (isset($inv_data) && !empty($inv_data)) : echo $inv_data->vic_resource_title;
                                        endif; ?>
                                    </span></p>
                                <p class="text-title-small fs-12 mb-1"><span>Industry Sector </span>- <span class="p_sector">
                                        <?php if (isset($inv_data) && !empty($inv_data)) : echo $inv_data->vic_resource_industrysector;
                                        endif; ?>
                                    </span></p>
                                <p class="text-title-small fs-12 mb-1"><span>Publisher </span>- <span class="p_publisher">

                                        <?php if (isset($inv_data) && !empty($inv_data)) : echo $inv_data->vic_resource_publisher;
                                        endif; ?>
                                    </span></p>
                                <p class="text-title-small fs-12 mb-1"><span>Email </span>- <span class="p_email">
                                        <?php if (isset($inv_data) && !empty($inv_data)) : echo $inv_data->vic_resource_email;
                                        endif; ?>
                                    </span></p>
                                <p class="text-title-small fs-12 mb-1"><span>Date </span>- <span class="p_date">
                                        <?php if (isset($inv_data) && !empty($inv_data)) : echo date('Y-m-d', strtotime($inv_data->vic_resource_date));
                                        endif; ?>
                                    </span></p>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <h6 class="pt-1 text-blue f-14 mb-3">Description</h6>
                                <p class="text-title-small fs-12 p_desc">
                                    <?php if (isset($inv_data) && !empty($inv_data)) : ?> <?php echo trim($inv_data->vic_resource_desc); ?> <?php endif; ?>
                                </p>
                            </div>
                            <div class="col-sm-12 mt-3">
                                <h6 class="pt-1 text-blue f-14 mb-3">Presentation</h6>
                                <video width="100%" height="240" controls class="p_video" <?php if (isset($inv_data) && !empty($inv_data)) : ?> src="<?php echo base_url(trim('upload/resource_library/'.$inv_data->vic_resource_presentation)); ?>" <?php endif; ?> type="video/mp4">
                                    
                                </video>
                            </div>
                        </div>
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
                        <button type="button" onclick="reject_resource()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
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
                        <button type="button" onclick="window.history.back();" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <!-- <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php if (isset($inv_data) && !empty($inv_data)) : ?>
        $('#inn_industry').val('<?php echo $inv_data->vic_resource_industrysector; ?>')
        $('#inn_region').val('<?php echo $inv_data->vic_resource_region; ?>');
    <?php endif; ?>
</script>