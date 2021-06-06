var ajax_url = $('#ajax_url').val();
var quill='';
$(document).ready(function () {
    $(".function-drp-list a").click(function () {
        $("#SelectFunction span").text($(this).text());
    });
	
	  /*window.quill = new Quill('#editor', {
		modules: {
		  toolbar: toolbarOptions
		},
		theme: 'snow'
	  });*/
	  
	$("form#addForumForm").validate({
		rules: {
		  forumName: "required",
		  sector: "required",
		  forumDescription:'required',
		  
		},
		messages: {
		  forumName: "Please Enter Forum Name",
		  sector: "Please Select Sector",
		  forumDescription:'Please Enter Forum Description'
		},
		submitHandler: function(form) {
		  var data = new FormData(document.getElementById("addForumForm"));
		  
		  /*var editor_content = window.quill.container.innerHTML
		  data.append('forumDescription',editor_content);*/
			showLoader();
			$.ajax({
				type: "POST",
				url: ajax_url + 'store_forum',
				cache: false,
				processData: false,
				contentType: false,
				data: data,
				dataType: 'json',
				success: function (data) 
				{
					hideLoader();
				   if(data.status='success'){
					toastr["success"](data.msg);   
					window.location.href=ajax_url+'forums';
				   }
				   else{
					   toastr["error"](data.msg);   
				   }
					
				},
				error: function (jqXHR, exception) 
				{
				 hideLoader();
				}
			})
		}
	  });	


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
	 
	 
});
$(document).on('click','.send_comment',function(){
	var id=$(this).data('id');
	var comment=$('#comment_input'+id).val();
	var obj={'url':ajax_url+'send_comment','id':id,'comment':comment}
	sendComment(obj);
})

$(document).on('click','.like_event',function(){
	
	var like_obj=$(this).data('obj');
	
	 var caseTxt='';
	 var btn_img_elem='#like_btn_img'+like_obj.id;
	 var total_count='#like_'+like_obj.id;
	 
	 var like_img='';
		 switch (like_obj.status) 
		 {
		  case 'default':
			caseTxt = "like";
			like_img=like_obj.blueimg;
			break;		
		  case 'like':
			caseTxt = "unlike";
			like_img=like_obj.defaultimg;
		   break;
		  
		}
		
	 obj={
		 'id':like_obj.id,
		 'status':caseTxt,
		 'url':ajax_url+'like_event',
		 'like_tblid':like_obj.liktblid,
		 'eventfrom':'like',
		 'btn_img':btn_img_elem,
		 'total_elem':total_count,
		 'like_img_path':like_img,
		 'like_lbl':'like_'+like_obj.id,
		 'unlike_lbl':'unlike_'+like_obj.id,
		 
	 }
	 
	 var result= like_dislike_event(obj);
	
	if(result){
		if(caseTxt=='like')
			$(this).attr('src',like_obj.blueimg)
			
		if(caseTxt=='unlike')
			
			$(this).attr('src',like_obj.defaultimg)
	}
	
	var strobj=JSON.stringify(obj)
	$(this).attr('data-obj',obj)
	
})
$(document).on('click','.search_btn',function(){
	var input_val=$('#search_input').val();
	var sector=$('#sector_dropdown').val();
	var obj={'url':ajax_url+'search_forums','title':input_val,'sector':sector}
	search_data(obj)
})
$(document).on('change','#sector_dropdown',function(){
	var input_val=$('#search_input').val();
	var sector=$(this).val();
	var obj={'url':ajax_url+'search_forums','title':input_val,'sector':sector}
	search_data(obj)
})
$(document).on('keyup change','#search_input',function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13') {
	  var input_val=$(this).val();
	  var sector=$('#sector_dropdown').val();
	  var obj={'url':ajax_url+'search_forums','title':input_val,'sector':sector}
	  search_data(obj)
	}
});
$(document).on('click','.unlike_event',function(){
	
	var like_obj=$(this).data('obj');
	 var like_status='';
	 var btn_img_elem='#dislike_btn_img'+like_obj.id;
	 var total_count='#unlike_'+like_obj.id;
	 var unlike_img='';
	 var caseTxt='';
	 
		 switch (like_obj.status) 
		 {
		  case 'dislike':
			caseTxt = "undislike";
			$(this).attr('src',like_obj.defaultimg);
			unlike_img=like_obj.blueimg;
			break;
		  case 'default':
			caseTxt = "dislike";
			$(this).attr('src',like_obj.blueimg);
			unlike_img=like_obj.defaultimg;
			break;
		 
		}
	
	 obj={
		 'id':like_obj.id,
		 'status':caseTxt,
		 'url':ajax_url+'like_event',
		 'like_tblid':like_obj.liktblid,
		 'eventfrom':'dislike',
		 'btn_img':btn_img_elem,
		 'total_elem':total_count,
		 'like_img_path':unlike_img,
		 'like_lbl':'like_'+like_obj.id,
		 'unlike_lbl':'unlike_'+like_obj.id,
		 
	 }
	var result=like_dislike_event(obj);
	
})

