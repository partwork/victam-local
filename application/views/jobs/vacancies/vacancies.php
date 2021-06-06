<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = (isset($_SESSION['plan_id'])) ? $_SESSION['plan_id'] : ''; ?>
<?php $userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : ''; ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
        <div class="list-vacancies">
            <div class="row pr-5">
                <div class="col-sm-3 ">
                    <div class="filters-wrap">
                        <div class="mb-4">
                            <span>Filters</span>
                            <button type="button" class="btn btn-blue btn-sm float-right btn-reset">Reset filters</button>
                        </div>

                        <div class="form-group">
                            <?php if (isset($search)) $status = $search;
                            else $status = "";  ?>
                            <input type="text" id="search" class="form-control" value="<?= $status ?>" placeholder="Search by designation, key skills , co...">
                            <i class="fa fa-search search-filter"></i>
                        </div>
                        <div class="form-group">
                            <label for="sel1">Display</label>
                            <select class="form-control" id="display" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                <option value="all">All Sectors</option>
                                <?php foreach ($sectors as $sector) : ?>
                                    <?php if (isset($display) && $display == $sector->vic_bn_sector_id) $status = "selected";
                                    else $status = ""; ?>
                                    <option value="<?= $sector->vic_bn_sector_id ?>" <?= $status ?>><?= $sector->vic_bn_sector_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Refine</label>
                            <select id="refine" class="form-control form-control-custom" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                <option value="all">All Country</option>
                                <?php foreach ($countries as $country) : ?>
                                    <?php if (isset($searchCountry) && $searchCountry == $country->name) $status = "selected";
                                    else $status = ""; ?>
                                    <option value="<?= $country->name ?>" <?= $status ?>><?= $country->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="button" onclick="add_jobs_clickHandel( '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $this->session->userdata('job_plan')?>')" class="btn btn-blue form-control btn-place-job-vacancy">Place A Job Vacancy</button>
                        <?php if ($this->session->userdata('plan_id') == 3 || $this->session->userdata('plan_id') == 2) { ?>
                        <button type="button" class="btn btn-blue form-control btn-place-job-vacancy btn-manage mt-3">Manage Jobs</button>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-9 pr-4 pt-3" id="jobs-list">
                    <h4 class="text-title-small fw-400 mt-3">VACANCIES</h4>
                    <div class="row" id="Ajaxresult">
                        <?php foreach ($jobs as $job) : ?>
                            <div class="col-sm-4 pt-3 pb-3">
                                <div class="vacancie-card">
                                    <h6 class="pt-2 pb-1 mb-0 company-name"><?= $job->vic_company_name ?></h6>
                                    <p class="job-title mb-1" onclick="get_job_details(<?php echo $job->idvic_jobs; ?>)"><?= $job->vic_jobsdesignation ?></p>
                                    <p class="f-14 mb-2 job-desc"><?= $job->vic_jobsdescription ?></p>
                                    <div class="pb-1 location-wrap f-14"> <img class="pr-1" src="<?php echo base_url(); ?>application/assets/shared/img/icon/noun_Location.png"> Location - <?= $job->vic_jobslocation ?></div>
                                    <button class="btn btn-blue mt-2 mb-1 btn-react-opportunity btn-sm" data-toggle="modal" data-id="<?= $job->idvic_jobs ?>" data-name="<?= $job->vic_jobsdesignation ?>">React to the Opportunity</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Job description -->
                <!-- <div class="col-sm-9 pr-4 pt-3" id="job-details">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <img src=""
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-sm-9 pr-4 pt-3" id="manage-jobs">
                    <div class="row mb-4">
                        <div class="col-sm-12">
                            <h4 class="text-title-small fw-400 mt-3 float-left">MANAGE JOBS</h4>
                            <button type="button" class="btn btn-blue btn-back float-right">Back</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <nav class="nav nav-pills nav-justified">
                                <a class="nav-item nav-link active" data-toggle="tab" href="#active">Active</a>
                                <a class="nav-item nav-link" data-toggle="tab" href="#inactive">Inactive</a>
                            </nav>

                            <div class="tab-content">
                                <div class="tab-pane fade in active show" id="active">
                                    <div class="row">
                                        <?php foreach ($active as $job) : ?>
                                            <div class="col-sm-4 pt-3 pb-3">
                                                <div class="vacancie-card vacancie-card-manage">
                                                    <!-- <img class="vacancie-img" src="<?php echo base_url(); ?>application/assets/shared/img/icon/mask_group.png"> -->
                                                    <h6 class="pt-2 pb-1 mb-0 company-name"><?= $job->vic_company_name ?></h6>
                                                    <p class="job-title mb-1"><?= $job->vic_jobsdesignation ?></p>
                                                    <p class="f-14 mb-2 job-desc"><?= $job->vic_jobsdescription ?></p>
                                                    <!-- <div class="pb-1 location-wrap f-14"> <img class="pr-1" src="<?php echo base_url(); ?>application/assets/shared/img/icon/noun_Money.png"> Salary - <?= $job->vic_jobssalary ?></div> -->
                                                    <div class="pb-1 location-wrap f-14"> <img class="pr-1" src="<?php echo base_url(); ?>application/assets/shared/img/icon/noun_Location.png"> Location - <?= $job->vic_jobslocation ?></div>
                                                    
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <!-- <button type="button" class="btn btn-blue"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</button> -->
                                                        <a href="<?php echo base_url() ?>jobs/place-job/<?= $job->idvic_jobs ?>" class="btn btn-blue"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                                        <button type="button" class="btn btn-blue active-inactive-btn"><input type="checkbox" id="activeCheck" checked="true" value="<?= $job->idvic_jobs ?>"><label for="check">Active</label></button>
                                                        <button type="button" data-toggle="modal" data-target="modal" data-id="<?= $job->idvic_jobs ?>" data-dismiss="modal" class="btn btn-blue btn-delete-job"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</button>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="inactive">
                                    <div class="row">
                                        <?php foreach ($inactive as $job) : ?>
                                            <div class="col-sm-4 pt-3 pb-3">
                                                <div class="vacancie-card vacancie-card-manage">
                                                    <!-- <img class="vacancie-img" src="<?php echo base_url(); ?>application/assets/shared/img/icon/mask_group.png"> -->
                                                    <h6 class="pt-2 pb-1 mb-0 company-name"><?= $job->vic_company_name ?></h6>
                                                    <p class="job-title mb-1"><?= $job->vic_jobsdesignation ?></p>
                                                    <p class="f-14 mb-2 job-desc"><?= $job->vic_jobsdescription ?></p>
                                                    <!-- <div class="pb-1 location-wrap f-14"> <img class="pr-1" src="<?php echo base_url(); ?>application/assets/shared/img/icon/noun_Money.png"> Salary - <?= $job->vic_jobssalary ?></div> -->
                                                    <div class="pb-1 location-wrap f-14"> <img class="pr-1" src="<?php echo base_url(); ?>application/assets/shared/img/icon/noun_Location.png"> Location - <?= $job->vic_jobslocation ?></div>
                                                    
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="<?php echo base_url() ?>jobs/place-job/<?= $job->idvic_jobs ?>" class="btn btn-blue"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                                        <button type="button" class="btn btn-blue active-inactive-btn"><input type="checkbox" id="inactiveCheck" value="<?= $job->idvic_jobs ?>"><label for="check">InActive</label></button>
                                                        <button type="button" data-toggle="modal" data-target="modal" data-id="<?= $job->idvic_jobs ?>" data-dismiss="modal" class="btn btn-blue btn-delete-job"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</button>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('shared/footer/footer'); ?>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>


    <!-- React to the Opportunity Modal -->
    <div class="modal" id="reactModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div>
                    <button type="button" class="close pr-2 pt-2" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="text-center">
                        <h3 class="form-title designation"></h3>
                        <h3 class="form-title">Contact Form</h3>
                        <p class="form-sub-title">After filling in and sending the below form, the company will be informed about your interest in the vacancy.</p>

                        <?php
                        $attributes = array('id' => 'contact-form');
                        echo form_open_multipart('e/JobsController', $attributes);
                        ?>
                        <div class="row text-left p-2">
                            <div class="col-sm-4">
                                <label>Contact Name<span class="text-danger">*</span> </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="cName" name="cName" class="form-control form-control-custom" placeholder="Enter Contact Name">
                            </div>
                        </div>
                        <div class="row text-left p-2">
                            <div class="col-sm-4">
                                <label>Email ID<span class="text-danger">*</span> </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="email" id="email" name="email" class="form-control form-control-custom" placeholder="Enter Email ID">
                            </div>
                        </div>
                        <div class="row text-left p-2">
                            <div class="col-sm-4">
                                <label>Phone Number<span class="text-danger">*</span> </label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="phone" name="phone" class="form-control form-control-custom" placeholder="Enter Phone Number" >
                            </div>
                        </div>
                        <div class="row text-left p-2">
                            <div class="col-sm-4">
                                <label>Current Company</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="company" name="company" class="form-control form-control-custom" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="row text-left p-2">
                            <div class="col-sm-4">
                                <label>Current Position</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" id="designation" name="designation" class="form-control form-control-custom" placeholder="Enter Current Position">
                            </div>
                        </div>
                        <div class="row text-left p-2">
                            <div class="col-sm-4">
                                <label>Country<span class="text-danger">*</span> </label>
                            </div>
                            <div class="col-sm-8">
                                <select id="country" name="country" class="form-control form-control-custom" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <?php foreach ($countries as $country) : ?>
                                        <option value="<?= $country->name ?>"><?= $country->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <input type="hidden" name="action" value="applyJob">
                            <input type="hidden" name="jobId" id="jobId">
                            <button type="submit" class="btn btn-blue pl-5 pr-5">Submit</button>
                        </div>
                        <?php echo form_close(); ?>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Job Details Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog job-dialog-modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <img id="companylogo" src="" style="width:10vw;" />
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="vic_jobsdesignation"></h5>
                    <p class="location-company-wrap">
                        <span class="comp-name ml-0 fw-700" id="vic_company_name"></span> |
                        <span class="comp-name f-14" id="vic_active_industry2"></span> |
                        <span class="location-mark"><i class="fa fa-map-marker mr-2" aria-hidden="true"></i><span id="vic_jobslocation"></span></span>
                    </p>
                    <p class="f-14 mb-1"><i class="fa fa-money mr-2" aria-hidden="true"></i><span class="">Salary</span> - <span class="fw-300 fs-12" id="vic_jobssalary"></span></p>
                    <!-- <p class="f-14"><i class="fa fa-envelope-o mr-2" aria-hidden="true"></i><span class="">Email Id</span> - <span class="fw-300 fs-12" id="vic_jobscontact"></span></p> -->
                    <p class="posted-duration" id="vic_created_on"></p>
                    <p class="text-center"><button class="btn btn-blue mt-2 mb-1 btn-react-opportunity1 btn-sm" id="react" data-toggle="modal" data-id="" data-name="" data-dismiss="modal" aria-label="Close">React to the Opportunity</button></p>
                    <hr />

                    <h6>Job Description</h6>
                    <p class="fw-300 f-14" id="vic_jobsdescription"></p>
                    <hr />
                    <h6>Responsibilities</h6>
                    <p class="fw-300 f-14" id="vic_jobsresponsibilties"></p>
                    <hr />
                    <h6>Skills</h6>
                    <p class="fw-300 f-14" id="vic_jobsskills"></p>
                    <hr />
                    <h6>Education Or Certification</h6>
                    <p class="fw-300 f-14" id="vic_jobseducation"></p>
                    <?php $url = base_url()."jobs/vacancy";
                        $url = "http://dev.victam.com/jobs/vacancy" ?>
                    <div class="float-right">
                    <a target="_blank" id="facebookinfo" href="" class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/facebook.png" height="15" width="15"></a>
                    <a target="_blank" id="linkedinfo" href="" class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/linkedin.png" height="15" width="15"></a>
                    <a target="_blank" id="twitterinfo" href="" class="share-social-icon"><img src="<?php echo base_url(); ?>application/assets/shared/img/icon/twitter.png" height="15" width="15"></a>
                 </div>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- Delete News Modal -->
<div class="modal fade" id="deleteModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text">Are you sure you want to delete?</p>
                    <div class="text-center">
                        <input type="hidden" name="job_id" id="job_id" value="">
                        <button type="button" class="add-company-details" data-dismiss="modal" id="delete_job" aria-label="Close">OK</button>
                        <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if ($this->session->flashdata('flash_success')) { ?>
    <script>
        toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
    </script>
<?php } else if ($this->session->flashdata('flash_error')) { ?>
    <script>
        toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
    </script>
<?php } ?>