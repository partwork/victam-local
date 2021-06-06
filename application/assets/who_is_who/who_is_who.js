var ajax_url = $('#ajax_url').val();
var fb_id = $('#fb_id').val();
var char = 'all';

$(window).scroll(function () {
    var wh = $(window).height() - 50;
    if ($(window).scrollTop() > $('.subscription-text').offset().top - wh) {
        $('.subscription-text').addClass('onScroll');
    }
});

$(document).ready(function () {
    $('#nodatafound').hide();
    $(".owl-carousel").owlCarousel({
        loop: true,
        items: 4, // Select Item Number
        autoplay: true,
        nav: false,
        dots: true
        // navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
    });


    $("#comp-detail-directory").hide();
    $(".back-to-comp-directory").click(function () {
        $("#comp-directory").show();
        $("#comp-detail-directory").hide();
    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $(document).ready(function ($) {
        var required_filed = {
            companyname: {
                required: true,
                maxlength: 50,
            },
            companydescription: "required",
            address: "required",
            city: "required",
            zipcode: {
                required: true,
                minlength: 6,
                maxlength: 6,
            },
            country: "required",
            email: {
                required: true,
                email: true,
            },
            phonenumber: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            website: {
                required: true,
                url: true
            },
            industrysector: "required",
            industries: "required",
            production: "required",
            companytodeal: "required",
            target_groups: "required",
            services: "required",
            USPS: "required",
            delivering: "required",
            duration: "required",
            specialities: "required",
            linkedinurl: "required",
            duration: "required",
            headquarters: "required",
            gridCheck: "required",
        }
        var companyID = $('#company_id').val();
        var logo = $('#logo').val();
        var presentation = $('#presentation').val();

        if (logo == null || logo == "") {
            required_filed['uploadImageFile'] = { required: true, extension: "jpg,jpeg,png", filesize: 5000000 }
        }
        if(presentation == null || presentation == ""){
            
            required_filed['uploadPresentationFile'] = { required: true, extension: "docx,doc,pdf,mp4", filesize: 50000000 }
        }
        $("#addCompanyForm").validate({
            rules: required_filed,
            messages: {
                companyname:{
                    required: "Company name required",
                    maxlength: "Company name max. length 50 char.",
                }, 
                companydescription: "Company description required",
                address: "Address required",
                city: "City required",
                zipcode: {
                    required: "ZIP code required",
                    minlength: "ZIP code number should be 6 digit",
                    maxlength: "ZIP code number should be 6 digit",
                },
                country: "Country required",
                email: {
                    required: "Email required",
                    email: "Please enter valid mail ID "
                },
                phonenumber: {
                    required: "Phone number required",
                    minlength: "Phone number should be 10 digit",
                    maxlength: "Phone number should be 10 digit",
                },
                website: {
                    required: "Website URL required",
                    url: "Please enter valid URL",
                },
                industrysector: "Industry required",
                industries: "Industries required",
                production: "Production required",
                companytodeal: "Company to deal required",
                services: "Service required",
                USPS: "USPs required",
                delivering: "Companies Delivering required",
                duration: "Duration required",
                specialities: "Specialities required",
                linkedinurl: "Linkedin URL required",
                headquarters: "Headquarters required",
                uploadImageFile: {
                    required: "Image required",
                    extension: "Allowed file extensions: PNG, JPEG",
                    filesize: "File size must be less than 5MB",
                },
                uploadPresentationFile: {
                    required: "Presentation file required",
                    extension: "Allowed file extensions: PDF, DOCX, PPTX, MP4",
                    filesize: "File size must be less than 10MB",
                },
                gridCheck: "Please check terms ",
            },

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('#services').change(function () {
            $('#productsServices').val('').trigger("change");
            $('#productsServices').text('');
            if (this.value == 'Machines') {
                $('.selected-service-title').text('Please make a selection for machines');
                $('.max-select').text('(Maximum four options can be selected)');
                var multipleSelect = `
                <option value="Baghandling">Bag handling</option>
                <option value="Conditioning">Conditioning</option>
                <option value="Conveying">Conveying</option>
                <option value="CoolingDryingCrumbling">Cooling / drying / crumbling</option>
                <option value="ExtrusionExpanding">Extrusion / expanding</option>
                <option value="GrainHandling">Grain Handling</option>
                <option value="Grinding">Grinding</option>
                <option value="Intakeandstorage">Intake and storage</option>
                <option value="Liquidaddition">Liquid addition</option>
                <option value="Liquid coating">Liquid coating</option>
                <option value="Mixing">Mixing</option>
                <option value="Pelleting">Pelleting</option>
                <option value="QualityControl">Quality Control</option>
                <option value="SiftingAndGrading">Sifting and grading</option>
                <option value="Utilities">Utilities</option>
                <option value="WeighingAndDosing">Weighing and dosing</option>`;
                $(".multi-select-wrap").show();
            } else if (this.value == 'Ingredients and Additives') {
                $('.selected-service-title').text('Please make a selection for Ingredients and Additives');
                $('.max-select').text('(Maximum four options can be selected)');
                var multipleSelect = `
                <option value="AcidsAcidifiers">Acids, Acidifiers</option>
                <option value="Algae">Algae</option>
                <option value="AminoAcids">Amino acids</option>
                <option value="Proteins">Proteins</option>
                <option value="Antibiotics">Antibiotics</option>
                <option value="Antioxidants">Antioxidants</option>
                <option value="BeetsAndOtherTuberousPlants">Beets and other tuberous plants</option>
                <option value="BindersAndFlowAgents">Binders and flow agents</option>
                <option value="Cereals(whole)">Cereals (whole)</option>
                <option value="Coccidiostatics">Coccidiostatics</option>
                <option value="ColouringAgentsPigments">Colouring agents, Pigments</option>
                <option value="DairyProducts">DairyProducts</option>
                <option value="Enzymes">Enzymes</option>
                <option value="FlavorsSweeteners">Flavors, Sweeteners</option>
                <option value="GrainDerivatives(by-products)">Grain derivatives (by-products)</option>
                <option value="GrassMealAndRoughage">Grass meal and roughage</option>
                <option value="GrowthPromoters">Growth promoters</option>
                <option value="HerbsAndNaturalAdditives">Herbs and natural additives</option>
                <option value="IndustrialByProducts">Industrial by-products</option>
                <option value="Insects">Insects</option>
                <option value="LiquidRawMaterials">Liquid raw materials</option>
                <option value="MilkReplacers">Milk replacers</option>
                <option value="MineralsAndFillers">Minerals and fillers</option>
                <option value="MouldPrevention">Mould prevention</option>
                <option value="Oilseeds">Oilseeds</option>
                <option value="OilsAndFats">Oils and fats</option>
                <option value="PalatabilityEnhancers">Palatability enhancers</option>
                <option value="Premixes">Premixes</option>
                <option value="ProbioticsAndPrebiotics">Probiotics and prebiotics</option>
                <option value="PulpAndDerivatives">Pulp and derivatives</option>
                <option value="Pulses(peas, beans, lupins)">Pulses (peas, beans, lupins)</option>
                <option value="SalmonellaPrevention">Salmonella prevention</option>
                <option value="TraceElements">Trace elements</option>
                <option value="VeterinaryProducts">Veterinary products</option>
                <option value="Vitamins">Vitamins</option>
                <option value="Yeasts">Yeasts</option>`;
                $(".multi-select-wrap").show();
            } else if (this.value == 'Logistics') {
                $('.selected-service-title').text('Please make a selection for Logistics');
                $('.max-select').text('');
                var multipleSelect = `
                <option value="Control">Control</option>
                <option value="Storage">Storage</option>
                <option value="Transportation">Transportation</option>
                <option value="Maintenance">Maintenance</option>
                <option value="SafetyAndEnvironment">Safety and environment</option>
                <option value="Packaging">Packaging</option>`;
                $(".multi-select-wrap").show();
            } else if (this.value == 'Other Services') {
                $('.selected-service-title').text('Please make a selection for Other Services');
                $('.max-select').text('');
                var multipleSelect = `
                <option value="Automation">Automation</option>
                <option value="FinancialServices">Financial services</option>
                <option value="Cleaning">Cleaning</option>
                <option value="OtherServices">Other services</option>`;
                $(".multi-select-wrap").show();
            } else {
                $(".multi-select-wrap").hide();
            }

            $("#productsServices").append(multipleSelect);

        });

    });



});

$(document).ready(function () {
    $(".multi-select-wrap").hide();
});
// Dropdown function
$(function () {
    $(".sector-drp-list a").click(function () {
        $("#SelectSector span").text($(this).text());
    });
    $(".refine-drp-list a").click(function () {
        $("#SelectRefine span").text($(this).text());
    });

    // Add Company to the guide
    $(".Industries-drp-list a").click(function () {
        $("#SelectIndustries span").text($(this).text());
        $("#SelectIndustries span").removeClass("text-light-grey");
    });
    $(".Companyprofile-drp-list a").click(function () {
        $("#SelectCompanyprofile span").text($(this).text());
        $("#SelectCompanyprofile span").removeClass("text-light-grey");
    });
    $(".Production-drp-list a").click(function () {
        $("#SelectProduction span").text($(this).text());
        $("#SelectProduction span").removeClass("text-light-grey");
    });
    $(".CompanyDeal-drp-list a").click(function () {
        $("#SelectCompanyDeal span").text($(this).text());
        $("#SelectCompanyDeal span").removeClass("text-light-grey");
    });
    $(".ProductsServices-drp-list a").click(function () {
        $("#SelectProductsServices span").text($(this).text());
        $("#SelectProductsServices span").removeClass("text-light-grey");
        $(".multi-select-wrap").show();
    });
    $(".ImportantUSPs-drp-list a").click(function () {
        $("#SelectImportantUSPs span").text($(this).text());
        $("#SelectImportantUSPs span").removeClass("text-light-grey");
    });
    $(".CompaniesDelivering-drp-list a").click(function () {
        $("#SelectCompaniesDelivering span").text($(this).text());
        $("#SelectCompaniesDelivering span").removeClass("text-light-grey");
    });
    $(".InvestmentDuration-drp-list a").click(function () {
        $("#SelectInvestmentDuration span").text($(this).text());
        $("#SelectInvestmentDuration span").removeClass("text-light-grey");
    });
});


// Add company to the guide
$(document).ready(function () {
    // File Upload

    // Image Upload
    const imageFileBtn = document.getElementById("upload-image-file");
    const imageBtn = document.getElementById("upload-image-button");
    const imageTxt = document.getElementById("upload-image-file-name");

    imageBtn.addEventListener("click", function () {
        imageFileBtn.click();
    });

    imageFileBtn.addEventListener("change", function () {
        if (imageFileBtn.value) {
            imageTxt.innerHTML = imageFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            imageTxt.innerHTML = "";
        }
    });

    // Video Upload
    const PresentationFileBtn = document.getElementById("upload-Presentation-file");
    const PresentationBtn = document.getElementById("upload-Presentation-button");
    const PresentationTxt = document.getElementById("upload-Presentation-file-name");

    PresentationBtn.addEventListener("click", function () {
        PresentationFileBtn.click();
    });

    PresentationFileBtn.addEventListener("change", function () {
        if (PresentationFileBtn.value) {
            PresentationTxt.innerHTML = PresentationFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            PresentationTxt.innerHTML = "";
        }
    });

});

// Multi selelction
$(document).ready(function () {
    $('.js-ProductsServices-basic-multi').select2({
        maximumSelectionLength: 4
    });
});

function get_company_info(id) {
    $("#comp-detail-directory").show();
    $("#comp-directory").hide();
    $.ajax({
        url: ajax_url + "e/WhoIsWhoController/get_company_details/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            $('[id="abouttitle"]').html(data['0'].vic_companyname);
            $('[id="compdesc"]').html(data['0'].vic_companydesc);
            $('#companylogo').attr('src', ajax_url + 'upload/company/' + data['0'].vic_companylogo);
            $('#linkedinfo').attr('href', data['0'].vic_companylinkedinurl);
            //$('#facebookinfo').attr('href', data['0'].vic_companylogo);
            $('#googleinfo').attr('href', data['0'].vic_companygooglemap);
            $('#twitterinfo').attr('href', data['0'].vic_companytwitterurl);
            $('#youtubeurl').attr('src', ajax_url + 'upload/company/' + data['0'].vic_companypresentation);
            $('#industryname').html(data['0'].vic_active_industry1);
            $('#headquarter').html(data['0'].vic_companyheadquarters);
            $('#specialties').html(data['0'].vic_specialities);
            $('#address').html(data['0'].vic_address_details);
            $('#country').html(data['0'].vic_companycity);
            $('#pnumber').html(data['0'].vic_phonenumber);
            // $('#faxnumber').html(data['0'].vic_companyfax);
            $('#emailidcom').html(data['0'].vic_companyemail);
            let companywebsite = ` <a class="text-blue fw-300 f-14 font-weight-bold" href="` + data['0'].vic_companywebsite + `" target='_blank'>` + data['0'].vic_companywebsite + `</a> `;
            $("#websiteurl").append(companywebsite);
            $('#facebookinfo').attr('href', 'https://www.facebook.com/dialog/share?app_id='+fb_id+'&href=http://dev.victam.com/e/CommonController/get_company_by_id/' + data['0'].idvic_company + '&display=popup');
            $('#linkedinfo').attr('href', 'https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_company_by_id/' + data['0'].idvic_company);
            $('#twitterinfo').attr('href', 'https://twitter.com/intent/tweet?text=' + data['0'].vic_companyname + data['0'].vic_companydesc + '');
        }
    });
}
$(function () {
    $(".sector-drp-list a").click(function () {
        $("#SelectSector span").text($(this).text());
    });
    $(".refine-drp-list a").click(function () {
        $("#SelectRefine span").text($(this).text());
    });
    $("#Searchme").click(function () {
        get_filter_result();
        // $('#Searchresult').hide();
        // var name = $('#filterSearch').val();
        // var type = 'name';
        // $.ajax({
        //     url: ajax_url + "e/WhoIsWhoController/search_using_keywords/" + name + "/" + type,
        //     type: "GET",
        //     dataType: "JSON",
        //     success: function(data) {
        //         var html = '';
        //         $("#Ajaxresult").empty();
        //         $.each(data, function(i, value) {
        //             html += `<div class="col-sm-3" id="Searchresult">
        //             <div class="comp-card-wrap">
        //             <div class="buyers-image" style="background: url('` + ajax_url + `upload/company/` + value.vic_companylogo + `')"></div>
        //             <div class="buyer-info-wrap text-left">
        //                 <h6 class="text-title-small">` + value.vic_companyname + `</h6>
        //                 <p class="mb-1"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400"> ` + value.vic_industry_sector + `</span></p>
        //                 <p class="mb-1"><span class="f-14 fw-500">Products</span>: <span class="f-14 fw-400"> ` + value.vic_products_services + `</span></p>
        //                 <p class="mb-1"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400"> ` + value.vic_country_name + `</span></p>
        //             </div>
        //             <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_company_info(` + value.idvic_company + `)">View</button>
        //             </div>
        //             </div>`
        //         });
        //         if (!html) {
        //             $('#nodatafound').show();
        //         } else {
        //             $('#nodatafound').hide();
        //             $("#Ajaxresult").append(html);
        //         }
        //     }
        // });
    });
    $("#sectorsearch").click(function () {
        $('#Searchresult').hide();
        var name = $('#sectorvalue').val();
        var type = 'sector';
        $.ajax({
            url: ajax_url + "e/WhoIsWhoController/search_using_keywords/" + name + "/" + type,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.length > 0) {
                    var html = '';
                    $.each(data, function (i, value) {
                        html += ` <div class="col-sm-3" id="Searchresult">
                    <div class="comp-card-wrap">
                    <div class="buyers-image" style="background: url('` + ajax_url + `upload/company/` + value.vic_companylogo + `')"></div>
                    <div class="buyer-info-wrap text-left">
                        <h6 class="text-title-small"><?php echo $list->vic_companyname ?></h6>
                        <p class="mb-1"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400"> ` + value.vic_industry_sector + `</span></p>
                        <p class="mb-1"><span class="f-14 fw-500">Products</span>: <span class="f-14 fw-400"> ` + value.vic_products_services + `</span></p>
                        <p class="mb-1"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400"> ` + value.vic_country_name + `</span></p>
                    </div>
                    <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_company_info(` + value.idvic_company + `)">View</button>
                </div>
                </div>`
                    });
                } else {
                    html += `<h2 class="text-blue text-center" style="margin:auto;">Result Not Found</h2>`;
                }
                $("#Ajaxresult").append(html);
            }
        });
    });
    $('#clearfilter').click(function () {
        $('#filterSearch').val('');
        $('#sector').val('');
        $('#countrySearch').val('');
        char = "all";
        get_filter_result();
    });
    $("#sector").change(function () {
        get_filter_result();

    });
    $('#countrySearch').change(function () {
        get_filter_result();
    });
    $('.box').click(function () {
        char = $(this).text();
        get_filter_result();
    })
});

$(document).on('keyup change', '#filterSearch', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        get_filter_result();
    }
});

