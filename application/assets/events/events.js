
$(window).scroll(function () {
    var wh = $(window).height() - 50;
    if ($(window).scrollTop() > $('.subscription-text').offset().top - wh) {
        $('.subscription-text').addClass('onScroll');
    }
});

$(document).ready(function () {

    var ajax_url = $('#ajax_url').val();
    $("#fromDate").datepicker({ 
        minDate: '0d',
        onSelect: function(selected) {
            $("#toDate").datepicker("option","minDate", selected);
            $("#date").val(selected)
        }
    });
    $("#toDate").datepicker({ 
        minDate: '0d',
        onSelect: function(selected) {
            $("#fromDate").datepicker("option","maxDate", selected)
            $("#date").datepicker("option","maxDate", selected)
        }
    });
    $("#date").datepicker({ minDate: '0d' });

    // $(".owl-carousel").owlCarousel({
    //     loop: true,
    //     items: 4, // Select Item Number
    //     autoplay: true,
    //     nav: false,
    //     dots: true
    //     // navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
    // });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    var events = [];

    $("#addEventForm").validate({
        rules: {
            eventType: "required",
            organizer: "required",
            cName: "required",
            title: {
                required: true,
                //maxlength: 50
            },
            fromDate: "required",
            toDate: "required",
            description: {
                required: function (element) {
                    return ( $('#userPlan').val() == 2 || $('#userPlan').val() == 3 );
                },
            },
            eventTime:{
                required: function (element) {
                    return ( $('#userPlan').val() == 2 || $('#userPlan').val() == 3 );
                },
            },
            venue: {
                required: function (element) {
                    return ($('input[type=radio][name=eventCategory]:checked').val() == "Onsite" && ($('#userPlan').val() == 3 || $('#userPlan').val() == 2));
                }
            },
            date: "required",
            registrationURL: {
                required: function (element) {
                    return ($('input[type=radio][name=eventCategory]:checked').val() == "Online" && ($('#userPlan').val() == 3 || $('#userPlan').val() == 2));
                },
                url: true
            },
            websiteURL: {
                required: function (element) {
                    if($('#userPlan').val() == 2 || $('#userPlan').val() == 3)
                    return true;
                    else false;
                },
                url: true
            },
            uploadLogo: {
                required: function (element) {
                    if($('#userPlan').val() == 2 || $('#userPlan').val() == 3)
                    return true;
                    else false;
                },
                extension: "jpg,jpeg,png",
                filesize: 5000000,
            },
            "uploadBanners[]": {
                required: function (element) {
                    if($('#userPlan').val() == 2 || $('#userPlan').val() == 3)
                    return true;
                    else false;
                },
                extension: "jpg,jpeg,png",
                filesize: 5000000,
            },
            "uploadAdvertisement[]": {
                required: function (element) {
                    if($('#userPlan').val() == 2 || $('#userPlan').val() == 3)
                    return true;
                    else false;
                },
                extension: "jpg,jpeg,png",
                filesize: 5000000,
            },
            "uploadReport[]": {
                extension: "docx,doc,pdf,pptx",
                filesize: 10000000,
            },
            "uploadPhotos[]": {
                required: function (element) {
                    if($('#userPlan').val() == 2 || $('#userPlan').val() == 3)
                    return true;
                    else false;
                },
                extension: "jpg,jpeg,png",
                filesize: 5000000,
            },
            "uploadVideo[]": {
                required: function (element) {
                    if($('#userPlan').val() == 2 || $('#userPlan').val() == 3)
                    return true;
                    else false;
                },
                extension: "mp3|mpeg|mp4",
                filesize: 50000000,
            },
        },
        messages: {
            eventType: "Event type required",
            organizer: "Organizer required",
            cName: "Organizer name required",
            title: {
                required: "Event required",
                maxlength: "Event name max. length required 50 char."
            },
            fromDate: { required: "To date required" },
            toDate: { required: "Form date required" },
            description: "Event description required",
            url: "URL required",
            venue: "Venue required",
            date: "Date required",
            registrationURL: {
                required: "registration URL required",
                url : "Please enter valid URL",
            },
            websiteURL: {
                required: "Website URL required",
                url : "Please enter valid URL",
            },
            uploadLogo: {
                required: "Logo required",
                extension: "Allowed file extensions: PNG, JPEG",
                filesize: "File size must be less than 5MB",
            },
            "uploadBanners[]": {
                required: "Banners required",
                extension: "Allowed file extensions: PNG, JPEG",
                filesize: "File size must be less than 5MB",
            },
            "uploadAdvertisement[]": {
                required: "Advertisement required",
                extension: "Allowed file extensions: PNG, JPEG",
                filesize: "File size must be less than 5MB",
            },
            "uploadReport[]": {
                extension: "Allowed file extensions: PDF, DOCX, PPTX",
                filesize: "File size must be less than 10MB",
            },
            "uploadPhotos[]": {
                required: "Photo required",
                extension: "Allowed file extensions: PNG, JPEG",
                filesize: "File size must be less than 5MB",
            },
            "uploadVideo[]": {
                required: "Video required",
                extension: "Allowed file extensions: MP4",
                filesize: "File size must be less than 50MB",
            },
            sector: "Sectors required",
            frequency: "Repeat required",
            eventTime: "Time required"
        },

        submitHandler: function (form) {
            // alert('dgh');
            form.submit();
        }
    });


    $.ajax({
        url: ajax_url + "events/get_events_date",
        type: "GET",
        success: function (data) {
            let result = data;
            let array = [];

            var obj = $.parseJSON(data);
            $.each(obj, function (k, v) { array = v; })
            array.forEach(element => {
                let eventDate = {
                    startDate: new Date(element.vic_eventstartdate).toDateString(),
                    endDate: new Date(element.vic_eventenddate).toISOString(),
                }
                events.push(eventDate);
            });
            $("#container").simpleCalendar({
                fixedStartDay: 0, // begin weeks by sunday
                disableEmptyDetails: true,
                events: events
            });

        },
        error: function (error) {
            console.log('error', error);
        }
    });

    // $('.ongoing-event-title').click(function () {
    //     $(".event-calender").addClass('display-none');
    //     $(".single-event-details").removeClass('display-none');
    // });

    $('.btn-back-event').click(function () {
        var Url = ajax_url + 'events/calender-event';
        window.location.replace(Url);
    });

    // $('#repeatType').change(function () {
    //     let repeatType = $('#repeatType').val();
    //     if (repeatType === 'Custom') {
    //         $('#fromDate').prop("disabled", false);
    //         $('#toDate').prop("disabled", false);
    //     } else {
    //         $('#fromDate').attr('disabled', 'disabled');
    //         $('#toDate').attr('disabled', 'disabled');
    //     }
    // });

    $('#date').change(function () {
        $('#fromDate').val($('#date').val());
    });

    $('input[type=radio][name=eventCategory]').change(function () {
        $('#eventType').val('');
        if (this.value == 'Online') {
            $(".onsite-events").addClass('display-none');
            $(".online-events").removeClass('display-none');
        }
        else if (this.value == 'Onsite') {
            $(".online-events").addClass('display-none');
            $(".onsite-events").removeClass('display-none');
        }
    });
});

