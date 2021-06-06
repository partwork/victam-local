<div class="container-fluid body-wrapper pl-24vw">
    <?php
    $attributes = array('id' => 'article_form');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Articles</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/market-info/articles">Articles </a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php if ($activePage == 'addArticles') { ?> Edit Articles <?php } else { ?> Add Articles <?php } ?> </li>
                        </ol>
                    </nav>
                </h4>
                <?php if (isset($mkt_data) && !empty($mkt_data)) : ?>
                    <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id('<?php echo $mkt_data->idvic_blogs_news; ?>')" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                <?php else : ?>
                    <a href="<?php echo base_url('admin/content-management/market-info/articles'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <?php endif; ?>

                <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                    <?php $value = 'Publish'; ?>
                    <?php $value2 = 'Preview'; ?>
                <?php else : ?>
                    <?php $value = 'Save'; ?>
                    <?php $value2 = 'Review'; ?>
                <?php endif; ?>
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value=<?php echo $value ?>>
                <a href="#" onclick="preview_article()" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4">Preview</a>
            </div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" value="<?php if (isset($type)) {
                                        echo $type;
                                    } else {
                                        echo 'article';
                                    } ?>" name="type">
        <input type="hidden" name="id" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->idvic_blogs_news; ?>" <?php endif; ?> id='isempty_magzin'>
        <div class="col-sm-12">
            <div class="form-wrapper">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Article Title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="cname" placeholder="Enter Article Title" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_bn_title; ?>" <?php endif; ?>>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Summary</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="summary" id="summary" placeholder="Enter Summary" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_blogs_article_summary; ?>" <?php endif; ?>>
                    </div>
                </div> -->
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label">Article Category</label>
                    <div class="col-sm-10">
                        <select id="sectorFilter" name="sectorFilter" class="form-control" required>
                            <option value="" disabled selected hidden class="placeholder-text">Select Industry sector</option>
                            <option value="processing technology">Processing Technology</option>
                            <option value="ingredients and additives">Ingredients & Additives</option>
                            <option value="rice and flour milling">Rice & Flour Miling</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="description" rows="4"><?php if (isset($mkt_data) && !empty($mkt_data)) : ?> <?php echo $mkt_data->vic_description; ?> <?php endif; ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Publisher</label>
                    <div class="col-sm-10 pos-rel">
                        <input type="text" class="form-control" name="publisher" id="publisher" placeholder="Enter Publisher Name" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_bn_firstname; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keywords</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Enter Keywords" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_blogs_article_keyword; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row upload-image-wrapper-outer">
                    <label class="col-sm-2 col-form-label">Website URL</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="websiteurls" id="websiteurls" placeholder="Enter Website URL" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> value="<?php echo $mkt_data->vic_blogs_website_url; ?>" <?php endif; ?>>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <label class="switch">
                            <input type="checkbox" name="status" value='active' id="status" <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> <?php if ($mkt_data->vic_bn_status == 'active') {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?> <?php endif; ?>>
                            <span class="slider round"></span>
                        </label>
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

                    <p class="text-title-small f-14" id="desc"> <?php if (isset($mkt_data) && !empty($mkt_data)) : ?> <?php echo $mkt_data->vic_description; ?> <?php endif; ?></p>
                    <img class="img-fluid w-100 p-3" id="preview_img" />
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
                        <a href="<?php echo base_url(); ?>admin/content-management/market-info/articles" class="add-company-details">OK</a>
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
                        <button type="button" onclick="reject_mkt()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php if (isset($mkt_data) && !empty($mkt_data)) : ?>

        $('#sectorFilter').val("<?php echo $mkt_data->vic_news_category; ?>")
    <?php endif; ?>
</script>