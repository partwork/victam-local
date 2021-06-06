$(document).ready(function($) {
    $("#registration-form").validate({
        rules: {
            password : {
                required: true,
                minlength : 8,
                pwcheck: true,
            },
            conf_password : {
                required: true,
                equalTo : "#password"
            },
        },
        messages: {
            password: {
                required: "Password required",
                pwcheck: "Must contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character.",
                minlength: "Min 8 length required"
            },
            conf_password:{
                required:"Confirm password required",
                equalTo : "Password and confirm password must be same"
            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
        var regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
        return regex.test(value)
     });
});