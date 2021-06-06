var selectedUPS = 0;
var ajax_url = $('#ajax_url').val();

$(window).scroll(function() {
    var wh = $(window).height() - 50;
    if ($(window).scrollTop() > $('.subscription-text').offset().top - wh) {
        $('.subscription-text').addClass('onScroll');
    }
});

$(document).ready(function() {
    $(".owl-carousel").owlCarousel({
        loop: true,
        items: 4, // Select Item Number
        autoplay: true,
        nav: false,
        dots: true
            // navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
    });

    $("#service_for").change(function() {
        let selectedService = $(this).val();
        $('#multipleSelect').text('');
        if (selectedService == 'Machines') {
            $(".multiple-select-section").removeClass('display-none');
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
        } else if (selectedService == 'Ingredients and Additives') {
            $(".multiple-select-section").removeClass('display-none');
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
        } else if (selectedService == 'Logistics') {
            $(".multiple-select-section").removeClass('display-none');
            $('.selected-service-title').text('Please make a selection for Logistics');
            $('.max-select').text('');
            var multipleSelect = `
            <option value="Control">Control</option>
            <option value="Storage">Storage</option>
            <option value="Transportation">Transportation</option>
            <option value="Maintenance">Maintenance</option>
            <option value="SafetyAndEnvironment">Safety and environment</option>
            <option value="Packaging">Packaging</option>`;
        } else if (selectedService == 'Other') {
            $(".multiple-select-section").removeClass('display-none');
            $('.selected-service-title').text('Please make a selection for Other');
            $('.max-select').text('');
            var multipleSelect = `
            <option value="Automation">Automation</option>
            <option value="FinancialServices">Financial services</option>
            <option value="Cleaning">Cleaning</option>
            <option value="OtherServices">Other services</option>`;
        } else {
            $(".multiple-select-section").addClass('display-none');
        }
        $("#multipleSelect").append(multipleSelect);

    });

});

