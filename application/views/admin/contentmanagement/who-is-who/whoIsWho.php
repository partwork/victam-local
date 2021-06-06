<div class="container-fluid body-wrapper pl-24vw">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Who Is Who</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Who Is Who</li>
                        </ol>
                    </nav>
                </h4>
                <!-- <a href="<?php echo base_url('admin/content-management/who-is-who/addCompany') ?>" class="btn btn-blue float-right f-14 pl-4 pr-4">Add Company</a> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="filter-wrap">
                <div class="status-wrap">
                    <label for="statusFilter">Status Filter</label>
                    <select id="whostatusFilter" name="whostatusFilter" class="form-control" required>
                        <option value="" disabled selected hidden class="placeholder-text">Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">InActive</option>
                    </select>
                </div>
                <div class="search-wrap">
                    <input type="text" class="form-control" placeholder="Search" id="who_input_search" name="who_input_search">
                </div>
            </div>
        </div>
    </div>  
    <div class="row" id="list_div">


        <?php if($company) : ?> 
            <?php foreach($company as $list) : ?>
                <div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('<?php echo base_url('upload/company/'.$list->vic_companylogo); ?>');">
                            </div>
                            <div class="card-body text-center">
                            <?php $u_time =  strtotime($list->vic_company_created_on) ?>
                                <p class="card-text text-green-light fs-13 mb-0"> <?php echo  $list->vic_companyname;?>
                                 <?php if($list->vic_company_status == 'Rejected') { echo '<span class="text-red f-14">Rejected</span>'; } 
                                       else if($list->vic_company_status == 'Under Review') { echo '<span class="text-blue f-14">Under Review</span>'; }
                                       else { echo $list->vic_company_status; } ?></p>
                                <p class="card-text text-green-light fs-13"> <?php  echo date('F d, Y', $u_time); ?> </p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="<?php echo base_url('admin/contentmanagement/WhoIsWhoController/get_company_details_by_ids/'. $list->idvic_company) ?>" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                     <?php if($list->vic_company_is_active == 'active'): ?>
                                    <a href="javascript:void(0)" class="btn btn-card toggle-text">
                                        <input type="checkbox" id="check1" class="mr-2 update_status_who" checked="true" onclick="whoiswho_status(<?php echo  $list->idvic_company;?>,'inactive')">
                                        <label for="check" class="m-0 text-blue">Active</label>
                                    </a>
                                
                                <?php else: ?>
                                    <a href="javascript:void(0)" class="btn btn-card toggle-text">
                                        <input type="checkbox" id="check1" class="mr-2 update_status_who" onclick="whoiswho_status(<?php echo  $list->idvic_company;?>,'active')">
                                        <label for="check" class="m-0 text-blue">Inactive</label>
                                    </a>
                                <?php endif;?>    
                                    <a href="#" class="btn btn-card"  data-toggle="modal" data-target="#deleteNewsModal" onclick="content_id(<?php echo $list->idvic_company; ?>)"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
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
                        <p class="pt-3 modal-center-text fs-20">Deleting company information will delete all the data related to events and jobs.</p>
                        <div class="text-center">
                            <button type="button" onclick="content_iddelete_company_id()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                            <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php if (isset($_GET['res']) && $_GET['res']=='success') { ?>
    <script>
        toastr["success"]("Company update successfully");
    </script>
    <?php } else if (isset($_GET['res'])) { ?>
        <script>
            toastr["error"]("Failed to update");
        </script>
    <?php } ?>