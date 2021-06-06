<div class="container-fluid body-wrapper pl-24vw">
    
<form id="addnews-form" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>News</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/market-info/news">News</a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                        </ol>
                    </nav>
                </h4>
                <?php if ($activePage == 'Add News') : ?>
                    <a href="<?php echo base_url(); ?>admin/content-management/market-info/news" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                    <?php else : ?>                        
                        <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id(<?php if (isset($content['0'])) : ?><?php echo $content['0']->idvic_blogs_news ?><?php endif; ?>)" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" id="publishnews" value=<?php echo $value ?>>
                <a href="#" onclick="preview_content(<?php if (isset($content['0'])) : ?><?php echo $content['0']->idvic_blogs_news ?><?php endif; ?>)" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div> 
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="idvic_blogs_news" value="<?php if (isset($content['0'])){echo $content['0']->idvic_blogs_news;}?>">
        <div class="col-sm-12">
            <div class="form-wrapper">
                    <input type="hidden" value="<?php if(isset($content[0]->idvic_blogs_news)){echo $content[0]->idvic_blogs_news;}?>" name="id" id="isempty_magzin">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">News Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter News Title" id="titles" name="titles" <?php if (isset($content['0']->idvic_blogs_news)) : ?> value="<?php echo $content['0']->vic_bn_title ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">News Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="category" id="category" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select News Category</option>
                                <option value="processing technology">Processing Technology</option>
                                <option value="ingredients and additives">Ingredients & Additives</option>
                                <option value="rice and flour milling">Rice & Flour Miling</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="4" id="description" name="description"><?php if (isset($content['0']->idvic_blogs_news)) : ?> <?php echo $content['0']->vic_description ?> <?php endif; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10 pos-rel">
                            <input type="text" class="form-control" id="Newsdatepicker" name="lndatepicker"  placeholder="Enter Date" <?php if (isset($content['0']->idvic_blogs_news)) : ?> value="<?php echo date('Y-m-d',strtotime($content['0']->vic_bn_createdat)) ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Website URL</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Website URL" name="websiteurl" <?php if (isset($content['0']->idvic_blogs_news)) : ?> value="<?php echo $content['0']->vic_blogs_website_url ?>" <?php endif; ?>> 
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
                <div class="text-left">
                    <h6 class="pt-3 text-blue f-14 mb-3" id="title"></h6>
                    <p class="text-title-small f-14" id="desc"></p>
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
                        <button type="button" id="addNewsCloseModal" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
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
                            <button type="button" onclick="reject_content()" class="add-company-details" >OK</button>
                            <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
     <?php if (isset($content['0']->idvic_blogs_news)) : ?>
        $('#category').val('<?php echo $content['0']->vic_news_category ?>')
    <?php endif; ?>
</script>