function get_filter_result() {
    var name = $('#filterSearch').val();
    var sector = $('#sector').val();
    var country = $('#countrySearch').val();
    var alphabet = char;
    if (alphabet == '0-9') alphabet = 'number';

    $.ajax({
        url: ajax_url + "e/WhoIsWhoController/company_filter",
        type: "POST",
        data: { 'name': name, 'sector': sector, 'country': country, 'type': alphabet },
        dataType: "JSON",
        success: function (data) {
            var html = '';
            $("#Ajaxresult").empty();
            if (data.length > 0) {
                $.each(data, function (i, value) {
                    html += ` <div class="col-sm-3" id="Searchresult">
                    <div class="comp-card-wrap">
                    <div class="buyers-image" style="background: url('` + ajax_url + `upload/company/` + value.vic_companylogo + `')"></div>
                    <div class="buyer-info-wrap text-left">
                        <h6 class="text-title-small">` + value.vic_companyname + `</h6>
                        <p class="mb-1"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400"> ` + value.vic_industry_sector + `</span></p>
                        <p class="mb-1"><span class="f-14 fw-500">Products</span>: <span class="f-14 fw-400"> ` + value.vic_products_services + `</span></p>
                        <p class="mb-1"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400"> ` + value.vic_country_name + `</span></p>
                    </div>
                    <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_company_info(` + value.idvic_company + `)">View</button>
                </div>
                </div>`
                });
            } else {
                html += `<h2 class="text-blue text-center" style="margin:auto;">Result Not Found</h2>`;
            }

            $("#Ajaxresult").append(html);
        }
    });
}

