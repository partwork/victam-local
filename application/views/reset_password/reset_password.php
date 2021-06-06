<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <section class="banner" id="Home">
        <div class="overlay"></div>
        <div class="banner-content">
            <div class="card">
                <div class="card-body">
                    <div class="pt-5">
                        <a href="<?php echo base_url(); ?>">
                            <img class="logo" src="<?php echo base_url(); ?>application/assets/shared/img/logo.png">
                        </a>
                        <div class="registration-form pt-3">
                            <h6>Reset your password</h6>
                            <?php
                            if ($this->session->flashdata('error')) {
                                echo '<p class="status-msg error">' . $this->session->flashdata('error') . '</p>';
                            }
                            $attributes = array('id' => 'registration-form');
                            echo form_open_multipart('i/ResetPasswordController', $attributes);
                            ?>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-custom" name="password" id="password" placeholder="Password">
                                <?php echo form_error('password', '<p class="status-msg error">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-custom" name="conf_password" placeholder="Confirm Password">
                                <?php echo form_error('conf_password', '<p class="status-msg error">', '</p>'); ?>
                            </div>
                            <input type="hidden" name="query" value="<?php echo $this->input->get('q') ?>">
                            <input type="hidden" name="query1" value="<?php echo $this->input->get('t') ?>">
                            <input type="submit" class="btn btn-sign-up form-control" name="action" value="Reset">

                            <p class="pt-3 f-12">Did you remembered your password?<a href="<?php echo base_url(); ?>login">Try sign in</a></p>
                            </form>
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