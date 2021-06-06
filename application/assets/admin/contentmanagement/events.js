var ajax_url = $('#ajax_url').val();
var idvic = 0;
$.validator.addMethod('filesize', function (value, element, param) {
	return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');


$(document).ready(function () {
	$("#date").datepicker({
		minDate: '0d',
		dateFormat:'yy-mm-dd'
	});
	$("#eventFrom").datepicker({ 
        minDate: '0d',
        onSelect: function(selected) {
            $("#eventTo").datepicker("option","minDate", selected);
            $("#date").datepicker("option","minDate", selected);
        }
    });
    $("#eventTo").datepicker({ 
        minDate: '0d',
        onSelect: function(selected) {
            $("#eventFrom").datepicker("option","maxDate", selected)
            $("#date").datepicker("option","maxDate", selected)
        }
    });
	var id = $('#event_no').val();
	var cat=$('input[name="eventCategory"]:checked').val();

	var required_filed = {
		eventType: "required",
		organizer: "required",
		evn_name: "required",
		sector: "required",
		title: {
            required: true,
            maxlength: 50,
        },
		date: "required",
		eventFrom: "required",
		eventTo: "required",
		evn_url: {
			required: function (element) {
				if(cat=='Online')
				return true;
				else false;
			},
			url: true
		},
		registrationURL: {
			required: function (element) {
				if(cat=='Online')
				return true;
				else false;
			},
			url: true
		},
		evn_venue : {
			required: function (element) {
				if(cat=='Onsite')
				return true;
				else false;
			}
		},
		uploadLogo: {
			required: function (element) {
				if(id)	return false; else true;
			},
			extension: "jpg,jpeg,png",
			filesize: 5000000,
		},
		"uploadBanners[]": {
			required: function (element) {
				if(id)	return false; else true;
			},
			extension: "jpg,jpeg,png",
			filesize: 5000000,
		},
		"uploadAdvertisement[]": {
			required: function (element) {
				if(id)	return false; else true;
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
				if(id)	return false; else true;
			},
			extension: "jpg,jpeg,png",
			filesize: 5000000,
		},
		"uploadVideo[]": {
			required: function (element) {
				if(id)	return false; else true;
			},
			extension: "mp3|mpeg|mp4",
			filesize: 50000000,
		},
	}


	var repeatType = $('#repeatType').val();
	var user_type= $('#user_type').val();

	if (user_type=='3' && user_type==''){
		if(cat=='Online')
		{
		  
		}
		else
		{
		  
		}
		
	}
	else{
		if(cat=='Online')
		{
		  required_filed.eventCategory='required';
		}
		else
		{
		  required_filed.venue='required';
		}
		// required_filed.registrationURL='required';
		// required_filed.evn_url='required';
		required_filed.evn_desc='required';
		required_filed.eventTime='required';
	}
	 
		required_filed.frequency='required';
	    //required_filed.evn_venue='required';
		required_filed.eventCategory='required';
		// required_filed.registrationURL='required';
		// required_filed.evn_url='required';
		required_filed.evn_desc='required';
		required_filed.eventTime='required';
	
	$("#add_events").validate({
		rules: required_filed,
		messages: {

			eventCategory: "Select Category",
			eventType: "Select Type",
			organizer: "Enter Organizer",
			evn_name: "Enter Event Name",
			sector: "Select Sector",
			title: {
                required:"Enter Event Name",
                maxlength: "Event name max. length required 50 char."
            },
			date: "Select Date",
			frequency: "Select Repeat",
			eventFrom: "Select From Date",
			eventTo: "Select To Date",
			eventTime: "Enter Event Time",
			evn_desc: "Enter Description",
			evn_url: {
                required: "Website URL required",
                url : "Please enter valid URL",
            },
			registrationURL: {
                required: "Registration URL required",
                url : "Please enter valid URL",
            },
			evn_venue: "required",
			evn_date: "Select Event Date",
			uploadLogo: { required: 'Upload Logo', extension: "Allow Only jpg,jpeg,png extension", filesize: 'File size must be less than 5MB' },
			'uploadBanners[]': { required: 'Upload Banner', extension: "Allow Only jpg,jpeg,png extension", filesize: 'File size must be less than 5MB' },
			'uploadAdvertisement[]': { required: 'Upload Advertisement', extension: "Allow Only jpg,jpeg,png extension", filesize: 'File size must be less than 5MB' },
			'uploadPhotos[]': { required: 'Upload Photos', extension: "Allow Only jpg,jpeg,png extension", filesize: 'File size must be less than 5MB' },
			'uploadVideo[]': { required: 'Upload Video', extension: "Allow Only mov,mpeg,mp3,avi,mp4 extension", filesize: 'File size must be less than 50MB' },
			'uploadReport[]': { required: 'Upload Report', extension: "Allow Only doc,ppt,docx,xls,xlsx,pdf extension", filesize: 'File size must be less than 5MB' }
		},

		submitHandler: function (form) {

			var data = new FormData(document.getElementById("add_events"));
			var ajax_url = $('#ajax_url').val();
			showLoader();
			$.ajax({
				type: "POST",
				url: ajax_url + 'admin/add_new_events',
				cache: false,
				processData: false,
				contentType: false,
				data: data,
				dataType: 'json',
				//data: $('#user_form').serialize(), // serializes the form's elements.
				success: function (data)
				{	
					hideLoader();
					//toastr["success"](data.status);
					if (data.status=='success') {
					  $('#publish').modal('show');
					  $('#add_events')[0].reset();
					  //window.location.href=ajax_url+'admin/contentmanagement/events/events';
					}
					else
					{
						toastr["error"](data.msg);
					}
					
				},
				error: function (jqXHR, exception) 
				{
					console.log(jqXHR)
				  toastr["error"](jqXHR.responseText);		
				  hideLoader();
				}
			})
		}
	});

	$('input[type=radio][name=eventCategory]').change(function () {
		if (this.value == 'Online') {
			$(".onsite-events").addClass('display-none');
			$(".online-events").removeClass('display-none');
		}
		else if (this.value == 'Onsite') {
			$(".online-events").addClass('display-none');
			$(".onsite-events").removeClass('display-none');
		}
	});


	// $('#repeatType').change(function () {
	//     let repeatType = $('#repeatType').val();
	//     if (repeatType === 'Custom') {
	//         $('#eventTo').prop("disabled", false);
	//         $('#eventFrom').prop("disabled", false);
	//     } else {
	//         $('#eventTo').val('00/00/0000').attr('disabled', 'disabled');
	//         $('#eventFrom').val('00/00/0000').attr('disabled', 'disabled');
	//     }
	// });

	$('#date').change(function () {
		$('#eventFrom').val($('#date').val());
	});

	$('input[type=radio][name=eventCategory]').change(function () {
		if (this.value == 'Online') {
			$(".onsite-events").addClass('display-none');
			$(".online-events").removeClass('display-none');
		}
		else if (this.value == 'Onsite') {
			$(".online-events").addClass('display-none');
			$(".onsite-events").removeClass('display-none');
		}
	});

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
			);
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
			);
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
			);
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
			);
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
			);
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
			);
		} else {
			videoTxt.innerHTML = "";
		}
	});

});

