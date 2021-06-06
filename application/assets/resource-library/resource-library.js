//when user select sector or refine then the value will stor in this global variable
var ajax_url = $('#ajax_url').val();
var sector_option = '';
var refine_option = '';

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
});
function UrlExists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
$(document).on('click','.p_file',function(e){
	 var path=$(this).attr('data-url')
	 e.preventDefault();  //stop the browser from following
	 
	 if(path==''){
		 
		 return false;
	 }
	if(!UrlExists(path)){
		return false;
	}
	var a = document.createElement('A');
	a.href = path;
	a.download = path;
	document.body.appendChild(a);
	a.click();
	document.body.removeChild(a);
	
})
$(document).on('click', '.view_doc_model', function() {
    var vscr = $(this).data('url');

    $('#doc_iframe').attr('src', vscr);
    $('#doc_model').modal('show');
});
$(document).on('click', '.view-comp-detail', function() {
    var id = $(this).data('id');

    $('.comp-detail-directory').hide()
    $("#comp-detail-directory" + id).show();
    $("#comp-directory").hide();
})
$(document).on('click', '.view-case-detail', function() {
    var id = $(this).data('id')
    $(".case-detail-directory").hide()
    $("#case-detail-directory" + id).show();
    $("#case-directory").hide();
})

$(document).on('click', '.back-to-comp-directory', function() {
    $("#comp-directory").show();
    $('.comp-detail-directory').hide()
})
$(document).on('click', '.back-to-case-directory', function() {
    $("#case-directory").show();
    $(".case-detail-directory").hide()
})
$(document).ready(function() {
    var ajax_url = $('#ajax_url').val();

    $("#comp-detail-directory").hide();

    $("#case-detail-directory").hide();


    $('.more_info').click(function() {
        $('#resource_id').val('').val($(this).data('resid'))
    })

    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');

    $("form#add_resource_frm").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            title: "required",
            description: {
                required: true,
                minlength: 200,
                maxlength: 800,
            },
            industry: 'required',
            publisher: 'required',
            region: 'required',
            date: 'required',
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            },
            prentation_file: {
                required: true,
                extension: "mp3|mpeg|mp4",
                filesize: 50000000,
            },
            doc_file: {
                required: true,
                extension: "docx,doc,rtf,pdf,ppt,pptx",
                filesize: 10000000,
            }
        },
        // Specify validation error messages
        messages: {

            title: "Please Enter Title",
            description: {
                required: "Please Enter Description",
                minlength: "Description should be at least 200 characters",
                maxlength: "Description should be Max. 800 characters",
            },
            industry: 'Please Select Industry',
            publisher: 'Please Enter Publisher',
            region: 'Please Select Region',
            date: 'Please Select Date',
            //   doc_file:'Please Select Document File',
            email: "Please enter a valid email address",
            prentation_file: {
                required: 'Please Select Prentation File',
                extension: "Allowed file extensions: MP4",
                filesize: "File size must be less than 50MB",
            },
            doc_file: {
                required: 'Please Select Document File',
                extension: "Allowed file extensions: PDF, DOCX, PPTX",
                filesize: "File size must be less than 10MB",
            },
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });
    $("form#inov_contact_frm").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            name: "required",
            mobile: "required",
            company: 'required',
            designation: 'required',
            country: 'required',

            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            }
        },
        // Specify validation error messages
        messages: {

            name: "Please Enter Name",
            mobile: "Plase Enter Mobile Number",
            company: 'Please Enter Company Name',
            designation: 'Please Enter Designation/Title',
            country: 'Please Enter Country Name',
            email: "Please enter a valid email address"
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            var url = ajax_url + 'store_source_contact';

            $.ajax({
                url: url,
                type: "POST",
                data: $('#inov_contact_frm').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status == 'success') {
                        // alert(data.message)
                        toastr["success"](data.message);
                        window.location.href = '';
                    } else {
                        toastr["errors"](data.message);
                    }
                }
            });
        }
    });

    $('.doc_btn').click(function() {
        var loc = $(this).data('loc');
        var title = $(this).data('title');

        $('#myModalLabel').text(title)
            //$('#doc_iframe').attr('src','https://view.officeapps.live.com/op/embed.aspx?src='+ajax_url+loc)
        $('#doc_iframe').attr('src', ajax_url + loc)
        $('#doc_model').modal('show');
    })
});

