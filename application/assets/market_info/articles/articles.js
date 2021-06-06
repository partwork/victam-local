//artilce
var ajax_url = $('#ajax_url').val();
var fb_id = $('#fb_id').val();
var industry_text='';
var publisher_text=""
$(document).ready(function () {
    $(".Publisher-drp-list a").click(function () {
        $("#SelectPublisher span").text($(this).text());
        $("#SelectPublisher span").removeClass("selected-option");
    });
    $("#SelectPublisher").click(function () {
        $(".drop-down-Publisher").addClass('rotateimg180');
        $("#SelectPublisher span").removeClass("selected-option");
    });
    $(".Publisher-drp-list .dropdown-item").click(function () {
        $(".drop-down-Publisher").removeClass('rotateimg180');
        $("#SelectPublisher span").removeClass("selected-option");
    });

    $(".Industry-drp-list a").click(function () {
        $("#SelectIndustry span").text($(this).text());
        $("#SelectIndustry span").removeClass("selected-option");
    });
    $("#SelectIndustry").click(function () {
        $(".drop-down-Industry").addClass('rotateimg180');
        $("#SelectIndustry span").removeClass("selected-option");
    });
    $(".Industry-drp-list .dropdown-item").click(function () {
        $(".drop-down-Industry").removeClass('rotateimg180');
        $("#SelectIndustry span").removeClass("selected-option");
    });

    // Accordian
    $('.accordian-btn').click(function() { 
        $(this).find('i').toggleClass('fa fa-angle-down fa fa-angle-up'); 
    });

    $('#industry_drop').on('change', function () {
        window.industry_text=$(this).val();
		var publisher=window.publisher_text;
        var page='article';
        var keyword=$('.mr-inf-search').val().trim(); 
        var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+$(this).val()+'&publisher='+publisher;
        var obj={url:url}
        getBlogdata(obj)
     })
	 $('#publisher_drop').change( function () {
		 
        window.publisher_text=$(this).val();
		var industry=window.industry_text;
        var page='article';
        var keyword=$('.mr-inf-search').val().trim(); 
        var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+industry+'&publisher='+$(this).val();
        var obj={url:url}
        getBlogdata(obj)
     })
});

