var ajax_url = $('#ajax_url').val();
var idvic = 0;
var quill='';
$.validator.addMethod('filesize', function (value, element, param) {
	return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');



$(document).ready(function () {
	
	/*======================forum table start=====================*/
	var tblobj = fourmtbl();
	$('#search_input').bind("keyup change", function (event) {
		
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
		  tblobj.draw()
		}
	});
	$('#monthFilter').bind("change", function () {
		tblobj.draw()
	});
	$('#yearFilter').bind("change", function () {
		tblobj.draw()
	});
	$('#statusFilter').bind("change", function () {
		tblobj.draw()
	});
	tblobj.on( 'preDraw', function () 
	{
		//showLoader();
	}).on( 'search.dt', function () {
		hideLoader();
	}).on( 'draw.dt', function () {
		hideLoader();
	});
	/*======================forum table end=====================*/
	
	var toolbarOptions = [
        ['bold', 'italic', 'underline'],        // toggled buttons
        ['link','image','video'],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
      ];
      window.quill = new Quill('#editor', {
        modules: {
          toolbar: toolbarOptions
        },
        theme: 'snow'
      });
	$("#forum_frm").validate({
		rules: {
			fname: "required",
			sector: "required",
			response: "required",
		},
		messages: {
			fname: "Enter Forums Name",
			sector: "Enter Sctor",
			response: "Enter Response",
		},

		submitHandler: function (form) {

			var data = new FormData(document.getElementById("forum_frm"));
			var ajax_url = $('#ajax_url').val();
			/*var editor_content = window.quill.container.innerHTML
			data.append('response',editor_content);*/
			showLoader();
			$.ajax({
				type: "POST",
				url: ajax_url + 'admin/add_forums',
				cache: false,
				processData: false,
				contentType: false,
				data: data,
				dataType: 'json',
				//data: $('#user_form').serialize(), // serializes the form's elements.
				success: function (data) {
					hideLoader();
					$('#publishForum').modal('show');
				},
				error: function (jqXHR, exception) 
				{
				 hideLoader();
				}
			})
		}
	});
	
});

// $(document).on('click','.delete_forums',function(){
// 	var id=$(this).data('id');
// 	var ajax_url = $('#ajax_url').val();
// 	$.LoadingOverlay("show");
// 	$.ajax({
// 		url: ajax_url + "admin/delete_forum/"+id,
// 		type: "GET",
// 		data:{'id':id},
// 		dataType: "JSON",
// 		success: function (data) {
// 			$.LoadingOverlay("hide");	
// 			toastr["success"]("Delete Successfully");

// 		 window.location.href="";
// 		}
// 	});
// })
function reject_forum() {
	$.ajax({
		type: "GET",
		url: ajax_url + 'admin/reject_forum/' + idvic,
		cache: false,
		processData: false,
		contentType: false,
		dataType: 'json',
		//data: $('#user_form').serialize(), // serializes the form's elements.
		success: function (data) {
			if (data) {
				toastr["success"]('Rejected Succesfull');
				window.location.href=ajax_url+'admin/content-management/forums/forums';
			}
			else {
				toastr["error"]('Rejected Unsuccesfull');
			}

		}
	})
}
function fourmtbl() {

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

	var tbl_obj = $("#forums").DataTable({
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
		"initComplete": function (oSettings, json) {
			hideLoader();
        },
		"drawCallback": function( settings ) {
			showLoader();
		},
		processing: false,
		serverSide: true,
		ajax: {
			"url": ajax_url + 'admin/get_forum_jsonlist',
			"type": "POST",
			"data": function (d) {
				return $.extend({}, d,
					{
						"search[value]": $("#search_input").val(),
						"eventfilter": $("#statusFilter").val(),
						"monthfilter": $("#monthFilter").val(),
						"yearfilter": $("#yearFilter").val(),
					});
			}
		},
		columns: [
			{
				"data": "vic_forumname",
				"name": "vic_forumname",
				"width": "11vw"
			},
			{
				"data": "vic_created_at",
				"name": "vic_created_at",
				"width": "11vw"
			},

			{
				"data": "vic_forum_modification_dt",
				"name": "vic_forum_modification_dt",
				"width": "8vw",
				'render':function(data,type,row){
					
					if (row.MIN<60 && row.MIN != null) {
						return row.MIN+' Minutes ago';
					}
					if (row.hours<24 && row.MIN>60) 
					{
						return row.hours+' Hours ago';
					}
					if(row.DAY!=0 && row.DAY!=null)
					{
						return  row.DAY+' Days ago';
					}
					else{
						return '';
					}
				}
			},
			{
				"data": "fcount",
				"searchable": false,
				"width": "8vw"
			},

			{
				'render': function (data, type, row) {
					var isPublish = 'empty';
					if (row.vic_modification_status == 'Published') {
						isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
					}
					else if (row.vic_modification_status == 'Under Review') {
						isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
					}
					else {
						isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
					}
					return isPublish;
				},
				"width": "6vw",
			},
			{
				"render": function (data, type, row) {
					return `<div class="action-btn-wrap">
						<a href="`+ ajax_url + `admin/edit_forums/` + row.idvic_forum + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="modal" data-target="#deleteModal" data-id="`+ row.idvic_forum + `" onclick="content_id(`+row.idvic_forum+`)"  class="ml-3 delete_forums"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
				},
				"width": "3vw"
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

function content_id(id) {
	idvic = id;
}

function delete_content() {
	var ajax_url = $('#ajax_url').val();
	if (idvic) {
		var ajax_url = $('#ajax_url').val();
		showLoader();
		$.ajax({
			url: ajax_url + "admin/delete_forum/" + idvic,
			type: "GET",
			data: { 'id': idvic },
			dataType: "JSON",
			success: function (data) {
				hideLoader();
				toastr["success"]("Delete Successfully");

				window.location.href = "";
			}
		});
	} else {
		return false;
	}
}

function preive_forum(){
	
	var name=$('#fname').val();
	var sector=$('#sector').val();
	var response=$('#response').val();
	
	$('#title').text(name);
	$('#p_sector').text(sector);
	$('#desc').text(response);
	$('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
}