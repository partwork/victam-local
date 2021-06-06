var ajax_url = $('#ajax_url').val();
var fb_id = $('#fb_id').val();
$(document).ready(function ($) {
    var country = null;
    var display = null;
    var search = null;

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) 
        {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "Please check your input."
    );

    $("#contact-form").validate({
        rules: {
            cName: "required",
            email: {
                required: true,
                email: true,
            },
            phone: {
                required: true,
                regex: /^[+-]{1}[0-9]{1,3}\-[0-9]{10}$/,
                // phoneUS: true
            },
            // company: "required",
            // designation: "required",
            country: "required",
        },
        messages: {
            cName: "Contact Name required",
            email: {
                required: "Email required",
                email: "Please enter valid mail ID "
            },
            phone: {
                required: "Phone Number required",
                //phoneUS: "Please enter valid phone number"
                regex: "e.g. +91-1234567890"  
            },
            // designation: "Designation required",
            country: "Country required",
        },

        submitHandler: function (form) {
            form.submit();
        },
    });

    $.validator.addMethod("phoneUS", function (phone, element) {
        phone = phone.replace(/\s+/g, "");
        return this.optional(element) || phone.length > 9 &&
            phone.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
    }, "Please specify a valid phone number");

    $("#vacancy-form").validate({
        rules: {
            cName: {
                required: true,
                maxlength: 50,
            },
            sector: "required",
            jobDescription: "required",
            responsibilities: "required",
            skill: "required",
            education: "required",
            country: "required",
            designation: "required",
            location: "required",
            email: {
                required: true,
                email: true,
            },
            // salary: "required"
        },
        messages: {
            cName: {
                required: "Company name required",
                maxlength: "Company name max. length 50 char.",
            }, 
            sector: "Sector required",
            jobDescription: "Job Description required",
            responsibilities: "Responsibilities required",
            skill: "Skills required",
            education: "Education Or Certification required",
            country: "Country required",
            designation: "Position required",
            location: "Location required",
            email: {
                required: "Email required",
                email: "Please enter valid mail ID "
            },
            // salary: "Salary required"
        },

        submitHandler: function (form) {
            form.submit();
        }
    });

    $('#search').change(function () {
        get_vacancies();
    });
    $('#display').change(function () {
        get_vacancies();
    });
    $('#refine').change(function () {
        get_vacancies();
    });

    $(".btn-reset").click(function () {
        $('#search').val('');
        $('#display').val('all');
        $('#refine').val('all');
        get_vacancies();
        // country = null;
        // display = null;
        // search = null;
    });
    $(".btn-react-opportunity").click(function () {
        $("#jobId").val($(this).data('id'));
        $('.designation').html('');
        $('.designation').html($(this).data('name'))

        $('#react').attr("data-id","");
        $('#react').attr("data-name","");
        $('#contact-form')[0].reset();
        $('#reactModal').modal('show');
    });

    $(".btn-react-opportunity1").click(function () {
        $("#jobId").val($('#react').attr('data-id'));
        $('.designation').html('');
        var name = $('#react').attr('data-name');
        $('.designation').html(name);
        $('#contact-form')[0].reset();
        $('#reactModal').modal('show');
    });

    $(".btn-delete-job").click(function () {
        $("#job_id").val($(this).data('id'));
        $('#deleteModal').modal('show');
    });

    $('#delete_job').click(function () {
        var jobID = $("#job_id").val();
        $.ajax({
            url: ajax_url + 'jobs/delete_job',
            type: "POST",
            dataType: "JSON",
            data: { 'jobID': jobID },
            success: function (response) {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });

    $("#manage-jobs").hide();
    // $("#job-details").hide();

    $(".btn-manage").click(function () {
        $("#jobs-list").hide();
        $("#job-details").hide();
        $("#manage-jobs").show();
    });
    $(".btn-back").click(function () {
        $("#jobs-list").show();
        $("#job-details").hide();
        $("#manage-jobs").hide();
    });
    // $(".link-card").click(function(){
    //     $("#jobs-list").hide();
    //     $("#job-details").show();
    //     $("#manage-jobs").hide();
    // });
    $(".active-inactive-btn input:checkbox").click(function () {
        var ischecked = $(this).is(':checked');
        if (!ischecked) {
            var jobID = $('#activeCheck').val();
            var status = 'inactive';
        } else {
            var jobID = $('#inactiveCheck').val();
            var status = 'active';
        }
        $.ajax({
            url: ajax_url + 'jobs/change_status',
            type: "POST",
            dataType: "JSON",
            data: { 'jobID': jobID, 'status': status },
            success: function (response) {
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });
});
$(document).on('keyup change', '#search', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        get_vacancies();
    }
});
function get_vacancies() {

    search = $('#search').val();
    display = $('#display').val();
    country = $('#refine').val();

    // window.location.href = ajax_url+'jobs/vacancy/' + display + '/' + country + '/' + search;
    $.ajax({
        url: ajax_url + "jobs/job-filter",
        type: "POST",
        dataType: "JSON",
        data: { 'search': search, 'display': display, 'country': country },
        success: function (data) {
            var html = '';
            console.log('data', data);
            $("#Ajaxresult").empty();
            if (data.length > 0) {
                $.each(data, function (i, value) {
                    html += `<div class="col-sm-4 pt-3 pb-3">
                                <div class="vacancie-card">
                                    <h6 class="pt-2 pb-1 mb-0 company-name">` + value.vic_company_name + `</h6>
                                    <p class="job-title mb-1" onclick="get_job_details(` + value.idvic_jobs + `)">` + value.vic_jobsdesignation + `</p>
                                    <p class="f-14 mb-2 job-desc">` + value.vic_jobsdescription + `</p>
                                    <div class="pb-1 location-wrap f-14"> <img class="pr-1" src="` + ajax_url + `application/assets/shared/img/icon/noun_Location.png"> Location - ` + value.vic_jobslocation + `</div>
                                    <button class="btn btn-blue mt-2 mb-1 btn-react-opportunity btn-sm" data-toggle="modal" data-id="` + value.idvic_jobs + `" data-name="` + value.vic_jobsdesignation + `">React to the Opportunity</button>
                                </div>
                            </div>`
                });
            } else {
                html += `<h2 class="text-blue text-center" style="margin:auto;">Result Not Found</h2>`;
            }
            $("#Ajaxresult").append(html);
        },
        error: function (jqXHR, textStatus, errorThrown) {

        }
    });
}

function get_job_details(id) {
    var ajax_url = $('#ajax_url').val();
    $.ajax({
        url: ajax_url + "jobs/get_job_info_by_id/" + id,
        type: "GET",
        dataType: "JSON",
        success: function (data) {

            $('#exampleModal').modal('toggle');
            $('#vic_jobsdesignation').html(data['0'].vic_jobsdesignation);
            $('#vic_company_name').html(data['0'].vic_company_name);
            $('#vic_jobsresponsibilties').html(data['0'].vic_jobsresponsibilties);
            $('#vic_jobsdescription').html(data['0'].vic_jobsdescription);

            $('#vic_jobsskills').html(data['0'].vic_jobsskills);
            $('#vic_created_on').html(data['0'].vic_created_on);
            $('#vic_jobssalary').html(data['0'].vic_jobssalary);
            $('#vic_jobslocation').html(data['0'].vic_jobslocation);
            $('#vic_jobscontact').html(data['0'].vic_jobscontact);
            $('#vic_active_industry2').html(data['0'].vic_bn_sector_name);
            $('#vic_jobseducation').html(data['0'].vic_jobseducation);
            $('#react').attr("data-id","");
            $('#react').attr("data-name","");
            $('#react').attr("data-id",id);
            $('#react').attr("data-name",data['0'].vic_jobsdesignation);

            if (data['0'].vic_companylogo) {
                $('#companylogo').attr('src', ajax_url + 'upload/company/' + data['0'].vic_companylogo);
            }

            $('#facebookinfo').attr('href', 'https://www.facebook.com/dialog/share?app_id='+fb_id+'&href=http://dev.victam.com/e/CommonController/get_jobs_by_id/' + data['0'].idvic_jobs + '&display=popup');
            $('#linkedinfo').attr('href', 'https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_jobs_by_id/' + data['0'].idvic_jobs);
            $('#twitterinfo').attr('href', 'https://twitter.com/intent/tweet?text=' + data['0'].vic_jobsdesignation + ' ' + data['0'].vic_jobsdescription + '');
        }
    });
}

function add_jobs_clickHandel(planId, userId, $job_plan) {
    $('#alertMsg').text('');
    if (userId) {
        if (planId == 2 || planId == 3 || $job_plan == 'true') {
            let Url = ajax_url + 'jobs/place-job';
            window.location.replace(Url);
        } else {
            let alertMsg = `
            <div class="mactchmaking-alert">
                        <p class="text-center f-16 fw-400">Only subscribed members have the access to our Jobs page.
                        To post jobs</p>
                        <p class="pl-3 text-left"> Pay As You Go <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/4">Click here</a></p>
                        <p class="pl-3 text-left">  To Upgrade Your Plan <a href="` + ajax_url + `pricing">Click here</a></p>
                        </div>`;
            $("#alertMsg").append(alertMsg);
            $('#myModal').modal('toggle');
        }
    } else {
        let alertMsg = `<span>Only premium members have the access to our Jobs page. To post jobs or apply for vacancies - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}
//   function fbs_click() {
//       u=location.href;
//       t=document.title;
//       window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');
//       return false;
//     }