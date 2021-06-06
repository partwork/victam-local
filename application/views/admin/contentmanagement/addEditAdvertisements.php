<?php
header("Access-Control-Allow-Origin: *");
?>
<div class="container-fluid body-wrapper pl-24vw">

    <form id="addAdvertisement-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="isempty_advert" id="isempty_advert" value="<?php if (!empty($content['0'])): echo $content['0']->idvic_advertisment; endif; ?>">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-top-elements">
                    <h4 class="page-title-wrap">
                        <span>Advertisements</span>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page">Home</li>
                                <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/home/advertisement">Advertisements</a> </li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                            </ol>
                        </nav>
                    </h4>
                    <?php if (isset($content['0'])){ ?>
                        <a href="javascript:void(0)" onclick="content_id(<?php if (isset($content['0'])) : ?><?php echo $content['0']->idvic_advertisment ?><?php endif; ?>)" data-toggle="modal" data-target="#rejectConfirmationModal" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url(); ?>admin/content-management/home/advertisement" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                    <?php }  ?>
                   
                    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                        <?php $value = 'Publish'; ?>
                        <?php $value2 = 'Preview'; ?>
                    <?php else : ?>
                        <?php $value = 'Save'; ?>
                        <?php $value2 = 'Review'; ?>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value="<?php echo $value; ?>">
                    <a href="#" onclick="preview_banner1()" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4"><?php echo $value2; ?></a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrapper">
                    <input type="hidden" name="idvic_advertisment" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->idvic_advertisment ?>" <?php endif; ?>>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control " id="cname" name="cname" placeholder="Enter Company Name" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_advertisment_company_name ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ads Page</label>
                        <div class="col-sm-10">
                            <select class="form-control" required name="adspage" id="adspage">
                                <option value="" selected disabled class="placeholder-text">Select Ads Page</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Add company to the guide form') : ?> selected <?php endif; ?> value="Add company to the guide form">Add company to the guide form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Add your innovation form') : ?> selected <?php endif; ?> value="Add your innovation form">Add your innovation form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Add your case study form') : ?> selected <?php endif; ?> value="Add your case study form">Add your case study form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Add your white paper form') : ?> selected <?php endif; ?> value="Add your white paper form">Add your white paper form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Add your publications form') : ?> selected <?php endif; ?> value="Add your publications form">Add your publications form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Add your events form') : ?> selected <?php endif; ?> value="Add your events form">Add your events form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Place a job vacancy form') : ?> selected <?php endif; ?> value="Place a job vacancy form">Place a job vacancy form</option>
                                <option <?php if (isset($content['0']) && $content['0']->vic_advertisment_ads_page == 'Open A New Forum Form') : ?> selected <?php endif; ?> value="Open A New Forum Form">Open A New Forum Form</option>
                                </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ads Position</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="adsposition" id="adsposition" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Ads Position</option>
                                

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
                                      if (isset($content['0']->vic_advertisment_ads_position) && $content['0']->vic_advertisment_ads_position==$value)
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
                        <label class="col-sm-2 col-form-label">Ads URL</label>
                        <div class="col-sm-10">
                            <input type="text" name="adsurl" class="form-control" placeholder="Enter Ads URL" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_advertisment_ads_url ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Duration</label>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper">
                                <label class="col-form-label mr-3">From</label>
                                <input type="text" class="form-control fromdate" id="adsFrom" name="adsFrom" placeholder="Enter Date" <?php if (isset($content['0'])) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->vic_advertisment_date_from)) ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="date-input-wrapper">
                                <label class="col-form-label mr-3">To</label>
                                <input type="text" class="form-control todate" id="adsTo" name="adsTo" placeholder="Enter Date" <?php if (isset($content['0'])) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->vic_advertisment_date_to)) ?>" <?php endif; ?>>
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
                            <input onchange="readURL(this);" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="uploadAttachment" />
                            <input id="media_data" name="media_data" type="hidden" <?php if (isset($content['0'])) : ?> value="<?php echo base_url('upload/advertisment/'.$content['0']->vic_advertisment_img_path); ?>" <?php endif; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>


                        <div class="col-sm-10">
                            <label class="switch">
                                <?php if (isset($content['0'])) : ?>
                                    <?php if ($content['0']->vic_advertisment_is_active == 'active') : ?>
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
                    <h6 class="pt-3 text-blue f-18 mb-3" id="title"></h6>
                    <img <?php if (isset($content['0'])) : ?> src="<?php echo base_url('upload/advertisment/' . $content['0']->vic_advertisment_img_path); ?>" <?php endif; ?> class="img-fluid w-100 p-3" id="preview_img"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Publish Modal -->
<div class="modal fade" id="advertisementModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                        <a href="<?php echo base_url(); ?>admin/content-management/home/advertisement" type="button" class="add-company-details">OK</a>
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
                        <button type="button" class="add-company-details" onclick="reject_adv()" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
