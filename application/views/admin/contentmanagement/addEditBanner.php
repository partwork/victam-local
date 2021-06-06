<div class="container-fluid body-wrapper pl-24vw">

    <?php
    /*$attributes = array('id' => 'addBanner-form');
    echo form_open_multipart('admin/contentmanagement/HomeController', $attributes);
    */
    ?>
    <form id="addBanner-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="isempty_banner" id="isempty_banner" value="<?php if (isset($content['0'])) {
                                                                                    echo $content['0']->vic_banner_id;
                                                                                } ?>">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-top-elements">
                    <h4 class="page-title-wrap">
                        <span>Banners</span>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                                <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/home/banners">Banners</a> </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                            </ol>
                        </nav>
                    </h4>
                    <!-- <a href="#" onclick="reject_banner_logos(<?php if (isset($content['0'])) : ?><?php echo $content['0']->vic_banner_id ?><?php endif; ?>)" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a> -->
                    <?php if ($activePage == 'Update Banner') : ?>
                        <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id(<?php if (isset($content['0'])) : ?><?php echo $content['0']->vic_banner_id ?><?php endif; ?>)" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                    <?php else : ?>
                        <a href="<?php echo base_url(); ?>admin/content-management/home/banners" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                        <?php $value = 'Publish'; ?>
                        <?php $value2 = 'Preview'; ?>
                    <?php else : ?>
                        <?php $value = 'Save'; ?>
                        <?php $value2 = 'Review'; ?>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value; ?>>
                    <a href="#" onclick="preview_banner1()" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4"><?php echo $value2; ?></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrapper">
                    <input type="hidden" name="banner_id" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_banner_id ?>" <?php endif; ?>>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Company Name" id="cname" name="cname" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_banner_company_name ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Banner Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Banner Title" name="btitle" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_banner_title ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Banner Position</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="position" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Banner Position</option>
                                

                                <?php
                                  $default_position=array(1=>'first',2=>'second',3=>'third',4=>'fourth',5=>'fifth',6=>'sixth',7=>'seventh',8=>'eighth',9=>'nineth',10=>'tenth',11=>'eleventh',12=>'twelvth');
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
                                      if (isset($content['0']->vic_banner_postition) && $content['0']->vic_banner_postition==$value)
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
                                <input type="text" class="form-control fromdate" id="bannerFrom" placeholder="Enter Date" name="bannerFrom" <?php if (isset($content['0'])) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->vic_banner_duration_from)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper ">
                                <label class="col-form-label mr-3">To</label>
                                <input type="text" class="form-control todate" id="bannerTo" placeholder="Enter Date" name="bannerTo" <?php if (isset($content['0'])) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->vic_banner_duration_to)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row upload-image-wrapper-outer">
                        <label class="col-sm-2 col-form-label">Upload Image</label>
                        <div class="col-sm-10  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                                <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="uploadAttachment" onchange="readURL(this);" />
                            <input id="media_data" name="media_data" type="hidden" <?php if (isset($content['0'])) : ?> value="<?php echo base_url('upload/banner/' . $content['0']->vic_banner_image); ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <label class="switch">
                                <?php if (isset($content['0'])) : ?>
                                    <?php if ($content['0']->vic_banner_is_active == 'enable') : ?>
                                        <input type="checkbox" checked value="enable" name="isactive">
                                        <span class="slider round"></span>
                                    <?php else : ?>
                                        <input type="checkbox" value="disable" name="isactive">
                                        <span class="slider round"></span>
                                    <?php endif; ?>
                                <?php else :  ?>
                                    <input type="checkbox" checked value="enable" name="isactive">
                                    <span class="slider round"></span>
                                <?php endif; ?>
                            </label>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
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
                    <h6 class="pt-3 text-blue f-14 mb-3" id="title"></h6>
                    <img <?php if (isset($content['0'])) : ?> src="<?php echo base_url('upload/banner/' . $content['0']->vic_banner_image); ?>" <?php endif; ?> class="img-fluid w-100 p-3" id="preview_img" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Publish Modal -->
<div class="modal fade" id="publishbanners" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                        <button type="button" id="addBannerCloseModal" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
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
                        <button type="button" onclick="reject_banner_logos()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
