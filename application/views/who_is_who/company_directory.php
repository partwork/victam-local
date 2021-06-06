<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $plan_id = (isset($_SESSION['plan_id'])) ? $_SESSION['plan_id'] : ''; ?>
<?php $userId = (isset($_SESSION['userId'])) ? $_SESSION['userId'] : ''; ?>

<body>
    <!-- Header Section -->
    <div class="container-fluid pr-0 pl-0">
        <?php $this->load->view('shared/header/header'); ?>
        <div class="row pr-5">
            <div class="col-sm-3">
                <div class="filters-wrap">
                    <div class="filter-btn-wrap">
                        <span>Filters</span>
                        <button type="button" class="btn btn-sm btn-blue float-right f-14 fw-400" id="clearfilter">Reset filters</button>
                    </div>
                    <div class="input-fields-wrap mt-2">
                        <div class="form-group search-filter-wrap pos-rel">
                            <input type="text" class="form-control" id="filterSearch" placeholder="Search for the company">
                            <i class="fa fa-search" id="Searchme" aria-hidden="true"></i>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Display</label>
                            <select class="form-control" name="category" id="sector" required>
                                <!-- <option value="" disabled selected hidden class="placeholder-text">Select</option> -->
                                <option value="">All Sectors</option>
                                <option value="Additives &amp; Raw Materials">Additives &amp; Raw Materials</option>
                                <option value="Automation &amp; Control">Automation &amp; Control</option>
                                <option value="Logistics">Logistics</option>
                                <option value="Machinery &amp; Equipments">Machinery &amp; Equipments</option>
                                <option value="Quality Control">Quality Control</option>
                                <option value="Safety &amp; Environment">Safety &amp; Environment</option>
                                <option value="Services">Services</option>
                                <option value="Additives">Additives</option>
                                <option value="All About Feeds">All About Feeds</option>
                                <option value="Animal Feed">Animal Feed</option>
                                <option value="Animal Nutrition">Animal Nutrition</option>
                                <option value="Aqua Feed">Aqua Feed</option>
                                <option value="Biomass">Biomass</option>
                                <option value="De Molenaar">De Molenaar</option>
                                <option value="Far Eastern Agriculture">Far Eastern Agriculture</option>
                                <option value="Rice &amp; Flour Milling">Rice &amp; Flour Milling</option>
                                <option value="Pet Foods">Pet Foods</option>
                                <option value="Rice Milling">Rice Milling</option>
                                <option value="Wooden Pellets">Wooden Pellets</option>
                                <option value="World Grain">World Grain</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Refine</label>
                            <select class="form-control" name="category" id="countrySearch" required>
                                <!-- <option value="" disabled="" selected="" hidden="" class="placeholder-text">Select Country</option> -->
                                <option value="">All Country</option>
                                <option value="Afghanistan">Afghanistan</option>
                                <option value="Albania">Albania</option>
                                <option value="Algeria">Algeria</option>
                                <option value="American Samoa">American Samoa</option>
                                <option value="Andorra">Andorra</option>
                                <option value="Angola">Angola</option>
                                <option value="Anguilla">Anguilla</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Armenia">Armenia</option>
                                <option value="Aruba">Aruba</option>
                                <option value="Australia">Australia</option>
                                <option value="Austria">Austria</option>
                                <option value="Azerbaijan">Azerbaijan</option>
                                <option value="Bahamas">Bahamas</option>
                                <option value="Bahrain">Bahrain</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Barbados">Barbados</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Belgium">Belgium</option>
                                <option value="Belize">Belize</option>
                                <option value="Benin">Benin</option>
                                <option value="Bermuda">Bermuda</option>
                                <option value="Bhutan">Bhutan</option>
                                <option value="Bolivia">Bolivia</option>
                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                <option value="Botswana">Botswana</option>
                                <option value="Bouvet Island">Bouvet Island</option>
                                <option value="Brazil">Brazil</option>
                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                <option value="Brunei">Brunei</option>
                                <option value="Bulgaria">Bulgaria</option>
                                <option value="Burkina Faso">Burkina Faso</option>
                                <option value="Burundi">Burundi</option>
                                <option value="Cambodia">Cambodia</option>
                                <option value="Cameroon">Cameroon</option>
                                <option value="Canada">Canada</option>
                                <option value="Cape Verde">Cape Verde</option>
                                <option value="Cayman Islands">Cayman Islands</option>
                                <option value="CÃ´te dÂ’Ivoire">CÃ´te dÂ’Ivoire</option>
                                <option value="Central African Republic">Central African Republic</option>
                                <option value="Chad">Chad</option>
                                <option value="Chile">Chile</option>
                                <option value="China">China</option>
                                <option value="Christmas Island">Christmas Island</option>
                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                <option value="Colombia">Colombia</option>
                                <option value="Comoros">Comoros</option>
                                <option value="Congo">Congo</option>
                                <option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
                                <option value="Cook Islands">Cook Islands</option>
                                <option value="Costa Rica">Costa Rica</option>
                                <option value="Croatia">Croatia</option>
                                <option value="Cuba">Cuba</option>
                                <option value="Cyprus">Cyprus</option>
                                <option value="Czech Republic">Czech Republic</option>
                                <option value="Denmark">Denmark</option>
                                <option value="Djibouti">Djibouti</option>
                                <option value="Dominica">Dominica</option>
                                <option value="Dominican Republic">Dominican Republic</option>
                                <option value="East Timor">East Timor</option>
                                <option value="Ecuador">Ecuador</option>
                                <option value="Egypt">Egypt</option>
                                <option value="El Salvador">El Salvador</option>
                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                <option value="Eritrea">Eritrea</option>
                                <option value="Estonia">Estonia</option>
                                <option value="Ethiopia">Ethiopia</option>
                                <option value="Falkland Islands">Falkland Islands</option>
                                <option value="Faroe Islands">Faroe Islands</option>
                                <option value="Fiji Islands">Fiji Islands</option>
                                <option value="Finland">Finland</option>
                                <option value="France">France</option>
                                <option value="French Guiana">French Guiana</option>
                                <option value="French Polynesia">French Polynesia</option>
                                <option value="French Southern territories">French Southern territories</option>
                                <option value="Gabon">Gabon</option>
                                <option value="Gambia">Gambia</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Germany">Germany</option>
                                <option value="Ghana">Ghana</option>
                                <option value="Gibraltar">Gibraltar</option>
                                <option value="Greece">Greece</option>
                                <option value="Greenland">Greenland</option>
                                <option value="Grenada">Grenada</option>
                                <option value="Guadeloupe">Guadeloupe</option>
                                <option value="Guam">Guam</option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guinea">Guinea</option>
                                <option value="Guinea-Bissau">Guinea-Bissau</option>
                                <option value="Guyana">Guyana</option>
                                <option value="Haiti">Haiti</option>
                                <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                <option value="Honduras">Honduras</option>
                                <option value="Hong Kong">Hong Kong</option>
                                <option value="Hungary">Hungary</option>
                                <option value="Iceland">Iceland</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Iran">Iran</option>
                                <option value="Iraq">Iraq</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Jamaica">Jamaica</option>
                                <option value="Japan">Japan</option>
                                <option value="Jordan">Jordan</option>
                                <option value="Kazakstan">Kazakstan</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Kiribati">Kiribati</option>
                                <option value="Kuwait">Kuwait</option>
                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                <option value="Laos">Laos</option>
                                <option value="Latvia">Latvia</option>
                                <option value="Lebanon">Lebanon</option>
                                <option value="Lesotho">Lesotho</option>
                                <option value="Liberia">Liberia</option>
                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                <option value="Liechtenstein">Liechtenstein</option>
                                <option value="Lithuania">Lithuania</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Macao">Macao</option>
                                <option value="Macedonia">Macedonia</option>
                                <option value="Madagascar">Madagascar</option>
                                <option value="Malawi">Malawi</option>
                                <option value="Malaysia">Malaysia</option>
                                <option value="Maldives">Maldives</option>
                                <option value="Mali">Mali</option>
                                <option value="Malta">Malta</option>
                                <option value="Marshall Islands">Marshall Islands</option>
                                <option value="Martinique">Martinique</option>
                                <option value="Mauritania">Mauritania</option>
                                <option value="Mauritius">Mauritius</option>
                                <option value="Mayotte">Mayotte</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                <option value="Moldova">Moldova</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Mongolia">Mongolia</option>
                                <option value="Montserrat">Montserrat</option>
                                <option value="Morocco">Morocco</option>
                                <option value="Mozambique">Mozambique</option>
                                <option value="Myanmar">Myanmar</option>
                                <option value="Namibia">Namibia</option>
                                <option value="Nauru">Nauru</option>
                                <option value="Nepal">Nepal</option>
                                <option value="Netherland">Netherland</option>
                                <option value="Netherland Antilles">Netherland Antilles</option>
                                <option value="New Caledonia">New Caledonia</option>
                                <option value="New Zealand">New Zealand</option>
                                <option value="Nicaragua">Nicaragua</option>
                                <option value="Niger">Niger</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Niue">Niue</option>
                                <option value="Norfolk Island">Norfolk Island</option>
                                <option value="North Korea">North Korea</option>
                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                <option value="Norway">Norway</option>
                                <option value="Oman">Oman</option>
                                <option value="Pakistan">Pakistan</option>
                                <option value="Palau">Palau</option>
                                <option value="Palestine">Palestine</option>
                                <option value="Panama">Panama</option>
                                <option value="Papua New Guinea">Papua New Guinea</option>
                                <option value="Paraguay">Paraguay</option>
                                <option value="Peru">Peru</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Pitcairn">Pitcairn</option>
                                <option value="Poland">Poland</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Puerto Rico">Puerto Rico</option>
                                <option value="Qatar">Qatar</option>
                                <option value="RÃ©union">RÃ©union</option>
                                <option value="Romania">Romania</option>
                                <option value="Russian Federation">Russian Federation</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Saint Helena">Saint Helena</option>
                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                <option value="Saint Lucia">Saint Lucia</option>
                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                <option value="Samoa">Samoa</option>
                                <option value="San Marino">San Marino</option>
                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Senegal">Senegal</option>
                                <option value="Seychelles">Seychelles</option>
                                <option value="Sierra Leone">Sierra Leone</option>
                                <option value="Singapore">Singapore</option>
                                <option value="Slovakia">Slovakia</option>
                                <option value="Slovenia">Slovenia</option>
                                <option value="Solomon Islands">Solomon Islands</option>
                                <option value="Somalia">Somalia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                <option value="South Korea">South Korea</option>
                                <option value="Spain">Spain</option>
                                <option value="Sri Lanka">Sri Lanka</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Suriname">Suriname</option>
                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                <option value="Swaziland">Swaziland</option>
                                <option value="Sweden">Sweden</option>
                                <option value="Switzerland">Switzerland</option>
                                <option value="Syria">Syria</option>
                                <option value="Taiwan">Taiwan</option>
                                <option value="Tajikistan">Tajikistan</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Togo">Togo</option>
                                <option value="Tokelau">Tokelau</option>
                                <option value="Tonga">Tonga</option>
                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                <option value="Tunisia">Tunisia</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Turkmenistan">Turkmenistan</option>
                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                <option value="Tuvalu">Tuvalu</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                <option value="Uruguay">Uruguay</option>
                                <option value="Uzbekistan">Uzbekistan</option>
                                <option value="Vanuatu">Vanuatu</option>
                                <option value="Venezuela">Venezuela</option>
                                <option value="Vietnam">Vietnam</option>
                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                <option value="Western Sahara">Western Sahara</option>
                                <option value="Yemen">Yemen</option>
                                <option value="Yugoslavia">Yugoslavia</option>
                                <option value="Zambia">Zambia</option>
                                <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="alphabet-filter clearfix">
                                <div class="az-alphabet-fliter">
                                    <span class="box">ALL</span>
                                    <span class="box">0-9</span>
                                </div>
                                <div class="alphabets-box-wrap">
                                    <span class="box" >A</span>
                                    <span class="box" >B</span>
                                    <span class="box" >C</span>
                                    <span class="box" >D</span>
                                    <span class="box" >E</span>
                                    <span class="box" >F</span>
                                    <span class="box" >G</span>
                                    <span class="box" >H</span>
                                    <span class="box" >I</span>
                                    <span class="box" >J</span>
                                    <span class="box" >K</span>
                                    <span class="box" >L</span>
                                    <span class="box" >M</span>
                                    <span class="box" >N</span>
                                    <span class="box" >O</span>
                                    <span class="box" >P</span>
                                    <span class="box" >Q</span>
                                    <span class="box" >R</span>
                                    <span class="box" >S</span>
                                    <span class="box" >T</span>
                                    <span class="box" >U</span>
                                    <span class="box" >V</span>
                                    <span class="box" >W</span>
                                    <span class="box" >X</span>
                                    <span class="box" >Y</span>
                                    <span class="box" >Z</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group search-filter-wrap pos-rel">
                            <!-- <a href="<?php echo base_url(); ?>who_Is_Who/add-company" class="btn btn-blue w-100 f-14 fw-400">Add Company To The Guide</a> -->
                            <div onclick="add_company_clickHandel( '<?php echo $plan_id ?>', '<?php echo $userId ?>' )" class="btn btn-blue w-100 f-14 fw-400">Add Company To The Guide</div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 mt-4 pb-5" id="comp-directory">
                <h4 class="text-title-small fw-400">COMPANY DIRECTORY</h4>
                <div id="nodatafound" class="alert alert-danger">No data found..</div>
                <div class="row mt-3 scroll-section pt-1" id="Ajaxresult">
                    <!-- <div id="Searchresult"> -->
                    <?php if ($companylist) : ?>
                        <?php foreach ($companylist as $list) : ?>
                            <div class="col-sm-3" id="Searchresult">
                                <div class="comp-card-wrap">
                                    <div class="buyers-image" style="background: url('<?php echo base_url('upload/company/' . $list->vic_companylogo); ?>')"></div>
                                    <div class="buyer-info-wrap text-left">
                                        <h6 class="text-title-small"><?php echo $list->vic_companyname ?></h6>
                                        <p class="mb-1"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400"><?php echo $list->vic_industry_sector; ?></span></p>
                                        <p class="mb-1"><span class="f-14 fw-500">Products</span>: <span class="f-14 fw-400"><?php echo $list->vic_products_services; ?></span></p>
                                        <p class="mb-1"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400"><?php echo $list->vic_country_name; ?></span></p>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_company_info(<?php echo $list->idvic_company; ?>)">View</button>
                                </div>
                                <!-- <div class="comp-card-wrap">
                                        <img src="<?php echo base_url('upload/company/' . $list->vic_companylogo); ?>"/>
                                        <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_company_info(<?php echo $list->idvic_company; ?>)">View</button>
                                    </div> -->
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="alert alert-danger">No Company Found...</div>
                    <?php endif; ?>
                    <!-- </div> -->
                </div>
            </div>
            <div class="col-sm-9 mt-4 pb-5" id="comp-detail-directory">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-sm btn-blue back-to-comp-directory float-right mb-3 pl-4 pr-4">Back</button>
                        <div class="w-100 center-align-lable pos-rel bb-grey bt-grey pt-4 pb-4">
                            <img id="companylogo" src="" width="220" />
                            <ul class="social-icons-wrap fs-22">
                                <li class="list-inline-item"> <a href="" id="linkedinfo" target="_blank">
                                        <i class="fa fa-linkedin fa-icon-social"></i></a></li>
                                <li class="list-inline-item"> <a href="" id="facebookinfo" target="_blank">
                                        <i class="fa fa-facebook-square fa-icon-social"></i> </a> </li>
                                <!-- <li class="list-inline-item"> <a href="" id="googleinfo" target="_blank"> <i class="fa fa-google fa-icon-social"></i> </a> </li> -->
                                <li class="list-inline-item"> <a href="" id="twitterinfo" target="_blank"> <i class="fa fa-twitter fa-icon-social"></i> </a> </li>
                            </ul>
                        </div>
                    </div> 
                    <div class="col-sm-12 mt-3">
                        <h4 class="text-title-small fw-400 mb-3" id="abouttitle"></h4>
                        <p class="company-sub-text-heading" id="compdesc">
                        </p>
                    </div>
                    <div class="col-sm-12 mt-3">
                        <h5 class="text-title-small fw-400 mb-3">Presentation</h5>
                        <iframe id="youtubeurl" width="400" height="200" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div> 
                    <div class="col-sm-12 mt-5">
                        <h5 class="text-title-small fw-400 mb-3">Company Details</h5>
                        <div class="company-details-wrap center-align-lable">
                            <div class="company-desc">
                                <h6 class="text-title-small fw-400">Industry Sector</h6>
                                <p class="text-blue fw-300 f-14" id="industryname"></p>
                            </div>
                            <div class="company-desc">
                                <h6 class="text-title-small fw-400">Company Location</h6>
                                <p class="text-blue fw-300 f-14" id="headquarter"></p>
                            </div>
                            <div class="company-desc">
                                <h6 class="text-title-small fw-400">Specialties</h6>
                                <p class="text-blue fw-300 f-14" id="specialties"></p>
                            </div>
                        </div>
                        <div class="company-desc">
                            <h6 class="text-title-small fw-400">Address details</h6>
                            <p class="text-blue fw-300 f-14 m-0" id="address"></p>
                            <p id="country"></p>
                            <p class="text-blue fw-300 f-14 m-0">Phone : <b id="pnumber"></b> &nbsp;|&nbsp; </p>
                            <p class="text-blue fw-300 f-14 m-0">Email : <b id="emailidcom"></b> &nbsp;|&nbsp;</p>
                            <p class="text-blue fw-300 f-14 m-0">Website : <span id="websiteurl"></span></p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('shared/footer/footer'); ?>
        <!-- Chatbot -->
        <?php $this->load->view('shared/chatbot/chatbot'); ?>

    </div>
</body>