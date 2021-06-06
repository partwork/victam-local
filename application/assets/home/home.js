
$(window).scroll(function () {
    var wh = $(window).height() - 50;
    if ($(window).scrollTop() > $('.subscription-text').offset().top - wh) {
      $('.subscription-text').addClass('onScroll');
    }
  });

$(document).ready(function() {
    var ajax_url = $('#ajax_url').val();
    // interviewsSlider
    $.ajax({
        url: ajax_url + "app/get_home_interview_list",
        method: "get",
        dataType: "json",
        success: function(data) {
					
            var html = '';
            $.each(data, function(i, value) {
				var str='';
				if(value.vic_bn_youtubeURL!=''){
				 str=`<iframe width="100%" height="140px" src="` + value.vic_bn_youtubeURL + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;			
				}
				if(value.vic_blogs_news_video!=''){
					str=`<video controls height="140px">
						  <source src="`+ajax_url+`upload/interviews/`+value.vic_blogs_news_video+`" type="video/mp4">
						  Your browser does not support the video tag.
						</video>`;
				}
                html += ` <div class="interview-items text-center">
								`+str+`
                                <a href="javascript:void(0)" class="text-blue f-14">` + value.vic_bn_title + `</a>
                            </div> `
            });
						
            $(".owl-carousel-interviews").append(html);

            $(".owl-carousel-interviews").owlCarousel({
                loop: true,
                items: 6, // Select Item Number
                autoplay: false,
                nav: true,
                // dots: true
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            });
        }
    });

    $.ajax({
        url: ajax_url + "app/get_home_latest_events",
        method: "get",
        dataType: "json",
        success: function(data) {
            
            var html = ''; var url= "";
            $.each(data, function(i, value) {
                if(value.vic_registration_url !=null && value.vic_registration_url!=""){
                    url=value.vic_registration_url;
                }else{
                    url=value.vic_event_website_url;
                }
                html += `<div class="event-item-wrap">
                        <img class="interview-img"  src="` + ajax_url + `upload/event/` + value.vic_logo + `" style="width: 100%;">
                                <div class="text-center">
                                    <a href="`+ajax_url+`events/event-details/`+value.idvic_events+`" target="_blank" title="`+value.vic_eventtitle+`"><h6 class="text-danger pt-2 f-14 e-title">` + value.vic_eventtitle + `</h6></a>
                                    <div class="text-blue f-14">` + value.vic_companyname +`</div>
                                    <diV class="event-name" title="`+value.vic_eventtitle+`">` + value.vic_eventtitle + `</diV>
                                    <diV class="event-name">` + value.vic_eventtype + `</diV>
                                    <div class="event-date pb-1">` + value.vic_date + `</div>
                                </div>
                                <a onclick="update_registration_count('`+ url+`',`+ value.idvic_events +`)" href="javascript:void(0);" class="btn btn-blue form-control btn-sm">Register</a>
                            </div>`
            });
            $(".owl-carousel-events").append(html);
            // Events
            $(".owl-carousel-events").owlCarousel({
                loop: true,
                items: 6, // Select Item Number
                autoplay: false,
                nav: true,
                // dots: true
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            });
        }
    });
    
    // event information banner
});
$(document).ready(function() {
    $(".owl-carousel-logo").owlCarousel({
        loop: true,
        items: 4, // Select Item Number
        autoplay: true,
        nav: false,
        dots: true
            // navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
    });

});

function shareinsocialmedia(url) {
    window.open(url, 'sharein', 'toolbar=0,status=0,width=648,height=395');
    return true;
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
