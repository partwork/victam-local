<div class="container-fluid body-wrapper pl-24vw">

    <?php
    /*$attributes = array('id' => 'addinterview-form');
    echo form_open_multipart( $attributes);*/
    ?>
    <form id="addinterview-form" method="post" enctype="multipart/form-data">
        <input type="hidden" id="isUpdateInterview" name="isUpdateInterview" value="<?php if (isset($content['0']->idvic_blogs_news)) {
                                                                                        echo $content['0']->idvic_blogs_news;
                                                                                    } ?>">
        <input type="hidden" id="idvic_blogs_news" name="idvic_blogs_news" value="<?php if (isset($content['0']->idvic_blogs_news)) {
                                                                                        echo $content['0']->idvic_blogs_news;
                                                                                    } ?>">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-top-elements">
                    <h4 class="page-title-wrap">
                        <span>Latest Interviews</span>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                                <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/home/latest-interview">Latest Interviews</a> </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                            </ol>
                        </nav>
                    </h4>
                    <?php if ($activePage == 'Update Interviews') : ?>
                        <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id(<?php if (isset($content['0'])) : ?><?php echo $content['0']->idvic_blogs_news ?><?php endif; ?>)" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                    <?php else : ?>
                        <a href="<?php echo base_url(); ?>admin/content-management/home/latest-interview" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                        <?php $value = 'Publish'; ?>
                        <?php $value2 = 'Preview'; ?>
                    <?php else : ?>
                        <?php $value = 'Save'; ?>
                        <?php $value2 = 'Review'; ?>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value; ?>>
                    <a href="#" onclick="preview_content(<?php if (isset($content['0'])) : ?><?php echo $content['0']->idvic_blogs_news ?><?php endif; ?>)" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4"><?php echo $value2; ?></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrapper">
                    <input type="hidden" name="idvic_blogs_news " <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->idvic_blogs_news ?>" <?php endif; ?>>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Interview Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Interview Title" name="titles" id="titles" <?php if (isset($content['0']->idvic_blogs_news)) : ?> value="<?php echo $content['0']->vic_bn_title ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Interview Position</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="position" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Interview Position</option>
                                <option value="1" <?php if (isset($content['0']->vic_bn_position) == '1') : ?> selected <?php endif; ?>>1</option>
                                <option value="2" <?php if (isset($content['0']->vic_bn_position) == '2') : ?> selected <?php endif; ?>>2</option>
                                <option value="3" <?php if (isset($content['0']->vic_bn_position) == '3') : ?> selected <?php endif; ?>>3</option>
                                <option value="4" <?php if (isset($content['0']->vic_bn_position) == '4') : ?> selected <?php endif; ?>>4</option>
                                <option value="5" <?php if (isset($content['0']->vic_bn_position) == '5') : ?> selected <?php endif; ?>>5</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Interview Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sector" id="sector" >
                                <option value="" disabled selected hidden class="placeholder-text">Select Interview Category</option>
                                <?php
                                   if($sector!=NULL): 
                                    foreach ($sector as $value):
                                ?>
                                <!-- <option value="<?php echo $value->vic_sectors_industry_category;?>"><?php echo $value->vic_bn_sector_name;?></option> -->
                                <?php
                                    endforeach;
                                  endif;  
                                ?>
                                <option <?php if (isset($content['0']->vic_news_category) && $content['0']->vic_news_category == 'ingredients and additives') : ?> selected <?php endif; ?> value="ingredients and additives">Ingredients & Additives</option>
                                <option <?php if (isset($content['0']->vic_news_category) && $content['0']->vic_news_category == 'processing technology') : ?> selected <?php endif; ?> value="processing technology">Processing Technology</option>
                                <option <?php if (isset($content['0']->vic_news_category) && $content['0']->vic_news_category == 'rice and flour milling') : ?> selected <?php endif; ?> value="rice and flour milling">Rice & Flour Milling</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Duration</label>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper ">
                                <label class="col-form-label mr-3">From</label>
                                <input type="text" class="form-control fromdate" id="lnInterviewFrom" name="lnInterviewFrom" placeholder="Enter Date" <?php if (isset($content['0']->duration_from)) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->duration_from)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper">
                                <label class="col-form-label mr-3">To</label>
                                <input type="text" class="form-control todate" id="lnInterviewTo" name="lnInterviewTo" placeholder="Enter Date" <?php if (isset($content['0']->duration_to)) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->duration_to)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-2 "><label class="m-0" for="usr">Upload Video <span class="text-danger">*</span> </label></div>
                        <div class="col-sm-10 ">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" <?php if (isset($content['0']->vic_blogs_news_video) && $content['0']->vic_blogs_news_video != '') : ?> checked <?php endif; ?> name="videoType" value="mp4"> MP4 Video
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" <?php if (isset($content['0']->vic_bn_youtubeURL) && $content['0']->vic_bn_youtubeURL != '') : ?> checked <?php endif; ?> name="videoType" value="youTube"> YouTube URL
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row upload-mp4 display-none">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                                <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: MP4, maximum file size: 50MB</span>
                            </div>
                            <input onchange="readURL(this);" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="interviewvideo" />
                        </div>
                    </div>

                    <div class="form-group row you-tube-url display-none">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="youtubeurl" name="youtubeurl" placeholder="Enter Embed YouTube URL" <?php if (isset($content['0']->idvic_blogs_news)) : ?> value="<?php echo $content['0']->vic_bn_youtubeURL ?>" <?php endif; ?>>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <label class="switch">
                                <?php if (isset($content['0'])) : ?>
                                    <?php if ($content['0']->vic_bn_status == 'active') : ?>
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
                        <!-- <video width="100%" height="240" controls>
                                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
                            </video> -->
                        <div id="videoUrl"></div>
                        <input type="hidden" id="media_data" value="<?php if (isset($content['0']->vic_blogs_news_video) && $content['0']->vic_blogs_news_video != '') {
                                                                        echo base_url('upload/interviews/' . $content['0']->vic_blogs_news_video);
                                                                    }  ?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Publish Modal -->
    <div class="modal fade" id="publishinterview" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                            <button type="button" id="addinterviewsCloseModal" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
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
            
            <?php if (isset($content['0']->idvic_blogs_news)) : ?>
                $("#lnInterviewFrom").val("<?php echo date('m/d/Y', strtotime($content['0']->duration_from)); ?>");
                $("#lnInterviewTo").val("<?php echo date('m/d/Y', strtotime($content['0']->duration_to)); ?>");
                $('#position').val("<?php echo $content['0']->vic_bn_position; ?>")


            <?php endif; ?>
            <?php
            if (isset($content['0']->vic_blogs_news_video) && $content['0']->vic_blogs_news_video != '') :
            ?>
                $(".upload-mp4").removeClass('display-none');
                $(".you-tube-url").addClass('display-none');
                $("#youtubeurl").val('');
            <?php endif; ?>

            <?php
            if (isset($content['0']->vic_bn_youtubeURL) && $content['0']->vic_bn_youtubeURL != '') :
            ?>
                $(".you-tube-url").removeClass('display-none');
                $(".upload-mp4").addClass('display-none');
                $("#youtubeurl").val('<?php echo $content['0']->vic_bn_youtubeURL ?>');
                $("#upload-attachment-file").val('');
                $("#upload-attachment-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');
            <?php endif; ?>
        })
    </script>