$(document).ready(function () {
    // $(".owl-carousel").owlCarousel({
    //     loop: true,
    //     items: 4, // Select Item Number
    //     autoplay: true,
    //     nav: false,
    //     dots: true
    //     // navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
    // });

    $(".owl-carousel-events2").owlCarousel({
        loop: false,
        items: 6, // Select Item Number
        autoplay: false,
        nav: true,
        dots: false,
        navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
    });

    // Accordian
    // $('.event-calender-info').click(function () {
    //     $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
    // });

    $('#sector').change(function () {
        filter_events();
    });

    $('#search1').click(function () {
        filter_events();
    });

    $('#event_type').change(function () {
        filter_events();
    });
});

$(document).on('keyup change','#search',function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13') {
	  filter_events();
	}
});
function filter_events() {
    var sector = $('#sector').val();
    var search = $('#search').val();
    var type = $('#event_type').val();

    var date = $('.selectedEvent').attr('data-date');
    $.LoadingOverlay("show");
    $.ajax({
        url: ajax_url + "events-filter",
        type: "POST",
        dataType: "JSON",
        data: { 'sector': sector, 'search': search, 'type': type, 'date': date },
        success: function(data) {
            $("#accordion").empty();
            if(data){
                $("#accordion").append(data);
            }else{
                $("#accordion").append(`<h2 class="text-blue text-center" style="margin:auto;">Result Not Found</h2>`);
            }
           
            $.LoadingOverlay("hide", true);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $.LoadingOverlay("hide", true);
        }
    });
}

