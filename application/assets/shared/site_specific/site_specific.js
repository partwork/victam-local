
$(document).ready(function () {
	
   var ajax_url = $('#ajax_url').val();
  $('.chat-bot').on('click', function () {
    $(".chatbot-card-wrapper").toggle(150);
  });
  $('.chat-close').on('click', function () {
    $(".chatbot-card-wrapper").toggle(150);
  });

  var visited = localStorage.getItem('visited');
  if (!visited) {
      document.getElementById("ccw").style.display = "block";
      localStorage.setItem('visited', true);
  }

  // Toastr JS
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

  // 

  $.ajax({
    url: ajax_url + "app/get_home_company_list",
    method: "get",
    dataType: "json",
    success: function (data) {
      var html = '';
      $.each(data, function (i, value) {
        html += `<div class="col-sm-2 p-2">
                <img class="img-section" src="` + ajax_url + `upload/banner/` + value.vic_banner_image + `">
            </div>`
      });
      $("#eventBanner").append(html);
    }
  });

});

function onlyNumberKey(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
  if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
  return true;
}


function lettersOnly(evt) {
  var ASCIICode = (evt.which) ? evt.which : evt.keyCode;
  if (ASCIICode > 31 && (ASCIICode < 65 || ASCIICode > 90) && (ASCIICode < 97 || ASCIICode > 122))
    return false;
  return true;
}
function showLoader()
{
	$.LoadingOverlay("show");
}
function hideLoader(){
	$.LoadingOverlay("hide");
}