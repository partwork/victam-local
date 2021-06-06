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
                        <div class="login-form pt-3">
                            <h6>Forgot your password ?</h6>
                            <p class="f-12">Enter your email id to reset the password</p>
                            <?php
                            $attributes = array('id' => 'forgotPasswordForm');
                            echo form_open_multipart('i/ForgotPasswordController', $attributes);
                            ?>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-custom" name="email" placeholder="Email Id">
                            </div>
                            <input type="hidden" name="resetlink" value="sendEmail">
                            <input type="submit" class="btn btn-sign-in form-control" name="action" value="Send Reset Instructions">
                            <p class="pt-3 f-12 icon-align">Did you remembered your password? <a class="text-blue" href="<?php echo base_url(); ?>login">Try sign in</a></p>
                            <p class="pt-3 f-12 icon-align"><a href="<?php echo base_url(); ?>login">Back To Sign In</a></p>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<?php if ($this->session->flashdata('flash_success')) { ?>
    <script>
        toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
    </script>
<?php }
if ($this->session->flashdata('flash_error')) { ?>
    <script>
        toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
    </script>
<?php } ?>