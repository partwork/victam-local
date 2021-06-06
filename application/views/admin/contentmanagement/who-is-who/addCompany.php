<div class="container-fluid body-wrapper pl-24vw">
    <form id="addcompanydetails" action="<?php echo base_url('admin/upda-company'); ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-top-elements">
                    <h4 class="page-title-wrap">
                        <span>Who Is Who</span>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item" aria-current="page"> <a class="text-blue" href="<?php echo base_url(); ?>admin/content-management/who-is-who/whoIsWho">Who Is Who</a> </li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Who Is Who</li>
                            </ol>
                        </nav>
                    </h4>

                    <input type="hidden" name="id" value="<?php echo $content['0']->idvic_company; ?>">
                    <?php if ($activePage == 'whoIsWho') : ?>
                        <a href="#" data-toggle="modal" data-target="#rejectConfirmationModal" onclick="content_id(<?php if (isset($content['0'])) : ?><?php echo $content['0']->idvic_company ?><?php endif; ?>)" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Reject</a>
                    <?php else : ?>
                        <a href="<?php echo base_url(); ?>admin/content-management/who-is-who/whoIsWho" class="btn btn-blue-border float-right f-14 pl-4 pr-4">Cancel</a>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('usertype') == 'super admin' || $this->session->userdata('usertype') == 'publisher - moderator') : ?>
                        <?php $value = 'Publish'; ?>
                        <?php $value2 = 'Preview'; ?>
                    <?php else : ?>
                        <?php $value = 'Save'; ?>
                        <?php $value2 = 'Review'; ?>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" id="submitform" name="action" value=<?php echo $value; ?>>
                    <a href="#" onclick="who_preview_content()" data-toggle="modal" data-target="#preview" class="btn btn-blue-border float-right f-14 mr-3 pl-4 pr-4"><?php echo $value2; ?></a>

                    <!-- <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Banner Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Banner Title" name="btitle" value="">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-blue float-right f-14 mr-3 pl-4 pr-4" name="action" value="save"> -->

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-wrapper">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Company Name<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Company Name" readonly name="companyname" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_companyname ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Company Description<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="4" name="companydescription" required><?php if (isset($content['0'])) : ?> <?php echo $content['0']->vic_companydesc ?> <?php endif; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Address Details<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea class="form-control" rows="4" name="address" required><?php if (isset($content['0'])) : ?> <?php echo $content['0']->vic_address_details ?> <?php endif; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">City<span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <div class="date-input-wrapper ">
                                <input type="text" class="form-control" placeholder="Enter City" name="city" required <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_companycity ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="col-sm-5 pr-0">
                            <div class="date-input-wrapper center-align-lable row">
                                <label class="col-sm-3 col-form-label mr-3">Zip Code<span class="text-danger">*</span></label>
                                <input type="text" class="col-sm-8 form-control pr-0" placeholder="Enter Zip Code" required name="zipcode" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_zip_code ?>" <?php endif; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Country <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <!-- <input type="text" class="form-control" placeholder="Enter Country" required name="country" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_country_name ?>" <?php endif; ?>> -->
                            <select class="form-control" required name="country" id="country">
                                <option value="" disabled selected hidden class="placeholder-text">Select Country</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country->name ?>" <?php if (isset($content[0]) && $content[0]->vic_country_name && $content[0]->vic_country_name == $country->name) echo 'selected' ?>><?= $country->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Email" required name="email" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_companyemail ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone Number<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Phone Number" onkeypress="return onlyNumberKey(event)" required name="phonenumber" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_phonenumber ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Website<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Website" required name="website" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_companywebsite ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Industry Sector<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <!-- <input type="text" class="form-control" placeholder="Enter Industry Sector" required name="industrysector" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_industry_sector ?>" <?php endif; ?>> -->
                            <select class="form-control w-100" id="industrysector" name="industrysector" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Industry Sector</option>
                                <?php foreach ($sector as $sectors) : ?>
                                    <option value="<?= $sectors->vic_bn_sector_name ?>" <?php if (isset($content[0]) && $content[0]->vic_industry_sector && $content[0]->vic_industry_sector == $sectors->vic_bn_sector_name) echo 'selected' ?>><?= $sectors->vic_bn_sector_name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Active Industries<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <!-- <input type="text" class="form-control" placeholder="Enter Industry Sector" required name="industries" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_active_industry1 ?>" <?php endif; ?>> -->
                            <select class="form-control w-100" id="industries" name="industries" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                <option <?php if (isset($content['0']->vic_active_industry1) && $content['0']->vic_active_industry1 == 'Animal feed') : ?> selected <?php endif; ?> value="Animal feed">Animal feed</option>
                                <option <?php if (isset($content['0']->vic_active_industry1) && $content['0']->vic_active_industry1 == 'Aqua feed') : ?> selected <?php endif; ?> value="Aqua feed">Aqua feed</option>
                                <option <?php if (isset($content['0']->vic_active_industry1) && $content['0']->vic_active_industry1 == 'Pet food') : ?> selected <?php endif; ?> value="Pet food">Pet food</option>
                                <option <?php if (isset($content['0']->vic_active_industry1) && $content['0']->vic_active_industry1 == 'Grain, rice, soybeans processing') : ?> selected <?php endif; ?> value="Grain, rice, soybeans processing">Grain, rice, soybeans processing</option>
                                <option <?php if (isset($content['0']->vic_active_industry1) && $content['0']->vic_active_industry1 == 'Biomass') : ?> selected <?php endif; ?> value="Biomass">Biomass</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Company Location<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Company Location" required name="headquarters" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_companyheadquarters ?>" <?php endif; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Company profile<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="target_groups">
                                <option <?php if (isset($content['0']->vic_company_target_groups) && $content['0']->vic_company_target_groups == 'Feed producing companies') : ?> selected <?php endif; ?> value="Feed producing companies">Feed producing companies</option>
                                <option <?php if (isset($content['0']->vic_company_target_groups) && $content['0']->vic_company_target_groups == 'Farmers / Self mixers') : ?> selected <?php endif; ?> value="Farmers / Self mixers">Farmers / Self mixers</option>
                                <option <?php if (isset($content['0']->vic_company_target_groups) && $content['0']->vic_company_target_groups == 'Flour Millers') : ?> selected <?php endif; ?> value="Flour Millers">Flour Millers</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Production (Tons)<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="production" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Production (Tons)</option>

                                <option <?php if (isset($content['0']->vic_companyproduction) && $content['0']->vic_companyproduction == 'Less than 100-ton') : ?> selected <?php endif; ?> value="Less than 100-ton">Less than 100-ton</option>

                                <option <?php if (isset($content['0']->vic_companyproduction) && $content['0']->vic_companyproduction == '100 – 500 ton') : ?> selected <?php endif; ?> value="100 – 500 ton">100 – 500 ton</option>
                                <option <?php if (isset($content['0']->vic_companyproduction) && $content['0']->vic_companyproduction == '500 – 1 million ton') : ?> selected <?php endif; ?> value="500 – 1 million ton">500 – 1 million ton</option>
                                <option <?php if (isset($content['0']->vic_companyproduction) && $content['0']->vic_companyproduction == 'Greater than 1 million ton') : ?> selected <?php endif; ?> value="Greater than 1 million ton">Greater than 1 million ton</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Company to deal<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="companytodeal" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Company to deal</option>
                                <option <?php if (isset($content['0']->vic_company_to_deal) && $content['0']->vic_company_to_deal == 'Producer') : ?> selected <?php endif; ?> value="Producer">Producer</option>
                                <option <?php if (isset($content['0']->vic_company_to_deal) && $content['0']->vic_company_to_deal == 'Distributor') : ?> selected <?php endif; ?> value="Distributor">Distributor</option>
                                <option <?php if (isset($content['0']->vic_company_to_deal) && $content['0']->vic_company_to_deal == 'Local representative') : ?> selected <?php endif; ?> value="Local representative">Local representative</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Products or Services<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="services" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Products or Services</option>
                                <option <?php if (isset($content['0']->vic_products_services) && $content['0']->vic_products_services == 'Turnkey projects') : ?> selected <?php endif; ?> value="Turnkey projects">Turnkey projects</option>
                                <option <?php if (isset($content['0']->vic_products_services) && $content['0']->vic_products_services == 'Machines') : ?> selected <?php endif; ?> value="Machines">Machines</option>
                                <option <?php if (isset($content['0']->vic_products_services) && $content['0']->vic_products_services == 'Ingredients and additives') : ?> selected <?php endif; ?> value="Ingredients and additives">Ingredients and additives</option>
                                <option <?php if (isset($content['0']->vic_products_services) && $content['0']->vic_products_services == 'Logistics') : ?> selected <?php endif; ?> value="Logistics">Logistics</option>
                                <option <?php if (isset($content['0']->vic_products_services) && $content['0']->vic_products_services == 'Spare parts') : ?> selected <?php endif; ?> value="Spare parts"> Spare parts</option>
                                <option <?php if (isset($content['0']->vic_products_services) && $content['0']->vic_products_services == 'Other') : ?> selected <?php endif; ?> value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Important USPs<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="USPS" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Important USPs</option>
                                <option <?php if (isset($content['0']->vic_important_usp) && $content['0']->vic_important_usp == 'Custom-made') : ?> selected <?php endif; ?> value="Custom-made">Custom-made</option>
                                <option <?php if (isset($content['0']->vic_important_usp)  && $content['0']->vic_important_usp == 'All specs possible') : ?> selected <?php endif; ?> value="All specs possible">All specs possible</option>
                                <option <?php if (isset($content['0']->vic_important_usp)  && $content['0']->vic_important_usp == 'Delivery time') : ?> selected <?php endif; ?> value="Delivery time">Delivery time</option>
                                <option <?php if (isset($content['0']->vic_important_usp)  && $content['0']->vic_important_usp == 'Price quality value') : ?> selected <?php endif; ?> value="Price quality value">Price quality value</option>
                                <option <?php if (isset($content['0']->vic_important_usp)  && $content['0']->vic_important_usp == 'Payment terms') : ?> selected <?php endif; ?> value="Payment terms">Payment terms</option>
                                <option <?php if (isset($content['0']->vic_important_usp)  && $content['0']->vic_important_usp == 'Integrated with existing systems') : ?> selected <?php endif; ?> value="Integrated with existing systems">Integrated with existing systems</option>
                                <option <?php if (isset($content['0']->vic_important_usp)  && $content['0']->vic_important_usp == 'Including installation and training') : ?> selected <?php endif; ?> value="Including installation and training">Including installation and training</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Companies Delivering<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="delivering" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Companies Delivering</option>
                                <option value="Worldwide" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Worldwide') : ?> selected <?php endif; ?>>Worldwide</option>
                                <option value="Europe" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Europe') : ?> selected <?php endif; ?>>Europe</option>
                                <option value="North America" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'North America') : ?> selected <?php endif; ?>>North America</option>
                                <option value="Latin America" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Latin America') : ?> selected <?php endif; ?>>Latin America</option>
                                <option value="Australia" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Australia') : ?> selected <?php endif; ?>>Australia</option>
                                <option value="Only local" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Only local') : ?> selected <?php endif; ?>>Only local</option>
                                <option value="Asia" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Asia') : ?> selected <?php endif; ?>>Asia</option>
                                <option value="Africa" <?php if (isset($content['0']->vic_companies_delivering) && $content['0']->vic_companies_delivering == 'Africa') : ?> selected <?php endif; ?>>Africa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Investment Duration<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" name="duration" required>
                                <option value="" disabled selected hidden class="placeholder-text">Select Investment Duration</option>
                                <option <?php if (isset($content['0']->vic_investment_duration) && $content['0']->vic_investment_duration == 'Within 3 months') : ?> selected <?php endif; ?> value="Within 3 months">Within 3 months</option>
                                <option <?php if (isset($content['0']->vic_investment_duration) && $content['0']->vic_investment_duration == 'Within 6 months') : ?> selected <?php endif; ?> value="Within 6 months">Within 6 months</option>
                                <option <?php if (isset($content['0']->vic_investment_duration) && $content['0']->vic_investment_duration == 'The coming 2 years') : ?> selected <?php endif; ?> value="The coming 2 years">The coming 2 years</option>
                                <option <?php if (isset($content['0']->vic_investment_duration) && $content['0']->vic_investment_duration == 'Longer than 2 years from now') : ?> selected <?php endif; ?> value="Longer than 2 years from now">Longer than 2 years from now</option>
                                <option <?php if (isset($content['0']->vic_investment_duration) && $content['0']->vic_investment_duration == 'Within a year') : ?> selected <?php endif; ?> value="Within a year">Within a year</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Specialities<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter Specialities" required name="specialities" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_specialities ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">LinkedIn URL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Enter LinkedIn URL" required name="linkedinurl" <?php if (isset($content['0'])) : ?> value="<?php echo $content['0']->vic_companylinkedinurl ?>" <?php endif; ?>>
                        </div>
                    </div>
                    <div class="form-group row upload-image-wrapper-outer">
                        <label class="col-sm-3 col-form-label">Company Logo</label>
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-attachment-button" class="custom-file-upload">Upload</button>
                                <span id="upload-attachment-file-name" class="input-file-name">Allowed file extensions: PNG, JPEG, maximum file size: 5MB</span>
                            </div>
                            <input onchange="readURL(this,'media_logo')" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-attachment-file" name="uploadImageFile" />
                            <input type="hidden" value="<?php if (isset($content['0'])) : echo base_url('upload/company/' . $content['0']->vic_companylogo);
                                                        endif; ?>" id="media_logo">
                        </div>

                    </div>
                    <div class="form-group row upload-image-wrapper-outer">
                        <label class="col-sm-3 col-form-label">Presentation</label>
                        <!-- <div class="col-sm-9 center-align-lable">
                            <input type="file" id="upload-presentation-file" hidden="hidden" />
                            <button type="button" id="upload-presentation-button" class="custom-file-upload">Upload</button>
                            <span id="upload-presentation-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                        </div> -->
                        <div class="col-sm-9  pos-rel">
                            <div class="center-align-lable">
                                <button type="button" id="upload-presentation-button" class="custom-file-upload">Upload</button>
                                <span id="upload-presentation-file-name" class="input-file-name">Allowed file extensions: MP4 maximum file size: 50MB</span>
                            </div>
                            <input onchange="readURL(this,'media_video')" class="form-control visibility-hidden" style="position: absolute; left:0" type="file" id="upload-presentation-file" name="uploadPresentationFile" />
                            <input type="hidden" value="<?php if (isset($content['0'])) : echo base_url('upload/company/' . $content['0']->vic_companypresentation); endif; ?>" id="media_video">
                        </div>
                    </div>




                </div>
            </div>
        </div>

    </form>

    <!-- Preview Modal -->
    <div class="modal fade" id="preview" role="dialog" aria-labelledby="preview" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="text-left">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-5 text-center">
                                    <img src="<?php if (isset($content['0'])) : echo base_url('upload/company/' . $content['0']->vic_companylogo);
                                                endif; ?>" class="img-fluid w-100 pt-3" id="who_is_who_imgtag" style="height: 140px;" />
                                    <h6 class="pt-1 text-blue f-14 mb-3"><?php if (isset($content['0'])) : echo $content['0']->vic_companyname;
                                                                            endif; ?></h6>
                                </div>
                                <div class="col-sm-7 mt-3 preview-comp-details">
                                    <p class="text-title-small fs-12 mb-1"><span>Sectors </span>- <span><?php if (isset($content['0'])) : echo $content['0']->vic_industry_sector;
                                                                                                        endif; ?></span></p>
                                    <p class="text-title-small fs-12 mb-1"><span>Products </span>- <span><?php if (isset($content['0'])) : echo $content['0']->vic_companyproduction;
                                                                                                            endif; ?></span></p>
                                    <p class="text-title-small fs-12 mb-1"><span>Country </span>- <span><?php if (isset($content['0'])) : echo $content['0']->vic_country_name;
                                                                                                        endif; ?></span></p>
                                    <p class="text-title-small fs-12 mb-1"><span>Phone </span>- <span><?php if (isset($content['0'])) : echo $content['0']->vic_phonenumber;
                                                                                                        endif; ?></span></p>
                                    <p class="text-title-small fs-12 mb-1"><span>Email </span>- <span><?php if (isset($content['0'])) : echo $content['0']->vic_companyemail;
                                                                                                        endif; ?></span></p>
                                    <p class="text-title-small fs-12 mb-1"><span>Website </span>- <span><?php if (isset($content['0'])) : echo $content['0']->vic_companywebsite;
                                                                                                        endif; ?></span></p>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <h6 class="pt-1 text-blue f-14 mb-3">Address Details</h6>
                                    <p class="text-title-small fs-12"><?php if (isset($content['0'])) : echo $content['0']->vic_companydesc;
                                                                        endif; ?></p>
                                </div>
                                <div class="col-sm-12 mt-3">
                                    <h6 class="pt-1 text-blue f-14 mb-3">Presentation</h6>
                                    <video type="video/mp4" width="100%" height="240" controls id="whoIsWho_video_tag" src="<?php if (isset($content['0'])) : echo base_url('upload/company/' . $content['0']->vic_companypresentation);
                                                        endif; ?>">
                                        
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Confirmation Modal -->
    <div class="modal fade" id="rejectConfirmationModal" role="dialog" aria-labelledby="publish" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                        <p class="pt-3 modal-center-text fs-20">Confirm Reject </p>
                        <div class="text-center">
                            <button type="button" onclick="reject_whoiswho()" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                            <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Publish Modal -->
    <div class="modal fade" id="publish" role="dialog" aria-labelledby="publish" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="text-center">
                        <img src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                        <?php if ($this->session->userdata('usertype') == 'content moderator') : ?>
                            <?php $value = 'Saved'; ?>
                        <?php else : ?>
                            <?php $value = 'Published'; ?>
                        <?php endif; ?>
                        <p class="pt-3 modal-center-text fs-20"><?php echo $value; ?> successfully on Victam portal</p>
                        <div class="text-center">
                            <button type="button" onclick="window.location.href='<?php echo base_url("admin/content-management/who-is-who/whoIsWho"); ?>'" class="add-company-details" data-dismiss="modal" aria-label="Close">OK</button>
                            <!-- <button type="button" class="skip-company-detail" data-dismiss="modal" aria-label="Close">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <?php if ($this->session->flashdata('flash_success')) { ?>
    <script>
        $('#publish').modal('show');
    </script>
<?php } ?> -->

    <?php if (isset($_GET['res']) && $_GET['res'] == 'success') : ?>
        <script>
            $('#publish').modal('show');
            var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
                var clean_uri = uri.substring(0, uri.indexOf("?"));
                window.history.replaceState({}, document.title, clean_uri);
            }
        </script>
    <?php endif; ?>
    <script>
        $('#industrysector').val('<?php echo $content['0']->vic_industry_sector ?>')
    </script>