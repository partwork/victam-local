$(document).keypress(
    function(event){
      if (event.which == '13') {
        event.preventDefault();
      }
  });

  $(document).ready(function($) {
    $("#userPasswordForm").validate({
        rules: {
            new_password : {
                required: true,
                pwcheck: true,
                minlength: 8
            },
            conf_password: {
                required: true,
            },
        },
        messages: {
            conf_password:{
                required:"confirm password required"
            },
            new_password: {
                required: "Password required",
                pwcheck: "Must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.",
                minlength: "Min 8 length required"
            }
          
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
        var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
        return regex.test(value)
     });
});

$(document).ready(function () {
    var ajax_url = $('#ajax_url').val();
    $('#types').change(function () {
        var country = $(this).find(":selected").val(); 
        let data = {"country": country };
        $.ajax({
            url: ajax_url + "e/ProfileController/get_country_code",
            method: "post",
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.res) {
                    if(data.code){
                        var code = '+'+data.code;
                        $('#country_code').val(code);
                    }else{
                        $('#country_code').val('');
                    }
                }
            }
        });
    });
    $('#country').change(function () {
        var country = $(this).find(":selected").val();
        let data = {"country": country };
        $.ajax({
            url: ajax_url + "e/ProfileController/get_country_code",
            method: "post",
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.res) {
                    if(data.code){
                        var code = '+'+data.code;
                        $('#country_code').val(code);
                    }else{
                        $('#country_code').val('');
                    }
                }
            }
        });
    });

    document.getElementById('userProfileSubmit').disabled = true;
    document.getElementById('fieldOfInterestSubmit').disabled = true;
    document.getElementById('companyNameSubmit').disabled = true;
    document.getElementById('industoryBelogSubmit').disabled = true;
    document.getElementById('answerSubmit').disabled = true;

    var showCompanyBlock = 0;

    $("#userProfileSubmit").click(function () {
        $("ul.form-step-wrap").find("li.active").next("li").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").removeClass("active");
    });

    $("#fieldOfInterestSubmit").click(function () {
        $("ul.form-step-wrap").find("li.active").next("li").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").removeClass("active");
    });

    $("#personalInformationSubmit").click(function () {
        let pContact = $('#pContact').val();
        let fname = $('#fname').val();
        let lname = $('#lname').val();
        if (fname.length >= 2 && fname.length <= 26 && lname.length >= 2 && lname.length <= 26
            && $('#email').val() && $('#country').val() && $('#gender').val()) {
            $('.personal-information-error').text('');
            $('#exampleModal').modal('toggle');
        } else {
            $('.personal-information-error').text('Mandatory fields are required');
        }
    });

    $("#companyDetailsTab").click(function () {
        $("ul.form-step-wrap").find("li.active").next("li").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").removeClass("active");
    });

    $("#companyNameSubmit").click(function () {
        $('#user_iscompany').val('1');
        
    });

    $("#specialitiesSubmit").click(function () {
        $("ul.form-step-wrap").find("li.active").next("li").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").removeClass("active");
    });

    $(".skip-btn").click(function () {
        $("ul.form-step-wrap").find("li.active").next("li").next("li").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").next(".form-wrap").next(".form-wrap").addClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").prev(".form-wrap").removeClass("active");
    });

    $(".back-btn").click(function () {
        $("ul.form-step-wrap").find("li.active").prev("li").addClass("active");
        $('ul.form-step-wrap li.active:last').removeClass("active");
        $(".all-form-wrap").find(".form-wrap.active").prev(".form-wrap").addClass("active");
        $('.all-form-wrap .form-wrap.active:last').removeClass("active");
    });
    $("#userPasswordProfileForm").validate({
        rules: {
            old_password : {
                required: true,
            },
            new_password: {
                required: true,
                pwcheck: true,
                minlength: 8
            },
        },
        messages: {
            old_password:{
                required:"Old password required"
            },
            new_password: {
                required: "Password required",
                pwcheck: "Must contain at least one number and one uppercase and lowercase letter",
                minlength: "Min 8 length required"
            }
            
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
        var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
        return regex.test(value)
     });
    $("#userProfileForm").validate({
        rules: {
            userType: "required",
            interest: "required",
            fname: {
                required: true,
                minlength: 2,
                maxlength: 26,
            },
            lname: {
                required: true,
                minlength: 2,
                maxlength: 26,
            },
            email: {
                required: true,
                email: true,
            },
            // addressOne: "required",
            // city: "required",
            // country: "required",
            gender: "required",
            // zipCode: {
            //     required: true
            // },
            // headquarters: "required",
            companyName: "required",
            industry: "required",
            answerInput: "required",
        },

        messages: {
            userType: "User type required",
            interest: "Interest required",
            fname: {
                required: "First name required",
                minlength: "First name should be 2 characters",
                maxlength: "First name should be 26 characters",
            },
            lname:
            {
                required: "Last name required",
                minlength: "Last name should be 2 characters",
                maxlength: "Last name should be 26 characters",
            },
            email: {
                required: "Email required",
                email: "Please enter valid mail ID "
            },
            addressOne: "Address required",
            city: "City required",
            country: "Country required",
            gender: "Gender required",
            zipCode: {
                required: "ZIP Code required"
            },
            headquarters: "Headquarter required",
            companyName: "Company name required",
            industry: "Industry required",
            answerInput: "required",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    // 
    // $('#PetFood-check').change(function () {
    //     if ($(this).is(":checked")) {
    //         $('#PetFood').addClass('profile-card');
    //     } else {
    //         $('#PetFood').removeClass('profile-card');
    //     }
    // });
    // $('#AquaticFeeds-check').change(function () {
    //     if ($(this).is(":checked")) {
    //         $('#AquaticFeeds').addClass('profile-card');
    //     } else {
    //         $('#AquaticFeeds').removeClass('profile-card');
    //     }
    // });
    // $('#AnimalFeeds-check').change(function () {
    //     if ($(this).is(":checked")) {
    //         $('#AnimalFeeds').addClass('profile-card');
    //     } else {
    //         $('#AnimalFeeds').removeClass('profile-card');
    //     }
    // });
    // $('#GrainandRice-check').change(function () {
    //     if ($(this).is(":checked")) {
    //         $('#GrainandRice').addClass('profile-card');
    //     } else {
    //         $('#GrainandRice').removeClass('profile-card');
    //     }
    // });
    // $('#AnimalHealth-check').change(function () {
    //     if ($(this).is(":checked")) {
    //         $('#AnimalHealth').addClass('profile-card');
    //     } else {
    //         $('#AnimalHealth').removeClass('profile-card');
    //     }
    // });

    $(".company-next").click(function () {
            $(".company-form-wrap").find(".company-forms.active").next(".company-forms").addClass("active");
            $(".company-form-wrap").find(".company-forms.active").prev(".company-forms").removeClass("active");
    });

    $(".industry-next").click(function () {
        if ($('input[type=radio][name=industry]:checked').val() == 'Others') {
            $(".company-form-wrap").find(".company-forms.active").next(".company-forms").addClass("active");
            $(".company-form-wrap").find(".company-forms.active").prev(".company-forms").removeClass("active");
        } else {
            $(".company-form-wrap").find(".company-forms.active").next(".company-forms").next(".company-forms").addClass("active");
            $(".company-form-wrap").find(".company-forms.active").prev(".company-forms").prev(".company-forms").removeClass("active");
        }
    });

    $(".industry-previous").click(function () {
        if ($('input[type=radio][name=industry]:checked').val() == 'Others') {
            $(".company-form-wrap").find(".company-forms.active").prev(".company-forms").addClass("active");
            $(".company-form-wrap").find(".company-forms.active").next(".company-forms").removeClass("active");
        } else {
            $(".company-form-wrap").find(".company-forms.active").prev(".company-forms").prev(".company-forms").addClass("active");
            $(".company-form-wrap").find(".company-forms.active").next(".company-forms").next(".company-forms").removeClass("active");
        }
    });

    $(".company-previous").click(function () {
        $(".company-form-wrap").find(".company-forms.active").prev(".company-forms").addClass("active");
        $(".company-form-wrap").find(".company-forms.active").next(".company-forms").removeClass("active");
    });

    // $("#companyName").on("change company name",function() {
    //     if( $(this).val() ){ document.getElementById('companyNameSubmit').disabled = false;
    //     }else{  document.getElementById('companyNameSubmit').disabled = true; }
    // });
    $("#answerInput").on("change input", function () {
        if ($(this).val()) {
            document.getElementById('answerSubmit').disabled = false;
        } else { document.getElementById('answerSubmit').disabled = true; }
    });

    // $('#country').on('change',function(){
    //     alert( $(this).find(":selected").val() );
    //     var country = $(this).val();
    //     console.log('country',country);
    // });

    

    // 
    $('#skipCompanyDetails').click(function () {

        let userType = $('input[name=userType]').val();
        let interest = $('[name="interest"]:checked').val();
        let fname = $('input[name=fname]').val();
        let lname = $('input[name=lname]').val();
        let email = $('input[name=email]').val();
        let pContact = $('input[name=pContact]').val();
        let addressOne = $('input[name=addressOne]').val();
        let zipCode = $('input[name=zipCode]').val();
        let country = $('#country').val();
        let city = $('#city').val();
        let gender = $('#gender').val();
        let country_code = $('#country_code').val();

        let data = {
            "userType": userType, "interest": interest, "fname": fname, "lname": lname, "email": email, "pContact": pContact, "country": country, "gender": gender,
            "addressOne": addressOne, "zipCode": zipCode, "country_code": country_code, "action": 'profileSetUp', "call": "ajax"
        };
        $.ajax({
            url: ajax_url + "e/ProfileController/profileSetup",
            method: "post",
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.res) {
                    let url = ajax_url + 'pricing'
                    $(location).attr('href', url)
                } else {
                    let url = ajax_url + 'profile'
                    $(location).attr('href', url)
                }
            }
        });
    });

    $(".contact").keydown(function (event) {
        // Allow only backspace and delete
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                event.preventDefault();
            }
        }
    });
    
});

