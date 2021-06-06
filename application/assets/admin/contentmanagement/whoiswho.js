
$(document).ready(function () {
  $('#addcompanydetails').validate({
    rules: {
      companyname: 'required',
      companydescription: 'required',
      address: 'required',
      city: 'required',
      zipcode: 'required',
      country: 'required',
      email: { required: true, email: true },
      phonenumber: 'required',
      website: {
        required: true,
        url: true
      },
      industrysector: 'required',
      industries: 'required',
      headquarters: 'required',
      target_groups: 'required',
      production: 'required',
      companytodeal: 'required',
      services: 'required',
      USPS: 'required',
      delivering:'required',
      duration:'required',
      specialities:'required',
      linkedinurl: {
        url: true
      },
      uploadImageFile: {
        extension: "jpg|jpeg|png",
        filesize: 5000000,
      },
      uploadPresentationFile: {
        extension:  "mp4",
        filesize: 50000000,
      }
    },
    messages: {
      companyname: 'Company name required',
      companydescription: 'Company description required',
      address: 'Address details required',
      city: 'City required',
      zipcode: 'ZIP code required',
      country: 'Country required',
      email: {
        required: 'Email required',
        email: 'Enter valid email',
      },
      phonenumber: 'Phone number required',
      website: {
        required: "Website URL required",
        url: "Please enter valid URL",
      },
      industrysector: 'Industry sector required',
      industries: 'industries required',
      headquarters: 'Headquarters required',
      target_groups: 'Company Profile required',
      production: 'Production required',
      companytodeal: 'Company to deal required',
      services: 'Service required',
      USPS: 'USP required',
      delivering:'Companies delivering required',
      duration:'Investment duration required',
      specialities:'Specialities required',
      linkedinurl: {
        url: "Please enter valid URL",
      },
      uploadImageFile: {
        extension: "Allowed file extensions: PNG, JPEG and JPG",
        filesize: "File size must be less than 5MB",
      },
      uploadPresentationFile: {
        extension: "Allowed file extensions: MP4",
        filesize: "File size must be less than 50MB",
      }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
});
function who_preview_content() {
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
    $('#videoUrl').text('');
    $('#title').html($('#titles').val());
    $('#desc').html($('#description').val());

    
	var video_path = $('#media_video').val();
	var img_path = $('#media_logo').val();
	
	$('#who_is_who_imgtag').attr('src',img_path);
    $('#whoIsWho_video_tag').attr('src',video_path);
    $("#videoUrl").append(html);
}
function readURL(input,tagid=null) {  
  
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
		if(tagid==null){
		 $('#media_data').val( e.target.result)		
		}
		else{
		  $('#'+tagid).val( e.target.result)	
		}
      
      
    };
    reader.readAsDataURL(input.files[0]);
  }
}