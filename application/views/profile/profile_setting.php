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
                        <li class="nav-item"><a data-toggle="pill" class="nav-link active" href="#pi">Personal Information</a></li>
                        <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#ci">Company Information</a></li>
                        <li class="nav-item"><a data-toggle="pill" class="nav-link" href="#cp">Change Password</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="pi" class="tab-pane fade show active">
                            <?php
                            $attributes = array('id' => 'userProfileForm');
                            echo form_open_multipart('e/ProfileController/update_personal_info', $attributes);
                            ?>
                            <div class="form-group">
                                <div class="row pt-1">
                                    <div class="col-sm-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="usr">User Profile<span class="text-danger">*</span></label>
                                                    <select class="form-control" id="userProfile" name="userType" required>
                                                        <option value="" disabled selected hidden>Select</option>
                                                        <option value="Grain, soy, rice farmers" <?php if (!empty($user) && $user->vic_user_type == "Grain, soy, rice farmers") echo 'selected' ?>>Grain, soy, rice farmers</option>
                                                        <option value="Ingredient/feed additive producers" <?php if (!empty($user) && $user->vic_user_type == "Ingredient/feed additive producers") echo 'selected' ?>>Ingredient/feed additive producers</option>
                                                        <option value="Feed processing technology" <?php if (!empty($user) && $user->vic_user_type == "Feed processing technology") echo 'selected' ?>>Feed processing technology</option>
                                                        <option value="Grain processing technology" <?php if (!empty($user) && $user->vic_user_type == "Grain processing technology") echo 'selected' ?>>Grain processing technology</option>
                                                        <option value="Feed processing companies" <?php if (!empty($user) && $user->vic_user_type == "Feed processing companies") echo 'selected' ?>>Feed processing companies</option>
                                                        <option value="Self-mixers" <?php if (!empty($user) && $user->vic_user_type == "Self-mixers") echo 'selected' ?>>Self-mixers</option>
                                                        <option value="Flour millers" <?php if (!empty($user) && $user->vic_user_type == "Flour millers") echo 'selected' ?>>Flour millers</option>
                                                        <option value="Logistic or service companies" <?php if (!empty($user) && $user->vic_user_type == "Logistic or service companies") echo 'selected' ?>>Logistic or service companies</option>
                                                        <option value="Animal Farmers / Breeding companies" <?php if (!empty($user) && $user->vic_user_type == "Animal Farmers / Breeding companies") echo 'selected' ?>>Animal Farmers / Breeding companies</option>
                                                        <option value="Food producing companies" <?php if (!empty($user) && $user->vic_user_type == "Food producing companies") echo 'selected' ?>>Food producing companies</option>
                                                    </select>
                                                    <?php echo form_error('userType', '<p class="status-msg error">', '</p>'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="usr">Field Of Interest <span class="text-danger">*</span></label>
                                                    <select class="form-control w-100" id="fieldOfInterest" name="interest" required>
                                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                                        <?php foreach ($InterestFields as $s) : ?>
                                                            <option value="<?= $s->idvic_fieldsofinterest ?>" <?php if (!empty($user) && $user->vic_fieldsofinterest_idvic_fieldsofinterest == $s->idvic_fieldsofinterest) echo 'selected' ?>><?= $s->vic_fieldname ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php echo form_error('interest', '<p class="status-msg error">', '</p>'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="fname" class="form-control" placeholder="Enter first name" maxlength="26" value="<?php if (!empty($user)) echo $user->vic_user_firstname ?>" required>
                                            <?php echo form_error('fname', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="lname" class="form-control" placeholder="Enter last name" maxlength="26" value="<?php if (!empty($user)) echo $user->vic_user_lastname ?>">
                                            <?php echo form_error('lname', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Email Id <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" placeholder="Enter email id" value="<?php if (!empty($user)) echo $user->user_email; elseif($this->session->userdata('email')) echo $this->session->userdata('email') ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Country<span class="text-danger">*</span></label>
                                            <select class="form-control" required name="country" id="types">
                                                <option value="" disabled selected hidden class="placeholder-text">Select Country</option>
                                                <?php foreach ($countries as $country) : ?>
                                                    <option value="<?= $country->name ?>" <?php if (!empty($user) && $country->name == $user->vic_user_country) echo 'selected' ?>><?= $country->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php echo form_error('country', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group row">
                                            <label for="usr" class="col-sm-12">Mobile Phone </label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="country_code" id="country_code" value="<?php if (!empty($user)) echo $user->vic_user_details_country_code ?>" readonly>
                                            </div>
                                            <div class="col-sm-9 pl-0 contact">
                                                <input type="text" name="pContact" class="form-control " placeholder="Enter Mobile Phone" value="<?php if (!empty($user)) echo $user->vic_user_primarycontact ?>">
                                            </div>
                                            <?php echo form_error('pContact', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Gender <span class="text-danger">*</span></label>
                                            <select class="form-control" required name="gender">
                                                <option value="" disabled selected hidden class="placeholder-text">Select Gender</option>
                                                <option value="Male" <?php if (!empty($user) && $user->vic_user_details_gender == "Male") echo 'selected' ?>>Male</option>
                                                <option value="Female" <?php if (!empty($user) && $user->vic_user_details_gender == "Female") echo 'selected' ?>>Female</option>
                                                <option value="Prefer not to say" <?php if (!empty($user) && $user->vic_user_details_gender == "Prefer not to say") echo 'selected' ?>>Prefer not to say</option>
                                            </select>
                                            <?php echo form_error('gender', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="personal-information-error text-danger"></p>
                            </div>
                            <div class="text-center pt-4">
                                <button type="submit" class="btn btn-blue pl-5 pr-5">Save</button>
                                <a href="<?php echo base_url()?>" class="btn btn-blue-border pl-5 pr-5 ml-3">Cancel</a>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div id="ci" class="tab-pane fade">
                            <?php
                            $attributes = array('id' => 'userProfileForm');
                            echo form_open_multipart('e/ProfileController/update_company_info', $attributes);
                            ?>
                            <div class="form-group">
                                <div class="row pt-1">
                                    <div class="col-sm-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="usr">Industry Sector</label>
                                                    <select class="form-control" id="userProfile" name="industry" required>
                                                        <option value="" disabled selected hidden>Select</option>
                                                        <?php foreach ($sectors as $s) : ?>
                                                            <option value="<?= $s->vic_bn_sector_name ?>" <?php if (!empty($company) && $s->vic_bn_sector_name == $company->vic_industry_sector) echo 'selected' ?>><?= $s->vic_bn_sector_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Company Name</label>
                                            <input type="text" class="form-control" name="companyname" placeholder="Enter Company name" value="<?php if (!empty($company)) echo $company->vic_companyname ?>" require>
                                            <?php echo form_error('companyname', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Company Location</label>
                                            <input type="text" class="form-control" name="headquarter" placeholder="Enter Company Location" value="<?php if (!empty($company)) echo $company->vic_companyheadquarters ?>">
                                            <?php echo form_error('headquarter', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">City</label>
                                            <input type="text" class="form-control contact" name="city" placeholder="Enter City" value="<?php if (!empty($company)) echo $company->vic_companycity ?>">
                                            <?php echo form_error('city', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Country</label>
                                            <select class="form-control" required name="country">
                                                <option value="" disabled selected hidden class="placeholder-text">Select Country</option>
                                                <?php foreach ($countries as $country) : ?>
                                                    <option value="<?= $country->name ?>" <?php if (!empty($company) && $country->name == $company->vic_country_name) echo 'selected' ?>><?= $country->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php echo form_error('country', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label for="usr">Zip Code</label>
                                            <input type="text" class="form-control" name="zipCode" placeholder="Enter Zip Code" value="<?php if (!empty($company)) echo $company->vic_zip_code ?>">
                                            <?php echo form_error('zipCode', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="usr">Address Details</label>
                                            <textarea class="form-control" rows="3" name="address" placeholder="Enter Address Details"><?php if (!empty($company)) echo $company->vic_address_details ?></textarea>
                                            <?php echo form_error('address', '<p class="status-msg error">', '</p>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <p class="personal-information-error text-danger"></p>
                            </div>
                            <div class="text-center pt-4">
                                <button type="submit" class="btn btn-blue pl-5 pr-5">Save</button>
                                <a href="<?php echo base_url()?>" class="btn btn-blue-border pl-5 pr-5 ml-3">Cancel</a>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div id="cp" class="tab-pane fade">
                            <?php
                            $attributes = array('id' => 'userPasswordForm');
                            echo form_open_multipart('e/ProfileController/change_password', $attributes);
                            ?>
                            <div class="row pt-1 mt-5">
                                <div class="col-md-6 col-lg-4 offset-md-2">
                                    <div class="form-group">
                                        <label for="usr">New Password<span class="text-danger">*</span></label>
                                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New password">
                                        <?php echo form_error('old_password', '<p class="status-msg error">', '</p>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="usr">Confirm Password<span class="text-danger">*</span></label>
                                        <input type="password" id="conf_password" name="conf_password" class="form-control" placeholder="Confirm password">
                                        <?php echo form_error('new_password', '<p class="status-msg error">', '</p>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="text-center pt-5 pb-5">
                                        <button type="submit" class="btn btn-blue pl-5 pr-5">Save</button>
                                        <a href="<?php echo base_url()?>" class="btn btn-blue-border pl-5 pr-5 ml-3">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
        <?php if ($this->session->flashdata('flash_success')) { ?>
            <script>
                toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
            </script>
        <?php } else if ($this->session->flashdata('flash_error')) { ?>
            <script>
                toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
            </script>
        <?php } ?>
    </div>
</body>