$(document).on('click','.res_like_event',function(){
	var like_obj=$(this).data('obj');
	 var like_status='';
	 var caseTxt='';
	 var btn_img_elem='#res_like_img'+like_obj.id
	 var total_elem='#like_count'+like_obj.id;
	 var like_img='';
		 switch (like_obj.status) 
		 {
		  case 'like':
			caseTxt = "dislike";
			$(this).attr('src',like_obj.defaultimg)
			like_img=like_obj.defaultimg
			break;
		  case 'default':
			caseTxt = "like";
			$(this).attr('src',like_obj.blueimg)
			like_img=like_obj.blueimg
			break;
		 
		}
	
	 obj={
		 'id':like_obj.id,
		 'status':caseTxt,
		 'url':ajax_url+'res_like_event',
		 'like_tblid':like_obj.liktblid,
		 'eventfrom':'like',
		 'forum':like_obj.forum,
		 'btn_img':btn_img_elem,
		 'total_elem':total_elem,
		 'like_img_path':like_img,
		 'like_lbl':'res_like_count'+like_obj.id,
		 'unlike_lbl':'res_unlike_count'+like_obj.id,
		 
	 }
	var result=like_dislike_event(obj);
	
})
$(document).on('click','.res_dislike_event',function(){
	
	var dis_like_obj=$(this).data('obj');
	
	 var like_status='';
	 var caseTxt='';
	 var btn_img_elem='#res_dislike_img'+dis_like_obj.id;
	 var total_count='#unlike_count'+dis_like_obj.id;
	 var like_img='';
		 switch (dis_like_obj.status) 
		 {
		  case 'dislike':
			caseTxt = "undislike";
			$(this).attr('src',dis_like_obj.defaultimg)
			like_img=dis_like_obj.defaultimg
			break;
		  case 'default':
			caseTxt = "dislike";
			$(this).attr('src',dis_like_obj.blueimg)
			like_img=dis_like_obj.blueimg
			break;
		 
		}
	
	 obj={
		 'id':dis_like_obj.id,
		 'status':caseTxt,
		 'url':ajax_url+'res_like_event',
		 'like_tblid':dis_like_obj.liktblid,
		 'eventfrom':'dislike',
		 'forum':dis_like_obj.forum,
		 'btn_img':btn_img_elem,
		 'total_elem':total_count,
		 'like_img_path':like_img,
		 'like_lbl':'res_like_count'+dis_like_obj.id,
		 'unlike_lbl':'res_unlike_count'+dis_like_obj.id,
		 
	 }
	var result=like_dislike_event(obj);
	
})

$(document).on('click','.comm_loadmore',function(){
	var id=$(this).data('id');
	var tcomment=$(this).data('totalcomment');
	var offset=parseInt($(this).data('offset'));
	var limit=parseInt($(this).data('limit'));
	var notin=$('#notin'+id).val();
	
	var obj={'id':id,'offset':offset+1,'limit':limit,'url':ajax_url+'load_comments','notin':notin};
	
	if(tcomment!='0'){
		var res=LoadComment(obj);
		$('#loadmore_btn'+id).data('offset',offset*2);
		if(res!=''){
			$(this).attr('data-offset',offset*2)
		}
		
	}
	else{
		$('#err_msg'+id).html('').append('<h5 class="text-center mt-5 text-blue">No more comments<h5>')
		return false;
	}
})
 function like_dislike_event(obj){
	$.LoadingOverlay("show");
	var rest='false';
	 $.ajax({
	   type: "POST",
	   async:true,
	   url:obj.url,
	   data:obj,	
	   dataType:'html',
	   success: function(data)
	   {
		   $('#lik_dislike_div'+obj.id).replaceWith(data)
		   $.LoadingOverlay("hide",true); 
	   }
	 });
	 $.LoadingOverlay("hide",true); 
	 return rest
}
function sendComment(obj){
	if(obj.comment==''){
		alert('Please Enter Comment')
		return false;
	}
	$.LoadingOverlay("show");
	$.ajax({
	   type: "POST",
	   async:true,
	   url:obj.url,
	   data:obj,	
	   dataType:'html',
	   success: function(data)
	   {
		  //$('#main_like_div'+obj.id).html(data)
		  $('#forum_section'+obj.id).replaceWith(data);
		  $('#collapseExample'+obj.id).collapse("show");
	   }
	 });
	$.LoadingOverlay("hide",true); 
}
function LoadComment(obj){
	
	$('#loadMoreComment'+obj.id).LoadingOverlay("show");
	var response=[];
	$.ajax({
	   type: "POST",
	   async:true,
	   url:obj.url,
	   data:obj,	
	   dataType:'html',
	   success: function(data)
	   {
		   
		   $(data).insertBefore('#loadmore_btn'+obj.id)
		   response=data;
		   if(data!='')
		   {
			 $('#notin'+obj.id).remove()  
		   }
		   else
		   {
			   $('#err_msg'+obj.id).html('').append('<h5 class="ml-5 mt-5 text-blue">No more comments<h5>')
		   }
	   }
	 });
	$('#loadMoreComment'+obj.id).LoadingOverlay("hide",true); 
	return response;
}
function search_data(obj){
	$.LoadingOverlay("show");
	$.ajax({
	   type: "POST",
	   async:true,
	   url:obj.url,
	   data:obj,	
	   success: function(data)
	   {
		  $('#list_result').html(data) 
	   }
	 });
	 $.LoadingOverlay("hide",true);
}
function new_forum_click_handel(userId){
	$('#alertMsg').text('');
	if (userId) {
		let companyUrl = ajax_url + 'forums/new-forum';
		window.location.replace(companyUrl);
	} else {
		let alertMsg = `<span>Only subscribed members have the access to our Forums. To start a forum - </span>  <a href="` + ajax_url + `register" > Subscribe Now </a> `;
		$("#alertMsg").append(alertMsg);
		$('#myModal').modal('toggle');
	}
}
function changeFlat(data) {
	
}
$(document).on('click','.social_share',function(){
	var platform=$(this).data('platform');
	var title=$(this).data('title');
	var description=$(this).data('desc');

	if(platform=='linkedin'){
	  	shareinsocialmedia('http://www.linkedin.com/shareArticle?mini=true&url='+title+'&title='+description);		
	}
	if(platform=='twitter'){
		shareinsocialmedia('http://twitter.com/home?status='+title+'&title='+description);			
	}

})
