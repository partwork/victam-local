<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div class="row pr-5">
            <div class="col-sm-3">
                <div class="filters-wrap">
                    <div class="filter-btn-wrap">
                        <span>Filters</span>
                        <button type="button" class="btn btn-sm btn-blue float-right f-14 fw-400" id="clearfilter">Reset filters</button>
                    </div>

                    <div class="input-fields-wrap mt-2" id="filter_div">
                        <div class="form-group search-filter-wrap pos-rel">
                            <input type="text" class="form-control" id="filterSearch" placeholder="Search for a publications">
                            <i class="fa fa-search" id="Searchme" aria-hidden="true"></i>
                            <input type="hidden" name="page_name" id="page_name" value="publication">
                            <p class="error" id="searchError" ></p>

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Display</label>
                            <div class="dropdowns">
                                <div class="">
                                    <select class="form-control sector-drp-list" id="sector-drp-list" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="all">All Sectors</option>
                                        <?php
                                            if(isset($sector_list) && !empty($sector_list)): 
                                              foreach($sector_list as $key=>$value):
                                        ?>

                                          <option value="<?php echo $value->vic_bn_sector_name;?>"><?php echo $value->vic_bn_sector_name;?></option>
                                        <?php
                                            endforeach;
                                          endif;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Refine</label>
                            <div class="dropdowns">
                               <select class="form-control refine-drp-list" id="refine-drp-list" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="all">All Country</option>
                                    <?php
                                        if(isset($country_list) && !empty($country_list)): 
                                          foreach($country_list as $key=>$value):
                                    ?>

                                      <option value="<?php echo $value->Name;?>"><?php echo $value->Name;?></option>
                                    <?php
                                        endforeach;
                                      endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="alphabet-filter clearfix">
                                <div class="az-alphabet-fliter">
                                    <span class="box">ALL</span>
                                    <span class="box">0-9</span>
                                </div>
                                <div class="alphabets-box-wrap">
                                    <span class="box">A</span>
                                    <span class="box">B</span>
                                    <span class="box">C</span>
                                    <span class="box">D</span>
                                    <span class="box">E</span>
                                    <span class="box">F</span>
                                    <span class="box">G</span>
                                    <span class="box">H</span>
                                    <span class="box">I</span>
                                    <span class="box">J</span>
                                    <span class="box">K</span>
                                    <span class="box">L</span>
                                    <span class="box">M</span>
                                    <span class="box">N</span>
                                    <span class="box">O</span>
                                    <span class="box">P</span>
                                    <span class="box">Q</span>
                                    <span class="box">R</span>
                                    <span class="box">S</span>
                                    <span class="box">T</span>
                                    <span class="box">U</span>
                                    <span class="box">V</span>
                                    <span class="box">W</span>
                                    <span class="box">X</span>
                                    <span class="box">Y</span>
                                    <span class="box">Z</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group search-filter-wrap pos-rel">
                            <a href="<?php echo base_url(); ?>index.php/resource-library/add-publication" class="btn btn-blue w-100 f-14 fw-400">Add Your Publication</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 mt-4 pb-5" id="comp-directory">

                <h4 class="text-title-small fw-400 mb-5">LIST OF PUBLICATIONS</h4>

                <div class="row mt-3 scroll-section pt-1" id="Ajaxresult">
                    
                       <?php
                       $not_in='';
                          if(isset($publication_list)):
                            $i=0;
                            
                            foreach($publication_list as $key=>$value):
                                $not_in.=$value->idvic_resource_library.',';
                        ?>  
                        <div class="col-sm-12">
                            <button type="button" class="comp-card-wrap p-3 bg-white text-dark view-comp-detail" data-id="<?php echo $value->idvic_resource_library;?>">
                                <h5 class="float-left mb-0"><?php echo $value->vic_resource_title;?></h5>
                                <span class="float-right">Created Date - <?php echo date('d/m/Y',strtotime($value->vic_updated_at));?></span>
                                
                            </button>
                        </div>


                        <?php
                            endforeach;
                        endif;
                        ?>
                    <input type="hidden" value="<?php echo $not_in;?>" id="not_in" name="not_in">
                </div>
                <div class="col-sm-9 mt-4 pb-5" id="Searchresult"></div>
            </div>
             <?php
              if(isset($publication_list)):
                $i=0;
                $Presentation="";
                foreach($publication_list as $key=>$value):
                    $ext = pathinfo($value->vic_resource_presentation, PATHINFO_EXTENSION)
                  //$Presentation=(in_array($ext,array('.ppt','.pptx'))) ?  
            ?>  
            <div class="col-sm-9 mt-4 pb-5 comp-detail-directory" id="comp-detail-directory<?php echo $value->idvic_resource_library;?>" style="display:none;">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-sm btn-blue back-to-comp-directory float-right mb-3 pl-4 pr-4">Back</button>
                        <div class="w-100 center-align-lable pos-rel bb-grey bt-grey pt-4 pb-4">
                            <h4 class="text-title-small fw-400 pr-10r"><?php echo $value->vic_resource_title;?></h4>
                            <ul class="social-icons-wrap fs-22">
                            <li class="list-inline-item">
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_resource_library_details_by_id/<?php echo $value->idvic_resource_library ?>"  target="_blank">
                                        <i class="fa fa-linkedin fa-icon-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/dialog/share?app_id=<?php echo $this->config->item('facebook_app_id'); ?>&href=http://dev.victam.com/e/CommonController/get_resource_library_details_by_id/<?php echo $value->idvic_resource_library ?>" target="_blank">
                                        <i class="fa fa-facebook-square fa-icon-social"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                <a href="https://twitter.com/intent/tweet?text=<?php echo $value->vic_resource_title .' - '.$value->vic_resource_desc; ?>" target="_blank"> 
                                        <i class="fa fa-twitter fa-icon-social"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-sm-12 mt-3">
                        <p class="company-sub-text-heading"><?php echo $value->vic_resource_desc;?></p>

                        <p class="text-blue mt-4 mb-0">Publisher : <?php echo $value->vic_resource_publisher;?></p>
                        <p class="text-blue">Date : <?php echo date('Y-m-d',strtotime($value->vic_resource_date));?></p>
                        <h5 class="text-title-small fw-400 mb-3">Artifacts</h5>
                    </div>
                    <?php if(isset($value->vic_resource_docs) && !empty($value->vic_resource_docs)):?>
                    <div class="col-sm-12 mt-3">
                        <a href="javascript:void(0)" class="view_doc_model p_file" data-url="<?php echo base_url('upload/resource_library/'.$value->vic_resource_docs);?>">
                            <img src="https://banner2.cleanpng.com/20180428/gie/kisspng-computer-icons-data-file-document-file-format-5ae44cd0f26028.4611855915249113129928.jpg" width="80" height="60"> 
                        </a>
                    </div>
                   <?php endif; ?> 
                    <?php if(isset($value->vic_resource_presentation) && !empty($value->vic_resource_presentation)):?>
                    <div class="col-sm-12 mt-3">
                        <h5 class="text-title-small fw-400 mb-3">Presentation</h5>
                        <video width="400" controls>
                          <source src="<?php echo base_url('upload/resource_library/'.$value->vic_resource_presentation);?>" type="video/mp4">
                                
                          Your browser does not support HTML video.
                        </video>
                    </div>
                   <?php endif; ?> 
                   <?php if(isset($value->vic_resource_youtube_url) && !empty($value->vic_resource_youtube_url)):?>
                    <div class="col-sm-12 mt-3">
                        <h5 class="text-title-small fw-400 mb-3">Presentation</h5>
                        <iframe width="400" height="200" src="<?php echo $value->vic_resource_youtube_url;?>" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                   <?php endif; ?> 
                   <!-- <div class="col-sm-12 mt-3">
                    <h5 class="text-title-small fw-400 mb-3">Document</h5>
                    <button type="button" class="btn btn-primary btn-lg doc_btn" data-loc="<?php echo $value->vic_resource_docs; ?>">View</button>
                   </div> -->
                    <div class="col-sm-12 mt-5">
                        <!-- <button type="button" class="btn btn-blue pl-5 pr-5" data-toggle="modal" data-title="<?php echo $value->vic_resource_title;?>" data-resid="<?php echo $value->vic_resource_docs;?>" data-target="#receiveMoreInfo">Receive More Information</button> -->

                        <button type="button" class="btn btn-blue pl-5 pr-5 more_info_btn" data-toggle="modal" data-title="<?php echo $value->vic_resource_title;?>" data-resid="<?php echo $value->vic_resource_docs;?>" data-email="<?php if(isset($value->vic_resource_presentation) && !empty($value->vic_resource_presentation)): echo $value->vic_resource_email; endif;?>" data-rtitle="<?php if(isset($value->vic_resource_presentation) && !empty($value->vic_resource_presentation)): echo $value->vic_resource_title; endif;?>" data-target="#receiveMoreInfo">Receive More Information</button>
                    </div>

                </div>
            </div>
            <?php
                endforeach;
               endif;
             ?>
        </div>

        <?php $this->load->view('shared/footer/footer'); ?>

        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="receiveMoreInfo" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <h4 class="text-center text-title-small fw-400 modal-title-innovation">Publication <br/>Contact Form</h4>
                        <p class="text-title-small pl-15 fs-16 mt-4 mb-2">Please let us know how we can help you by filling out the contact form below</p>
                        
                        <form id="inov_contact_frm">
                            <input type="hidden" name="resource_id" id="resource_id">
                            <input type="hidden" name="resource" id="research_and_innovations" value="publication">
                            <div class="innovation-contact-form-wrap">
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Contact Name <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-custom" name="name" placeholder="Enter Contact Name" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Email ID <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control form-control-custom" name="email" placeholder="Enter Email ID" required="">
                                        <input type="hidden" value="" name="r_email" id="r_email" />
                                        <input type="hidden" value="" name="r_title" id="r_title" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Phone Number <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-custom" name="mobile" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Company Name <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-custom" name="company" placeholder="Enter Company Name" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Designation / Title <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-custom" name="designation" placeholder="Enter Designation / Title" required="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-sm-4 col-form-label">Country  <span class="text-red">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-custom" name="country" placeholder="Enter Country" required="">
                                    </div>
                                </div>
                                <input type="hidden" name="reqpage" value="Publication">
                                <div class="form-group mt-5 mb-0 text-center">
                                    <!-- <button type="submit" class="btn btn-blue pl-4 pr-4">Submit</button> -->
                                    <input type="submit" class="btn btn-blue pl-4 pr-4" value="Submit" />
                                </div>
                            </div>
                       </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Document Model-->
        <!--Document Model-->
        <div class="modal fade" id="doc_model" tabindex="-1" role="dialog" aria-labelledby="doc_model" aria-hidden="true">
          <div class="modal-dialog modal-xl" style="margin: 0 auto;height: 100%;">
            <div class="modal-content" style="background:transparent;border:none;height: 100%;">
              <div class="modal-body" style="padding: 0;">
                <iframe id="doc_iframe" width="100%" height="100%" style="border: none;"  src=""></iframe>
              </div>
            </div>
          </div>
        </div>
</body>
<script type="text/javascript">
    $('.more_info_btn').click(function(){
        var email=$(this).data('email');
        var title=$(this).data('rtitle');        
        $('#r_email').val(email);
        $('#r_title').val(title);
    })
</script>