<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <section class="banner" id="Home">
        
        <div class="banner-content">
            <div class="card">
                <div class="card-body">
                    <div class="pt-5">

                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png">
                        </a>
                        <div class="login-form pt-3">
                            <h6 class="mb-3">Login to Your Account</h6>
                            <?php
                            $attributes = array('id' => 'login-form');
                            echo form_open_multipart('i/LoginController', $attributes);
                            ?>

                            <?php
                            if (!empty($success_msg)) {
                                echo '<p class="status-msg success">' . $success_msg . '</p>';
                            } elseif (!empty($error_msg)) {
                                echo '<p class="status-msg error">' . $error_msg . '</p>';
                            }
                            ?>
                            <?php if (($this->session->flashdata('error')) != NULL) {
                                echo '<p class="status-msg error">' . $this->session->flashdata('error') . '</p>';
                            }
                            if (($this->session->flashdata('sucess')) != NULL) {
                                echo '<p class="status-msg success">' . $this->session->flashdata('sucess') . '</p>';
                            }
                            ?>


                            <div class="form-group">
                                <input type="text" class="form-control form-control-custom" name="email" placeholder="Email Id">
                                <?php echo form_error('email', '<p class="status-msg error">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-custom" name="password" placeholder="Password">
                                <?php echo form_error('password', '<p class="status-msg error">', '</p>'); ?>
                            </div>
                            <input type="submit" class="btn btn-sign-in form-control" name="action" value="Sign In">
                            <div class="pt-3 icon-align">
                                <div class="mb-2 fs-12">or sign in with</div>
                                <?php if (isset($login_button)) echo $login_button ?>
                                <img class="social-icon" src="<?php echo base_url(); ?>application/assets/shared/img/icon/linkedin.png">
                                <a href="<?php echo $this->facebook->login_url(); ?>">
                                    <img class="social-icon" src="<?php echo base_url(); ?>application/assets/shared/img/icon/facebook.png">
                                </a>
                            </div>
                            <div class="pt-3 mb-1 icon-align">
                                <a href="<?php echo base_url(); ?>forgotPassword" class="text-blue f-14">Forgot Password?</a>
                            </div>
                            <p class="pt-3 fs-12 icon-align">Doesn’t have an account? <a class="text-blue" href="<?php echo base_url(); ?>register">Register</a></p>
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
<?php } else if ($this->session->flashdata('flash_error')) { ?>
    <script>
        toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
    </script>
<?php } ?>