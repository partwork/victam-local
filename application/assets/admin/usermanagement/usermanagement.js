var idvic = 0;
var ajax_url = $('#ajax_url').val();
var tbl_obj = {};

$('#confirmationBox').modal({
	backdrop: 'static',
	keyboard: false
})
$(document).ready(function () {


	/*tbl_obj=$('#manageUser').DataTable({
		"bPaginate": true,
		"bLengthChange": false,
		"bInfo": false,
		"bFilter": true,
		"bAutoWidth": false,
		"aoColumnDefs": [
			{
			   bSortable: false,
			   aTargets: [ -1, -2 ]
			}
		],
		language: {
			paginate: {
			  next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
			  previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'  
			}
		},
		"stripeClasses": [],
		"orderClasses": false
	});*/
	// Setup datatables

	window.tbl_obj = loadTbl();
	$('.search_input').bind("keyup change", function () {
		window.tbl_obj.draw()

	});
	$('#statusFilter').bind("change", function () {
		window.tbl_obj.draw()

	});
	//$('.dataTables_filter').hide();
	$.validator.addMethod('noemail', function (value) {
		return /^([\w-.]+[\w-]{2,4})?$/.test(value);
	});
	$("#user_form").validate({

		rules: {
			userRole: "required",
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
			contact:
			{
				required: true,
				digits: true
			},
			email: {
				required: true,
				noemail: true,
			},
		},
		messages: {
			userRole: "Please Enter First Name",
			fname: {
				required: "First name required",
				minlength: "First name should be 2 digit",
				maxlength: "First name should be 26 digit",
			},
			lname: {
				required: 'Please Enter Last Name',
				minlength: "First name should be 2 digit",
				maxlength: "First name should be 26 digit",
			},
			contact: {
				required: 'Please Enter Contact No.',
			},
			email: {
				required: "Please enter a username",
				nofreeemail: "Please use your business email"
			}
		},

		submitHandler: function (form) {
			showLoader();
			let vic_id = $('#vicId').val();
			$.ajax({
				type: "POST",
				url: ajax_url + 'admin/add_user',
				data: $('#user_form').serialize(), // serializes the form's elements.
				dataType: 'json',
				success: function (data) {
					hideLoader();
					if(data.mstatus=='success'){
						$('#add-edit-msg').text('');
						$('#confirmationBox').modal({
							backdrop: 'static',
							keyboard: false
						})
						if( vic_id ){
							$('#add-edit-msg').text('User Updated Successfully');
						}else{
							$('#add-edit-msg').text('User Added Successfully');
						}
						$('#confirmationBox').modal('toggle');
					}
					else{
						toastr["error"]('Error : '+data.msg);
					}

					
				},
				error: function (request, status, error) {
					hideLoader();
					var test = $.parseJSON(request.responseText);
					var test2 = $.parseJSON(test);
		
					toastr["error"](test2.msg);
				}
			})
		}
	});


});

function content_id(id) {
	idvic = id;
}

function delete_user() {
	if (idvic) {
		showLoader();

		$.ajax({
			type: "POST",
			url: ajax_url + 'admin/user_delete',
			data: { 'id': idvic }, // serializes the form's elements.
			success: function (data) {
				hideLoader();
				toastr["success"]("Deleted Successfully");
				window.location.href = "";
			},
			error: function (jqXHR, exception) {
				hideLoader();
				toastr["error"]("Failed");
				var msg = '';
				/*if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}*/

			},
		});
	}
}



$(document).on('click', '.status_btn', function () {
	var id = $(this).data('id');
	var status = 'inactive';
	if ($(this).is(':checked')) {
		status = 'active';
	}
	$.ajax({
		type: "POST",
		url: ajax_url + 'admin/user_changestatus',
		data: { 'id': id, 'status': status },
		dataType: 'json',
		success: function (data) {
			toastr["success"](data.msg);
			window.location.href = ""
		}
	});
})

function loadTbl() {

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

    var tbl_obj = $("#manageUser").DataTable({
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
        processing: false,
        serverSide: true,
        "info": false,
        "lengthChange": false,
        "bFilter": false,
		"initComplete": function (oSettings, json) {
			hideLoader();
        },
		"drawCallback": function( settings ) {
			hideLoader();
		},
        ajax: {
            "url": ajax_url + 'admin/get_user_list_json',
            "type": "POST",
            "data": function (d) {
				hideLoader();
                return $.extend({}, d,
                    {
                        "search[value]": $(".search_input").val(),
						"filter_option": $("#statusFilter").val(),
					});
            }
        },
        columns: [
			{
				"data": "vic_user_role",
				"name": "vic_user_role",
			},
			{
				"data": "vic_user_firstname",
				"name": "vic_user_firstname",
			},
			{
				"data": "vic_user_lastname",
				"name": "vic_user_lastname",
			},
			{
				"data": "user_email",
				"name": "user_email",
			},
			{
				"data": "user_mobile",
				"name": "user_mobile",
			},

			{
				"data": "vic_user_status",
				"name": "vic_user_status",
				"render": function (data, type, row) {
					var status = (row.vic_user_status == 'active') ? 'checked' : '';
					var str = `<label class="switch">
							<input data-id="`+ row.iduser_details + `" class="status_btn" type="checkbox" ` + status + `>
							<span class="slider round"></span>
						</label>`;
					return str;
				}
			},
			{
				"render": function (data, type, row) {
					return `<div class="action-btn-wrap">
								<a href="user_edit_page/`+ row.iduser_details + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="#" class="ml-3 user_delete_btn" data-toggle="modal" data-target="#deleteUserModal" onclick="content_id(`+ row.iduser_details + `)" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							</div>`;
				}
			},
		],
        order: [
            [1, 'desc']
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