// $(document).on('click', '.delete_event', function () {
// 	var id = $(this).data('id');
// 	var ajax_url = $('#ajax_url').val();

// 	$.ajax({
// 		type: "POST",
// 		url: ajax_url + 'admin/delete_event',
// 		data: { 'id': id },
// 		dataType: 'json',
// 		//data: $('#user_form').serialize(), // serializes the form's elements.
// 		success: function (data) {
// 			if (data) {
// 				toastr["success"]('Event Deleted Succesfull');
// 				window.location.href = "";
// 			}
// 			else {
// 				toastr["error"]('Event Deleted Unsuccesfull');
// 			}

// 		}
// 	})

// })

function content_id(id) {
    idvic = id;
}

function reject_event() {
	if(idvic){
		$.ajax({
			type: "GET",
			url: ajax_url + 'admin/reject_event/' + idvic,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			//data: $('#user_form').serialize(), // serializes the form's elements.
			success: function (data) {
				if (data) {
					toastr["success"]('Event Rejected Succesfull');
					window.location.href=ajax_url+'admin/contentmanagement/events/events';
				}
				else {
					toastr["error"]('Event Rejected Unsuccesfull');
				}
	
			}
		})
	}
}

function delete_event(){
	var ajax_url = $('#ajax_url').val();
	$.ajax({
		type: "POST",
		url: ajax_url + 'admin/delete_event',
		data: { 'id': idvic },
		dataType: 'json',
		//data: $('#user_form').serialize(), // serializes the form's elements.
		success: function (data) {
			if (data) {
				toastr["success"]('Event Deleted Succesfull');
				location.reload();
			}
			else {
				toastr["error"]('Event Deleted Unsuccesfull');
			}

		}
	})
}