// Upload file
$(document).ready(function() {
    // Image Upload
    const PresentationFileBtn = document.getElementById("upload-Presentation-file");
    const PresentationBtn = document.getElementById("upload-Presentation-button");
    const PresentationTxt = document.getElementById("upload-Presentation-file-name");

    if (PresentationBtn) {
        PresentationBtn.addEventListener("click", function() {
            PresentationFileBtn.click();
        });
    }

    if (PresentationFileBtn) {
        PresentationFileBtn.addEventListener("change", function() {
            if (PresentationFileBtn.value) {
                PresentationTxt.innerHTML = PresentationFileBtn.value.match(
                    /[\/\\]([\w\d\s\.\-\(\)]+)$/
                )[1];
            } else {
                PresentationTxt.innerHTML = "";
            }
        });
    }

    // Video Upload
    const DocumentFileBtn = document.getElementById("upload-Document-file");
    const DocumentBtn = document.getElementById("upload-Document-button");
    const DocumentTxt = document.getElementById("upload-Document-file-name");

    if (DocumentBtn) {
        DocumentBtn.addEventListener("click", function() {
            DocumentFileBtn.click();
        });
    }

    if (DocumentFileBtn) {
        DocumentFileBtn.addEventListener("change", function() {
            if (DocumentFileBtn.value) {
                DocumentTxt.innerHTML = DocumentFileBtn.value.match(
                    /[\/\\]([\w\d\s\.\-\(\)]+)$/
                )[1];
            } else {
                DocumentTxt.innerHTML = "";
            }
        });
    }

    /*data submit by form submit with ajax*/
    /* $('#add_casestudy_frm').submit(function(e){
    	 var url = ajax_url+''
    	$.ajax({
    		   url: url,
    		   type: "POST",
    		   data: $('#form').serialize(),
    		   dataType: "JSON",
    		   success: function(data) {
    			 console.log('adsssssssssssssssss', data)
    			 $('#modal_form').modal('hide');
    			 location.reload(); // for reload a page
    		   },
    		 });
     });*/


    /*$('#inov_contact_frm').submit(function(e){
    	var url = ajax_url+'store_source_contract';
    	e.preventdefault()
    	$.ajax({
    		  url: url,
    		  type: "POST",
    		  data: $('#inov_contact_frm').serialize(),
    		  dataType: "JSON",
    		  success: function(data) {
    		   
    		  }
    	});
    });*/
    $('#Searchme').click(function() {
        var name = $('#filterSearch').val();
        var sector = window.sector_option;
        var refine = window.refine_option;
        var obj = { 'name': name, 'isChar': 'false', 'sector': sector, 'refine': refine, 'char': '' }

        getResourceData(obj)
    })
	$(document).on('keyup change','#filterSearch',function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			var name = $(this).val();
			var sector = window.sector_option;
			var refine = window.refine_option;
			var obj = { 'name': name, 'isChar': 'false', 'sector': sector, 'refine': refine, 'char': '' }

			getResourceData(obj)
		}
	});
    $('#clearfilter').click(function() {
        $('#filter_div').LoadingOverlay("hide");
        $('#filterSearch').val('');
        // $('select').prop('selectedIndex', 0);
        $('#refine-drp-list').val('all');
        $('#sector-drp-list').val('all');
        window.sector_option = '';
        window.refine_option = '';
        $('.ajax_response_div').remove()
        getDefaultList();
    });
    $('#sector-drp-list').change(function() {
        var opt_text = $(this).val();
        var name = $('#filterSearch').val();
        window.sector_option = opt_text;
        var refine = window.refine_option;
        var obj = { 'name': name, 'isChar': 'false', 'sector': opt_text, 'refine': refine, 'char': '' }

        getResourceData(obj)
    });
    $('#refine-drp-list').change(function() {
        var opt_text = $(this).val();
        var name = $('#filterSearch').val();

        var sector = window.sector_option;
        window.refine_option = opt_text;
        var obj = { 'name': name, 'isChar': 'false', 'sector': sector, 'refine': opt_text, 'char': '' }

        getResourceData(obj)
    });
    $('.box').click(function() {
        var name = $('#filterSearch').val();
        var char_text = $(this).text();
        var obj = { name: name, 'char': char_text, 'isChar': 'true', 'sector': window.sector_option, 'refine': window.refine_option }
        getResourceData(obj)
    })

});