function active_profile_card(profileCard, userId) {
    $('#farmer').removeClass('profile-card');
    $('#ingredient').removeClass('profile-card');
    $('#feedProcessing').removeClass('profile-card');
    $('#grainProcessing').removeClass('profile-card');
    $('#feedProcessingCompanies').removeClass('profile-card');
    $('#selfMixers').removeClass('profile-card');
    $('#flourMillers').removeClass('profile-card');
    $('#serviceCompanies').removeClass('profile-card');
    $('#animalFarmers').removeClass('profile-card');
    $('#foodProducing').removeClass('profile-card');

    $(profileCard).addClass('profile-card');

    if (userId) {
        $(userId).click();
        document.getElementById('userProfileSubmit').disabled = false;
    }
}

function active_interest_card(card, id) {
    var selectedCard = '';
    // switch (card) {
    //     case 'PetFood':
    //         $("#PetFood-check").click();
    //         break;
    //     case 'AquaticFeeds':
    //         $("#AquaticFeeds-check").click();
    //         break;
    //     case 'AnimalFeeds':
    //         $("#AnimalFeeds-check").click();
    //         break;
    //     case 'GrainandRice':
    //         $("#GrainandRice-check").click();
    //         break;
    //     case 'AnimalHealth':
    //         $("#AnimalHealth-check").click();
    //         break;
    // }
    // if (card) {
    //     document.getElementById('fieldOfInterestSubmit').disabled = false;
    // }


    ///////////////////////////
    $('.interest-profile-card').removeClass('profile-card');

    $(card).addClass('profile-card');
    if (id) {
        $(id).click();
        document.getElementById('fieldOfInterestSubmit').disabled = false;
    }
    console.log('card',$('[name="interest"]:checked').val());
}

