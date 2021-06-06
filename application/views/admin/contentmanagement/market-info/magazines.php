<div class="container-fluid body-wrapper pl-24vw">
    
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Magazines</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Market Information</li>
                            <li class="breadcrumb-item active" aria-current="page">Magazines</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/market-info/add-magazines') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add New Magazines</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="mgstatusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option>Under Review</option>
                        <option>Published</option>
                        <option>Rejected</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" id="mgsearch_input" placeholder="Search">
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-sm-3 pl-1 pr-3 mb-3">
            <div class="interviews-card-wrapper w-100">
                <div class="card">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/magazines/mag2.png" class="card-img2"/>
                    <div class="card-body text-center">
                        <a href="<?php echo base_url(); ?>application/assets/shared/img/Receipt.pdf" target="_blank" class="card-title f-14 text-blue cp">Victam International</a>
                        <p class="card-text text-green-light fs-13 mb-2">2021-02-23 Published</p>
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <a href="javascript:void(0)" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                            <a href="javascript:void(0)"  class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2" checked="true"><label for="check1" class="m-0 text-blue">Active</label></a>
                            <a href="#" data-toggle="modal" data-target="#deleteNewsModal"  class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row" id="list_div">
        <?php if ($magzine) : ?>
            <?php 
            $isChecked='';
            $function='';
            $status_text='';
            foreach ($magzine as $list) : 
                $isChecked=($list->vic_bn_status=='active')? 'checked' : '';
                $status_text=($list->vic_bn_status=='active')? 'Active' : 'Inactive';
                $function=($list->vic_bn_status=='active')? "change_status_mkg(".$list->idvic_blogs_news.",'inactive')": "change_status_mkg(".$list->idvic_blogs_news.",'active')";
            ?>
                <div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <img src="<?php echo base_url('upload/marketing_info/'.$list->vic_bn_image); ?>" class="card-img2"/>
                            <div class="card-body text-center">
                                <a href="<?php echo base_url('upload/marketing_info/'.$list->vic_bn_document_url); ?>" target="_blank" class="card-title f-14 text-blue cp"><?php echo $list->vic_bn_title;?></a>
                                <p class="card-text text-green-light fs-13 mb-2"><?php echo date('Y-m-d',strtotime($list->vic_bn_createdat));?> 
                                <?php if($list->vic_modification_status == 'Rejected') { echo '<span class="text-red f-14">Rejected</span>'; } 
                                       else if($list->vic_modification_status == 'Under Review') { echo '<span class="text-blue f-14">Under Review</span>'; }
                                       else { echo $list->vic_modification_status; } ?>
                            </p>

                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="<?php echo base_url('admin/edit_marketing_info/'.$list->idvic_blogs_news);?>" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>

                                    <a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                        <input type="checkbox" id="check<?php echo $list->idvic_blogs_news;?>" class="mr-2" <?php echo $isChecked;?> onclick="<?php echo $function;?>" >
                                        <label for="check1" class="m-0 text-blue"><?php echo $status_text;?></label>
                                    </a>

                                    <a href="#" data-toggle="modal" onclick="content_id('<?php echo $list->idvic_blogs_news?>')" data-target="#deleteNewsModal"  class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="row" id="result_div" style="display: none;">
    
    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <ul class="pagination justify-content-center banner-pageination-wrap">
                <?php echo $links ?>
            </ul>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteNewsModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text fs-20">Confirm Delete </p>
                    <div class="text-center">
                        <button type="button" onclick="delete_content()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>