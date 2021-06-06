<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = (isset($_SESSION['plan_id'])) ? $_SESSION['plan_id'] : '';
$userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : '';
$matchmaking = (isset($_SESSION['matchmaking_plan'])) ? $_SESSION['matchmaking_plan'] : '';
?>



<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <input type="hidden" name="ind" id="ind" value='<?php echo $this->session->flashdata('industriesactive'); ?>'>
        <input type="hidden" name="companyprofile" id="profile" value='<?php echo $this->session->flashdata('companyprofile'); ?>'>
        <input type="hidden" name="position" id="position" value='<?php echo $this->session->flashdata('companydealwith'); ?>'>
        <input type="hidden" name="service" id="service" value='<?php echo $this->session->flashdata('servicesfor'); ?>'>

        <input type="hidden" name="tonscount" id="tonscount" value='<?php echo $this->session->flashdata('tonscount'); ?>'>
        <input type="hidden" name="importantups" id="importantups" value='<?php echo $this->session->flashdata('importantups'); ?>'>
        <input type="hidden" name="companies" id="companies" value='<?php echo $this->session->flashdata('companies'); ?>'>
        <input type="hidden" name="investmentmonth" id="investmentmonth" value='<?php echo $this->session->flashdata('investmentmonth'); ?>'>


        <div class="row pr-5">
            <div class="col-sm-3">
                <div class="filters-wrap">
                    <div class="filter-btn-wrap">
                        <span>Profile Questions</span>
                        <button type="button" class="btn btn-sm btn-blue float-right f-14 fw-400" id="resetFilter">Reset filters</button>
                    </div>

                    <div class="input-fields-wrap mt-2">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Industries Supplying</label>
                            <div class="form-group m-0">
                                <select class="form-control filter" id="industry" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option class="text-light-grey">Animal Feed</option>
                                    <option value="Aqua feed">Aqua feed</option>
                                    <option value="Pet food">Pet food</option>
                                    <option value="rain, rice, soybeans processing">Grain, rice, soybeans processing</option>
                                    <option value="Biomass">Biomass</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Target groups</label>
                            <div class="form-group m-0">
                                <select class="form-control filter" id="target_group" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Feed producing companies">Feed producing companies</option>
                                    <option value="Farmers / Self mixers">Farmers / Self mixers</option>
                                    <option value="Flour Millers">Flour Millers</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Target Capacity Clients</label>
                            <div class="form-group m-0">
                                <select class="form-control filter" id="tonscount_year" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Less than 100-ton">Less than 100-ton</option>
                                    <option value="100 – 500 ton">100 – 500 ton</option>
                                    <option value="500 – 1 million ton">500 – 1 million ton</option>
                                    <option value="Greater than 1 million ton">Greater than 1 million ton</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Trade position</label>
                            <div class="form-group m-0">
                                <select class="form-control filter" id="companydealwith" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Producer">Producer</option>
                                    <option value="Distributor">Distributor</option>
                                    <option value="Local representative">Local representative</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Products Or Services</label>
                            <div class="form-group m-0">
                                <select class="form-control filter" name="Services" id="service_for" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Machines">Machines</option>
                                    <option value="Turnkey projects">Turnkey projects</option>
                                    <option value="Ingredients and additives">Ingredients and additives</option>
                                    <option value="Logistics">Logistics </option>
                                    <option value="Spare parts">Spare parts</option>
                                    <option value="Other">Other </option>
                                </select>
                            </div>
                        </div>


                        <div class="center-align-lable drp-form-group mt-2 multiple-select-section display-none">
                            <div class="form-group w-100 multi-select-wrap pos-rel">
                                <select class="js-ProductsServices-basic-multi form-control w-100" name="ProductsServices" id="multipleSelect" multiple="multiple">

                                </select>
                                <img src="<?php echo base_url(); ?>application/assets/shared/img/dropdown-arrow.png" class="drp-arrow">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Important USP’s</label>
                            <div class="form-group m-0">
                                <select class="form-control filter" name="importantUSP" id="importantUSP" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Custom-made">Custom-made</option>
                                    <option value="All specs possible">All specs possible</option>
                                    <option value="Delivery time">Delivery time</option>
                                    <option value="Price quality value">Price quality value</option>
                                    <option value="Payment terms">Payment terms</option>
                                    <option value="Integrated with existing systems">Integrated with existing systems </option>
                                    <option value="Including installation and training">Including installation and training</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Delivering Country </label>
                            <div class="form-group m-0">
                                <select class="form-control filter" name="deliveringCountry" id="deliveringCountry" required>
                                    <option value="" disabled selected hidden class="placeholder-text">Select</option>
                                    <option value="Worldwide">Worldwide</option>
                                    <option value="Europe">Europe</option>
                                    <option value="North America">North America</option>
                                    <option value="Latin America">Latin America</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Only local">Only local </option>
                                    <option value="Asia">Asia</option>
                                    <option value="Africa">Africa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 mt-4 pb-5" id="comp-directory">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="text-title-small fw-400 float-left">LIST OF BUYERS</h4>
                        <div class="form-group search-filter-wrap pos-rel float-right w-60">
                            <input type="text" class="form-control mr-inf-search" id="filterSearch" placeholder="Search by company name">
                            <i class="fa fa-search" aria-hidden="true" id="searchbyme"></i>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 pt-1" id="Ajaxresult">


                </div>

                <!-- <div class="row mt-3 pt-1" id="searchresult">


                </div> -->

                <?php if ($this->session->userdata('plan_id') == 2) { ?>
                    <p class="subscription-text-2 mt-5 mb-5 text-center">
                        Upgrade your plan to a market leader package and get access to all matched companies. To upgrade
                        <!-- <a href="<?php echo base_url(); ?>pricing" class="text-blue text-undeine">Upgrade now!</a> -->
                        <a href="javascript:void(0)" onclick="match_making_upgrade_planclickHandel('buyers', '<?php echo $plan_id ?>', '<?php echo $userId ?>', '<?php echo $matchmaking ?>')" class="text-blue text-undeine">Click here</a>
                    </p>
                <?php }  ?>

                <!-- <div class="row">
                    <div class="col-sm-12">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link pl-4 pr-4 first-link" href="#">First</a></li>
                            <li class="page-item disabled mr-2"><a class="page-link" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                            <li class="page-item active ml-2"><a class="page-link" href="#">1</a></li>
                            <li class="page-item ml-2"><a class="page-link" href="#">2</a></li>
                            <li class="page-item ml-2 mr-2"><a class="page-link" href="#">3</a></li>
                            <li class="page-item ml-2"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            <li class="page-item"><a class="page-link pl-4 pr-4 last-link" href="#">Last</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>

        <?php $this->load->view('shared/footer/footer'); ?>

        <section class="chat-bot-section">
            <img class="chat-bot" src="<?php echo base_url(); ?>application/assets/shared/img/chat_bot.png" width="60" height="60">
        </section>

    </div>


    <div class="modal fade" id="comp-info" role="dialog" aria-labelledby="congrats" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body p-4">
                    <div class="text-center">
                        <h4 class="text-title-small mb-4" id="cname"></h4>
                        <p class="f-14 mb-2 text-blue">
                            <span>Specialities:</span>
                            <span id="Specialities"></span>
                        </p>
                        <p class="f-14 mb-2 text-blue">
                            <span>Sector:</span>
                            <span id="Sector"></span>
                        </p>
                        <p class="f-14 mb-2 text-red">
                            <span>Email:</span>
                            <span id="Email"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>