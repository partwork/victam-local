var ajax_url = $('#ajax_url').val();
var idvic = 0;
$(document).ready(function () {

	/*var l_news_tbl=virtualTbl();
	$('#input_search').bind("keyup change", function(){
		l_news_tbl.draw()
    
	});
	
	$('#statusFilter').bind("change", function(){
		l_news_tbl.draw()
	});*/
	$('#statusFilter').change(function () {
		var value = $(this).val()
		var input = $('#input_search').val()
		var obj = {};

		obj.url = ajax_url + 'admin/virtual_search_list';
		obj.input = input;
		obj.drop = value;
		getVirtualList(obj)
	})
	$('#input_search').blur(function () {
		var value = $(this).val()
		var drop = $('#statusFilter').val();
		var obj = {};
		obj.url = ajax_url + 'admin/virtual_search_list';
		obj.input = value;
		obj.drop = drop;
		getVirtualList(obj)
	})
	function getVirtualList(obj) {

		if (obj.input == '' && obj.drop == '') {
			//$('#list_div').show()
			return false;
		}
		$.ajax({
			type: "POST",
			url: obj.url,
			data: obj,
			dataType: 'json',
			success: function (data) {

				if (virtual_design(data)) {
					$('#result_div').html('').html(virtual_design(data))
					$('#list_div').hide()
					$('#result_div').show()
				}
				else {
					$('#list_div').show()
					$('#result_div').html('').hide()
				}

			}
		})
	}
	function virtual_design(data) {
		var str = '';
		$.each(data, function (k, v) {
			var ischecked = '';

			var status_text = 'Inactive';
			if (v.vic_promoted_video_is_active == 'active') {
				var ischecked = 'checked="true"';
				var status_text = 'Active';
			}
			str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
            <div class="interviews-card-wrapper w-100">
                <div class="card">
                    <div class="card-img">
                         <iframe class="card-img" src="`+ v.vic_promoted_video_url + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text text-green-light fs-13 mb-2">`+ v.vic_promoted_video_title + `</p>
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <a href="`+ ajax_url + `admin/edit_videos/` + v.idvic_promoted_video + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                            <a  class="btn btn-card toggle-text "><input type="checkbox"  data-id="`+ v.idvic_promoted_video + `" id="check1" class="mr-2 change_status"  ` + ischecked + `><label for="check" class="m-0 text-blue">` + status_text + `</label></a>
                            <a  class="btn btn-card delete_video" data-id="`+ v.idvic_promoted_video + `"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
		});
		if (str == '') {
			str = false;
		}
		return str;
	}
	var id = $('#event_no').val()
	var required_filed = {
		vname: "required",
		vdesc: "required",
		vfile: "required",
		vdate: "required",

	}


	var required_msg = {
		eventCategory: "Select Category",
		vname: "Enter Video Name",
		vdesc: "Enter Video Description",
		vfile: "Youtube video URL is required",
		vdate: "Select Date",

	}

	$("#add_video").validate({
		rules: required_filed,
		messages: required_msg,

		submitHandler: function (form) {

			var data = new FormData(document.getElementById("add_video"));
			var ajax_url = $('#ajax_url').val();
			showLoader();
			$.ajax({
				type: "POST",
				url: ajax_url + 'admin/add_videos',
				cache: false,
				processData: false,
				contentType: false,
				data: data,
				dataType: 'json',
				//data: $('#user_form').serialize(), // serializes the form's elements.
				success: function (data) {
					hideLoader();
					//toastr["success"](data.status);
					$('#publishvirtaul').modal('show');
				},
				error: function (jqXHR, exception) 
				{
				 hideLoader();
				}
			})
		}
	});


})
$(document).on('click', '.change_status', function () {
	var id = $(this).data('id');
	var ajax_url = $('#ajax_url').val();

	$.ajax({
		type: "POST",
		url: ajax_url + 'admin/change_status_video',

		data: { 'id': id },
		dataType: 'json',
		//data: $('#user_form').serialize(), // serializes the form's elements.
		success: function (data) {
			if (data) {
				toastr["success"](data);
				location.reload(true);
			}

		}
	})
})
// $(document).on('click','.delete_video',function(){
// 	var id=$(this).data('id');
// 	var ajax_url = $('#ajax_url').val();