function active_industry_card(profileCard, industryId) {
    $('#processingTechnology').removeClass('profile-card');
    $('#ingredients').removeClass('profile-card');
    $('#milling').removeClass('profile-card');
    $('#others').removeClass('profile-card');
    $(profileCard).addClass('profile-card');

    if (industryId) {
        $(industryId).click();
        document.getElementById('industoryBelogSubmit').disabled = false;
    }
}

function check_company_size() {
    if ($('#companySize').val()) {
        document.getElementById('companySizeSubmit').disabled = false;
        $('.company-size-error').text('');
    } else {
        document.getElementById('companySizeSubmit').disabled = true;
        $('.company-size-error').text('This field is required');
    }
}

function check_headquarter() {
    if ($('#headquarter').val()) {
        document.getElementById('headquarterSubmit').disabled = false;
        $('.headquarter-error').text('');
    } else {
        document.getElementById('headquarterSubmit').disabled = true;
        $('.headquarter-error').text('This field is required');
    }
}
function check_companyFounded() {
    if ($('#companyFounded').val()) {
        document.getElementById('companyFoundedSubmit').disabled = false;
        $('.company-founded-error').text('');
    } else {
        document.getElementById('companyFoundedSubmit').disabled = true;
        $('.company-founded-error').text('This field is required');
    }
}
function check_specialities() {
    if ($('#specialities').val()) {
        document.getElementById('specialitiesSubmit').disabled = false;
        $('.specialities-error').text('');
    } else {
        document.getElementById('specialitiesSubmit').disabled = true;
        $('.specialities-error').text('This field is required');
    }
}

