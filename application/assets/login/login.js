$(document).ready(function($) {
    $("#login-form").validate({
        rules: {
            email: {
                required: true,
				email: true,
            },
            password: "required",
        },
        messages: {
            email: {
                required: "Email required",
				email: "Please enter valid mail ID "
            },
            password: "Password required",
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});