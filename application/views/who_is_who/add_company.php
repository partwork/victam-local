<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
    <input type="hidden" id="reqpage" value="Add company to the guide form">
        <?php $this->load->view('shared/header/header'); ?>

        <section class="pb-4 pl-3 pr-3">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-9 col-md-9">
                    <div class="col-sm-12 pl-0">
                        <div class="pl-5 pr-5">
                            <h4 class="pt-4 text-title-small">ADD COMPANY TO THE GUIDE</h4>

                            <p class="sub-description-light mb-0">
                                All companies active in the feed and grain processing industries could be added to this supplier guide by filling in the below form and pay a small registration fee.
                                Visitors of the portal can search for a company, branch, product, or country what is making it a highly specialized search engine. Companies who are registered
                                in the Network Industry Guide at the Victam Corporate website or have the complete registration package will be included automatically.
                            </p>
                            <p class="sub-description-dark">Note: Companies listed should be represented by headquarters offices only (no satellite/office branches)</p>
                            <p class="sub-description-light">
                                Contact fields will only be used if you wish to receive a new password or wish to receive certain news or notifications by e-mail. This information will not be visible
                                to site visitors. Only Corporate information will be shown.
                            </p>
                        </div>
                    </div>

                    <div class="pl-5">
                        <div class="add-company-form">
                            <?php
                            $attributes = array('id' => 'addCompanyForm');
                            echo form_open_multipart('e/WhoIsWhoController/register_company', $attributes);
                            ?>
                            <div class="row p-2">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                <input type="hidden" name="company_id" id="company_id" value="<?php if(isset($company[0]) && $company[0]->idvic_company) echo $company[0]->idvic_company ?>">
                                <input type="hidden" name="presentation" id="presentation" value="<?php if(isset($company[0]) && $company[0]->vic_companypresentation) echo $company[0]->vic_companypresentation ?>">
                                <input type="hidden" name="logo" id="logo" value="<?php if(isset($company[0]) && $company[0]->vic_companylogo) echo $company[0]->vic_companylogo ?>">

                                <div class="col-sm-3 "><label class="m-0" for="usr">Company Name<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" name="companyname" id="companyname" class="form-control form-control-custom" value="<?php if(isset($company[0]) && $company[0]->vic_companyname) echo $company[0]->vic_companyname ?>" placeholder="Enter Company Name"></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Company Description<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><textarea name="companydescription" id="companydescription" class="form-control form-control-custom" rows="3" placeholder="Write Company Description"><?php if(isset($company[0]) && $company[0]->vic_companydesc) echo $company[0]->vic_companydesc ?></textarea></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Address Details<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><textarea name="address" id="address" class="form-control form-control-custom" rows="3" placeholder="Write Address Details"><?php if(isset($company[0]) && $company[0]->vic_address_details) echo $company[0]->vic_address_details ?></textarea></div>
                            </div>
                            <div class="row p-2">
                                <div class="col-sm-3 "><label class="m-0" for="usr">City<span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" name="city" id="city" class="form-control form-control-custom" value="<?php if(isset($company[0]) && $company[0]->vic_companycity) echo $company[0]->vic_companycity ?>" placeholder="Enter City">
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-4 pl-0 pr-0">
                                                    <label class="m-0" for="usr">Zip Code <span class="text-danger">*</span> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" name="zipcode" id="zipcode" class="form-control form-control-custom" onkeypress="return onlyNumberKey(event)" value="<?php if(isset($company[0]) && $company[0]->vic_zip_code) echo $company[0]->vic_zip_code ?>" placeholder="Enter Zip Code">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Country <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                    <select class="form-control" required name="country" id="country">
                                        <option value="" disabled selected hidden class="placeholder-text">Select Country</option>
                                        <?php foreach ($countries as $country) : ?>
                                            <option value="<?= $country->name ?>" <?php if(isset($company[0]) && $company[0]->vic_country_name && $company[0]->vic_country_name==$country->name) echo 'selected' ?>><?= $country->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <!-- <input type="text" name="country" id="country" class="form-control form-control-custom" placeholder="Enter Country"> -->
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Email <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="email" name="email" id="email" class="form-control form-control-custom" value="<?php if(isset($company[0]) && $company[0]->vic_companyemail) echo $company[0]->vic_companyemail ?>" placeholder="Enter Email"></div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Phone Number <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" name="phonenumber" id="phonenumber" onkeypress="return onlyNumberKey(event)" class="form-control form-control-custom" placeholder="Enter Phone Number" value="<?php if(isset($company[0]) && $company[0]->vic_phonenumber) echo $company[0]->vic_phonenumber ?>"></div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Website <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" name="website" id="website" class="form-control form-control-custom" placeholder="Enter Website" value="<?php if(isset($company[0]) && $company[0]->vic_companywebsite) echo $company[0]->vic_companywebsite ?>"></div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Industry Sector <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 ">
                                    <select class="form-control w-100" id="industrysector" name="industrysector" required>
                                        
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <!-- <option value="All Sectors">All Sectors</option> -->
                                        <?php foreach ($sectors as $s) : ?>
                                            <option value="<?= $s->vic_bn_sector_name ?>" <?php if (!empty($company[0]) && $company[0]->vic_industry_sector && $s->vic_bn_sector_name == $company[0]->vic_industry_sector) echo 'selected' ?>><?= $s->vic_bn_sector_name ?></option>
                                        <?php endforeach; ?>

                                        <!-- <option value="Additives & Raw Materials" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Additives & Raw Materials') echo 'selected'; ?>>Additives & Raw Materials</option>
                                        <option value="Automation & Control" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Automation & Control') echo 'selected'; ?>>Automation & Control</option>
                                        <option value="Logistics" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Logistics') echo 'selected'; ?>>Logistics</option>
                                        <option value="Machinery & Equipments" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Machinery & Equipments') echo 'selected'; ?>>Machinery & Equipments</option>
                                        <option value="Quality Control" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Quality Control') echo 'selected'; ?>>Quality Control</option>
                                        <option value="Safety & Environment" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Safety & Environment') echo 'selected'; ?>>Safety & Environment</option>
                                        <option value="Services" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Services') echo 'selected'; ?>>Services</option>
                                        <option value="Additives" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Additives') echo 'selected'; ?>>Additives</option>
                                        <option value="All About Feeds" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'All About Feeds') echo 'selected'; ?>>All About Feeds</option>
                                        <option value="Animal Feed" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Animal Feed') echo 'selected'; ?>>Animal Feed</option>
                                        <option value="Animal Nutrition" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Animal Nutrition') echo 'selected'; ?>>Animal Nutrition</option>
                                        <option value="Aqua Feed" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Aqua Feed') echo 'selected'; ?>>Aqua Feed</option>
                                        <option value="Biomass" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Biomass') echo 'selected'; ?>>Biomass</option>
                                        <option value="De Molenaar" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'De Molenaar') echo 'selected'; ?>>De Molenaar</option>
                                        <option value="Far Eastern Agriculture" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Far Eastern Agriculture') echo 'selected'; ?>>Far Eastern Agriculture</option>
                                        <option value="Rice & Flour Milling"<?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Rice & Flour Milling') echo 'selected'; ?>>Rice & Flour Milling</option>
                                        <option value="Pet Foods" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Pet Foods') echo 'selected'; ?>>Pet Foods</option>
                                        <option value="Rice Milling" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Rice Milling') echo 'selected'; ?>>Rice Milling</option>
                                        <option value="Wooden Pellets" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'Wooden Pellets') echo 'selected'; ?>>Wooden Pellets</option>
                                        <option value="World Grain" <?php if(isset($company[0]) && $company[0]->vic_industry_sector && $company[0]->vic_industry_sector == 'World Grain') echo 'selected'; ?>>World Grain</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Active Industries <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  drp-form-group">
                                    <select class="form-control w-100" id="industries" name="industries" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Animal feed" <?php if(isset($company[0]) && $company[0]->vic_active_industry1 && $company[0]->vic_active_industry1 == 'Animal feed') echo 'selected'; ?>>Animal feed</option>
                                        <option value="Aqua feed" <?php if(isset($company[0]) && $company[0]->vic_active_industry1 && $company[0]->vic_active_industry1 == 'Aqua feed') echo 'selected'; ?>>Aqua feed</option>
                                        <option value="Pet food" <?php if(isset($company[0]) && $company[0]->vic_active_industry1 && $company[0]->vic_active_industry1 == 'Pet food') echo 'selected'; ?>>Pet food</option>
                                        <option value="Grain, rice, soybeans processing" <?php if(isset($company[0]) && $company[0]->vic_active_industry1 && $company[0]->vic_active_industry1 == 'Grain, rice, soybeans processing') echo 'selected'; ?>>Grain, rice, soybeans processing</option>
                                        <option value="Biomass" <?php if(isset($company[0]) && $company[0]->vic_active_industry1 && $company[0]->vic_active_industry1 == 'Biomass') echo 'selected'; ?>>Biomass</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Company Location <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="headquarters" name="headquarters" class="form-control form-control-custom" value="<?php if(isset($company[0]) && $company[0]->vic_companyheadquarters) echo $company[0]->vic_companyheadquarters ?>" placeholder="Enter Company Location"></div>
                            </div>

                            <div class="row p-2 ">
                                <div class="col-sm-3"><label class="m-0" for="usr">Production (Tons) <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 drp-form-group">
                                    <select class="form-control w-100" id="production" name="production" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Less than 100-ton" <?php if(isset($company[0]) && $company[0]->vic_companyproduction && $company[0]->vic_companyproduction == 'Less than 100-ton') echo 'selected'; ?>>Less than 100-ton</option>
                                        <option value="100 – 500 ton" <?php if(isset($company[0]) && $company[0]->vic_companyproduction && $company[0]->vic_companyproduction == '100 – 500 ton') echo 'selected'; ?>>100 – 500 ton</option>
                                        <option value="500 – 1 million ton" <?php if(isset($company[0]) && $company[0]->vic_companyproduction && $company[0]->vic_companyproduction == '500 – 1 million ton') echo 'selected'; ?>>500 – 1 million ton</option>
                                        <option value="Greater than 1 million ton" <?php if(isset($company[0]) && $company[0]->vic_companyproduction && $company[0]->vic_companyproduction == 'Greater than 1 million ton') echo 'selected'; ?>>Greater than 1 million ton</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3"><label class="m-0" for="usr">Company to deal <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 drp-form-group">
                                    <select class="form-control w-100" id="companytodeal" name="companytodeal" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Producer" <?php if(isset($company[0]) && $company[0]->vic_company_to_deal && $company[0]->vic_company_to_deal == 'Producer') echo 'selected'; ?>>Producer</option>
                                        <option value="Distributor" <?php if(isset($company[0]) && $company[0]->vic_company_to_deal && $company[0]->vic_company_to_deal == 'Distributor') echo 'selected'; ?>>Distributor</option>
                                        <option value="Local representative" <?php if(isset($company[0]) && $company[0]->vic_company_to_deal && $company[0]->vic_company_to_deal == 'Local representative') echo 'selected'; ?>>Local representative</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3"><label class="m-0" for="usr">Target groups <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 drp-form-group">
                                    <select class="form-control w-100" id="target_groups" name="target_groups" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Feed producing companies" <?php if(isset($company[0]) && $company[0]->vic_company_target_groups && $company[0]->vic_company_target_groups == 'Feed producing companies') echo 'selected'; ?>>Feed producing companies</option>
                                        <option value="Farmers / Self mixers" <?php if(isset($company[0]) && $company[0]->vic_company_target_groups && $company[0]->vic_company_target_groups == 'Farmers / Self mixers') echo 'selected'; ?>>Farmers / Self mixers</option>
                                        <option value="Flour Millers" <?php if(isset($company[0]) && $company[0]->vic_company_target_groups && $company[0]->vic_company_target_groups == 'Flour Millers') echo 'selected'; ?>>Flour Millers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Products or Services <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  drp-form-group">
                                    <select class="form-control w-100" id="services" name="services" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Turnkey projects" <?php if(isset($company[0]) && $company[0]->vic_products_services && $company[0]->vic_products_services == 'Turnkey projects') echo 'selected'; ?>>Turnkey projects</option>
                                        <option value="Machines" <?php if(isset($company[0]) && $company[0]->vic_products_services && $company[0]->vic_products_services == 'Machines') echo 'selected'; ?>>Machines</option>
                                        <option value="Ingredients and Additives" <?php if(isset($company[0]) && $company[0]->vic_products_services && $company[0]->vic_products_services == 'Ingredients and Additives') echo 'selected'; ?>>Ingredients and Additives</option>
                                        <option value="Logistics" <?php if(isset($company[0]) && $company[0]->vic_products_services && $company[0]->vic_products_services == 'Logistics') echo 'selected'; ?>>Logistics</option>
                                        <option value="Spare parts" <?php if(isset($company[0]) && $company[0]->vic_products_services && $company[0]->vic_products_services == 'Spare parts') echo 'selected'; ?>>Spare parts</option>
                                        <option value="Other Services" <?php if(isset($company[0]) && $company[0]->vic_products_services && $company[0]->vic_products_services == 'Other Services') echo 'selected'; ?>>Other Services</option>
                                    </select>

                                </div>
                                <div class="col-sm-3 "><label class="m-0 visibility-hidden"></label></div>
                                <div class="col-sm-9  drp-form-group mt-2">
                                    <div class="form-group w-100 multi-select-wrap">
                                        <small class="form-text text-light-grey"><span class="selected-service-title"></span> <span class="max-select"></span></small>
                                        <select class="js-ProductsServices-basic-multi form-control w-100" id="productsServices" name="ProductsServices[]" multiple="multiple">
                                          
                                        </select>
                                        <img src="<?php echo base_url(); ?>application/assets/shared/img/dropdown-arrow.png" class="drp-arrow">
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Important USPs <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  drp-form-group">
                                    <select class="form-control w-100" id="USPS" name="USPS" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Custom-made" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'Custom-made') echo 'selected'; ?>>Custom-made</option>
                                        <option value="All specs possible" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'All specs possible') echo 'selected'; ?>>All specs possible</option>
                                        <option value="Delivery time" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'Delivery time') echo 'selected'; ?>>Delivery time</option>
                                        <option value="Price quality value" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'Price quality value') echo 'selected'; ?>>Price quality value</option>
                                        <option value="Payment terms" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'Payment terms') echo 'selected'; ?>>Payment terms</option>
                                        <option value="Integrated with existing systems" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'Integrated with existing systems') echo 'selected'; ?>>Integrated with existing systems</option>
                                        <option value="Including installation and training" <?php if(isset($company[0]) && $company[0]->vic_important_usp && $company[0]->vic_important_usp == 'Including installation and training') echo 'selected'; ?>>Including installation and training</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Companies Delivering <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  drp-form-group">
                                    <select class="form-control w-100" id="delivering" name="delivering" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Worldwide" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Worldwide') echo 'selected'; ?>>Worldwide</option>
                                        <option value="Europe" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Europe') echo 'selected'; ?>>Europe</option>
                                        <option value="North America" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'North America') echo 'selected'; ?>>North America</option>
                                        <option value="Latin America" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Latin America') echo 'selected'; ?>>Latin America</option>
                                        <option value="Australia" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Australia') echo 'selected'; ?>>Australia</option>
                                        <option value="Only local" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Only local') echo 'selected'; ?>>Only local</option>
                                        <option value="Asia" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Asia') echo 'selected'; ?>>Asia</option>
                                        <option value="Africa" <?php if(isset($company[0]) && $company[0]->vic_companies_delivering && $company[0]->vic_companies_delivering == 'Africa') echo 'selected'; ?>>Africa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Investment Duration <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  drp-form-group">
                                    <select class="form-control w-100" id="duration" name="duration" required>
                                        <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                        <option value="Within 3 months" <?php if(isset($company[0]) && $company[0]->vic_investment_duration && $company[0]->vic_investment_duration == 'Within 3 months') echo 'selected'; ?>>Within 3 months</option>
                                        <option value="Within 6 months" <?php if(isset($company[0]) && $company[0]->vic_investment_duration && $company[0]->vic_investment_duration == 'Within 6 months') echo 'selected'; ?>>Within 6 months</option>
                                        <option value="The coming 2 years" <?php if(isset($company[0]) && $company[0]->vic_investment_duration && $company[0]->vic_investment_duration == 'The coming 2 years') echo 'selected'; ?>>The coming 2 years</option>
                                        <option value="Longer than 2 years from now" <?php if(isset($company[0]) && $company[0]->vic_investment_duration && $company[0]->vic_investment_duration == 'Longer than 2 years from now') echo 'selected'; ?>>Longer than 2 years from now</option>
                                        <option value="Within a year" <?php if(isset($company[0]) && $company[0]->vic_investment_duration && $company[0]->vic_investment_duration == 'Within a year') echo 'selected'; ?>>Within a year</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">Specialities <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="specialities" name="specialities" class="form-control form-control-custom" value="<?php if(isset($company[0]) && $company[0]->vic_specialities) echo $company[0]->vic_specialities ?>" placeholder="Enter Specialities"></div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 "><label class="m-0" for="usr">LinkedIn URL <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9 "><input type="text" id="linkedinurl" name="linkedinurl" class="form-control form-control-custom" placeholder="Enter LinkedIn URL" value="<?php if(isset($company[0]) && $company[0]->vic_companylinkedinurl) echo $company[0]->vic_companylinkedinurl ?>"></div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Company Logo <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  pos-rel">
                                    <div class="center-align-lable">
                                        <button type="button" id="upload-image-button" class="custom-file-upload">Upload</button>
                                        <span id="upload-image-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                                    </div>
                                    <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-image-file" name="uploadImageFile"/>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Presentation <span class="text-danger">*</span> </label></div>
                                <div class="col-sm-9  pos-rel">
                                    <div class="center-align-lable">
                                        <button type="button" id="upload-Presentation-button" class="custom-file-upload">Upload</button>
                                        <span id="upload-Presentation-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                                    </div>
                                    <input class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-Presentation-file" name="uploadPresentationFile"/>
                                </div>
                            </div>
                            <div class="row p-2 ">
                                <div class="col-sm-3 center-align-lable"><label class="m-0" for="usr">Terms of Use </label></div>
                                <div class="col-sm-9 center-align-lable">
                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="gridCheck" name="gridCheck">
                                        <label class="form-check-label text-blue" for="gridCheck">
                                            I agree with these terms of use
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class=" row p-2  text-center ">
                                <div class="col-sm-12">
                                    <button type="submit" id="submit" class="btn btn-blue btn-sm pl-5 pr-5">Submit</button>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-lg-3 col-md-3 pr-5">
                    <h5 class="pt-4 text-title-small">Newsletters</h5>
                    <ul class="news-letter-wrap">
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/showtime-subscription-form">Showtime subscription form</a></li>
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/advertising-form">Showtime advertisement form</a></li>
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/admin/subscribe">Newsletter subscription form</a></li>
                        <li><a class="text-blue pl-3" target="_blank" href="https://victam.com/network-subscription-form">Who-Is-Who subscription form</a></li>
                    </ul>
                    <div id="advertisment-list">
                    </div>
                </div>
            </div>
        </section>

        <?php $this->load->view('shared/footer/footer'); ?>
    </div>

    <?php if ($this->session->flashdata('flash_success')) { ?>
        <script>
            toastr["success"]("<?=$this->session->flashdata('flash_success')?>");
        </script>
    <?php } ?>

    <?php if ($this->session->flashdata('flash_error')) { ?>
        <script>
            toastr["error"]("<?=$this->session->flashdata('flash_error')?>");
        </script>
    <?php } ?>

</body>