function myFunction(value) {
    char = value;
    if (value == 'all') {
        get_filter_result();
    } else {
        $('#Searchresult').hide();
        var name = value;
        var type = value;
        $.ajax({
            url: ajax_url + "e/WhoIsWhoController/search_using_keywords/" + name + "/" + type,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#Ajaxresult').html("");
                var html = '';

                $.each(data, function (i, value) {
                    html += `<div class="col-sm-3" id="Searchresult">
                <div class="comp-card-wrap">
                <div class="buyers-image" style="background: url('` + ajax_url + `upload/company/` + value.vic_companylogo + `')"></div>
                <div class="buyer-info-wrap text-left">
                    <h6 class="text-title-small"> ` + value.vic_companyname + `</h6>
                    <p class="mb-1"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400"> ` + value.vic_industry_sector + `</span></p>
                    <p class="mb-1"><span class="f-14 fw-500">Products</span>: <span class="f-14 fw-400"> ` + value.vic_products_services + `</span></p>
                    <p class="mb-1"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400"> ` + value.vic_country_name + `</span></p>
                </div>
                <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_company_info(` + value.idvic_company + `)">View</button>
            </div>
            </div>`
                });
                $("#Ajaxresult").append(html);
            }
        });
    }
}

function add_company_clickHandel(planId, userId) {
    $('#alertMsg').text('');
    if (userId) {
        if (planId == 2 || planId == 3 || planId == 5) {
            let Url = ajax_url + 'who_Is_Who/add-company';
            window.location.replace(Url);
        } else {
            let alertMsg = `
            <div class="mactchmaking-alert">
                        <p class="text-center fs-16 mb-4 fw-600">Add Your Company To The Guide</p>
                        <p class="pl-3 text-left"> Pay As You Go <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/4">Click here</a></p>
                        <p class="pl-3 text-left">  To Upgrade Your Plan <a href="` + ajax_url + `pricing">Click here</a></p>
                        </div>`;
            $("#alertMsg").append(alertMsg);
            $('#myModal').modal('toggle');
        }
    } else {
        let alertMsg = `<span>  Premium members can browse the online directories by industry, geography, category, or search by company name. If you have not subscribed yet, please <a href="` + ajax_url + `register" > click </a>  here for a premium membership </span>   `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}