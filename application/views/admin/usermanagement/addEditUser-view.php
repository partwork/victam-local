<div class="container-fluid body-wrapper pl-24vw">
    <?php
    $attributes = array('id' => 'user_form');
    echo form_open_multipart('#', $attributes);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="page-top-elements">
                <h4 class="page-title-wrap">
                    <span>Manage User</span>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/manage-user">Manage User</a> </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo  $activePage; ?></li>
                        </ol>
                    </nav>
                </h4>

                <a href="<?php echo base_url('admin/manage-user'); ?>" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                <!-- <a href="#" data-toggle="modal" data-target="#confirmationBox" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4">Save</a> 
                -->
                <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" value="Save">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-wrapper">

                <input type="hidden" id="vicId" name="id" value="<?php if (isset($udata['iduser_details'])) {
                                                            echo $udata['iduser_details'];
                                                        } ?>">
                <div class="form-group row">
                    <?= validation_errors(); ?>
                    <label class="col-sm-2 col-form-label">Select User Role</label>
                    <div class="col-sm-10 radio-wrapper">
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="userRole" id="userRole1" value="super admin" <?php if ($udata['vic_user_role'] == 'super admin') {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                            <label class="form-check-label" for="userRole1">
                                Super Admin
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="userRole" id="euserRole2" value="admin" <?php if ($udata['vic_user_role'] == 'admin') {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label" for="euserRole2">
                                Admin
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="userRole" id="userRole3" value="publisher - moderator" <?php if ($udata['vic_user_role'] == 'publisher - moderator') {
                                                                                                                                            echo 'checked';
                                                                                                                                        } ?>>
                            <label class="form-check-label" for="userRole3">
                                Publisher - Moderator
                            </label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="userRole" id="userRole4" value="content moderator" <?php if ($udata['vic_user_role'] == 'content moderator') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?>>
                            <label class="form-check-label" for="userRole4">
                                Content Moderator
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="fname" value="<?php if (!empty($udata)) {
                                                                                        echo $udata['vic_user_firstname'];
                                                                                    } ?>" id="fname" placeholder="Enter First Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lname" value="<?php if (!empty($udata)) {
                                                                                        echo $udata['vic_user_lastname'];
                                                                                    } ?>" id="lname" placeholder="Enter Last Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)" name="contact" value="<?php if (!empty($udata)) {
                                                                                                                                    echo $udata['user_mobile'];
                                                                                                                                } ?>" id="contact" placeholder="Enter Contact Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email Id </label>
                    <div class="col-sm-6 pr-0">
                        <input type="text" id="email_input" class="form-control" name="email" value="<?php if (!empty($udata)) {
                                                                                                            $part = explode('@', $udata['user_email']);
                                                                                                            echo $part[0];
                                                                                                        } ?>" placeholder="Enter Email Id">
                    </div>
                    <label class="col-sm-4 col-form-label pl-1">@victam.com</label>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-6">
                        <label class="switch">
                            <input type="checkbox" value="active" name="status" id="status" <?php if ($udata['vic_user_status'] == 'active') {
                                                                                                echo 'checked';
                                                                                            } ?>>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                </form>
                
            </div>
        </div>
    </div>
    </form>
</div>

<div class="modal fade" id="confirmationBox" role="dialog" aria-labelledby="confirmationBox" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="text-center">
                    <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                    <p class="pt-3 modal-center-text fs-20" id="add-edit-msg"></p>
                    <div class="text-center">
                        <a onclick="window.history.back();" class="add-company-details" aria-label="Close">OK</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>