
var ajax_url = $('#ajax_url').val();
var industry_text='';
$(document).ready(function () {
    $(".function-drp-list a").click(function () {
        $("#SelectFunction span").text($(this).text());
        $("#SelectFunction span").removeClass("selected-option");
    });
    $("#SelectFunction").click(function () {
        $(".drop-down-arrow").addClass('rotateimg180');
        $("#SelectFunction span").removeClass("selected-option");
    });
    $(".function-drp-list .dropdown-item").click(function () {
        $(".drop-down-arrow").removeClass('rotateimg180');
        $("#SelectFunction span").removeClass("selected-option");
    });

    $('#industry_drop').on('change', function () {
        window.industry_text=$(this).val();
        var page='interview';
        var keyword=$('.mr-inf-search').val().trim(); 
        var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+$(this).val();
        var obj={url:url}
        getBlogdata(obj)
     })
});
$(document).on('keyup change','.mr-inf-search',function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13') {
		var page='interview';
		var keyword=$(this).val().trim();
		
		var publisher_drop_text='';
		publisher_drop_text=(typeof window.industry_text==undefined)? '' :window.industry_text;
		var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&publisher='+publisher_drop_text;
		var obj={url:url}
		getBlogdata(obj)
	}
});
$(document).on("click",".mr_inf_sarch_btn",function() {
    var page=$(this).data('page');
	var keyword=$('.mr-inf-search').val().trim();
	if(keyword==''){
		alert('Please Enter Value');
		return false;
	}
	var industry_text='';
	industry_text=(typeof window.industry_text==undefined)? '' :window.industry_text;
	var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+industry_text
	var obj={url:url}
    getBlogdata(obj)
});
function getBlogdata(obj){
	//var obj={'page':page,'keyword':keyword};
	
	var keyword=$('.mr-inf-search').val();
	var industry=$('#industry_drop').val();
	var page='interview';
	
	
	obj.industry=industry;
	obj.keyword=keyword;
	
	var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+industry;
	
	$.LoadingOverlay("show");
	$.ajax({
	   type: "GET",
	   async:true,
	   url:url,
	   dataType:'json',
	   success: function(data)
	   {
		   $('#accordion').empty().append(videoHtml(data))
	   }
	 });
	 $.LoadingOverlay("hide",true);
}
function videoHtml(data)
{
	var str=``;
	var i=0;
	$.each(data,function(k,v){
		i++;
		var video_tag='';
		if (v.vic_bn_youtubeURL != '') {
            video_tag = `<iframe width="100%" height="150px"  class="card-img" src="` + v.vic_bn_youtubeURL + `" autoplay="0" frameborder="0" allow="accelerometer; autoplay="0"; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        }
        else if (v.vic_blogs_news_video != '') {
            video_tag = `<video src="`+ ajax_url + `upload/interviews/` + v.vic_blogs_news_video + `" type="video/mp4" controls="true" class="embed-responsive-item" width="100%" height="150px">
						  
						</video>`;
        }
		str+=` <div class="col-sm-3 pt-3 pb-3">
					<div class="card">
						<!-- <iframe src="`+v.vic_bn_youtubeURL+`" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
						`+video_tag+`
						<div class="text-center p-2">
							<a href="javascript:void(0)">`+v.vic_bn_title+`</a>
						</div>
					</div>
				</div>`;
	});
	if(str==''){
		str='<h2 class="text-center mt-5 text-blue w-100">Result Not Found</h2>';
	}
	return str;
}
function readmore(id) {
  /*
  var moreText = document.getElementById("more");
  var btnText = document.getElementById("myBtn");*/
  var dots = document.getElementById("dots"+id);
  var moreText =$("#more"+id);
  var btnText =$("#myBtn"+id);

  if (dots.style.display === "none") {
    dots.style.display = "inline";
	
    //btnText.innerHTML = "Read more";
	btnText.text("Read more");
    //moreText.style.display = "none";
	moreText.hide(500);
  } else {
    dots.style.display = "none";
	
    //btnText.innerHTML = "Read less";
	btnText.text("Read less");
    //moreText.style.display = "inline";
	moreText.show(500)
  }
}