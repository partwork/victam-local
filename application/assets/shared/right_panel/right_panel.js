var ajax_url = $('#ajax_url').val();
$(document).ready(function () {
    //promoted video
    $.ajax({
        url: ajax_url + "app/get_promoted_video",
        method: "get",
        dataType: "json",
        success: function (data) {
            var html = '';
            $.each(data, function (i, value) {
				
                let active =  i == 0 ? 'active' : '';
				if(value.vic_promoted_video_url!='')
				{
					html += `
					<div class="carousel-item `+active+` ">
					<iframe width="100%" height="240" src="`+value.vic_promoted_video_url+`" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>`	
				}
				else if(value.vic_promoted_upload_video!=''){
					html += `
					<div class="carousel-item `+active+` ">
					<video class="card-img" controls="" height="240">
						<source src="`+ajax_url+`upload/promoted/`+value.vic_promoted_upload_video+`" type="video/mp4">
					</video>
					</div>`
				}
                
            });

            $("#promotedv").append(html);
        }
    });

    // topRatedEvents
    $.ajax({
        url: ajax_url + "app/get_top_rated_events",
        method: "get",
        dataType: "json",
        success: function (data) {
            console.log('data',data)
            var html = '';
            $.each(data, function (i, value) {
                html += `<div class="p-1">
                <i class="fa fa-star text-danger pl-1 pr-1"></i> <a href="`+ ajax_url + `events/event-details/` + value.idvic_events + `" > <span class="rate-event">` + value.vic_eventtitle + `</span> </a> 
                    </div>`
            });
            $("#topRatedEvents").append(html);
        }
    });
    
    $.ajax({
        url: ajax_url + "app/get_upcoming_events",
        method: "get",
        dataType: "json",
        success: function (data) {
            var html = '';
            $.each(data, function (i, value) {
                html += `<div class="p-1">
            <a href="`+ ajax_url + `events/event-details/` + value.idvic_events + `">
            <i class="fa fa-star text-danger pl-1 pr-1"></i>
                 <span class="rate-event">` + value.vic_eventtitle + `(` + value.vic_date + `)</span></a>
        </div>`
            });
            $("#upcomingEvents5").append(html);
        }
    });
});

function click_handel(text) {
    $('#alertMsg').text(text);
}
getEvents();
function getEvents() {

    var ajax_url = $('#ajax_url').val();
    $.ajax({
        url: ajax_url + "app/get_events_rightside_bar",
        method: "get",
        dataType: "json",
        success: function (data) {
            if (data != null) {
                var str = '';
                $.each(data, function (k, v) {
                    str += `<div class="p-1">
					<a href="`+ ajax_url + `events/event-details/` + v.idvic_events + `" target="_blank">
						<i class="fa fa-star text-danger pl-1 pr-1"></i> 
						<span class="rate-event">`+ v.vic_eventtitle + `</span>
					</a>
				</div> `;
                });
                $("#upcomingEvents").html(str)
            }
        }
    });
}
function involved_click_handel(type, planId, userId) {
    $('#alertMsg').text('');
    switch (type) {
        case 'listCompany':
            if (userId) {
                    let companyUrl = ajax_url + 'who_Is_Who/company-directory';
                    window.location.replace(companyUrl);
            } else {
                let alertMsg = `<span>Only subscribed members have access to the Company Directory.</span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'startForum':
            if (userId) {
                let companyUrl = ajax_url + 'forums';
                window.location.replace(companyUrl);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to our Forums. To start your forum</span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'writeForUs':
            if (userId) {
                let companyUrl = ajax_url + 'write-for-us';
                window.location.replace(companyUrl);
            } else {
                let alertMsg = `<span>Only subscribed members have the access to our resource library. To publish your articles</span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
        case 'advertise':
            if (userId) {
                let companyUrl = ajax_url + 'e/AdvertiseController';
                window.location.replace(companyUrl);
            } else {
                let alertMsg = `<span>Only subscribed members have an access to the contact information for publishing ads or magazines - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
                $("#alertMsg").append(alertMsg);
                $('#myModal').modal('toggle');
            }
            break;
    }
}