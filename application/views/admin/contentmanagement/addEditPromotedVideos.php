<div class="container-fluid body-wrapper pl-24vw">

    <form id="addVideo-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="isempty_promot" id="isempty_promot" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->idvic_promoted_video ?>" <?php endif; ?>>
        <input type="hidden" name="idvic_promoted_video" id="idvic_promoted_video" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->idvic_promoted_video ?>" <?php endif; ?>>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-top-elements">
                    <h4 class="page-title-wrap">
                        <span>Promoted Videos</span>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                                <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/home/promoted-videos">Promoted Videos</a> </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                            </ol>
                        </nav>
                    </h4>
                    <?php if (isset($content['0'])) : ?>
                        <a href="javascript:void(0)" data-toggle="modal" onclick="content_id(<?php echo $content['0']->idvic_promoted_video ?>)" data-target="#rejectConfirmationModal" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                        <?php else: ?>
                            <a href="<?php echo base_url('admin/content-management/home/promoted-videos');?>"  class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                        <?php endif; ?>
                    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                        <?php $value = 'Publish'; ?>
                        <?php $value2 = 'Preview'; ?>

                    <?php else : ?>
                        <?php $value = 'Save'; ?>
                        <?php $value2 = 'Review'; ?>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value; ?>>

                    <a href="#" onclick="preview_videos()" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4"><?php echo $value2; ?></a>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrapper">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Video Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control cname" placeholder="Enter Video Title" value="<?php if (isset($content[0]->idvic_promoted_video)) {
                                                                                                                            echo $content[0]->vic_promoted_video_title;
                                                                                                                        } ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Video Position</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="position" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Video Position</option>
                                <?php
                                  $default_position=array('1','2','3');
                                  $db_position=array();
                                  if(isset($position) && !empty($position)){
                                    $db_position=$position; 
                                   }
                                   $str='';
                                   foreach ($default_position as $key => $value)
                                   {
                                       $disable=''; 
                                       $selected='';
                                       $style='';
                                      if(in_array($value,$db_position,true))
                                      {
                                        $disable='disabled';
                                        $style='color:gray;';
                                      }  
                                      if (isset($content['0']->vic_promoted_video_position) && $content['0']->vic_promoted_video_position==$value)
                                      {
                                        $selected='selected'; 
                                        $disable='';
                                      }
                                      $str.='<option value="'.$value.'" '.$style.' '.$disable.' '.$selected.'>'.$value.'</option>';         
                                   }
                                     
                                    
                                    echo $str;
                                ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Duration</label>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper ">
                                <label class="col-form-label mr-3">From</label>
                                <input type="text" class="form-control fromdate" id="logoFrom" name="dFrom" placeholder="Enter Date" <?php if (isset($content['0'])) : ?> value="<?php echo date('Y-m-d', strtotime($content['0']->vic_promoted_video_duration_from)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper ">
                                <label class="col-form-label mr-3">To</label>
                                <input type="text" class="form-control todate" id="logoTo" name="dTo" placeholder="Enter Date" <?php if (isset($content['0'])) : ?> value="<?php echo date('Y-m-d', strtotime($content['0']->vic_promoted_video_duration_to)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-2 "><label class="m-0" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-10 ">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input  type="radio" class="form-check-input" <?php if (isset($content['0']->vic_promoted_upload_video) && $content['0']->vic_promoted_upload_video != '') : ?> checked <?php endif; ?> name="videoType" value="mp4"> MP4 Video
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" <?php if (isset($content['0']->vic_promoted_video_url) && $content['0']->vic_promoted_video_url!= '') : ?> checked <?php endif; ?> name="videoType" value="youTube"> YouTube URL
                                </label>
                            </div>
                        </div>
                    </div>

                    <input id="media_data" name="media_data" type="hidden" value="">
                    <div class="form-group row upload-image-wrapper-outer upload-mp4 display-none">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                                <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                            </div>
                            <input onchange="readURL(this);" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="uploadAttachment" />
                        </div>
                    </div>
                    <div class="form-group row you-tube-url display-none">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" name="youtubeurl" id="youtubeurl" class="form-control youtubeurl" placeholder="Enter Embed YouTube URL " <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_promoted_video_url ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row pt-2">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <label class="switch">
                                <?php if (isset($content['0'])) : ?>
                                    <?php if ($content['0']->vic_promoted_video_is_active == 'active') : ?>
                                        <input type="checkbox" checked name="status" value="active">
                                        <span class="slider round"></span>
                                    <?php else : ?>
                                        <input type="checkbox" name="status">
                                        <span class="slider round"></span>
                                    <?php endif; ?>
                                <?php else :  ?>
                                    <input type="checkbox" checked name="status" value="active">
                                    <span class="slider round"></span>
                                <?php endif; ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
                    <h6 class="pt-3 text-blue fs-18 mb-3" id="title"></h6>
                    <div id="source_content"></div>
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
                        <button type="button" class="add-company-details" onclick="window.history.back();" data-dismiss="modal" aria-label="Close">OK</button>
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
                        <button type="button" class="add-company-details"  onclick="reject_promoted_video()" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function() {
          
            <?php
            if (isset($content['0']->vic_promoted_upload_video) && $content['0']->vic_promoted_upload_video != '') :
            ?>
                $(".upload-mp4").removeClass('display-none');
                $(".you-tube-url").addClass('display-none');
                $("#youtubeurl").val('');
                $('#media_data').val("<?php echo base_url('upload/promoted/'.$content['0']->vic_promoted_upload_video);?>");
            <?php endif; ?>

            <?php
            if (isset($content['0']->vic_promoted_video_url) && $content['0']->vic_promoted_video_url != '') :
            ?>
                $(".you-tube-url").removeClass('display-none');
                $(".upload-mp4").addClass('display-none');
                $("#youtubeurl").val('<?php echo $content['0']->vic_promoted_video_url ?>');
                $("#upload-attachment-file").val('');
                $("#upload-attachment-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');
                $('#media_data').val("<?php echo $content['0']->vic_promoted_video_url; ?>");
            <?php endif; ?>
        })
    </script>