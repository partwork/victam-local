<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Advertisements</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                            <li class="breadcrumb-item active" aria-current="page">Advertisements</li>
                        </ol>
                    </nav>
                </h4>
                <a href="<?php echo base_url('admin/content-management/home/advertisement/add-advertisement') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add New Ads</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="adv_statusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">InActive</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" placeholder="Search" id="adv_input_serach">
                </div>
            </div>
        </div>
    </div>
    <div class="row" id="list_div">
        <?php if ($content) : ?>
            <?php 
            foreach ($content as $list) :
            ?>
                <div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('<?php echo base_url('upload/advertisment/' . $list->vic_advertisment_img_path); ?>');">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text text-green-light fs-13 mb-2"><?php echo date('Y-m-d',strtotime($list->vic_advertisment_created_on)); ?> <?php if($list->vic_advertisment_status == 'Rejected') { echo '<span class="text-red f-14">Rejected</span>'; }else if($list->vic_advertisment_status == 'Under Review') { echo '<span class="text-blue f-14">Under Review</span>'; }else{ echo $list->vic_advertisment_status;}  ?></p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="<?php echo base_url('admin/content-management/home/advertisement/get-advertisement-news/'.$list->idvic_advertisment) ?>" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                    <!-- <a href="javascript:void(0)" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2" checked="true"><label for="check" class="m-0 text-blue">Active</label></a> -->
                                    <?php if ($list->vic_advertisment_is_active == 'active') : ?>
                                        <a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                            <input type="checkbox" onclick="update_status_advertisment(<?php echo $list->idvic_advertisment; ?>, 'inactive')" id="check1" class="mr-2" checked="true"><label for="check" class="m-0 text-blue">Active</label></a>
                                    <?php else :  ?>
                                        <a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                            <input type="checkbox" onclick="update_status_advertisment(<?php echo $list->idvic_advertisment; ?>, 'active')" id="check1" class="mr-2"><label for="check" class="m-0 text-blue">Inactive</label></a>
                                    <?php endif; ?>
                                    <a href="#" data-toggle="modal" data-target="#deleteAdvertismentModal" onclick="content_id(<?php echo $list->idvic_advertisment; ?>)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
    </div>
    <div class="row" id="result_div" style="display:none;">
        
    </div>
    <!-- <div class="row mt-3">
        <div class="col-sm-12">
            <ul class="pagination justify-content-center">
                <li class="page-item prev-page disabled mr-2"><a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                <li class="page-item active ml-2"><a class="page-link" href="#">1</a></li>
                <li class="page-item next-page ml-2"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div> -->
    <div class="row mt-3">
        <div class="col-sm-12">
            <ul class="pagination justify-content-center">
             <?php echo $links ?>
            </ul>
        </div>
    </div>
</div>

<!-- Delete News Modal -->
<div class="modal fade" id="deleteAdvertismentModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
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
                        <button type="button" onclick="delete_advertisment()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