$(document).ready(function () {
    // File Upload

    // Logo Upload
    const logoFileBtn = document.getElementById("upload-logo-file");
    const logoBtn = document.getElementById("upload-logo-btn");
    const logoTxt = document.getElementById("upload-logo-file-name");

    logoBtn.addEventListener("click", function () {
        logoFileBtn.click();
    });

    logoFileBtn.addEventListener("change", function () {
        if (logoFileBtn.value) {
            logoTxt.innerHTML = logoFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            logoTxt.innerHTML = "";
        }
    });
    // Banner Upload
    const bannerFileBtn = document.getElementById("upload-banner-file");
    const bannerBtn = document.getElementById("upload-banner-btn");
    const bannerTxt = document.getElementById("upload-banner-file-name");

    bannerBtn.addEventListener("click", function () {
        bannerFileBtn.click();
    });

    bannerFileBtn.addEventListener("change", function () {
        if (bannerFileBtn.value) {
            bannerTxt.innerHTML = bannerFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            bannerTxt.innerHTML = "";
        }
    });
    // Advertisement Upload
    const advertisementFileBtn = document.getElementById("upload-advertisement-file");
    const advertisementBtn = document.getElementById("upload-advertisement-btn");
    const advertisementTxt = document.getElementById("upload-advertisement-file-name");

    advertisementBtn.addEventListener("click", function () {
        advertisementFileBtn.click();
    });

    advertisementFileBtn.addEventListener("change", function () {
        if (advertisementFileBtn.value) {
            advertisementTxt.innerHTML = advertisementFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            advertisementTxt.innerHTML = "";
        }
    });
    // Conclusion Report Upload
    const reportFileBtn = document.getElementById("upload-report-file");
    const reportBtn = document.getElementById("upload-report-btn");
    const reportTxt = document.getElementById("upload-report-file-name");

    reportBtn.addEventListener("click", function () {
        reportFileBtn.click();
    });

    reportFileBtn.addEventListener("change", function () {
        if (reportFileBtn.value) {
            reportTxt.innerHTML = reportFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            reportTxt.innerHTML = "";
        }
    });
    // Photos Upload
    const photosFileBtn = document.getElementById("upload-photos-file");
    const photosBtn = document.getElementById("upload-photos-btn");
    const photosTxt = document.getElementById("upload-photos-file-name");

    photosBtn.addEventListener("click", function () {
        photosFileBtn.click();
    });

    photosFileBtn.addEventListener("change", function () {
        if (photosFileBtn.value) {
            photosTxt.innerHTML = photosFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            photosTxt.innerHTML = "";
        }
    });
    // Video Upload
    const videoFileBtn = document.getElementById("upload-video-file");
    const videoBtn = document.getElementById("upload-video-btn");
    const videoTxt = document.getElementById("upload-video-file-name");

    videoBtn.addEventListener("click", function () {
        videoFileBtn.click();
    });

    videoFileBtn.addEventListener("change", function () {
        if (videoFileBtn.value) {
            videoTxt.innerHTML = videoFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            videoTxt.innerHTML = "";
        }
    });
});

function get_event_list_by_date(date) {
    var ajax_url = $('#ajax_url').val();
    var sector = $('#sector').val();
    var search = $('#search').val();
    var type = $('#event_type').val();
    $.LoadingOverlay("show");

    $.ajax({
        type: "post",
        url: ajax_url + 'events/geteventby_date',
        data: { 'date': date,'sector': sector, 'search': search, 'type': type  },
        dataType: 'json',
        success: function (data) {
            $('#accordion').html(data);
            $.LoadingOverlay("hide", true);
        },
        error: function(data){
            $.LoadingOverlay("hide", true);
        }
    });
    
}
function update_registration_count(url,id){
    $.ajax({
        type: "post",
        url: ajax_url + 'events/update_registration_count',
        data: { 'event_id': id},
        dataType: 'json',
        success: function (data) {
            
        },
        error: function(data){
           
        }
    });
    window.open(url, '_blank');

}
