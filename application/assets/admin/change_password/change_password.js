$(document).ready(function() {
    var ajax_url = $('#ajax_url').val();

    $("#resetpassword").validate({

        rules: {
            old_password: "required",
            new_password: {
                required: true,
                minlength: 8,
                pwcheck: true,
            },
        },
        messages: {
            old_password: "Please Enter Old Password",
            new_password: {
                required: "Password required",
                pwcheck: "Must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.",
                minlength: "Min 8 length required"
            },
        },

        submitHandler: function(form) {
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/resetpassword',
                data: $('#resetpassword').serialize(), // serializes the form's elements.
                dataType: 'json',
                success: function(data) {
                    hideLoader();
                    toastr[data.status](data.msg);
                    $('#resetpassword')[0].reset();
                }
            })
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
        var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
        return regex.test(value)
     });

});
function resetFrom(){
	
	$('#resetpassword')[0].reset();
	$('label.error').hide()
}