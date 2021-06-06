$(document).ready(function() {


    $('input[type=radio][name=videoType]').change(function() {
        $("#upload-video-file").val('');
        $("#upload-video-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');
        $("#youtubeUrl").val('');
        if (this.value == 'mp4') {
            $(".upload-mp4").removeClass('display-none');
            $(".you-tube-url").addClass('display-none');
        } else if (this.value == 'youTube') {
            $(".upload-mp4").addClass('display-none');
            $(".you-tube-url").removeClass('display-none');
        }
    });


    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0}');


    $("#writeForUsForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 50,
            },
            position: {
                required: true,
                maxlength: 30,
            },
            companyName: {
                required: true,
                maxlength: 50,
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
            },
            address: "required",
            city: "required",
            zipCode: {
                required: true,
                minlength: 6,
                maxlength: 6,
            },
            country: "required",
            title: "required",
            category: "required",
            type: "required",
            keyword: "required",
            uploadImage: {
                // required: function (element) {
                //     return $('input[type=radio][name=type]:checked').val() != "interview";
                // },
                extension: "jpg,jpeg,png",
                filesize: 5000000,
            },
            uploadVideo: {
                required: function(element) {
                    return $('input[type=radio][name=type]:checked').val() != "interview";
                },
                extension: "mp3|mpeg|mp4",
                filesize: 50000000,
            },
            // uploadAttachment: {
            //     required: function (element) {
            //         return $('input[type=radio][name=type]:checked').val() != "Interview";
            //     },
            //     extension: "mp3|mpeg|mp4",
            //     filesize: 50000000,
            // },
            youtubeUrl: {
                required: function(element) {
                    return $('input[type=radio][name=videoType]:checked').val() == "youTube";
                },
                url: true
            },
            uploadVideo: {
                required: function(element) {
                    return $('input[type=radio][name=videoType]:checked').val() == "mp4";
                },
                extension: "mp4|MKV|MOV",
                filesize: 50000000,
            },
            videoType: {
                required: function(element) {
                    return $('input[type=radio][name=type]:checked').val() == "interview";
                }
            },
            hiddenRecaptcha: {
                required: function() {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        messages: {
            name: {
                required: "Name required",
                maxlength: "Name max. length 50 char.",
            }, 
            position: {
                required: "Position required",
                maxlength: "Position max. length 30 char.",
            }, 
            companyName: {
                required: "Company name required",
                maxlength: "Company name max. length 50 char.",
            }, 
            phone: {
                required: "Phone number required",
                minlength: "Phone number should be 10 digit",
                maxlength: "Phone number should be 10 digit",
            },
            address: "Address Details required",
            city: "City required",
            zipCode: {
                required: "ZIP code required",
                minlength: "ZIP code number should be 6 digit",
                maxlength: "ZIP code number should be 6 digit",
            },
            country: "Country required",
            title: "Title required",
            category: "Category required",
            type: "Type required",
            keyword: "Company Name required",
            uploadImage: {
                required: "Image required",
                extension: "Allowed file extensions: PNG, JPEG",
                filesize: "File size must be less than 5MB",
            },
            uploadVideo: {
                required: "Video required",
                extension: "Allowed file extensions: MP4",
                filesize: "File size must be less than 50MB",
            },
            uploadAttachment: {
                required: "Attachment required",
                extension: "Allowed file extensions: MP4",
                filesize: "File size must be less than 50MB",
            },
            youtubeUrl: {
                required: "Youtube URL required",
                url: "Please enter valid URL",
            },
            videoType: "Video required",
            hiddenRecaptcha: "Captcha required",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $("input[name='type']").click(function() {

        $("#upload-video-file").val('');
        $("#upload-video-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');

        $("#upload-image-file").val('');
        $("#upload-image-file-name").text('Allowed file extensions: PNG, JPEG, maximum file size: 5MB');

        $("#upload-attachment-file").val('');
        $("#upload-attachment-file-name").text('Allowed file extensions: PDF, DOCX, PPTX, maximum file size: 10MB');

        $("#description").val('');
        $("#youtubeUrl").val('');

        $(".upload-mp4").removeClass('display-none');
        $(".you-tube-url").addClass('display-none');

        if (this.value == 'news' || this.value == 'article') {
            $(".video-type").addClass('display-none');
            $(".upload-attachment").addClass('display-none');
            $(".upload-image").removeClass('display-none');
            $(".description").removeClass('display-none');
            $('#upload-video-button').attr('disabled', 'disabled');
            $('#upload-attachment-button').attr('disabled', 'disabled');
            $('#youtubeUrl').attr('disabled', 'disabled');
            $('#upload-image-button').removeAttr("disabled");
            $('#description').removeAttr("disabled");
        } else if (this.value == 'interview') {
            $('input[name="videoType"]').prop('checked', false);
            $("#upload-video-file").val('');
            $("#upload-video-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');
            $("#youtubeUrl").val('');
            $(".upload-mp4").addClass('display-none');
            $(".you-tube-url").addClass('display-none');
            $(".video-type").removeClass('display-none');
            $(".description").addClass('display-none');
            $(".upload-attachment").addClass('display-none');
            $(".upload-image").addClass('display-none');
            $('#description').attr('disabled', 'disabled');
            $('#upload-attachment-button').attr('disabled', 'disabled');
            $('#upload-image-button').attr('disabled', 'disabled');
            $('#upload-video-button').removeAttr("disabled");
            $('#youtubeUrl').removeAttr("disabled");
        }
    });

});

// Dropdown function
$(function() {

    $(".category-drp-list a").click(function() {
        $("#SelectGender span").text($(this).text());
    });
});

$(document).ready(function() {
    // File Upload

    // Image Upload
    // const imageFileBtn = document.getElementById("upload-image-file");
    // const imageBtn = document.getElementById("upload-image-button");
    // const imageTxt = document.getElementById("upload-image-file-name");

    // imageBtn.addEventListener("click", function() {
    //     imageFileBtn.click();
    // });

    // imageFileBtn.addEventListener("change", function() {
    //     if (imageFileBtn.value) {
    //         imageTxt.innerHTML = imageFileBtn.value.match(
    //             /[\/\\]([\w\d\s\.\-\(\)]+)$/
    //         )[1];
    //     } else {
    //         imageTxt.innerHTML = "";
    //     }
    // });

    // Video Upload
    const videoFileBtn = document.getElementById("upload-video-file");
    const videoBtn = document.getElementById("upload-video-button");
    const videoTxt = document.getElementById("upload-video-file-name");

    videoBtn.addEventListener("click", function() {
        videoFileBtn.click();
    });

    videoFileBtn.addEventListener("change", function() {
        if (videoFileBtn.value) {
            videoTxt.innerHTML = videoFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            videoTxt.innerHTML = "";
        }
    });

    // Attachment Upload
    const attachmentFileBtn = document.getElementById("upload-attachment-file");
    const attachmentBtn = document.getElementById("upload-attachment-button");
    const attachmentTxt = document.getElementById("upload-attachment-file-name");

    attachmentBtn.addEventListener("click", function() {
        attachmentFileBtn.click();
    });

    attachmentFileBtn.addEventListener("change", function() {
        if (attachmentFileBtn.value) {
            attachmentTxt.innerHTML = attachmentFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            attachmentTxt.innerHTML = "";
        }
    });
});