function getResourceData(obj) {
    $('#searchError').text('');
    //$('#Searchresult').hide();
    if (obj.char == '' && obj.name == '' && obj.refine == '' && obj.sector == '') {
        // alert('Please Select Filters')
        $('#searchError').text('Please enter keyword');
        return false;
    }
    /*$('#filter_div').LoadingOverlay("show",{
    	background  : "rgba(165, 190, 100, 0.5)"
    });*/
    $.LoadingOverlay('show');
    var not_in_id = $('#not_in').val();
    var page = $('#page_name').val();
    obj['not_id'] = not_in_id;
    obj['page'] = page;

    var detail_div_name = (page == 'case_study') ? 'case-detail-directory' : 'comp-detail-directory';
    var back_div_name = (page == 'case_study') ? 'back-to-case-directory' : 'back-to-comp-directory';
    var view_btn_name = (page == 'case_study') ? 'view-case-detail' : 'view-comp-detail';
    var name = $('#filterSearch').val();
    var type = 'name';
    $.ajax({
        url: ajax_url + "search_resource/",
        type: "POST",
        data: obj,
        dataType: "JSON",
        success: function(data) {
            var html = '';

            $("#Ajaxresult").html('')
                //$('#source_detail_section .ajax_response_div').html('')
            var str = "";
            $.each(data, function(i, value) {
                $('#not_in').val($('#not_in').val() + value.idvic_resource_library + ',');
                html += `<div class="col-sm-12">
                            <button type="button" class="comp-card-wrap p-3 bg-white text-dark ` + view_btn_name + `" data-id="` + value.idvic_resource_library + `">
                                <h5 class="float-left mb-0">` + value.vic_resource_title + `</h5>
                                <span class="float-right">Created Date - ` + value.r_date + `</span>
                                
                            </button>
                        </div>`


                str += `<div class="col-sm-9 mt-4 pb-5 ` + detail_div_name + ` ajax_response_div"  id="` + detail_div_name + value.idvic_resource_library + `" style="display:none;">
					<div class="row">
						<div class="col-sm-12">
							<button type="button" class="btn btn-sm btn-blue ` + back_div_name + ` float-right mb-3 pl-4 pr-4">Back</button>
							<div class="w-100 center-align-lable pos-rel bb-grey bt-grey pt-4 pb-4">
								<h4 class="text-title-small fw-400">` + value.vic_resource_title + `</h4>
								<ul class="social-icons-wrap fs-22">
									<li class="list-inline-item"> <a href="https://www.linkedin.com/company/victam-international-b-v-/" target="_blank">
											<i class="fa fa-linkedin fa-icon-social"></i></a></li>
									<li class="list-inline-item"> <a href="https://www.facebook.com/VictamInt/" target="_blank">
											<i class="fa fa-facebook-square fa-icon-social"></i> </a> </li>
									<li class="list-inline-item"> <a href="https://twitter.com/VictamInt" target="_blank"> <i class="fa fa-twitter fa-icon-social"></i> </a> </li>
								</ul>
							</div>
						</div>

						<div class="col-sm-12 mt-3">
							<p class="company-sub-text-heading">` + value.vic_resource_desc + `</p>

							<p class="text-blue mt-4 mb-0">Publisher : ` + value.vic_resource_publisher + `</p>
							<p class="text-blue">Date : ` + value.r_date + `</p>
						</div>
						<div class="col-sm-12 mt-3">
							<h5 class="text-title-small fw-400 mb-3">Presentation</h5>
							<iframe width="400" height="200" src="` + value.vic_resource_presentation + `" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<div class="col-sm-12 mt-5">
							<button type="button" class="btn btn-blue pl-5 pr-5 more_info" data-resid="` + value.idvic_resource_library + `" data-toggle="modal" data-target="#receiveMoreInfo">Receive More Information</button>
						</div>
					</div>
				</div>`;
            });
            $(str).insertAfter("#" + detail_div_name);
            $('#source_detail_section').append(str)

            html = (html != '') ? html : '<h2 class="text-center mt-5 text-blue data-not-found">Result Not Found</h2>';
            $("#Ajaxresult").append(html);
        }
    });

    //$("#filter_div").LoadingOverlay("hide", true);
    $.LoadingOverlay("hide", true);
}

