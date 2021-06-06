<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Banners</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Banners</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/home/banners/add-banner') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add Banners</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="statusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="enable">Active</option>
                        <option value="disable">InActive</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" placeholder="Search" id="input_search">
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="list_div">
        <?php if ($banner) : ?>
            <?php foreach ($banner as $list) : ?>
                <div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('<?php echo base_url('upload/banner/' . $list->vic_banner_image); ?>');">
                            </div>
                            <div class="card-body text-center">
                                <h6 class="card-title f-14 text-blue" title="VICTAM and Animal Health and Nutrition"><?php echo $list->vic_banner_title ?></h6>
                                <p class="card-text text-green-light fs-13 mb-2"><?php echo date('Y-m-d', strtotime($list->vic_banner_created_on)); ?> 
                                
                                <?php if($list->vic_banner_status == 'Rejected') { echo '<span class="text-red f-14">Rejected</span>'; } 
                                       else if($list->vic_banner_status == 'Under Review') { echo '<span class="text-blue f-14">Under Review</span>'; }
                                       else { echo $list->vic_banner_status; } ?>
                                </p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="<?php echo base_url('admin/content-management/home/banners/get_banner_by_id/' . $list->vic_banner_id) ?>" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                    <?php if ($list->vic_banner_is_active == 'enable') : ?>
                                        <a href="javascript:void(0)" onclick="update_status_banner(<?php echo $list->vic_banner_id; ?>, 'disable')" class="btn btn-card toggle-text">
                                            <input type="checkbox" id="check1" class="mr-2" checked="true">
                                            <label for="check" class="m-0 text-blue">Active</label>
                                        </a>
                                    <?php elseif ($list->vic_banner_is_active == 'disable') :  ?>
                                        <a href="javascript:void(0)" onclick="update_status_banner(<?php echo $list->vic_banner_id; ?>, 'enable')" class="btn btn-card toggle-text">
                                            <input type="checkbox" id="check1" class="mr-2">
                                            <label for="check" class="m-0 text-blue">Inactive</label>
                                        </a>
                                    <?php endif; ?>
                                    <a href="#" data-toggle="modal" data-target="#deleteBannerModal" onclick="content_id(<?php echo $list->vic_banner_id; ?>)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div id="result_div" class="row" style="display: none;">

    </div>
    <div class="row mt-3">
        <div class="col-sm-12">
            <ul class="pagination justify-content-center banner-pageination-wrap">
                <?php echo $links ?>
                <!-- <li class="page-item prev-page disabled mr-2"><a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                <li class="page-item active ml-2"><a class="page-link" href="#">1</a></li>
                <li class="page-item ml-2"><a class="page-link" href="#">2</a></li>
                <li class="page-item ml-2 mr-2"><a class="page-link" href="#">3</a></li>
                <li class="page-item next-page ml-2"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li> -->
            </ul>
        </div>
    </div>
</div>

<!-- Delete News Modal -->
<div class="modal fade" id="deleteBannerModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                        <button type="button" onclick="delete_banner_logo()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>