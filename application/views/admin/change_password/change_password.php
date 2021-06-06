<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container-fluid body-wrapper pl-24vw">
    <div class="row mt-5">
        <div class="col-sm-12">
            <section class="pl-3 pr-3 pt-3 profile-nav-wrapper">
            <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="img-ellipse" />
            <img src="<?php echo base_url(); ?>application/assets/shared/img/bottom-left-ellipse.png" class="img-ellipse2" />
            <div class="row">
                <div class="col-sm-12 p-0">
                    <h3 class="text-center">Change Password</h3>

                    <div class="tab-content">
                        <div id="cp" class="tab-pane fade show active">
                        <form id="resetpassword">
                            <div class="form-group">
                                <div class="row pt-1 mt-5">
                                    <div class="col-sm-4 offset-sm-2">
                                        <div class="form-group">
                                            <label for="usr">Old Password<span class="text-danger">*</span></label>
                                            <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter Old Password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="usr">New Password<span class="text-danger">*</span></label>
                                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter New Password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center pt-5 pb-5">
                                <button type="submit" class="btn btn-blue pl-5 pr-5">Save</button>
                                <button type="button" onclick="resetFrom()" class="btn btn-blue-border pl-5 pr-5 ml-3">Cancel</button>
                            </div>
                        </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        </div>
    </div>
</div>
