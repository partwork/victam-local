$(document).ready(function () {
	$(".owl-carousel").owlCarousel({
		loop: true,
		items: 4, // Select Item Number
		autoplay: true,
		nav: false,
		dots: true
		// navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"],
	});

	$('#searchresult').click(function(){
		var value = $('#searchparam').val();
		var ajax_url = $('#ajax_url').val();
 
		$.ajax({
			url: ajax_url + "e/SearchController/ajax_request_by_value/" + value,
			method: "get",
			dataType: "json",
			success: function (data) {
				$('#foreachresult').empty();
				$('#ajaxresult').empty();
				var html = '';
				if (data.length > 0) {
				$.each(data, function (i, value) {
					html += `<div class="col-sm-12 mt-3">
                                    <div class="news-card">
                                        <h6 class="text-blue fs-16">`+value.vic_bn_title+`</h6>
                                        <p class="f4-14 mb-3">`+value.vic_description+`</p>
                                        <a href="`+ajax_url+`news/`+value.idvic_blogs_news+`" class="read-more text-blue"> Read More </a>
                                    </div>
                                </div>`
					});
				} else {
					html += `<h2 class="text-blue text-center" style="margin:auto;">Result Not Found</h2>`;
				}
				$("#ajaxresult").append(html);
			}
		});

	});
});
$(document).on('keyup change','#searchparam',function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if (keycode == '13'){
		var value = $('#searchparam').val();
		var ajax_url = $('#ajax_url').val();

		$.ajax({
			url: ajax_url + "e/SearchController/ajax_request_by_value/" + value,
			method: "get",
			dataType: "json",
			success: function (data) {
				$('#foreachresult').hide();
				$("#ajaxresult").empty();
				$('#foreachresult').empty();
				var html = '';
				if (data.length > 0) {
				$.each(data, function (i, value) {
					html += `<div class="col-sm-12 mt-3">
                                    <div class="news-card">
                                        <h6 class="text-blue fs-16">`+value.vic_bn_title+`</h6>
                                        <p class="f4-14 mb-3">`+value.vic_description+`</p>
                                        <a href="`+ajax_url+`news/`+value.idvic_blogs_news+`" class="read-more text-blue"> Read More </a>
                                    </div>
                                </div>`
					});
				} else {
					html += `<h2 class="text-blue text-center" style="margin:auto;">Result Not Found</h2>`;
				}
				$("#ajaxresult").append(html);
			}
		});
	}
});