function getDefaultList() {
    page = $('#page_name').val();
    $.LoadingOverlay('show');

    var detail_div_name = (page == 'case_study') ? 'case-detail-directory' : 'comp-detail-directory';

    var back_div_name = (page == 'case_study') ? 'back-to-case-directory' : 'back-to-comp-directory';
    var view_btn_name = (page == 'case_study') ? 'view-case-detail' : 'view-comp-detail';
    var privew_img = (page == 'case_study') ? 'application/assets/shared/img/research_innovation/casestudy1.png' : 'application/assets/shared/img/research_innovation/research-innovation_1.png';
    $.ajax({
        url: ajax_url + "default_resource_list/",
        type: "POST",
        data: { 'page': page },
        dataType: "JSON",
        success: function(data) {
            var html = '';
            $("#Ajaxresult").html('')
            $('#source_detail_section .ajax_response_div').html('')

            var str = '';
            $.each(data, function(i, value) {
                $('#not_in').val($('#not_in').val() + value.idvic_resource_library + ',');
                html += `<div class="col-sm-12">
                            <button type="button" class="comp-card-wrap p-3 bg-white text-dark ` + view_btn_name + `" data-id="` + value.idvic_resource_library + `">
                                <h5 class="float-left mb-0">` + value.vic_resource_title + `</h5>
                                <span class="float-right">Created Date - ` + value.r_date + `</span>
                                
                            </button>
                        </div>`


                str += `<div class="col-sm-9 mt-4 pb-5 ` + detail_div_name + ` ajax_response_div"  id="` + detail_div_name + value.idvic_resource_library + `" style="display:none;">
					<div class="row">
						<div class="col-sm-12">
							<button type="button" class="btn btn-sm btn-blue ` + back_div_name + ` float-right mb-3 pl-4 pr-4">Back</button>
							<div class="w-100 center-align-lable pos-rel bb-grey bt-grey pt-4 pb-4">
								<h4 class="text-title-small fw-400">` + value.vic_resource_title + `</h4>
								<ul class="social-icons-wrap fs-22">
									<li class="list-inline-item">
                                    <a onclick="shareinsocialmedia('https://www.linkedin.com/company/victam-international-b-v-/')"  target="_blank">
                                        <i class="fa fa-linkedin fa-icon-social"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a onclick="shareinsocialmedia('https://www.facebook.com/VictamInt/')" target="_blank">
											<i class="fa fa-facebook-square fa-icon-social"></i>
										</a>
									</li>
									<li class="list-inline-item">
										<a onclick="shareinsocialmedia('https://twitter.com/VictamInt')" target="_blank"> 
											<i class="fa fa-twitter fa-icon-social"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="col-sm-12 mt-3">
							<p class="company-sub-text-heading">` + value.vic_resource_desc + `</p>

							<p class="text-blue mt-4 mb-0">Publisher : ` + value.vic_resource_publisher + `</p>
							<p class="text-blue">Date : <?php echo date('Y-m-d',strtotime(` + value.vic_resource_date + `));?></p>
						</div>
						<div class="col-sm-12 mt-3">
							<h5 class="text-title-small fw-400 mb-3">Presentation</h5>
							<iframe width="400" height="200" src="` + value.vic_resource_presentation + `" frameborder="0" allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<div class="col-sm-12 mt-5">
							<button type="button" class="btn btn-blue pl-5 pr-5 more_info" data-resid="` + value.idvic_resource_library + `" data-toggle="modal" data-target="#receiveMoreInfo">Receive More Information</button>
						</div>
					</div>
				</div>`;
            });
            $(str).insertAfter("#" + detail_div_name);
            $('#source_detail_section').append(str)
            html = (html != '') ? html : '<h3>Data Not Found</h3>';
            $("#Ajaxresult").append(html);
        }
    });

    $.LoadingOverlay("hide", true);
}

// Dropdown
$(function() {

    $(".sector-drp-list a").click(function() {
        $("#SelectSector span").text($(this).text());
    });
    $(".refine-drp-list a").click(function() {
        $("#SelectRefine span").text($(this).text());
    });
});