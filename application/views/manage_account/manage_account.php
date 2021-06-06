<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pl-3 pr-3 pt-3 profile-nav-wrapper">
            <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="img-ellipse" />
            <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="img-ellipse2" />
            <div class="row">
                <div class="col-sm-12 p-0">
                    <ul class="nav nav-pills profile-nav-pills">
                        <li class="nav-item"><a data-toggle="pill" class="nav-link active" href="#pi">Manage Account</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="pi" class="tab-pane fade show active">
                            <div class="form-group">
                                <div class="row pt-1">
                                    <div class="col-sm-12 mb-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group text-center mt-5">
                                                    <label for="usr"><b>Note -</b> Deleting your account will delete profile details, company information, events, jobs and forums permanently.<span class="text-danger">*</span></label><br />
                                                    <button type="submit" class="btn btn-blue pl-5 pr-5 mt-3" data-toggle="modal" data-target="#confirmDialog">Delete My Account</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- The Modal -->
    <div class="modal" id="confirmDialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png" alt="" style="width:150px;margin:0 auto;"><br/>
                    <!-- <h5 class="modal-title p-2 w-100">Do you really delete your account?</h5> -->
                </div>
                <?php
                    $attributes = array('id' => 'account-form');
                    echo form_open_multipart('e/ManageAccountController/delete_account', $attributes);
                ?>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row pt-2 pb-2">
                            <div class="col-sm-12">
                                <div class="form-group text-center">
                                    <h6 class="modal-title p-2 w-100">Do you really want to delete the account?</h6>
                                </div>
                                <div class="form-group">
                                    <label for="usr">Enter  Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your account password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-blue pl-5 pr-5 mt-3">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
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