// Dropdown function
$(function () {
    $(".gender-drp-list a").click(function () {
        $("#SelectGender span").text($(this).text());
    });
    $(".country-drp-list a").click(function () {
        $("#SelectCountry span").text($(this).text());
    });

    // $('#websiteNameSubmit').click(function(){
    //     if (  $('#headquarters').val() && $('#addressOne').val() && $('#city').val() && $('#companyCountry').val() && $('#zipCode').val() ) {
    //             $('.company-address-error').text('');
    //             $('#listCompanyModa').modal('toggle');
    //     } else {
    //         $('.company-address-error').text('Mandatory fields are required');
    //     }
    // });
});

document.addEventListener("keydown", KeyCheck);  //or however you are calling your method
function KeyCheck(event)
{
   var KeyID = event.keyCode;
   switch(KeyID)
   {
      case 8:
        check_company_name();
      case 46:
        check_company_name();
      break;
      default:
      break;
   }
}   

function check_company_name() {
    let length = $("#companyName").val().length;
    var company = $("#companyName").val()+' ';
    if ( length > 2 ) {
        $('#companyError').text('');
        $.ajax({
            url: "e/ProfileController/check_company",
            method: "post",
            data: {'companyName':company},
            dataType: "json",
            success: function (data) {
                $('#companyError').text('');
               if(data.status == 'true'){
                    document.getElementById('companyNameSubmit').disabled = false;
                    $('#companySubmit').addClass('display-none');
                    $('#companyNameSubmit').removeClass('display-none');
                    return 'true';
               }else{
                    $('#companyError').text('This company is already registered on the Victam Portal. Please click on "Submit" to complete the registration.');
                    document.getElementById('companyNameSubmit').disabled = true;
                    $('#companySubmit').removeClass('display-none');
                    $('#companyNameSubmit').addClass('display-none');
                    return 'false';
               }
            }
        });
        // document.getElementById('companyNameSubmit').disabled = false;
    } else { 
        document.getElementById('companyNameSubmit').disabled = true;
        return 'false'; 
    }
    
}