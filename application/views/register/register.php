<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <section class="banner" id="Home">
        <div class="banner-content">
            <div class="card">
                <div class="card-body">
                    <div class="pt-2">
                    <?php  
                        if(!empty($success_msg)){ 
                            echo '<p class="status-msg success">'.$success_msg.'</p>'; 
                        }elseif(!empty($error_msg)){ 
                            echo '<p class="status-msg error">'.$error_msg.'</p>'; 
                        }
                        
                    ?>
                    <a href="<?php echo base_url(); ?>">
                    <img class="logo" src="<?php echo base_url(); ?>application/assets/shared/img/logo.png">
                    </a>
                        <div class="registration-form pt-3">
                            <h6 class="mb-3">Create an Account</h6>
                            <?php   
                            $attributes = array('id' => 'registration-form');
                            echo form_open_multipart('i/RegisterController', $attributes);
                            ?>
                            <?php
                            if (!empty($success_msg)) {
                                echo '<p class="status-msg success">' . $success_msg . '</p>';
                            } elseif (!empty($error_msg)) {
                                echo '<p class="status-msg error">' . $error_msg . '</p>';
                            }
                            ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-custom" name="email" placeholder="Email Id">
                                <?php echo form_error('email', '<p class="status-msg error">', '</p>'); 

                                if(($this->session->flashdata('error')) != NULL) { 
                                    echo '<p>' . $this->session->flashdata('error') . '</p>';
                                } 
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-custom" name="password" id="password" placeholder="Password">
                                <?php echo form_error('password', '<p class="status-msg error">', '</p>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-custom" name="conf_password" id="conf_password" placeholder="Confirm Password">
                                <?php echo form_error('conf_password', '<p class="status-msg error">', '</p>'); ?>
                            </div>
                            <input type="submit" class="btn btn-sign-up form-control" name="action" value="Sign Up">
                            <div class="pt-3 icon-align">
                                <div class="mb-2 fs-12">or Sign Up with</div>
                                <?php if (isset($login_button)) echo $login_button ?>
                                <img class="social-icon" src="<?php echo base_url(); ?>application/assets/shared/img/icon/linkedin.png">
                                <a href="<?php if (isset($this->facebook)) echo $this->facebook->login_url(); ?>">
                                    <img class="social-icon" src="<?php echo base_url(); ?>application/assets/shared/img/icon/facebook.png">
                                </a>
                            </div>
                            <p class="pt-3 fs-12 icon-align ">By creating an account, you agree to our <a class="text-blue" href="<?php echo base_url(); ?>privacy-policy">Privacy Policy</a></p>
                            <p class="pt-3 fs-12 icon-align">Already have an account? <a class="text-blue" href="<?php echo base_url(); ?>login">Sign In</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>