var ajax_url = $('#ajax_url').val();
$(document).ready(function($) {
    // $("#mrktInfoNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'marketing_info';
    //     $(location).attr('href', url);
    // });
    // $("#vrtulNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'virtual_entertainment';
    //     $(location).attr('href', url);
    // });

    // $("#jobsNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'jobs';
    //     $(location).attr('href', url);
    // });
    // $("#eventsNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'events';
    //     $(location).attr('href', url);
    // });
    // $("#whoiswhoNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'who_Is_Who';
    //     $(location).attr('href', url);
    // });
    // $("#resourceLibraryNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'resource-library';
    //     $(location).attr('href', url);
    // });
    // $("#matchmakingNavbarDrpdnLink").click(function () {
    //     let url = ajax_url + 'match_making';
    //     $(location).attr('href', url);
    // });

    //advertisment
    var req = $('#reqpage').val();
    $.ajax({
        url: ajax_url + "app/get_advertisment_video/" + req,
        method: "get",
        dataType: "json",
        success: function(data) {
            var html = '';
            $.each(data, function(i, value) {
                html += `<a href="` + value.vic_advertisment_ads_url + `" target="_blank"><img class="advertis-img"  src="` + ajax_url + `upload/advertisment/` + value.vic_advertisment_img_path + `" height="200px"></a>`
            });
			
            $("#advertisment-list").append(html);
        }
    });

});

function active_navbar(event) {
    $('.nav-item-home').removeClass('active-main');
    $('.nav-item-market').removeClass('active-main');
    $('.nav-item-who').removeClass('active-main');
    $('.nav-item-resource').removeClass('active-main');
    $('.nav-item-events').removeClass('active-main');
    $('.nav-item-matchmarking').removeClass('active-main');
    $('.nav-item-jobs').removeClass('active-main');
    $('.nav-item-forums').removeClass('active-main');
    $('.nav-item-virtual').removeClass('active-main');
    $(event).addClass('active-main');
}

function search_inputs() {
    $("#searchInput").toggleClass("expandSearchBox");
    var name = document.getElementById("searchInput").value;
    if (name != '') {
        var url = ajax_url + "e/SearchController?q=" + encodeURIComponent(name);
        window.location.href = url;
    } else {
        return false;
    }
}
$(document).on('keyup change','#searchInput',function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13'){
		var name = document.getElementById("searchInput").value;
		if (name != '') {
			var url = ajax_url + "e/SearchController?q=" + encodeURIComponent(name);
			window.location.href = url;
		} else {
			return false;
		}
	}
});
function shareinsocialmedia(url) {
    window.open(url, 'sharein', 'toolbar=0,status=0,width=648,height=395');
    return true;
}