$(document).on('keyup change','.mr-inf-search',function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13') {
		var page='article';
		var keyword=$(this).val().trim();
		var industry=window.industry_text;
		var publisher=window.publisher_text=$(this).val();
		
		var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+industry+'&publisher='+publisher;
		var obj={url:url}
		getBlogdata(obj)
	}
});
$(document).on("click",".mr_inf_sarch_btn",function() {
    var page=$(this).data('page');
	var publisher=window.publisher_text=$(this).val();
	var keyword=$('.mr-inf-search').val().trim();
	if(keyword==''){
		alert('Please Enter Value');
		return false;
	}
	var industry_text='';
	industry_text=(typeof window.industry_text==undefined)? '' :window.industry_text;
	var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+industry_text+'&publisher='+publisher;
	var obj={url:url}
    getBlogdata(obj)
});
function getBlogdata(obj){
	
	var keyword=$('.mr-inf-search').val();
	var publisher=$('#publisher_drop').val();
	var industry=$('#industry_drop').val();
	var page='article';
	
	obj.publisher=publisher;
	obj.industry=industry;
	obj.keyword=keyword;
	
	var url=ajax_url+'mrk_sarch_data?page='+page+'&keyword='+keyword+'&industry='+industry+'&publisher='+publisher;
	//var obj={'page':page,'keyword':keyword};
	$.LoadingOverlay("show");
	$.ajax({
	   type: "GET",
	   async:true,
	   url:url,
	   dataType:'json',
	   success: function(data)
	   {
			 if (videoHtml(data)) {
				$('#accordion').empty().append(videoHtml(data))
			 }
			 else
			 {
				 $('.accordian-title').hide();
					str='<h2 class="text-center mt-5 text-blue">Result Not Found</h2>';
					$('#accordion').empty().append(str)
			 }
		   
		  
	   }
	 });
	 $.LoadingOverlay("hide",true);
}
function videoHtml(data)
{
	var str=``;
	var i=0;
	$.each(data,function(k,v){

		var post_date = new Date(v.vic_bn_createdat);
		var curr_day = post_date.getDate();
		var curr_month = post_date.getMonth()+1;
		var curr_year = post_date.getFullYear();
		var show = (i == 1) ? 'show' : '';
		i=v.idvic_blogs_news;

		var pdate=curr_day+'/'+curr_month+'/'+curr_year;
		var txt=v.vic_description;
		var limited_string=truncateString(txt,100,' ','')
		var show = (i == 0) ? 'show' : '';
		var reset_of_string=v.vic_description.replace(limited_string,' ')


	str+=`<div class="card">
					<div id="heading`+i+`">
						<div class="d-flex accordian-btn" data-toggle="collapse" data-target="#collapse`+i+`" aria-expanded="true" aria-controls="collapse`+i+`">
							<p class=" news-title text-blue f-14" data-toggle="collapse" data-target="#collapse`+i+`" aria-expanded="false" aria-controls="collapse`+i+`">
							`+v.vic_bn_title+`</p>
							<i class="fa fa-angle-down drop-down-arrow-accordion" aria-hidden="true"></i>
						</div>
					</div>

					<div id="collapse`+i+`" class="collapse `+show+`" aria-labelledby="heading`+i+`" data-parent="#accordion">
						<div class="card-body plr-15">
							<p class="text-justify mb-0 f-14"> `+limited_string+`<span id="dots`+v.idvic_blogs_news+`">...</span><span id="more`+v.idvic_blogs_news+`" class='more'>`+reset_of_string+`</span></p>
							<div class="news-footer">
								<span class="float-right news-date">`+v.vic_bn_createdat+`</span>
								<span class="float-left">
									<span><a class="visit-website text-blue" onclick="readmore(`+v.idvic_blogs_news+`)" id="myBtn`+v.idvic_blogs_news+`"> Read More </a></span>
									<span><a href="`+v.vic_blogs_website_url+`" target="_blank" class="visit-website text-blue"> Visit website </a></span>
									<span><a href="`+ajax_url+`source_download/`+v.idvic_blogs_news+`" class="download text-blue"> Download </a></span>
									<a href="https://www.facebook.com/dialog/share?app_id=`+fb_id+`&href=http://dev.victam.com/e/CommonController/get_articles_by_id/`+v.idvic_blogs_news+`&display=popup" target="__blank"><img src="`+ajax_url+`application/assets/shared/img/icon/facebook.png" height="10" width="10"></span></a>
									<a href="https://www.linkedin.com/sharing/share-offsite/?url=http://dev.victam.com/e/CommonController/get_articles_by_id/`+v.idvic_blogs_news+`" target="__blank"><img src="`+ajax_url+`application/assets/shared/img/icon/linkedin.png" height="10" width="10"></span></a>
									<a href="https://twitter.com/intent/tweet?text=`+v.vic_bn_title+` `+v.vic_description+`" target="__blank"><img src="`+ajax_url+`application/assets/shared/img/icon/twitter.png" height="10" width="10"></span></a>
								</span>
							</div>
						</div>
					</div>
				</div>`;
	});
	if(str==''){
		str='<h2 class="text-center mt-5 text-blue">Result Not Found</h2>';
		str=false;
	}
	return str;
}
function truncateString (string, limit, breakChar, rightPad) {
    if (string.length <= limit) return string;
    
    var substr = string.substr(0, limit);
    if ((breakPoint = substr.lastIndexOf(breakChar)) >= 0) {
        if (breakPoint < string.length -1) {
            return string.substr(0, breakPoint) + rightPad;
        }
    }
}
function shareinsocialmedia(url) {
    window.open(url, 'sharein', 'toolbar=0,status=0,width=648,height=395');
    return true;
}
function truncate(str, no_words) {
    return str.split(" ").splice(0,no_words).join(" ");
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