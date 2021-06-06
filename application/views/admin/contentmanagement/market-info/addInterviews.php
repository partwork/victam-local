<script type="text/javascript">
    var ajax_url = $('#ajax_url').val();
</script>
<div class="container-fluid body-wrapper pl-24vw">
    <?php
    $attributes = array('id' => 'interview_form');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Interviews</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/market-info/interviews">Interviews </a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php if ($activePage == 'addInterviews') { ?> Edit Interviews <?php } else { ?> Add Interviews <?php } ?> </li>
                        </ol>
                    </nav>
                </h4>
                <?php if (isset($mkt_data) && !empty($mkt_data)) : ?>
                    <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id('<?php echo $mkt_data->idvic_blogs_news; ?>')" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else : ?>
                    <a href="<?php echo base_url('admin/content-management/market-info/interviews'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif; ?>

                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>
                <!-- <a href="#" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a> -->

                <a href="#" onclick="preview_videos()" onclickd="preview_content(<?php if (isset($mkt_data)) : ?><?php echo $mkt_data->idvic_blogs_news ?><?php endif; ?>)" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" value="<?php if (isset($type)) {
                                        echo $type;
                                    } else {
                                        echo 'interview';
                                    } ?>" name="type" id="type">
        <input type="hidden" id="isempty_magzin" name="id" value="<?php if (isset($mkt_data) && !empty($mkt_data)) {
                                                                        echo $mkt_data->idvic_blogs_news;
                                                                    } ?>">
        <div class="col-sm-12">
            <div class="form-wrapper">
                <input type="hidden" name="idvic_blogs_news " <?php if (isset($mkt_data)) : ?> value="<?php echo $mkt_data->idvic_blogs_news ?>" <?php endif; ?>>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Interview Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control cname" placeholder="Enter Interview Title" name="title" id="titles" <?php if (isset($mkt_data->idvic_blogs_news)) : ?> value="<?php echo $mkt_data->vic_bn_title ?>" <?php endif; ?>>
                    </div>
                </div>
               <!--  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Interview Position</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="position" id="position" required>
                            <option value="" disabled selected hidden class="placeholder-text">Select Interview Position</option>
                            <option value="1" <?php if (isset($mkt_data->vic_bn_position) == '1') : ?> selected <?php endif; ?>>1</option>
                            <option value="2" <?php if (isset($mkt_data->vic_bn_position) == '2') : ?> selected <?php endif; ?>>2</option>
                            <option value="3" <?php if (isset($mkt_data->vic_bn_position) == '3') : ?> selected <?php endif; ?>>3</option>
                            <option value="4" <?php if (isset($mkt_data->vic_bn_position) == '4') : ?> selected <?php endif; ?>>4</option>
                            <option value="5" <?php if (isset($mkt_data->vic_bn_position) == '5') : ?> selected <?php endif; ?>>5</option>
                        </select>
                    </div>
                </div> -->
                <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sectorFilter" id="sectorFilter" >
                                <option value="" disabled selected hidden class="placeholder-text">Select Interview Category</option>
                                <option <?php if (isset($mkt_data->vic_news_category) && $mkt_data->vic_news_category == 'ingredients and additives') : ?> selected <?php endif; ?> value="ingredients and additives">Ingredients & Additives</option>
                                <option <?php if (isset($mkt_data->vic_news_category) && $mkt_data->vic_news_category == 'processing technology') : ?> selected <?php endif; ?> value="processing technology">Processing Technology</option>
                                <option <?php if (isset($mkt_data->vic_news_category) && $mkt_data->vic_news_category == 'rice and flour milling') : ?> selected <?php endif; ?> value="rice and flour milling">Rice & Flour Milling</option>
                            </select>
                        </div>
                    </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Duration</label>
                    <div class="col-sm-5">
                        <div class="date-input-wrapper ">
                            <label class="col-form-label mr-3">From</label>
                            <input type="text" class="form-control fromdate" id="lnInterviewFrom" name="lnInterviewFrom" placeholder="Enter Date" <?php if (isset($mkt_data->duration_from)) : ?> value="<?php echo date('Y-m-d',strtotime($mkt_data->duration_from)) ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="date-input-wrapper">
                            <label class="col-form-label mr-3">To</label>
                            <input type="text" class="form-control todate" id="lnInterviewTo" name="lnInterviewTo" placeholder="Enter Date" <?php if (isset($mkt_data->duration_to)) : ?> value="<?php echo date('Y-m-d',strtotime($mkt_data->duration_to)) ?>" <?php endif; ?>>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-2 "><label class="m-0" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                    <div class="col-sm-10 ">
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" <?php if (isset($mkt_data->vic_blogs_news_video) && $mkt_data->vic_blogs_news_video != '') : ?> checked <?php endif; ?> name="videoType" value="mp4"> MP4 Video
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" <?php if (isset($mkt_data->vic_bn_youtubeURL) && $mkt_data->vic_bn_youtubeURL != '') : ?> checked <?php endif; ?> name="videoType" value="youTube"> YouTube URL
                            </label>
                        </div>
                    </div>
                </div>
                <?php
                    $video_data=(isset($mkt_data->vic_blogs_news_video) && $mkt_data->vic_blogs_news_video!='') ? base_url('upload/interviews/'.$mkt_data->vic_blogs_news_video) : '';
                    $youtube_data=(isset($mkt_data->vic_bn_youtubeURL) && $mkt_data->vic_bn_youtubeURL!='') ? $mkt_data->vic_bn_youtubeURL : '';
                    $vtpe=($video_data=='')? 'youtube' : 'videos';
                ?>
                <input id="media_data" name="media_data" type="hidden" data-vtype="<?php echo $vtpe;?>" value="<?php if($video_data!=''){echo $video_data;}else{echo $youtube_data;}?>">
                <div class="form-group row upload-mp4 display-none">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10  pos-rel">
                        <div class="center-align-lable">
                            <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                            <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: MP4, maximum file size: 50MB</span>
                        </div>
                        <input onchange="readURL(this);" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="interviewvideo" />
                        <!-- accept="application/pdf" -->
                    </div>
                </div>
                <div class="form-group row you-tube-url display-none">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control youtubeurl" id="youtubeurl" name="youtubeurl" placeholder="Enter Embed YouTube URL" <?php if (isset($mkt_data->idvic_blogs_news)) : ?> value="<?php echo $mkt_data->vic_bn_youtubeURL; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row pt-2">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <?php if (isset($mkt_data)) : ?>
                                <?php if ($mkt_data->vic_bn_status == 'active') : ?>
                                    <input type="checkbox" checked name="status">
                                    <span class="slider round"></span>
                                <?php else : ?>
                                    <input type="checkbox" name="status">
                                    <span class="slider round"></span>
                                <?php endif; ?>
                            <?php else :  ?>
                                <input type="checkbox" checked name="status">
                                <span class="slider round"></span>
                            <?php endif; ?>

                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    </form>

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
                            <button type="button" onclick="window.location.href=ajax_url+'admin/content-management/market-info/interviews'" id="addinterviewsCloseModal" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            <button type="button" onclick="reject_content()" class="add-company-details">OK</button>
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
            if (isset($mkt_data->vic_blogs_news_video) && $mkt_data->vic_blogs_news_video != '') :
            ?>
                $(".upload-mp4").removeClass('display-none');
                $(".you-tube-url").addClass('display-none');
                $("#youtubeurl").val('');
                $('#media_data').val("<?php echo base_url('upload/interviews/'.$mkt_data->vic_blogs_news_video);?>");
            <?php endif; ?>

            <?php
            if (isset($mkt_data->vic_bn_youtubeURL) && $mkt_data->vic_bn_youtubeURL != '') :
            ?>
                $(".you-tube-url").removeClass('display-none');
                $(".upload-mp4").addClass('display-none');
                $("#youtubeurl").val('<?php echo $mkt_data->vic_bn_youtubeURL ?>');
                $("#upload-attachment-file").val('');
                $("#upload-attachment-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');
                $('#media_data').val("<?php echo $mkt_data->vic_bn_youtubeURL; ?>");
            <?php else: ?>
                <input id="media_data" name="media_data" type="hidden" value="">
            <?php endif; ?>
        })
    </script>