function job_menu_clickHandel(type, planId, userId, $job_plan) {
    $('#alertMsg').text('');
    if (userId) {
        if (planId) {
            if (type == 'placeJob') {
                if (planId == 2 || planId == 3 || $job_plan == 'true') {
                    let companyUrl = ajax_url + 'jobs/place-job';
                    window.location.replace(companyUrl);
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
            } else if (type == 'vacancies') {
                let companyUrl = ajax_url + 'jobs/vacancy';
                window.location.replace(companyUrl);
            }
        } else {
            if (type == 'vacancies') {
                let companyUrl = ajax_url + 'jobs/vacancy';
                window.location.replace(companyUrl);
            } else {
                // let alertMsg = `<span> Only subscribed members have the access to our Jobs page. To post jobs or apply for vacancies - </span>  <a href="` + ajax_url + `pricing" > Upgrade Now </a> `;
                let alertMsg = `
            <div class="mactchmaking-alert">
                        <p class="text-center f-16 fw-400">Only subscribed members have the access to our Jobs page. <br/>To post jobs  </p>
                        <p class="pl-3 text-left"> Pay As You Go <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/4">Click here</a></p>
                        <p class="pl-3 text-left">  To Upgrade Your Plan <a href="` + ajax_url + `pricing">Click here</a></p>
                        </div>`;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
        }
    } else {
        let alertMsg = `<span> Only premium members have the access to our Jobs page. To post jobs or apply for vacancies - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}

function events_menu_click_handel(type, planId, userId) {
    $('#alertMsg').text('');
    if (userId) {
        if (type == 'calender') {
            var eventUrl = ajax_url + 'events/calender-event';
        } else if (type == 'online') {
            var eventUrl = ajax_url + 'events/online-events';
        } else if (type == 'onsite') {
            var eventUrl = ajax_url + 'events/onsite-events';
        }
        window.location.replace(eventUrl);
    } else {
        let alertMsg = `<span>Only subscribed members have the access to the Events page. To publish your events - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}

function resource_menu_clickHandel(type, userId) {
    $('#alertMsg').text('');
    if (userId) {
        if (type == 'research') {
            var url = ajax_url + 'resource-library/research-innovation';
        } else if (type == 'caseStudies') {
            var url = ajax_url + 'resource-library/case-studies';
        } else if (type == 'whitepapers') {
            var url = ajax_url + 'resource-library/white-paper';
        } else if (type == 'publications') {
            var url = ajax_url + 'resource-library/publication';
        }
        window.location.replace(url);
    } else {
        let alertMsg = `<span> Only subscribed members have the access to our resource library. To publish your resources - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}


function directory_clickHandel(planId, userId) {
    $('#alertMsg').text('');
    if (userId) {
        let companyUrl = ajax_url + 'who_Is_Who/company-directory';
        window.location.replace(companyUrl);
        // if (planId) {
        //     let companyUrl = ajax_url + 'who_Is_Who/company-directory';
        //     window.location.replace(companyUrl);
        // } else {
        //     let alertMsg = `<span> Only premium members can browse the online directories by industry, geography, category, or search by company name. If you have not upgraded your plan yet, please </span>  <a href="` + ajax_url + `pricing" > Upgrade Now </a> `;
        //     $("#alertMsg").append(alertMsg);
        //     $('#myModal').modal('toggle');
        // }
    } else {
        let alertMsg = `<span>  Premium members can browse the online directories by industry, geography, category, or search by company name. If you have not subscribed yet, please <a href="` + ajax_url + `register" > click </a>  here for a premium membership </span>   `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}

function match_making_clickHandel(type, planId, userId, $matchmaking_plan) {
    $('#alertMsg').text('');
    $('#buyerMsg').text('');
    if (userId) {
        if (type == 'suppliers') {
            let url = ajax_url + 'matchmaking/find_suppliers';
            window.location.replace(url);
        } else if (type == 'buyers') {
            if (planId == 2 || planId == 3 || $matchmaking_plan == 'true') {
                let url = ajax_url + 'matchmaking/find_buyers';
                window.location.replace(url);
            } else if (planId == 1 || planId == undefined || !planId) {
                let alertMsg = `
                    <div class="mactchmaking-alert pl-4 pr-4">
                    <h6 class="mb-4 text-center fw-600"> Fees to participate to get in contact with potential buyers</h6>
                    <p class="text-left text-red f-16 fw-400">Fee per match: Euro 990 / match</p>
                    <p class="text-left"> Every time there is a match, the supplier receives a notification. To access the lead details suppliers will need to pre-pay for every match- <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/6">Click here</a> </p>
                    <p class="text-left text-red f-16 fw-400">Prepaid number of matches:</p>
                    <p class="pl-3 text-left"> Up to 10 matches – Euro 4900 <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/7">Click here</a></p>
                    <p class="pl-3 text-left">  Up to 25 matches – Euro 8900 <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/8">Click here</a></p>
                    <p class="text-left text-red f-16 fw-400">Fixed Fee: Euro 9900/ year</p>
                    <p class="text-left">Unlimited number of matches for the participation year Click here <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/9">Click here</a>  </p>
                    <p class="text-center fw-600">OR</p>
                    <p class="text-left"> Upgrade your plan to the Market leader for unlimited matches per year <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/3">Click here</a></p>
                    </div>`;
                $("#buyerMsg").append(alertMsg);
                $('#mactchmakingAlert').modal('toggle');
            }
        } else if (type == 'others') {
            let url = ajax_url + 'matchmaking';
            window.location.replace(url);
        }

    } else {
        let alertMsg = `<span>Only subscribed members have the access to the Matchmaking. To find potential buyers or suppliers </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }

}


function match_making_upgrade_planclickHandel(type, planId, userId, $matchmaking_plan) {
    $('#alertMsg').text('');
    $('#buyerMsg').text('');
    if (userId) {
        if (type == 'buyers') {
            let alertMsg = `
                    <div class="mactchmaking-alert pl-4 pr-4">
                    <h6 class="mb-4 text-center fw-600"> Fees to participate to get in contact with potential buyers</h6>
                    <p class="text-left text-red f-16 fw-400">Fee per match: Euro 990 / match</p>
                    <p class="text-left"> Every time there is a match, the supplier receives a notification. To access the lead details suppliers will need to pre-pay for every match- <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/6">Click here</a> </p>
                    <p class="text-left text-red f-16 fw-400">Prepaid number of matches:</p>
                    <p class="pl-3 text-left"> Up to 10 matches – Euro 4900 <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/7">Click here</a></p>
                    <p class="pl-3 text-left">  Up to 25 matches – Euro 8900 <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/8">Click here</a></p>
                    <p class="text-left text-red f-16 fw-400">Fixed Fee: Euro 9900/ year</p>
                    <p class="text-left">Unlimited number of matches for the participation year Click here <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/9">Click here</a>  </p>
                    <p class="text-center fw-600">OR</p>
                    <p class="text-left"> Upgrade your plan to the Market leader for unlimited matches per year <a href="` + ajax_url + `e/PricingController/get_hosted_paymentpage/3">Click here</a></p>
                    </div>`;
            $("#buyerMsg").append(alertMsg);
            $('#mactchmakingAlert').modal('toggle');
        }
    }
}

function mrktIn_menu_clickHandel(type, userId) {
    $('#alertMsg').text('');
    if (userId) {
        let url = ajax_url + type;
        window.location.replace(url);
    } else {
        let alertMsg = `<span>  Only registered members have the access to our Market information. To publish news, articles, or interviews, please register <a href="` + ajax_url + `register" > here </a>.   </span>`;
        $("#alertMsg").append(alertMsg);
        $('#myModal').modal('toggle');
    }
}

function check_login_user(type, userId) {
    $('#alertMsg').text('');
    switch (type) {
        case 'mrkt_info':
            if (userId) {
                let url = ajax_url + 'marketing_info';
                window.location.replace(url);
            } else {
                let alertMsg = `<span> Only subscribed members have the access to our Market information. To publish news, articles, or interviews  <a href="` + ajax_url + `register" > subscribe </a>now   </span>`;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'whoiswho':
            if (userId) {
                let url = ajax_url + 'who_Is_Who';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>  Premium members can browse the online directories by industry, geography, category, or search by company name. If you have not subscribed yet, please <a href="` + ajax_url + `register" > click </a>  here for a premium membership </span>   `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'resourceLibrary':
            if (userId) {
                let url = ajax_url + 'resource-library';
                window.location.replace(url);
            } else {
                let alertMsg = `<span> Only subscribed members have the access to our resource library. To publish your resources - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'events':
            if (userId) {
                let url = ajax_url + 'events';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to the Events page. To publish your events - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'matchmaking':
            if (userId) {
                let url = ajax_url + 'match_making';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to the Matchmaking. To find potential buyers or suppliers </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'jobs':
            if (userId) {
                let url = ajax_url + 'jobs';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>Only premium members have the access to our Jobs page. To post jobs or apply for vacancies - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'forums':
            if (userId) {
                let url = ajax_url + 'forums';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to our Forums. To start a forum </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'entertainment':
            if (userId) {
                let url = ajax_url + 'virtual_entertainment';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to our virtual entertainments. To explore virtual entertainments </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'entertainment_video':
            if (userId) {
                let url = ajax_url + 'video_gallery';
                window.location.replace(url);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to our virtual entertainments. To explore virtual entertainments </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
    }
}