$(document).ready(function($) {
    $("#account-form").validate({
        rules: {
            password : {
                required: true,
                minlength : 8,
                pwcheck: true,
            }
        },
        messages: {
            password: {
                required: "Password required",
                pwcheck: "Must contain at least one number and one uppercase and lowercase letter",
                minlength: "Min 8 length required"
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