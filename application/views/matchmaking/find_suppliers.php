<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>

        <div class="row mt-4">
            <div class="col-sm-12 pos-rel">
                <img src="<?php echo base_url(); ?>application/assets/shared/img/ellipse.png" class="top-ellipse" />
                <div class="all-form-wrap">
                    <!-- Form 1 -->
                    <div class="form-1 form-wrap active">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title"> 1. In what industries you are active?<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper industrie-card animal-feed " onclick="active_industrie_card('.animal-feed', '#animalFeed')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Animal feed</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio industriesactive" name="industriesactive" id="animalFeed" value="Animal feed">
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper industrie-card aqua-feed" onclick="active_industrie_card('.aqua-feed', '#aquaFeed')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Aqua feed</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio industriesactive" name="industriesactive" id="aquaFeed" value="Aqua feed">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper industrie-card pet-food" onclick="active_industrie_card('.pet-food', '#petFood')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Pet food</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio industriesactive" name="industriesactive" id="petFood" value="Pet food">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper industrie-card grain-rice" onclick="active_industrie_card('.grain-rice', '#grainRice')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Grain, rice, soybeans
                                            processing</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio industriesactive" name="industriesactive" id="grainRice" value="Grain, rice, soybeans">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper industrie-card biomass" onclick="active_industrie_card('.biomass', '#biomass')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Biomass</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio industriesactive" name="industriesactive" id="biomass" value="Biomass">
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-4">
                            <button type="button" id="industriesNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                        </div>

                        <div class="mt-5 text-center">
                            <strong>0%</strong>
                            <div class="progress-title pb-1">Completed so far</div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width:0%"></div>
                            </div>
                            <div class="progress-title pt-1">Matchmaking</div>
                        </div>
                    </div>
                    <!-- Form 2 -->
                    <div class="form-2 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title"> 2. Profile of your company<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper company-card feed-producing" onclick="active_company_card('.feed-producing', '#feedProducing')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Feed producing companies
                                        </div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="feedProducing" name="companyprofile" value="Feed producing companies">
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper company-card farmers" onclick="active_company_card('.farmers', '#farmers')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Farmers / Self mixers</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="farmers" name="companyprofile" value="Farmers / Self mixers">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper company-card flour-millers" onclick="active_company_card('.flour-millers', '#flourMillers')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Flour Millers</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="flourMillers" name="companyprofile" value="Flour Millers">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="companyNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>25%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:25%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>

                        </div>
                    </div>
                    <!-- Form 3 -->
                    <div class="form-3 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title"> 3. Producing tons per year<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper production-card tons-one" onclick="active_production_card('.tons-one', '#tonsOne')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Less than 100-ton</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio capacity" id="tonsOne" name="tonscount" value="Less than 100-ton">
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper production-card tons-two" onclick="active_production_card('.tons-two', '#tonsTwo')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> 100 – 500 ton</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio capacity" id="tonsTwo" name="tonscount" value="100 – 500 ton">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper production-card tons-three" onclick="active_production_card('.tons-three', '#tonsThree')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> 500 – 1 million ton</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio capacity" id="tonsThree" name="tonscount" value="500 – 1 million ton">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper production-card tons-four" onclick="active_production_card('.tons-four', '#tonsFour')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Greater than 1 million ton
                                        </div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio capacity" id="tonsFour" name="tonscount" value="Greater than 1 million ton">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="tonsProductionNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>37.5%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:37.5%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>

                        </div>
                    </div>
                    <!-- Form 4 -->
                    <div class="form-4 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title">4. Preferred company to deal with<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper preferred-company-card producer" onclick="active_pref_company_card('.producer', '#producer')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Producer</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="producer" name="companydealwith" value="Producer">
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper preferred-company-card distributor" onclick="active_pref_company_card('.distributor', '#distributor')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Distributor</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="distributor" name="companydealwith" value="Distributor">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper preferred-company-card local" onclick="active_pref_company_card('.local', '#local')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Local representative</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="local" name="companydealwith" value="Local representative">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="prefCompanyNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>50%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:50%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>

                        </div>
                    </div>
                    <!-- Form 5 -->
                    <div class="form-5 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title">5. What products or services are you looking for<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper service-card turnkey" onclick="active_service_card('.turnkey', '#turnkey')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Turnkey projects</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="turnkey" name="servicesfor" value="Turnkey projects">
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper service-card machines" onclick="active_service_card('.machines', '#machines')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Machines </div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="machines" name="servicesfor" value="Machines">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper service-card ingredients" onclick="active_service_card('.ingredients', '#ingredients')">
                                        <div class="p-2 p-card-text pl-3 pr-3   text-center"> Ingredients and Additives
                                        </div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="ingredients" name="servicesfor" value="Ingredients and Additives">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper service-card logistics" onclick="active_service_card('.logistics', '#logistics')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Logistics</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="logistics" name="servicesfor" value="Logistics">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper service-card spare" onclick="active_service_card('.spare', '#spare')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Spare parts</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="spare" name="servicesfor" value="Spare parts">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper service-card other" onclick="active_service_card('.other', '#other')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center"> Other </div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio" id="other" name="servicesfor" value="Other">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="servicesNext" class="btn btn-blue services-next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>62.5%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:62.5%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>
                        </div>
                    </div>
                    <!-- Form 5 (Inner Form) -->
                    <div class="form-5 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12 pl-1">
                                    <h5 class="wizard-title"> <span class="selected-service-title"></span>  <span class="f-14 text-small-grey max-select"></span><span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-sm-12 p-1">
                                    <div class="center-align-lable drp-form-group mt-2">

                                        <div class="form-group w-100 multi-select-wrap pos-rel" >
                                           
                                                <select class="js-ProductsServices-basic-multi form-control w-100 " name="ProductsServices" id="multipleSelect" multiple="multiple">
                                                
                                                </select> 
                                                <img src="<?php echo base_url(); ?>application/assets/shared/img/dropdown-arrow.png" class="drp-arrow">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="productsServicesNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>
                        </div>
                    </div>
                    <!-- Form 6 -->
                    <div class="form-6 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title">6. Important USP’s <span class="f-14 text-small-grey">(Multi-selection fields)</span><span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card custom-made" onclick="active_usp_card('uspCard')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Custom-made</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups" id="customMade" value="Custom-made">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card all-specs" onclick="active_usp_card('allSpecs')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">All specs possible</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups" id="allSpecs" value="All specs possible">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card delivery-time" onclick="active_usp_card('deliveryTime')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Delivery time</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups " id="deliveryTime" value="Delivery time">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card price-quality" onclick="active_usp_card('priceQuality')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Price quality value</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups " id="priceQuality" value="Price quality value">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card payment" onclick="active_usp_card('payment')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Payment terms</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups " id="payment" value="Payment terms">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card integrat" onclick="active_usp_card('integrat')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Integrated with existing systems</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups " id="integrat" value="Integrated with existing systems">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper usp-card installation" onclick="active_usp_card('installation')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Including installation and training</div>
                                    </div>
                                    <input type="checkbox" class="form-check-input userType-radio importantups " id="installation" value="Including installation and training">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn ups-back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="USPNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>75%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:75%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>
                        </div>
                    </div>
                    <!-- Form 7 -->
                    <div class="form-7 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title">7. Looking for companies delivering in<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card worldwide" onclick="active_companies_del_card('.worldwide', '#worldwide')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Worldwide</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="worldwide" name="companies" value="Worldwide">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card europe" onclick="active_companies_del_card('.europe', '#europe')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Europe</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="europe" name="companies" value="Europe">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card north-america" onclick="active_companies_del_card('.north-america', '#northAmerica')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">North America</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="northAmerica" name="companies" value="North America">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card latin-america" onclick="active_companies_del_card('.latin-america', '#northAmerica')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Latin America</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="latinAmerica" name="companies" value="Latin America">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card australia" onclick="active_companies_del_card('.australia', '#australia')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Australia</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="australia" name="companies" value="Australia">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card only-local" onclick="active_companies_del_card('.only-local', '#onlyLocal')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Only local</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="onlyLocal" name="companies" value="Only local">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card asia" onclick="active_companies_del_card('.asia', '#asia')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Asia</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="asia" name="companies" value="Asia">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper companies-del-card africa" onclick="active_companies_del_card('.africa', '#africa')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Africa</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="africa" name="companies" value="Africa">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="deliveringNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>87.5%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:87.5%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>
                        </div>
                    </div>
                    <!-- Form 8 -->
                    <div class="form-8 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title">8. When the investment will be done<span class="text-danger">*</span> </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper investment-card month-one" onclick="active_investment_card('.month-one', '#monthOne')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Within 3 months</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="monthOne" name="investmentmonth" value="Within 3 months">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper investment-card month-two" onclick="active_investment_card('.month-two', '#monthTwo')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Within 6 months</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="monthTwo" name="investmentmonth" value="Within 6 months">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper investment-card month-three" onclick="active_investment_card('.month-three', '#monthThree')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">The coming 2 years</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="monthThree" name="investmentmonth" value="The coming 2 years">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper investment-card month-four" onclick="active_investment_card('.month-four', '#monthFour')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Longer than 2 years from now</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="monthFour" name="investmentmonth" value="Longer than 2 years from now">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6 p-1">
                                    <div class="card m-1 p-card-wrapper investment-card month-five" onclick="active_investment_card('.month-five', '#monthFive')">
                                        <div class="p-2 p-card-text pl-3 pr-3 text-center">Within a year</div>
                                    </div>
                                    <input type="radio" class="form-check-input userType-radio " id="monthFive" name="investmentmonth" value="Within a year">
                                </div>
                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="investmentNext" class="btn btn-blue next-btn pl-5 pr-5">Next</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>92.5%</strong>
                                <div class="progress-title pb-1">Completed so far</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:87.5%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>

                        </div>
                    </div>

                    <!-- Form 9 -->
                    <div class="form-9 form-wrap">
                        <div class="form-group">
                            <h4 for="exampleInputEmail1" class="pb-3 text-center mb-4">FIND SUPPLIERS</h4>
                            <div class="row pt-1">
                                <div class="text-left col-sm-12">
                                    <h5 class="wizard-title">9. Additional Information </h5>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 p-1">
                                    <textarea class="form-control" rows="5" id="additionalInfo" name="comments"></textarea>
                                </div>

                            </div>

                            <div class="text-center pt-3 mt-4">
                                <input type="hidden" id="" name="" value="0">
                                <button type="button" class="btn back-btn pl-5 pr-5 mr-3">Back</button>
                                <button type="button" id="finishquestions" class="btn btn-blue pl-5 pr-5">Finish</button>
                            </div>

                            <div class="mt-5 text-center">
                                <strong>Congratulation!</strong>
                                <div class="progress-title pb-1">100% Done</div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width:1100%"></div>
                                </div>
                                <div class="progress-title pt-1">Matchmaking</div>
                            </div>
                        </div>
                    </div>

                </div>
                <img src="<?php echo base_url(); ?>application/assets/shared/img/ellipse.png" class="bottom-ellipse" />
            </div>
        </div>
    </div>

    <div class="modal fade" id="congrats" role="dialog" aria-labelledby="congrats" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body p-5">
                    <div class="text-center">
                        <img class="mb-4" src="<?php echo base_url(); ?>application/assets/shared/img/admin/logo.png">
                        <div id="supplierText"></div>
                        <div class="text-center mt-4">
                            <a class="td-none" href="<?php echo base_url(); ?>matchmaking">
                                <span class="red-btn">OK</span>
                            </a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>