// })

function content_id(id) {
	idvic = id;
}

function delete_video() {
	if (idvic) {
		$.ajax({
			type: "POST",
			url: ajax_url + 'admin/delete_video',

			data: { 'id': idvic },
			dataType: 'json',
			//data: $('#user_form').serialize(), // serializes the form's elements.
			success: function (data) {
				if (data) {
					toastr["success"]('Video deleted Succesfull');
					window.location.href = "";
				}
				else {
					toastr["error"]('Video deleted Unsuccesfull');
				}

			}
		})
	}
}

function reject_video() {
	if (idvic) {
		$.ajax({
			type: "GET",
			url: ajax_url + 'admin/reject_video/' + idvic,
			cache: false,
			processData: false,
			contentType: false,
			dataType: 'json',
			//data: $('#user_form').serialize(), // serializes the form's elements.
			success: function (data) {
				if (data) {
					toastr["success"]('Event Rejected Succesfull');
					window.location.href=ajax_url+'admin/content-management/virtual-entertainment/video';
				}
				else {
					toastr["error"]('Event Rejected Unsuccesfull');
				}

			}
		})
	}
}
function virtualTbl() {

	$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
		return {
			"iStart": oSettings._iDisplayStart,
			"iEnd": oSettings.fnDisplayEnd(),
			"iLength": oSettings._iDisplayLength,
			"iTotal": oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
			"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		};
	};

	var tbl_obj = $("#virtual").DataTable({
		initComplete: function () {
			var api = this.api();
			$('#myTable_filter input').off('.DT').on('input.DT', function () {
				api.search(this.value).draw();
			});
		},
		oLanguage: {
			sProcessing: "loading..."
		},
		language: {
			paginate: {
				next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
				previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
			}
		},
		"info": false,
		"lengthChange": false,
		"bFilter": false,
		processing: true,
		serverSide: true,
		ajax: {
			"url": ajax_url + 'admin/virtual_json_list',
			"type": "POST",
			"data": function (d) {
				return $.extend({}, d,
					{
						"search[value]": $("#input_search").val(),
						"eventfilter": $("#statusFilter").val(),

					});
			}
			//https://ghsfha.org/datatables_cards.html
		},
		columns: [

			{
				"data": 'vic_promoted_video_title',
				'render': function (data, type, row) {
					var design = section_design(row);

					return design;
				},
				"width": "6vw",
			},

		],
		rowCallback: function (row, data, iDisplayIndex) {
			var info = this.fnPagingInfo();
			var page = info.iPage;
			var length = info.iLength;
			$('td:eq(0)', row).html();
		}

	});
	return tbl_obj;
}
function section_design(obj) {

	var status_text = (obj.vic_promoted_video_is_active == 'active') ? 'Active' : 'Inactive';
	var ischecked = (obj.vic_promoted_video_is_active == 'active') ? 'checked="true"' : '';
	return `<div class="col-sm-12 pl-1 pr-3 mb-3">
            <div class="interviews-card-wrapper w-100">
                <div class="card">
                    <div class="card-img">
                         <iframe class="card-img" src="`+ obj.vic_promoted_video_url + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text text-green-light fs-13 mb-2">`+ obj.vic_promoted_video_title + `</p>
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <a href="`+ ajax_url + `admin/edit_videos/` + obj.idvic_promoted_video + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                            <a  class="btn btn-card toggle-text "><input type="checkbox"  data-id="`+ obj.idvic_promoted_video + `" id="check1" class="mr-2 change_status" ` + ischecked + `><label for="check" class="m-0 text-blue">` + status_text + `</label></a>
                            <a  class="btn btn-card delete_video" data-id="`+ obj.idvic_promoted_video + `"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
}