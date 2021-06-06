<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <section class="banner" id="Home">
        <div class="overlay"></div>
        <div class="banner-content">
            <div class="card">
                <div class="card-body">
                    <div class="pt-5">

                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png">
                        </a>
                        <form id="resetpassword">
                            <div class="login-form pt-3">
                                <h6 class="mb-3">Reset Password</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-custom" name="email" placeholder="Enter Old Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-custom" name="password" placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-custom" name="password" placeholder="Confirm Password">
                                </div>
                                <input type="submit" class="btn btn-sign-in form-control" name="action" value="Sign In">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>