$(document).ready(function() {
    var ajax_url = $('#ajax_url').val();
    document.getElementById('industriesNext').disabled = true;
    document.getElementById('companyNext').disabled = true;
    document.getElementById('tonsProductionNext').disabled = true;
    document.getElementById('prefCompanyNext').disabled = true;
    document.getElementById('servicesNext').disabled = true;
    document.getElementById('USPNext').disabled = true;
    document.getElementById('deliveringNext').disabled = true;
    document.getElementById('investmentNext').disabled = true;
    document.getElementById('productsServicesNext').disabled = true;

    // Accordian
    $('.accordian-btn').click(function() {
        $(this).find('i').toggleClass('fa fa-angle-down fa fa-angle-up');
    });

    // Step Form
    $(".next-btn").click(function() {
        $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").removeClass("active");
    });
    $(".back-btn").click(function() {
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").addClass("active");
        $('.all-form-wrap .form-wrap.active:last').removeClass("active");
    });

    $(".services-next-btn").click(function() {
        let selectedServiceVal = $('input[type=radio][name=servicesfor]:checked').val();
        if (selectedServiceVal == 'Turnkey projects' || selectedServiceVal == 'Spare parts') {
            $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").next(".form-wrap").addClass("active");
            $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").prev(".form-wrap").removeClass("active");
        } else {
            $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").addClass("active");
            $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").removeClass("active");
        }
    });


    $(".ups-back-btn").click(function() {
        let selectedServiceVal = $('input[type=radio][name=servicesfor]:checked').val();
        if (selectedServiceVal == 'Turnkey projects' || selectedServiceVal == 'Spare parts') {
            $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").prev(".form-wrap").addClass("active");
            $('.all-form-wrap .form-wrap.active:last').removeClass("active");
        } else {
            $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").addClass("active");
            $('.all-form-wrap .form-wrap.active:last').removeClass("active");
        }
    });

    // 
    $('#customMade').change(function() {
        if ($(this).is(":checked")) {
            $('.custom-made').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.custom-made').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });
    $('#allSpecs').change(function() {
        if ($(this).is(":checked")) {
            $('.all-specs').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.all-specs').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });
    $('#deliveryTime').change(function() {
        if ($(this).is(":checked")) {
            $('.delivery-time').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.delivery-time').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });
    $('#priceQuality').change(function() {
        if ($(this).is(":checked")) {
            $('.price-quality').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.price-quality').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });
    $('#payment').change(function() {
        if ($(this).is(":checked")) {
            $('.payment').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.payment').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });
    $('#integrat').change(function() {
        if ($(this).is(":checked")) {
            $('.integrat').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.integrat').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });
    $('#installation').change(function() {
        if ($(this).is(":checked")) {
            $('.installation').addClass('profile-card');
            selectedUPS = selectedUPS + 1;
        } else {
            $('.installation').removeClass('profile-card');
            selectedUPS = selectedUPS - 1;
        }
    });

    $('#animalFeed').change(function() {
        if ($(this).is(":checked")) {
            $('.animal-feed').addClass('profile-card');
        } else {
            $('.animal-feed').removeClass('profile-card');
        }
    });

    $('#aquaFeed').change(function() {
        if ($(this).is(":checked")) {
            $('.aqua-feed').addClass('profile-card');
        } else {
            $('.aqua-feed').removeClass('profile-card');
        }
    });

    $('#petFood').change(function() {
        if ($(this).is(":checked")) {
            $('.pet-food').addClass('profile-card');
        } else {
            $('.pet-food').removeClass('profile-card');
        }
    });
    $('#grainRice').change(function() {
        if ($(this).is(":checked")) {
            $('.grain-rice').addClass('profile-card');
        } else {
            $('.grain-rice').removeClass('profile-card');
        }
    });
    $('#biomass').change(function() {
        if ($(this).is(":checked")) {
            $('.biomass').addClass('profile-card');
        } else {
            $('.biomass').removeClass('profile-card');
        }
    });

    // 
    $('#tonsOne').change(function() {
        if ($(this).is(":checked")) {
            $('.tons-one').addClass('profile-card');
        } else {
            $('.tons-one').removeClass('profile-card');
        }
    });
    $('#tonsOne').change(function() {
        if ($(this).is(":checked")) {
            $('.tons-one').addClass('profile-card');
        } else {
            $('.tons-one').removeClass('profile-card');
        }
    });

    $('#tonsTwo').change(function() {
        if ($(this).is(":checked")) {
            $('.tons-two').addClass('profile-card');
        } else {
            $('.tons-two').removeClass('profile-card');
        }
    });

    $('#tonsThree').change(function() {
        if ($(this).is(":checked")) {
            $('.tons-three').addClass('profile-card');
        } else {
            $('.tons-three').removeClass('profile-card');
        }
    });

    $('#tonsFour').change(function() {
        if ($(this).is(":checked")) {
            $('.tons-four').addClass('profile-card');
        } else {
            $('.tons-four').removeClass('profile-card');
        }
    });




    $('#multipleSelect').change(function() {
        let value = $('#multipleSelect').val();
        if (value.length > 0) {
            document.getElementById('productsServicesNext').disabled = false;
        } else {
            document.getElementById('productsServicesNext').disabled = true;
        }
    });
});

// Multi selelction
$(document).ready(function() {
    $('.js-ProductsServices-basic-multi').select2({
        maximumSelectionLength: 4
    });

    $('#finishquestions').click(function() {
        var ProductsServices = [];
        var importantups = [];
        var tonscount = [];
        var industriesactive = [];
        $('.industriesactive:checked').each(function() {
            industriesactive.push($(this).val());
        });
        $('.capacity:checked').each(function() {
            tonscount.push($(this).val());
        });
        var companyprofile = $('input[name=companyprofile]:checked').val();
        var companydealwith = $('input[name=companydealwith]:checked').val();
        var servicesfor = $('input[name=servicesfor]:checked').val();
        $('#multipleSelect :selected').each(function() {
            ProductsServices[$(this).val()] = $(this).text();
        });
        $('.importantups:checked').each(function() {
            importantups.push($(this).val());
        });
        var companies = $('input[name="companies"]:checked').val();
        var investmentmonth = $('input[name=investmentmonth]:checked').val();
        var additionalInfo = $('#additionalInfo').val();

        $.ajax({
            url: "find_new_suppliers",
            method: "post",
            data: { "industriesactive": industriesactive, "companyprofile": companyprofile, "tonscount": tonscount, "companydealwith": companydealwith, "servicesfor": servicesfor, "ProductsServices": ProductsServices, "importantups": importantups, "companies": companies, "investmentmonths": investmentmonth, "comments": additionalInfo },
            dataType: "json",
            success: function(data) {
                hideLoader();
                $('#supplierText').text('');
                if (data.count == 0) {
                    var alertMsg = `<span>
                    <p class="mb-0">Sorry! No Matching Records Found.</p>
                    <p class="mb-0">Please try later. Thank you for your patience.</p>
                    </span> `;
                } else {
                    var alertMsg = `<span>
                    <h3 class="text-red f-14">Congratulations!</h3>
                    <p class="mb-0">We have found ` + data.count + ` matches based on your interest.</p>
                    <p class="mb-0">Suppliers will contact you soon.</p>
                    <p class="mb-0">Thank you for your patience</p>
                    </span> `;
                }
                $("#supplierText").append(alertMsg);
                $('#congrats').modal('toggle');
            },
            error: function(jqXHR, exception) {
                hideLoader();
            }
        });
    });



    $('#finishquestionsbuyers').click(function() {
        var ProductsServices = [];
        var importantups = [];
        var industriesactive = [];
        var tonscount = [];
        $('.industriesactive:checked').each(function() {
            industriesactive.push($(this).val());
        });
        $('.capacity:checked').each(function() {
            tonscount.push($(this).val());
        });

        var companyprofile = $('input[name=companyprofile]:checked').val();
        var companydealwith = $('input[name=companydealwith]:checked').val();
        var servicesfor = $('input[name=servicesfor]:checked').val();
        $('#multipleSelect :selected').each(function() {
            ProductsServices[$(this).val()] = $(this).text();
        });
        $('.importantups:checked').each(function() {
            importantups.push($(this).val());
        });
        var companies = $('input[name="companies"]:checked').val();

        var investmentmonth = $('input[name=investmentmonth]:checked').val();
        var additionalInfo = $('#additionalInfo').val();
        showLoader();
        $.ajax({
            url: "find_new_buyers",
            method: "post",
            data: { "industriesactive": industriesactive, "companyprofile": companyprofile, "tonscount": tonscount, "companydealwith": companydealwith, "servicesfor": servicesfor, "ProductsServices": ProductsServices, "importantups": importantups, "companies": companies, "investmentmonth": investmentmonth, "comments": additionalInfo },
            dataType: "json",
            success: function(data) {
                hideLoader();
                $('#buyersText').text('');
                if (data.count == 0) {
                    var alertMsg = `<span>
                    <p class="mb-0">Sorry! No Matching Records Found.</p>
                    <p class="mb-0">Please try later. Thank you for your patience.</p>
                    </span> `;
                } else {
                    var alertMsg = `<span>
                    <h4 class="text-red f-14">Congratulations!</h4>
                    <p class="mb-0">We have found ` + data.count + ` matches based on your interest.</p>
                    <p class="mb-0">Thanks for your patience</p>
                    </span> `;
                }
                $("#buyersText").append(alertMsg);
                $('#congrats').modal('toggle');

            },
            error: function(jqXHR, exception) {
                hideLoader();
            }
        });
    });
});

function active_industrie_card(industrieCard, id) {
    // $('.industrie-card').removeClass('profile-card');
    // $(industrieCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (industrieCard) { document.getElementById('industriesNext').disabled = false; }
}

function active_company_card(companyCard, id) {
    $('.company-card').removeClass('profile-card');
    $(companyCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (companyCard) { document.getElementById('companyNext').disabled = false; }
}

function active_production_card(productionCard, id) {
    // $('.production-card').removeClass('profile-card');
    // $(productionCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (productionCard) { document.getElementById('tonsProductionNext').disabled = false; }
}

function active_pref_company_card(prefCompanyCard, id) {
    $('.preferred-company-card').removeClass('profile-card');
    $(prefCompanyCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (prefCompanyCard) { document.getElementById('prefCompanyNext').disabled = false; }
}

function active_service_card(serviceCard, id) {
    $('.service-card').removeClass('profile-card');
    $(serviceCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (serviceCard) { document.getElementById('servicesNext').disabled = false; }

    let selectedService = $('input[type=radio][name=servicesfor]:checked').val();
    $('#multipleSelect').text('');
    if (selectedService == 'Machines') {
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
    } else if (selectedService == 'Ingredients and Additives') {
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
    } else if (selectedService == 'Logistics') {
        $('.selected-service-title').text('Please make a selection for Logistics');
        $('.max-select').text('');
        var multipleSelect = `
        <option value="Control">Control</option>
        <option value="Storage">Storage</option>
        <option value="Transportation">Transportation</option>
        <option value="Maintenance">Maintenance</option>
        <option value="SafetyAndEnvironment">Safety and environment</option>
        <option value="Packaging">Packaging</option>`;
    } else if (selectedService == 'Other') {
        $('.selected-service-title').text('Please make a selection for Other');
        $('.max-select').text('');
        var multipleSelect = `
        <option value="Automation">Automation</option>
        <option value="FinancialServices">Financial services</option>
        <option value="Cleaning">Cleaning</option>
        <option value="OtherServices">Other services</option>`;
    }





    $("#multipleSelect").append(multipleSelect);

    // 

}

function active_companies_del_card(companyCard, id) {
    $('.companies-del-card').removeClass('profile-card');
    $(companyCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (companyCard) { document.getElementById('deliveringNext').disabled = false; }
}

function active_investment_card(investmentCard, id) {
    $('.investment-card').removeClass('profile-card');
    $(investmentCard).addClass('profile-card');
    if (id) { $(id).click(); }
    if (investmentCard) { document.getElementById('investmentNext').disabled = false; }
}

function active_usp_card(card) {
    switch (card) {
        case 'uspCard':
            if ($('#customMade').is(":checked")) {
                $("#customMade").click();
            } else {
                if (selectedUPS < 3) { $("#customMade").click(); }
            }
            break;
        case 'allSpecs':
            if ($('#allSpecs').is(":checked")) {
                $("#allSpecs").click();
            } else {
                if (selectedUPS < 3) { $("#allSpecs").click(); }
            }
            break;
        case 'deliveryTime':
            if ($('#deliveryTime').is(":checked")) {
                $("#deliveryTime").click();
            } else {
                if (selectedUPS < 3) { $("#deliveryTime").click(); }
            }
            break;
        case 'priceQuality':
            if ($('#priceQuality').is(":checked")) {
                $("#priceQuality").click();
            } else {
                if (selectedUPS < 3) { $("#priceQuality").click(); }
            }
            break;
        case 'payment':
            if ($('#payment').is(":checked")) {
                $("#payment").click();
            } else {
                if (selectedUPS < 3) { $("#payment").click(); }
            }
            break;
        case 'integrat':
            if ($('#integrat').is(":checked")) {
                $("#integrat").click();
            } else {
                if (selectedUPS < 3) { $("#integrat").click(); }
            }
            break;
        case 'installation':
            if ($('#installation').is(":checked")) {
                $("#installation").click();
            } else {
                if (selectedUPS < 3) { $("#installation").click(); }
            }
            break;
    }
    if (card) {
        document.getElementById('USPNext').disabled = false;
    }
    // }
}

$(document).ready(function() {
    var ajax_url = $('#ajax_url').val();
    var ind = $('#ind').val();
    var profile = $('#profile').val();
    var position = $('#position').val();
    var service = $('#service').val();
    var tonscount = $('#tonscount').val();
    var importantups = $('#importantups').val();
    var companies = $('#companies').val();
    var investmentmonth = $('#investmentmonth').val();

    $('#Services').val(service);

    if (ind) {
        $.ajax({
            url: ajax_url + "matchmaking/get_buyers_list",
            type: "POST",
            dataType: "JSON",
            data: { "industriesactive": ind, "companyprofile": profile, "tonscount": tonscount, "companydealwith": position, "servicesfor": service, "importantups": importantups, "companies": companies, "investmentmonth": investmentmonth },
            success: function(data) {
                var html = '';
                $("#Ajaxresult").empty();
                if (!$.trim(data)) {
                    html = `Sorry! No Matching Records Found.
                    You will be notified once we find an exact match according to the shared preferences.`;
                } else {
                    $.each(data, function(i, value) {
                        html += `<div class="col-sm-3">
                                        <div class="comp-card-wrap">
                                            <div class="buyers-image" style="background: url(` + ajax_url + `upload/company/` + value.vic_companylogo + `);"></div>
                                            <div class="buyer-info-wrap text-left">
                                                <h6 class="text-title-small">` + value.vic_companyname + `</h6>
                                                <p class="mb-1 text-ellipses" title="` + value.vic_industry_sector + `"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400">` + value.vic_industry_sector + `</span></p>
                                                <p class="mb-1 text-ellipses" title="` + value.vic_country_name + `"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400">` + value.vic_country_name + `</span></p>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_details(` + value.idvic_company + `)">Show more</button>
                                        </div>
                                    </div>`;
                    });
                }

                $("#Ajaxresult").append(html);
            }
        });
    } else {
        get_all_buyer_list();
    }
    $('#resetFilter').click(function() {
        get_all_buyer_list();
    });
    $('.filter').on('change', function() {
        var ind = $('#industry').val();
        var profile = $('#target_group').val();
        var companydealwith = $('#companydealwith').val();
        var service = $('#service_for').val();
        var tonscount = $('#tonscount_year').val();
        var importantUSP = $('#importantUSP').val();
        var deliveringCountry = $('#deliveringCountry').val();

        $("#Ajaxresult").empty();
        showLoader();
        $.ajax({
            url: "filter_buyers_list",
            method: "post",
            data: { "industriesactive": ind, "companyprofile": profile, "tonscount": tonscount, "companydealwith": companydealwith, "servicesfor": service, "importantUSP": importantUSP, "deliveringCountry": deliveringCountry },
            dataType: "json",
            success: function(data) {
                
                var html = '';
                if(data.status=="false"){
                    window.location.href = ajax_url;
                }
                else if(!$.trim(data)) {
                    html = `Sorry! No Matching Records Found.
                    You will be notified once we find an exact match according to the shared preferences.`;
                } else {
                    $.each(data, function(i, value) {
                        html += `<div class="col-sm-3">
                                        <div class="comp-card-wrap">
                                            <div class="buyers-image" style="background: url(` + ajax_url + `upload/company/` + value.vic_companylogo + `);"></div>
                                            <div class="buyer-info-wrap text-left">
                                                <h6 class="text-title-small">` + value.vic_companyname + `</h6>
                                                <p class="mb-1 text-ellipses" title="` + value.vic_industry_sector + `"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400">` + value.vic_industry_sector + `</span></p>
                                                <p class="mb-1 text-ellipses" title="` + value.vic_country_name + `"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400">` + value.vic_country_name + `</span></p>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_details(` + value.idvic_company + `)">Show more</button>
                                        </div>
                                    </div>`;
                    });
                }

                $("#Ajaxresult").append(html);
                hideLoader();
            },
            error : function(data){
                hideLoader();
            }
        });
    });
    $('#searchbyme').click(function() {
        var filterSearch = $('#filterSearch').val();
        search(filterSearch);
    });
    $(document).on('keyup change','.mr-inf-search',function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            var keyword=$(this).val().trim();
            search(keyword);
        }
    });
});
function search(filterSearch){
    showLoader();
    $.ajax({
        url: ajax_url + "matchmaking/get_buyers_list_by_search/" + filterSearch,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            var html = '';
            
            $("#Ajaxresult").empty();
            if(data.status=="false"){
                window.location.href = ajax_url;
            }
            else if(!$.trim(data)) {
                html = `Sorry! No Matching Records Found.`;
            }
            else{
                $.each(data, function(i, value) {
                    html += `<div class="col-sm-3">
                                    <div class="comp-card-wrap">
                                        <div class="buyers-image" style="background: url(` + ajax_url + `upload/company/` + value.vic_companylogo + `);"></div>
                                        <div class="buyer-info-wrap text-left">
                                            <h6 class="text-title-small">` + value.vic_companyname + `</h6>
                                            <p class="mb-1 text-ellipses" title="` + value.vic_industry_sector + `"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400">` + value.vic_industry_sector + `</span></p>
                                            <p class="mb-1 text-ellipses" title="` + value.vic_country_name + `"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400">` + value.vic_country_name + `</span></p>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_details(` + value.idvic_company + `)">Show more</button>
                                    </div>
                                </div>`;
                });
            }
            $("#Ajaxresult").append(html);
            hideLoader();
        },
        error : function(data){
            hideLoader();
        }
    });
}
function get_all_buyer_list() {
    furl = ajax_url + "matchmaking/get_buyers_list_all/";
    $.ajax({
        url: furl,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            var html = '';

            $("#Ajaxresult").empty();
            if (!$.trim(data)) {
                html = `Sorry! No Matching Records Found.
                    You will be notified once we find an exact match according to the shared preferences.`;
            } else {
                $.each(data, function(i, value) {
                    html += `<div class="col-sm-3">
                                        <div class="comp-card-wrap">
                                            <div class="buyers-image" style="background: url(` + ajax_url + `upload/company/` + value.vic_companylogo + `);"></div>
                                            <div class="buyer-info-wrap text-left">
                                                <h6 class="text-title-small">` + value.vic_companyname + `</h6>
                                                <p class="mb-1 text-ellipses" title="` + value.vic_industry_sector + `"><span class="f-14 fw-500">Sectors</span>: <span class="f-14 fw-400">` + value.vic_industry_sector + `</span></p>
                                                <p class="mb-1 text-ellipses" title="` + value.vic_country_name + `"><span class="f-14 fw-500">Country</span>: <span class="f-14 fw-400">` + value.vic_country_name + `</span></p>
                                            </div>
                                            <button type="button" class="btn btn-sm btn-blue view-comp-detail" onclick="get_details(` + value.idvic_company + `)">Show more</button>
                                        </div>
                                    </div>`;
                });
            }

            $("#Ajaxresult").append(html);
            //reset filter
            $('.filter').val('');
        },
        error: function(jqXHR, exception) {

        }
    });
}

function get_details(id) {
    var ajax_url = $('#ajax_url').val();
    $.ajax({
        url: ajax_url + "matchmaking/get_company_details/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            $('#comp-info').modal('toggle');
            $('#cname').html(data['0'].vic_companyname);
            $('#Specialities').html(data['0'].vic_specialities);
            $('#Sector').html(data['0'].vic_industry_sector);
            $('#Email').html(data['0'].vic_companyemail);
        }
    });
}