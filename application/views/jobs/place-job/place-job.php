<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
    <input type="hidden" id="reqpage" value="Place a job vacancy form">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pl-5 pr-5">
            <div class="place-vacancies  pl-3">
                <h4 class="pt-3">PLACE A JOB VACANCY</h4>
                <p class="f-14">Please complete the below form accurately to place a job vacancy with us.</p>
                <div class="row">
                    <div class="col-sm-9">
                        <div class="vacancy-form-card">
                            <?php
                            if (!empty($success_msg)) {
                                echo '<p class="status-msg success">' . $success_msg . '</p>';
                            } elseif (!empty($error_msg)) {
                                echo '<p class="status-msg error">' . $error_msg . '</p>';
                            }
                            $attributes = array('id' => 'vacancy-form');
                            echo form_open_multipart('e/JobsController', $attributes);
                            ?>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Company Name<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <?php if(isset($job[0]->vic_companyname)) $companyName = $job[0]->vic_companyname;
                                          elseif(isset($company[0]->vic_companyname)) $companyName = $company[0]->vic_companyname;
                                          else $companyName = "";
                                    ?>
                                    <input type="text" id="cName" name="cName" value="<?=$companyName?>" class="form-control form-control-custom" placeholder="Enter Company Name">
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Industry Sector<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-control form-control-custom" name="sector" id="sector" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <?php foreach ($sectors as $sector) : ?>
                                            <?php $status='';
                                                 if(isset($job[0]->vic_industry_sector_id) && $job[0]->vic_industry_sector_id==$sector->vic_bn_sector_id) $status = 'selected';
                                                  elseif(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector==$sector->vic_bn_sector_name) $status = 'selected';
                                            ?>
                                            <option value="<?= $sector->vic_bn_sector_id ?>" <?=$status?> ><?= $sector->vic_bn_sector_name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Job Description<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" id="jobDescription" name="jobDescription" placeholder="Enter Job Description"><?php if(isset($job[0]->vic_jobsdescription)) echo $job[0]->vic_jobsdescription;?></textarea>
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Responsibilities<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" id="responsibilities" name="responsibilities" placeholder="Enter Responsibilities"><?php if(isset($job[0]->vic_jobsresponsibilties)) echo $job[0]->vic_jobsresponsibilties;?></textarea>
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Skills<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="skill" name="skill" class="form-control form-control-custom" placeholder="Enter Skills" value="<?php if(isset($job[0]->vic_jobsskills)) echo $job[0]->vic_jobsskills;?>">
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Education Or Certification<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="education" name="education" class="form-control form-control-custom" placeholder="Enter Education Or Certification" value="<?php if(isset($job[0]->vic_jobseducation)) echo $job[0]->vic_jobseducation;?>">
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Position<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="designation" name="designation" class="form-control form-control-custom" placeholder="Enter Position" value="<?php if(isset($job[0]->vic_jobsdesignation)) echo $job[0]->vic_jobsdesignation;?>">
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Salary</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="salary" name="salary" class="form-control form-control-custom" onkeypress="return onlyNumberKey(event)" placeholder="Enter Salary" value="<?php if(isset($job[0]->vic_jobssalary)) echo $job[0]->vic_jobssalary;?>">
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Location<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <select id="location" name="location" class="form-control form-control-custom" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <?php foreach ($countries as $country) : ?>
                                            <option value="<?= $country->name ?>" <?php if(isset($job[0]->vic_jobslocation) && $job[0]->vic_jobslocation==$country->name) echo 'selected';?>><?= $country->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row text-left p-2">
                                <div class="col-sm-3">
                                    <label>Email Id<span class="text-danger">*</span> </label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="email" name="email" class="form-control form-control-custom" placeholder="Enter Email Id" value="<?php if(isset($job[0]->vic_jobscontact)) echo $job[0]->vic_jobscontact;?>">
                                </div>
                            </div>
                            <div class="text-center pt-3 pb-4">
                                <input type="hidden" name="action" value="addJobVacancy">
                                <input type="hidden" name="jobID" value="<?php if(isset($job[0]->idvic_jobs)) echo $job[0]->idvic_jobs;?>">
                                <input type="hidden" name="companyID" value="<?php if(isset($job[0]->vic_company_idvic_company)) echo $job[0]->vic_company_idvic_company;?>">
                                <button type="submit" class="btn btn-blue pl-5 pr-5">Submit</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <section>
                            <h6 class="newsletters">Newsletters</h6>
                            <a href="https://victam.com/showtime-subscription-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Showtime subscription form</a>
                            <a href="https://victam.com/advertising-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Showtime advertisement form</a>
                            <a href="https://victam.com/admin/subscribe" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Newsletter subscription form</a>
                            <a href="https://victam.com/network-subscription-form" target="_blank" class="d-block f-14 mb-1 text-blue"><i class="fa fa-angle-right pr-2"></i> Who-Is-Who subscription form</a>
                        </section>

                        <div id="advertisment-list">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
    </div>
</body>
<?php if ($this->session->flashdata('flash_success')) { ?>
    <script>
        toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
    </script>
<?php } else if ($this->session->flashdata('flash_error')) { ?>
    <script>
        toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
    </script>
<?php } ?>