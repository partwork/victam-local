<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>

    <div class="nav-logo pl-3 pt-1 pb-2">
        <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png" width="150px">
    </div>

    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-sm-12">
                <ul class="form-step-wrap">
                    <li class="active first-step"><a href="javascript:void(0)">User Profile</a></li>
                    <li><a href="javascript:void(0)">Field of Interest</a></li>
                    <li><a href="javascript:void(0)">Personal Information</a></li>
                    <li class="last-step"><a href="javascript:void(0)">Company Information</a></li>
                    <!-- <li class="last-step"><a href="">Company Information</a></li> -->
                </ul>
            </div>
            <div class="col-sm-12 pos-rel">
                <?php
                $attributes = array('id' => 'userProfileForm');
                echo form_open_multipart('e/ProfileController/profileSetup', $attributes);
                ?>
                <img src="<?php echo base_url(); ?>application/assets/shared/img/ellipse.png" class="top-ellipse" />
                <div class="all-form-wrap">
                    <div class="form-1 form-wrap active">
                        <div class="form-group">
                            <h5 for="exampleInputEmail1" class="pb-3 text-center">User Profile</h5>
                            <div class="row pt-1">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="farmer" onclick="active_profile_card('#farmer', '#farmerCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3"> Grain, soy, rice farmers</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="farmerCheck" name="userType" value="Grain, soy, rice farmers">
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="ingredient" onclick="active_profile_card('#ingredient', '#ingredientCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Ingredient/feed additive producers</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="ingredientCheck" name="userType" value="Ingredient/feed additive producers">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="feedProcessing" onclick="active_profile_card('#feedProcessing','#feedProcessingCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Feed processing technology</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="feedProcessingCheck" name="userType" value="Feed processing technology">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="grainProcessing" onclick="active_profile_card('#grainProcessing', '#grainProcessingCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3"> Grain processing technology</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="grainProcessingCheck" name="userType" value="Grain processing technology">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="feedProcessingCompanies" onclick="active_profile_card('#feedProcessingCompanies', '#feedProcessingCompaniesCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Feed processing companies</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="feedProcessingCompaniesCheck" name="userType" value="Feed processing companies">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="selfMixers" onclick="active_profile_card('#selfMixers', '#selfMixersCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Self-mixers</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="selfMixersCheck" name="userType" value="Self-mixers">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="flourMillers" onclick="active_profile_card('#flourMillers', '#flourMillersCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3"> Flour millers</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="flourMillersCheck" name="userType" value="Flour millers">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="serviceCompanies" onclick="active_profile_card('#serviceCompanies', '#serviceCompaniesCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Logistic or service companies</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="serviceCompaniesCheck" name="userType" value="Logistic or service companies">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="animalFarmers" onclick="active_profile_card('#animalFarmers', '#animalFarmersCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Animal Farmers / Breeding companies</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="animalFarmersCheck" name="userType" value="Animal Farmers / Breeding companies">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper" id="foodProducing" onclick="active_profile_card('#foodProducing', '#foodProducingCheck')">
                                        <div class="p-2 p-card-text pl-3 pr-3">Food producing companies</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="foodProducingCheck" name="userType" value="Food producing companies">
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-4">
                            <button type="button" id="userProfileSubmit" class="btn btn-blue next-btn pl-5 pr-5">Proceed</button>
                        </div>
                    </div>
                    <div class="form-2 form-wrap">
                        <div class="form-group">
                            <h5 for="exampleInputEmail1" class="pb-3 text-center">Field of Interest</h5>

                            <div class="row pt-1">
                                <?php foreach($InterestFields as $fe) : ?>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4 p-1">
                                    <?php $idname = str_replace(' ', '', $fe->vic_fieldname); ?>
                                    <div class="card m-1 p-card-wrapper interest-profile-card" id="<?=$idname?>" onclick="active_interest_card('#<?=$idname?>','#<?=$idname?>-check')">
                                        <div class="p-2 p-card-text pl-3 pr-3"><?=$fe->vic_fieldname?></div>
                                    </div>
                                    <input type="radio" class="form-check-input interest-check" id="<?=$idname?>-check" name="interest" value="<?=$fe->idvic_fieldsofinterest?>">
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3 rback">Back</button>
                                <button type="button" id="fieldOfInterestSubmit" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                                <!-- <button type="submit" id="submit" name="action" value="profileSetUp" class="btn btn-blue next-btn">Submit</button> -->
                            </div>

                        </div>
                    </div>
                    <div class="form-3 form-wrap">
                        <div class="form-group">
                            <h5 for="exampleInputEmail1" class="pb-3 text-center">Personal Information</h5>
                            <p class="personal-information-error text-danger text-center f-14"></p>
                            <div class="row pt-1">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" require>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Email Id <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email id" value="<?php echo $this->session->userdata('email') ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Country <span class="text-danger">*</span></label>
                                        <select class="form-control w-100" id="country" name="country" required>
                                            <option value="" disabled selected hidden class="placeholder-text">Select Country</option>
                                            <?php foreach ($countries as $country) : ?>
                                                <?php if (isset($searchCountry) && $searchCountry == $country->name) $status = "selected";
                                                else $status = ""; ?>
                                                <option class="dropdown-item" value="<?= $country->name ?>" <?= $status ?>><?= $country->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group row">
                                        <label for="usr" class="col-sm-12">Mobile Phone</label>
                                        <div class="col-sm-3 rescountry">
                                            <input type="text" class="form-control" name="country_code" id="country_code" value="" readonly>
                                        </div>
                                        <div class="col-sm-9 pl-0 resmobile">  
                                            <input type="text" class="form-control contact" id="pContact" name="pContact" placeholder="Enter Mobile Phone">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="usr">Gender <span class="text-danger">*</span></label>
                                        <select class="form-control w-100" id="gender" name="gender" required>
                                            <option value="" disabled selected hidden class="placeholder-text">Select Gender</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Prefer not to say">Prefer not to say</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="text-center pt-4">
                            <button type="button" class="btn back-btn pl-5 pr-5 mr-3 rback">Back</button>
                            <button type="button" id="personalInformationSubmit" class="btn next-btn btn-blue pl-5 pr-5">Next</button>
                        </div>
                    </div>
                    <div class="form-4 form-wrap">
                        <div class="form-group company-form-wrap">

                            <div class="company-forms active pl-5 pr-5 pt-5">
                                <div class="text-left">
                                    <h5 class="wizard-title"> 1. Please add your company name?<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control single-border-input" onkeypress="check_company_name()" id="companyName" maxlength="46" name="companyName" placeholder="Type your answer here....">
                                    <div class="text-danger answer-input"></div>
                                    <div class="text-blue fs-16" id="companyError"></div>
                                </div>

                                <div class="text-center pt-5 mt-4">
                                    <button type="button" class="btn back-btn pl-5 pr-5 mr-3 rback">Back</button>
                                    <button type="button" id="companyNameSubmit" class="btn btn-blue next-btn company-next pl-5 pr-5">Next</button>
                                    <button type="submit" id="companySubmit" name="action" value="profileSetUp" class="btn btn-blue next-btn btn-width display-none">Submit</button>
                                </div>

                                <div class="mt-5 text-center">
                                    <strong>0%</strong>
                                    <div class="progress-title pb-1">Completed so far</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width:0%"></div>
                                    </div>
                                    <div class="progress-title pt-1">Company Information</div>
                                </div>

                            </div>

                            <div class="industory-belog company-forms pl-5 pr-5 pt-3">
                                <div class="text-left">
                                    <h5 class="wizard-title">2. Which industry or sector you belong to?<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="row pt-1 mt-3">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                        <div class="card m-1 p-card-wrapper" id="processingTechnology" onclick="active_industry_card('#processingTechnology', '#processingTechnologyCheck')">
                                            <div class="p-2 p-card-text pl-3 pr-3">Feed Processing Technology</div>
                                        </div>
                                        <input type="radio" class="form-check-input userType-radio" id="processingTechnologyCheck" name="industry" value="Feed Processing Technology">

                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                        <div class="card m-1 p-card-wrapper" id="ingredients" onclick="active_industry_card('#ingredients', '#ingredientsCheck')">
                                            <div class="p-2 p-card-text pl-3 pr-3">Additives & Ingredients</div>
                                        </div>
                                        <input type="radio" class="form-check-input userType-radio" id="ingredientsCheck" name="industry" value="Additives & Ingredients">
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                        <div class="card m-1 p-card-wrapper" id="milling" onclick="active_industry_card('#milling', '#millingCheck')">
                                            <div class="p-2 p-card-text pl-3 pr-3">Rice & Grain Milling Technology</div>
                                        </div>
                                        <input type="radio" class="form-check-input userType-radio" id="millingCheck" name="industry" value="Rice & Grain Milling Technology">
                                    </div>


                                    <!-- <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                        <div class="card m-1 p-card-wrapper" id="millingTechnology" onclick="active_industry_card('#millingTechnology', 'millingTechnologyCheck')">
                                            <div class="p-2 p-card-text pl-3 pr-3">Rice & Grain Milling Technology</div>
                                        </div>
                                        <input type="radio" class="form-check-input userType-radio" id="millingTechnologyCheck" name="industry" value="millingTechnology">
                                    </div> -->
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                        <div class="card m-1 p-card-wrapper" id="others" onclick="active_industry_card('#others', '#othersCheck')">
                                            <div class="p-2 p-card-text pl-3 pr-3">Others</div>
                                        </div>
                                        <input type="radio" class="form-check-input userType-radio" id="othersCheck" name="industry" value="Others">
                                    </div>
                                </div>

                                <div class="text-center pt-5 mt-4">
                                    <button type="button" class="btn company-previous pl-5 pr-5 mr-3 rback ">Back</button>
                                    <button type="button" id="industoryBelogSubmit" class="btn btn-blue next-btn industry-next pl-5 pr-5">Next</button>
                                </div>

                                <div class="mt-5 text-center">
                                    <strong>50%</strong>
                                    <div class="progress-title pb-1">Completed so far</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width:50%"></div>
                                    </div>
                                    <div class="progress-title pt-1">Company Information</div>
                                </div>

                            </div>

                            <div class="industory-ans company-forms pl-5 pr-5 pt-5">
                                <div class="text-left">
                                    <h5 class="wizard-title"> 2. Write your answer?<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control single-border-input" id="answerInput" name="answer" placeholder="Type your answer here....">
                                    <div class="text-danger answer-input"></div>
                                </div>

                                <div class="text-center pt-5">
                                    <button type="button" class="btn company-previous pl-5 pr-5 mr-3 rback">Back</button>
                                    <button type="button" id="answerSubmit" class="btn btn-blue next-btn company-next pl-5 pr-5">Next</button>
                                </div>

                                <div class="mt-5 text-center">
                                    <strong>50%</strong>
                                    <div class="progress-title pb-1">Completed so far</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width:50%"></div>
                                    </div>
                                    <div class="progress-title pt-1">Company Information</div>
                                </div>
                            </div>

                            <div class="company-address company-forms">
                                <div class="text-left">
                                    <h5 class="wizard-title"> 3. Would you mind telling us your company address? </h5>
                                </div>
                                <div class="row pt-1 mt-3">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="usr">Company Location</label>
                                            <input type="text" class="form-control" id="headquarters" name="headquarters" placeholder="Enter Company Location">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="usr">Address Details</label>
                                            <input type="text" class="form-control" id="addressOne" name="addressOne" placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="usr">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="usr">Country</label>
                                            <select id="companyCountry" name="companyCountry" class="form-control form-control-custom ">
                                                <option value="" disabled selected hidden class="placeholder-text">Select Country</option>

                                                <?php foreach ($countries as $country) : ?>
                                                    <?php if (isset($searchCountry) && $searchCountry == $country->name) $status = "selected";
                                                    else $status = ""; ?>
                                                    <option class="dropdown-item" value="<?= $country->name ?>" <?= $status ?>><?= $country->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="usr">Zip Code</label>
                                            <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="Enter zip code">
                                        </div>
                                    </div>
                                </div>
                                <p class="company-address-error text-danger"></p>
                                <div class="text-center pt-5">
                                    <button type="button" class="btn industry-previous btn-width mr-3 rback">Back</button>
                                    <!-- <button type="button" id="websiteNameSubmit" class="btn btn-blue pl-5 pr-5">Submit</button> -->
                                    <!-- <a href="<?php echo base_url(); ?>pricing" class="btn btn-blue pl-5 pr-5">Submit</a> -->
                                    <input type="hidden" name="user_iscompany" id="user_iscompany" value="">
                                    <button type="submit" id="submit" name="action" value="profileSetUp" class="btn btn-blue next-btn btn-width ">Submit</button>
                                    <!-- data-toggle="modal" data-target="#listCompanyModa"  -->
                                </div>
                                <div class="mt-5 text-center">
                                    <strong>100%</strong>
                                    <div class="progress-title pb-1">Congratulation!!</div>
                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width:100%"></div>
                                    </div>
                                    <div class="progress-title pt-1">Company Information</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="<?php echo base_url(); ?>application/assets/shared/img/ellipse.png" class="bottom-ellipse" />


                <div class="modal fade" id="listCompanyModa" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png" width="150px">
                                    <p class="pt-3 modal-center-text">Would you like to list your company to the guide?</p>
                                    <div class="text-center mb-4">
                                        <!-- <button type="button" id="companyDetailsTab" class="btn add-company-details" data-dismiss="modal">Yes</button> -->
                                        <!-- <a class="td-none" href="<?php echo base_url(); ?>who_Is_Who/add-company"> -->
                                        <!-- <span class="add-company-details">Yes</span> -->
                                        <input type="submit" name="action" id="action" value="Yes" class="add-company-details">
                                        <!-- </a> -->
                                        <!-- <a class="td-none" href="<?php echo base_url(); ?>index.php/e/PricingController"> -->
                                        <!-- <span class="skip-company-details">Skip</span> -->
                                        <input type="submit" name="action" id="action" value="Skip" class="skip-company-details">
                                        <!-- </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="<?php echo base_url(); ?>application/assets/shared/img/logo.png" width="150px">
                            <p class="pt-3 modal-center-text">Would you like to add your company details?</p>
                            <div class="text-center">
                                <button type="button" id="companyDetailsTab" class="btn add-company-details next-btn b-none yesbtn yeslarge" data-dismiss="modal">Yes</button>
                                <span class="skip-company-details skipbtn " id="skipCompanyDetails">Skip</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <button type="button" id="listCompanyBtn" class="btn next-btn" style="display: none;" data-toggle="modal" data-target="#listCompanyModa">Modal</button> -->
        <?php if ($this->session->flashdata('flash_success')) { ?>
            <script>
                toastr["success"]("<?= $this->session->flashdata('flash_success') ?>");
            </script>
        <?php } else if ($this->session->flashdata('flash_error')) { ?>
            <script>
                toastr["error"]("<?= $this->session->flashdata('flash_error') ?>");
            </script>
        <?php } ?>

</body>