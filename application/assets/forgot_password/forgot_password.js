$(document).ready(function($) {
    $("#forgotPasswordForm").validate({
        rules: {
            email:{
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Email required",
                email: "Please enter valid mail ID "
            }
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});