var ajax_url = $('#ajax_url').val();
var idvic = 0;
var inv_id = $('#inv_id').val();

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');


$(document).ready(function () {
    $('input[type=radio][name=videoType]').change(function () {
        // $("#upload-attachment-file").val('');
        $("#upload-attachment-file-name").text('Allowed file extensions: MP4, maximum file size: 50MB');
        //$("#youtubeurl").val('');
        if (this.value == 'mp4') {
            $(".upload-mp4").removeClass('display-none');
            $(".you-tube-url").addClass('display-none');
        } else if (this.value == 'youTube') {
            $(".upload-mp4").addClass('display-none');
            $(".you-tube-url").removeClass('display-none');
        }
    });


    $("#addnews-form").validate({
        rules: {
            titles: {
                required: true,
                minlength: 2,
                maxlength: 100,
            },
            category: "required",
            description: {
                required: true,
                maxlength: 10000,
            },
            lndatepicker: "required",
            websiteurl: {
                required: true,
                url: true
            },
        },
        messages: {
            titles: {
                required: "Title required",
                minlength: "Min. length should be 2 character",
                maxlength: "Max. length should be 50 character",
            },
            category: "Category required",
            description: {
                required: "Description required",
                maxlength: "Max. length should be 10000 character",
            },
            lndatepicker: "Date required",
            websiteurl: {
                required: "Website URL required",
                url: "Please enter valid URL",
            },
        },

        submitHandler: function (form) {
            add_new_news();
        }
    });

    var required_innovation = {
        inn_name: "required",
        inn_desc: "required",
        inn_industry: "required",
        inn_publisher: "required",
        inn_date: "required",
        inn_email: { required: true, email: true },

        //inn_url: {
        //    required: true,
        //    url: true
        //},
    }

    if ($('#inv_id').val() == '') {
        required_innovation.inn_doc = {
            required: true,
            extension: "doc|docx|xls|xlsx|pdf",
            filesize: 15000000,
        }
        required_innovation.inn_presentation = {
            required: true,
            extension: "mp4",
            filesize: 50000000,
        }
    } else {
        required_innovation.inn_doc = {
            extension: "doc|docx|xls|xlsx|pdf",
            filesize: 15000000,
        }
        required_innovation.inn_presentation = {
            extension: "mp4",
            filesize: 50000000,
        }
    }
    $("#research_innovation").validate({
        rules: required_innovation,
        messages: {
            inn_name: "Please Enter Name",
            inn_desc: "Please Enter Description",
            inn_industry: "Please Select Industry",
            inn_publisher: "Please Enter Publisher",
            inn_email: "Please Enter Email",
            inn_date: "Please Select Date",
            inn_doc: "required",
            inn_presentation: "required",
            //inn_url: {
            //    required: "Website URL required",
            //    url: "Please enter valid URL",
            //},
            inn_doc: {
                required: "Attachment file required",
                extension: "Allowed file extensions: doc,docx,xls,xlsx and PDF",
                filesize: "File size must be less than 5MB",
            },
            inn_presentation: {
                required: "Presentation video file is required",
                extension: "Allowed file extensions: .mp4",
                filesize: "File size must be less than 50MB",
            }

        },

        submitHandler: function (form) {

            var file = $('#upload-presentation-file')[0].files[0]
            var data = new FormData(document.getElementById("research_innovation"));

            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/add_resourcelib',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                //data: $('#user_form').serialize(), // serializes the form's elements.
                success: function (data) {
                    hideLoader();
                    if (data.status == 'added') {
                        $('#publish').modal('show');
                        $('#research_innovation')[0].reset();
                    } else {

                        toastr["error"](data.msg);
                    }
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            })
        }
    });

    var required_whitepaper = {
        inn_name: "required",
        inn_desc: "required",
        inn_industry: "required",
        inn_publisher: "required",
        inn_email: { required: true, email: true },
        inn_date: "required",

    }

    if ($('#inv_id').val() == '') {
        required_whitepaper.inn_doc = {
            required: true,
            extension: "doc|docx|xls|xlsx|pdf",
            filesize: 15000000,
        },
            required_whitepaper.inn_presentation = {
                required: true,
                extension: "mp4",
                filesize: 50000000,
            }
    } else {
        required_whitepaper.inn_doc = {
            extension: "doc|docx|xls|xlsx|pdf",
            filesize: 15000000,
        },
            required_whitepaper.inn_presentation = {
                extension: "mp4",
                filesize: 50000000,
            }
    }
    $("#whitepaper-form").validate({
        rules: required_whitepaper,
        messages: {
            inn_name: "Please Enter Title",
            inn_desc: "Please Enter Description",
            inn_industry: "Please Select Industry",
            inn_publisher: "Please Enter Publisher",
            inn_email: "Please Enter Email",
            inn_date: "Please Select Date",
            inn_doc: "Please Select Document",
            inn_doc: {
                required: "Attachment file required",
                extension: "Allowed file extensions: PDF",
                filesize: "File size must be less than 5MB",
            },
            inn_presentation: {
                required: "Presentation video file is required",
                extension: "Allowed file extensions: mp4",
                filesize: "File size must be less than 5MB",
            }
        },

        submitHandler: function (form) {
            //var file = $('#upload-presentation-file')[0].files[0]
            var data = new FormData(document.getElementById("whitepaper-form"));

            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/add_resourcelib',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                //data: $('#user_form').serialize(), // serializes the form's elements.
                success: function (data) {
                    hideLoader();
                    $('#publish').modal('show');
                    $('#whitepaper-form')[0].reset();
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            })
        }
    });


    var required_publication = {
        inn_name: "required",
        inn_desc: "required",
        inn_industry: "required",
        inn_publisher: "required",
        inn_email: { required: true, email: true },
        inn_date: "required",

    }
    var inv_id = $('#id').val();
    if (inv_id == '') {
        required_publication.inn_doc = {
            required: true,
            extension: "pdf",
            filesize: 15000000,
        },
            required_publication.inn_presentation = {
                required: true,
                extension: "mp4",
                filesize: 50000000,
            }
    } else {
        required_publication.inn_doc = {
            extension: "pdf",
            filesize: 15000000,
        },
            required_publication.inn_presentation = {
                extension: "mp4",
                filesize: 50000000,
            }
    }

    $("#publication").validate({
        rules: required_publication,
        messages: {
            inn_name: "Please Enter Title",
            inn_desc: "Please Enter Description",
            inn_industry: "Please Select Industry",
            inn_publisher: "Please Enter Publisher",
            inn_email: "Please Enter Email",
            inn_date: "Please Select Date",

            inn_doc: {
                required: "Attachment file required",
                extension: "Allowed file extensions: PDF",
                filesize: "File size must be less than 5MB",
            },
            inn_presentation: {
                required: "Presentation video file is required",
                extension: "Allowed file extensions: mp4",
                filesize: "File size must be less than 5MB",
            }
        },

        submitHandler: function (form) {

            var file = $('#upload-presentation-file')[0].files[0]
            var data = new FormData(document.getElementById("publication"));

            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/add_resourcelib',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                //data: $('#user_form').serialize(), // serializes the form's elements.
                success: function (data) {
                    hideLoader();
                    if (data.status == 'added') {
                        $('#publish').modal('show');
                        $('#publication')[0].reset();
                    } else {
                        toastr["error"](data.msg);
                    }

                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            })
        }
    });

    var isempty_magzin = $('#isempty_magzin').val()
    var required_interview = {
        title: "required",
        summary: "required",
        description: "required",
        sectorFilter: "required",
        lnInterviewFrom: "required",
        lnInterviewTo: "required",
        publisher: "required",
        keyword: "required",
        videoType: "required",
    }

    if (isempty_magzin == '') {
        required_interview.interviewvideo = {
            required: function (element) {
                return $('input[type=radio][name=videoType]:checked').val() == "mp4";
            },
            extension: "mp4",
            filesize: 50000000
        }
        required_interview.youtubeurl = {
            required: function (element) {
                return $('input[type=radio][name=videoType]:checked').val() == "youTube";
            },
            url: true
        }
    } else {
        required_interview.interviewvideo = {
            extension: "mp4",
            filesize: 50000000
        }
        required_interview.youtubeurl = {
            url: true
        }
    }

    $("#interview_form").validate({
        rules: required_interview,
        messages: {
            title: "Enter Title",
            summary: "Enter Summary",
            description: "Enter Description",
            publisher: "Enter Publisher Name",
            keyword: "Enter Keywords",
            sectorFilter: "Select Sector",
            lnInterviewFrom: "From date required",
            lnInterviewTo: "To date required",
            interviewvideo: {
                required: 'MP4 file required',
                extension: "Allowed file extensions: MP4",
                filesize: "File size must be less than 50MB",
            },
            youtubeurl: {
                required: "Youtube URL required",
                url: "Please enter valid URL",
            },
            videoType: "Video required",

        },

        submitHandler: function (form) {

            var data = new FormData(document.getElementById("interview_form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/add_marketing_info',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                //data: $('#user_form').serialize(), // serializes the form's elements.
                success: function (data) {
                    hideLoader();
                    if (data.status == 'fail') {
                        toastr["error"](data.msg);
                        return false;
                    }
                    $('#publish').modal('show');
                    $('#interview_form')[0].reset();
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }

            })
        }
    });

    var isempty_magzin = $('#isempty_magzin').val()
    var required_article = {
        title: "required",
        sectorFilter: "required",
        description: "required",
        publisher: "required",
        keyword: "required",
        websiteurls: "required",

    }
    var form_type = $('#type').val();
    if (isempty_magzin == '') {
        required_article.mkt_file = {
            required: true,
            extension: "jpg|png|jpeg"
        }


    }
    $("#article_form").validate({
        rules: required_article,
        messages: {
            title: "Enter Title",
            sectorFilter: "Select Cateogry",
            description: "Enter Description",
            publisher: "Enter Publisher Name",
            keyword: "Enter Keywords",
            websiteurls: "Enter WebsiteURL",
        },

        submitHandler: function (form) {

            var data = new FormData(document.getElementById("article_form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/add_marketing_info',
                cache: false,
                processData: false,
                contentType: false,
                data: data,
                dataType: 'json',
                //data: $('#user_form').serialize(), // serializes the form's elements.
                success: function (data) {
                    hideLoader();
                    if (data.status == 'success') {
                        $('#publish').modal('show');
                        $('#article_form')[0].reset();
                    }

                    else {
                        toastr["error"](data.msg);
                    }

                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            })
        }
    });

    var isMagzinempty = $('#isempty_magzin').val();
    var required_magzine = {
        title: "required",
        issue: "required",
        volume: "required",
        year: "required"

    }

    if (isMagzinempty == '') {
        required_magzine.mkt_file = {
            required: true,
            extension: "pdf",
            filesize: 15000000,
        }
        required_magzine.upload_pdf_thumb = {
            required: true,
            extension: "jpg|jpeg|png",
            filesize: 500000,
        }
    }
    $("#magzine_form").validate({
        rules: required_magzine,
        messages: {
            title: "Enter Title",
            issue: "Enter Issue",
            volume: "Enter Valume",
            year: "Enter Year",
            mkt_file: {
                required: "Attachment file required",
                extension: "Allowed file extensions: PDF",
                filesize: "File size must be less than 15MB",
            },
            upload_pdf_thumb: {
                required: "Attachment file required",
                extension: "Allowed file extensions: JPG",
                filesize: "File size must be less than 5MB",
            }

        },

        submitHandler: function (form) {

            var data = new FormData(document.getElementById("magzine_form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                url: ajax_url + 'admin/add_magzine',
                cache: false,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                data: data,
                //data: $('#magzine_form').serialize(), // serializes the form's elements.
                dataType: 'json',
                success: function (data) {
                    hideLoader();
                    if (data.status == 'success') {
                        $('#publish').modal('show');
                        $('#magzine_form')[0].reset();

                    } else {
                        toastr["error"](data.msg);
                    }
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    alert(msg)
                },
            })
        }
    });

    var st = $('#isUpdateInterview').val()
    var required_filed_intv = {
        position: "required",
        lnInterviewFrom: "required",
        lnInterviewTo: "required",
        sector: "required",
        titles: {
            required: true,
            minlength: 2,
            maxlength: 26,
        },
        videoType: "required",
    }
    if (st == '') {
        required_filed_intv.interviewvideo = {
            required: function (element) {
                return $('input[type=radio][name=videoType]:checked').val() == "mp4";
            },
            extension: "mp4|MKV|MOV",
            filesize: 50000000,
        },
            required_filed_intv.youtubeurl = {
                required: function (element) {
                    return $('input[type=radio][name=videoType]:checked').val() == "youTube";
                },
                url: true
            }
        required_filed_intv

    } else {
        required_filed_intv.interviewvideo = {
            extension: "mp4|MKV|MOV",
            filesize: 50000000,
        },
            required_filed_intv.youtubeurl = {
                url: true
            }
    }
    $("#addinterview-form").validate({
        rules: required_filed_intv,
        messages: {
            titles: {
                required: "Title required",
                minlength: "Min. length should be 2 character",
                maxlength: "Max. length should be 26 character",
            },
            position: "Position required",
            lnInterviewFrom: "From date required",
            lnInterviewTo: "To date required",
            sector: "Sector is required",
            interviewvideo:
            {
                required: "MP4 file required",
                extension: "Allowed file extensions: MP4",
                filesize: "File size must be less than 50MB",

            },
            youtubeurl: {
                required: "Youtube URL required",
                url: "Please enter valid URL",
            },
            videoType: "Video required",
        },

        submitHandler: function (form) {
            if (window.location.href.indexOf("add-latest-interview") > -1) {
                var route_url = "add_interviews";
            } else {
                var route_url = "edit_interviews";
            }
            var file = $('#upload-attachment-file')[0].files[0]
            var data = new FormData(document.getElementById("addinterview-form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "post",
                url: ajax_url + "admin/content-management/home/latest-news/" + route_url,
                cache: false,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                dataType: "json",
                //$('#addinterview-form').serialize()+'&interviewvideo='+file,
                data: data,
                success: function (data) {
                    if (data.error) {
                        alert(data.msg)
                        return false;
                    }
                    hideLoader();
                    $('#publishinterview').modal('show');
                    $('#addinterview-form')[0].reset();

                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            });
        }
    });

    var banner_ismepty = $('#isempty_banner').val()
    var required_filed_banner = {
        cname: "required",
        btitle: {
            required: true,
            minlength: 2,
            maxlength: 26,
        },
        position: "required",
        bannerFrom: "required",
        bannerTo: "required",
    }
    if (banner_ismepty == '') {
        required_filed_banner.uploadAttachment = {
            required: true,
            extension: "jpg|png|jpeg",
            filesize: 5000000,
        }
    }else{
        required_filed_banner.uploadAttachment = {
            extension: "jpg|png|jpeg",
            filesize: 5000000,
        }
    }
    $("#addBanner-form").validate({
        rules: required_filed_banner,
        messages: {
            cname: "Company name required",
            btitle: {
                required: "Title required",
                minlength: "Min. length should be 2 character",
                maxlength: "Max. length should be 26 character",
            },
            position: "Position required",
            bannerFrom: "From date required",
            bannerTo: "To date required",
            uploadAttachment: {
                required: "Attachment file required",
                extension: "Allowed file extensions: JPG, JPEG, PNG",
                filesize: "File size must be less than 5MB",
            },
        },

        submitHandler: function (form) {
            if (window.location.href.indexOf("add-banner") > -1) {
                var route_url = "add_banner";
            } else {
                var route_url = "edit_banner";
            }
            var file = $('#upload-attachment-file')[0].files[0]
            var data = new FormData(document.getElementById("addBanner-form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "post",
                url: ajax_url + "admin/content-management/home/banners/" + route_url,
                cache: false,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                dataType: "json",
                //$('#addinterview-form').serialize()+'&interviewvideo='+file,
                data: data,
                success: function (data) {
                    hideLoader();
                    if (data.error) {
                        alert(data.msg)
                        return false;
                    } else {
                        $('#publishbanners').modal('show');
                        $('#addBanner-form')[0].reset();
                    }

                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            });
        }
    });
    var ismpty_logo = $('#logo_ismepty').val();
    var required_filed_logo = {
        cname: "required",
        logourl: {
            required: true,
            url: true
        },
        position: "required",
        dfrom: "required",
        tfrom: "required",
    }
    if (ismpty_logo == '') {
        required_filed_logo.uploadAttachment = {
            required: true,
            extension: "jpg|png|jpeg",
            filesize: 5000000,
        }
    }else{
        required_filed_logo.uploadAttachment = {
            extension: "jpg|png|jpeg",
            filesize: 5000000,
        }
    }
    $("#addLogo-form").validate({
        rules: required_filed_logo,
        messages: {
            cname: "Company name required",
            logourl: {
                required: "Logo URL required",
                url: "Please enter valid URL",
            },
            // btitle: {
            //     required: "Title required",
            //     minlength: "Min. length should be 2 character",
            //     maxlength: "Max. length should be 26 character",
            // },
            position: "Position required",
            dfrom: "From date required",
            tfrom: "To date required",
            uploadAttachment: {
                required: "Attachment file required",
                extension: "Allowed file extensions: JPG, JPEG, PNG",
                filesize: "File size must be less than 5MB",
            },
        },

        submitHandler: function (form) {
            if (window.location.href.indexOf("add-logos") > -1) {
                var route_url = "add_logo";
            } else {
                var route_url = "edit_logo";
            }
            var file = $('#upload-attachment-file')[0].files[0]
            var data = new FormData(document.getElementById("addLogo-form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "post",
                url: ajax_url + "admin/content-management/home/banners/" + route_url,
                cache: false,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                dataType: "json",
                //$('#addinterview-form').serialize()+'&interviewvideo='+file,
                data: data,
                success: function (data) {
                    hideLoader();
                    if (data.error) {
                        alert(data.msg)
                        return false;
                    } else {
                        $('#addLogo-form')[0].reset();
                        $('#logos').modal('show');
                    }
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            });
        }
    });
    var isempty_adv = $('#isempty_advert').val()
    var required_advert = {
        cname: "required",
        adspage: "required",
        adsposition: "required",
        adsurl: { required: true, url: true },
        adsFrom: "required",
        adsTo: "required",

    }
    if (isempty_adv == '') {
        required_advert.uploadAttachment = {
            required: true,
            extension: "jpg|png|jpeg",
        }
    }else{
        required_advert.uploadAttachment = {
            extension: "jpg|png|jpeg",
        }
    }

    $("#addAdvertisement-form").validate({
        rules: required_advert,
        messages: {
            cname: "Company name required",
            adspage: "Ads. Page required",
            adsposition: "Position required",
            adsurl: {
                required: "URL required",
                url: "Please enter valid URL",
            },
            // 
            adsFrom: "From date required",
            adsTo: "To date required",
            uploadAttachment: {
                required: "Attachment file required",
                extension: "Allowed file extensions: JPG, JPEG, PNG",
                // filesize: "File size must be less than 2MB",
            },
        },

        submitHandler: function (form) {
            if (window.location.href.indexOf("add-advertisement") > -1) {
                var route_url = "add_advertisement";
            } else {
                var route_url = "edit_advertisement";
            }

            var userData = new FormData(document.getElementById("addAdvertisement-form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "POST",
                async: true,
                url: ajax_url + "admin/content-management/home/advertisement/" + route_url,
                cache: false,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                dataType: "json",
                //$('#addinterview-form').serialize()+'&interviewvideo='+file,
                data: userData,
                success: function (data) {
                    hideLoader();
                    if (data.error) {
                        alert(data.msg)
                        return false;
                    } else {
                        $('#addAdvertisement-form')[0].reset();
                        $('#advertisementModal').modal('show');
                    }
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                },
            });
        }
    });

    var prmot = $('#isempty_promot').val();
    var rquired_promote = {
        title: "required",
        position: "required",
        adsurl: { required: true, url: true },
        dFrom: "required",
        dTo: "required",
        videoType: "required",
    }
    if (prmot == '') {
        rquired_promote.uploadAttachment = {
            required: function (element) {
                return $('input[type=radio][name=videoType]:checked').val() == "mp4";
            },
            extension: "mp4|MKV|MOV",
            filesize: 50000000,
        },
            rquired_promote.youtubeurl = {
                required: function (element) {
                    return $('input[type=radio][name=videoType]:checked').val() == "youTube";
                },
                url: true
            }
    } else {
        rquired_promote.uploadAttachment = {
            extension: "mp4|MKV|MOV",
            filesize: 50000000,
        },
            rquired_promote.youtubeurl = {
                url: true
            }
    }
    $("#addVideo-form").validate({
        rules: rquired_promote,
        messages: {
            title: "Title required",
            position: "Psosition required",
            url: {
                required: "URL required",
                url: "Please enter valid URL",
            },
            dFrom: "From date required",
            dTo: "To date required",
            uploadAttachment: {
                required: "Attachment file required",
                extension: "Allowed file extensions: MP4 maximum",
                filesize: "File size must be less than 50MB",
            },
            youtubeurl: {
                required: "Youtube URL required",
                url: "Please enter valid URL",
            },
            videoType: "Video required",
        },

        submitHandler: function (form) {

            if (window.location.href.indexOf("add-promoted-video") > -1) {
                var route_url = "add-video";
            } else {
                var route_url = "update_promoted_video";
            }
            var file = $('#upload-attachment-file')[0].files[0]
            var userData = new FormData(document.getElementById("addVideo-form"));
            var ajax_url = $('#ajax_url').val();
            showLoader();
            $.ajax({
                type: "post",
                url: ajax_url + "admin/content-management/home/promoted-videos/" + route_url,
                cache: false,
                processData: false, // tell jQuery not to process the data
                contentType: false,
                dataType: "json",
                //$('#addinterview-form').serialize()+'&interviewvideo='+file,
                data: userData,
                success: function (data) {
                    hideLoader();
                    if (data.status == 'fail') {
                        toastr["error"](data.msg);
                        return false;
                    } else {
                        $('#addVideo-form')[0].reset();
                        $('#publish').modal('show');
                    }
                },
                error: function (jqXHR, exception) {
                    hideLoader();
                }
            });
        }
    });

    /*========active-deactive whoiswho ==============*/

    /*========active-deactive whoiswho end ==========*/
    /*======================latest news table=====================*/
    var lnewsobj = latestNewsTbl();
    $('#ls_statusFilter').change(function () {
        lnewsobj.draw()
    });
    $('#ls_search_input').bind("keyup change", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            lnewsobj.draw()
        }

    });
    /*======================latest news table end=====================*/

    /*======================news table start=====================*/


    /*======================news table end=====================*/
    /*======================article table start =====================*/
    var mkt_art_tblobj = articles();
    $('#artinput_search').bind("keyup change", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            mkt_art_tblobj.draw()
        }


    });

    $('#artstatusFilter').bind("change", function () {
        mkt_art_tblobj.draw()
    });
    $('#artsectorFilter').bind("change", function () {
        mkt_art_tblobj.draw()
    });
    mkt_art_tblobj.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });

    /*======================article table end=====================*/
    $('#interviews').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bInfo": false,
        "bFilter": false,
        "bAutoWidth": false,
        "aoColumnDefs": [{
            bSortable: false,
            aTargets: [-1]
        }],
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "stripeClasses": [],
        "orderClasses": false,
        "columns": [
            { "width": "11vw" },
            { "width": "18vw" },
            { "width": "9vw" },
            { "width": "6vw" },
            { "width": "3vw" },
        ]
    });
    /*======================start magzine table =====================*/
    /*var mkt_mag_tbl = mktmagzintbl();

    $('#mgsearch_input').bind("blur", function () {
        mkt_mag_tbl.draw()

    });
    $('#mgstatusFilter').bind("change", function () {
        mkt_mag_tbl.draw()

    });
    mkt_mag_tbl.on( 'preDraw', function () 
    {
        //showLoader();
    }).on( 'search.dt', function () {
        hideLoader();
    }).on( 'draw.dt', function () {
        hideLoader();
    });*/
    /*======================magzine table end=====================*/

    /*======================research innovation table start=====================*/
    var res_innov_tbl = innov_tbl()
    $('#res_input_search').bind("keyup change", function (event) {

        var keycode = (event.keyCode ? event.keyCode : event.which);

        if (keycode == '13') {
            res_innov_tbl.draw()
        }

    });
    $('#res_statusFilter').bind("change", function () {
        res_innov_tbl.draw()

    });
    res_innov_tbl.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });
    /*======================research innovation table end=====================*/

    /*======================case study table start=====================*/
    var tbl_case = caseTbl();
    $('#res_search_input').bind("keyup change", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            tbl_case.draw()
        }
    });
    $('#res_statusFilter').bind("change", function () {
        tbl_case.draw()

    });
    tbl_case.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });
    /*======================case study table end=====================*/
    /*======================whitepaper table start=====================*/

    var tbl_whitepaper = whitepaperTbl()
    $('#wht_input_search').bind("keyup change", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            tbl_whitepaper.draw()
        }
    });
    $('#wht_statusFilter').bind("change", function () {
        tbl_whitepaper.draw()

    });
    tbl_whitepaper.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });
    /*======================white paper table end=====================*/
    /*======================publication table start=====================*/
    var pub_tbl = publicationTbl()
    $('#res_search_input').bind("keyup change", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            pub_tbl.draw()
        }
    });
    $('#res_statusFilter').bind("change", function () {
        pub_tbl.draw()
    });
    pub_tbl.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });
    /*======================white paper table end=====================*/
    var mkt_news_tbl = mkt_news()
    $('#nsinput_search').bind("keyup change", function (event) {

        var keycode = (event.keyCode ? event.keyCode : event.which);

        if (keycode == '13') {
            mkt_news_tbl.draw()
        }

    });

    $('#nsstatusFilter,#sectorFilter').bind("change", function () {
        mkt_news_tbl.draw()
    });
    $('#nssectorFilter').bind("change", function () {
        mkt_news_tbl.draw()
    });
    mkt_news_tbl.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });
    /*======================events table start=====================*/
    var event_tbl = eventTbl()
    $('#evn_search_input').bind("keyup change", function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            event_tbl.draw()
        }
    });
    $('#evn_monthfilter,#evn_yearfilter,#evn_statusFilter').bind("change", function () {
        event_tbl.draw()
    });
    /*event_tbl.on( 'draw', function () {
        showLoader();
    } );*/
    event_tbl.on('preDraw', function () {
        //showLoader();
    }).on('search.dt', function () {
        hideLoader();
    }).on('draw.dt', function () {
        hideLoader();
    });
    /*======================events table end=====================*/


    // Datepicker
    $(function () {
        $("#lndatepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#lnInterviewFrom").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#lnInterviewTo").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#bannerFrom").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#bannerTo").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#logoFrom").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#logoTo").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#adsFrom").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#adsTo").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#Newsdatepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#ridatepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#eventFrom").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#eventTo").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#eventdatepicker").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });
        $("#forumDate").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0 });

    });

    $(".fromdate").datepicker({
        dateFormat: 'yy-mm-dd',

        minDate: 0,
        onClose: function (selectedDate) {
            $(".todate").datepicker("option", "minDate", selectedDate);
        }
    });
    $(".todate").datepicker({
        dateFormat: 'yy-mm-dd',

        minDate: 0,
        onClose: function (selectedDate) {
            //$(".fromdate").datepicker("option", "maxDate", selectedDate);
        }
    });
    // Active Inactive text
    $('.toggle-text').click(function () {
        var checked = $('input', this).is(':checked');
        $('label', this).text(checked ? 'Active' : 'Inactive');
        $('label', this).toggleClass(checked ? 'text-blue' : '');
    });

    // File Upload
    const attachmentFileBtn = document.getElementById("upload-attachment-file");
    // const attachmentFileBtn1 = document.getElementById("upload_pdf_thumb");

    const attachmentBtn = document.getElementById("upload-attachment-button");
    // const attachmentBtn1 = document.getElementById("upload-attachment-button1");

    const attachmentTxt = document.getElementById("upload-attachment-file-name");
    // const attachmentTxt1 = document.getElementById("upload-attachment-file-name1");


    attachmentBtn.addEventListener("click", function () {
        attachmentFileBtn.click();
    });
    // attachmentBtn1.addEventListener("click", function () {
    //     attachmentFileBtn1.click();
    // });

    attachmentFileBtn.addEventListener("change", function () {
        if (attachmentFileBtn.value) {
            attachmentTxt.innerHTML = attachmentFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            attachmentTxt.innerHTML = "";
        }
    });
    // attachmentFileBtn1.addEventListener("change", function () {
    //     if (attachmentFileBtn1.value) {
    //         attachmentTxt1.innerHTML = attachmentFileBtn1.value.match(
    //             /[\/\\]([\w\d\s\.\-\(\)]+)$/
    //         )[1];
    //     } else {
    //         attachmentTxt1.innerHTML = "";
    //     }
    // });

    // File Presentation
    const presentationFileBtn = document.getElementById("upload-presentation-file");
    const presentationBtn = document.getElementById("upload-presentation-button");
    const presentationTxt = document.getElementById("upload-presentation-file-name");

    presentationBtn.addEventListener("click", function () {
        presentationFileBtn.click();
    });

    presentationFileBtn.addEventListener("change", function () {
        if (presentationFileBtn.value) {
            presentationTxt.innerHTML = presentationFileBtn.value.match(
                /[\/\\]([\w\d\s\.\-\(\)]+)$/
            )[1];
        } else {
            presentationTxt.innerHTML = "";
        }
    });

});
// $(document).on('click', '.delete_mkt_info', function () {
//     var id = $(this).data('id');
//     var ajax_url = $('#ajax_url').val();
//     $.LoadingOverlay("show");
//     $.ajax({
//         url: ajax_url + "admin/delete_mkt_info/" + id,
//         type: "GET",
//         data: { 'id': id },
//         dataType: "JSON",
//         success: function (data) {
// 			$.LoadingOverlay("hide");
//             toastr["success"]("Delete Successfully");
// 			window.location.href="";
//         }
//     });
// })
// $(document).on('click', '.delete_research_inv', function () {
//     var id = $(this).data('id');
//     var ajax_url = $('#ajax_url').val();
//     $.LoadingOverlay("show");
//     $.ajax({
//         url: ajax_url + "admin/delete_resourcelib/" + id,
//         type: "GET",
//         data: { 'id': id },
//         dataType: "JSON",
//         success: function (data) {
//             toastr["success"]("Delete Successfully");
//             $.LoadingOverlay("hide");
// 			window.location.href="";
//         }
//     });
// })
$(document).on('change', '#adspage', function () {
    var page = $(this).val();
    showLoader();
    $.ajax({
        url: ajax_url + "admin/get_adv_book_position/",
        type: "GET",
        data: { 'page': page },
        dataType: "html",
        success: function (data) {
            $('#adsposition').html('');
            $('#adsposition').html(data);
            hideLoader();
        },
        error: function (jqXHR, exception) {
            hideLoader();
        },
    });
});

function delete_research_inv() {
    if (idvic) {
        var ajax_url = $('#ajax_url').val();
        showLoader();
        $.ajax({
            url: ajax_url + "admin/delete_resourcelib/" + idvic,
            type: "GET",
            data: { 'id': idvic },
            dataType: "JSON",
            success: function (data) {
                toastr["success"]("Delete Successfully");
                hideLoader();
                window.location.href = "";
            }
        });
    }
}

function content_iddelete_company_id(id) {

    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/delete_whoiswho",
            type: "POST",
            data: { 'id': idvic },
            dataType: "JSON",
            success: function (data) {
                toastr["success"]("Delete Successfully");
                window.location.href = ajax_url + 'admin/content-management/who-is-who/whoIsWho';
            }
        });
    }
}


function reject_content() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        showLoader();
        $.ajax({
            url: ajax_url + "admin/content-management/home/latest-news/reject_interview_article_news/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                hideLoader();
                toastr["success"]("Rejected Successfully");
                // let url = ajax_url + 'admin/content-management/home/latest-news';
                //window.location.replace(url);
                window.history.back();
            },
            error: function (jqXHR, exception) {
                hideLoader();
            },
        });
    } else {
        return false;
    }
}

function content_id(id) {
    idvic = id;
}

function delete_content() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/content-management/home/latest-news/delete-latest-news/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data == true) {
                    toastr["success"]("Deleted Successfully");
                    location.reload();
                } else {
                    toastr["error"]("Failed To Delete");
                }
                idvic = 0;
            }
        });
    } else {
        return false;
    }
}

function delete_banner_logo() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/content-management/home/banners/delete_banner/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data == true) {
                    toastr["success"]("Deleted Successfully");
                    location.reload();
                } else {
                    toastr["error"]("Failed To Delete");
                }
                idvic = 0;
            }
        });
    } else {
        return false;
    }
}

function delete_advertisment() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/content-management/home/advertisement/delete_advertisement/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data == true) {
                    toastr["success"]("Deleted Successfully");
                    location.reload();
                } else {
                    toastr["error"]("Failed To Delete");
                }
                idvic = 0;
            }
        });
    } else {
        return false;
    }
}

function delete_article() {
    if (idvic) {
        var ajax_url = $('#ajax_url').val();
        showLoader();
        $.ajax({
            url: ajax_url + "admin/delete_mkt_info/" + idvic,
            type: "GET",
            data: { 'id': idvic },
            dataType: "JSON",
            success: function (data) {
                hideLoader();
                toastr["success"]("Delete Successfully");
                window.location.href = "";
            }
        });
    }
}

function preview_content(id) {
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
    $('#videoUrl').text('');
    $('#title').html($('#titles').val());
    $('#desc').html($('#description').val());

    let youtubeurl = $('#youtubeurl').val();
    let html = `<div>
    <iframe width="100%" height="240" src="` + youtubeurl + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>  `;
    if (youtubeurl == '') {
        var video_path = $('#media_data').val();
        html = `<video width="320" height="240" controls>
                <source src="` + video_path + `" type="video/mp4">
                <source src="` + video_path + `" type="video/ogg">
            Your browser does not support the video tag.
            </video>`;
    }
    $("#videoUrl").append(html);
}

function preview_banner() {
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
    $('#previewImg').text('');
    $('#title').html($('#cname').val());
    let imgPath = $('#imgPath').val();
    alert(imgPath)
    let imgHtml = `<div>
    <img src="` + ajax_url + 'upload/company/' + imgPath + `" class="img-fluid w-100 p-3" />
    </div>  `;
    $("#previewImg").append(imgHtml);
}
function preview_banner1() {
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
    //$('#previewImg').text('');
    $('#title').text($('#cname').val());
    let media_data = $('#media_data').val();

    $('#preview_img').attr('src', media_data);
    //$("#previewImg").append(imgHtml);
}
function preview_article() {
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
    $('#title').text($('#cname').val());
    $('#desc').text($('#description').val());
}
$(document).on('blur', '.youtubeurl', function () {
    var val = $(this).val();
    $('#media_data').val(val);
})
function preview_videos() {
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
    let media_data = $('#media_data').val();

    var video_type = $('input[type=radio][name=videoType]:checked').val();
    var str = '';
    if (video_type == 'mp4') {
        str = ` <video width="100%" height="240" controls>
				<source src="`+ media_data + `" id="video_tag" type="video/mp4">
			</video>`;
        $('#source_content').html(str);
    }
    else if (video_type == 'youTube') {
        str = `<iframe width="100%" height="240" src="` + media_data + `" id="ifram_tag" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        $('#source_content').html(str);
    }
    $('#title').text($('.cname').val());

    //$("#previewImg").append(imgHtml);
}
function resource_preview() {

    let media_presentation = $('#inv_video').val();
    let media_file = $('#inv_file').val();

    var title = $('.inn_name').val();
    var desc = $('.inn_desc').val();
    var Industry = $('.inn_industry').val();
    var Publisher = $('.inn_publisher').val();
    var Email = $('.inn_email').val();
    var Date = $('.ridatepicker').val();

    $('.p_title').text(title);
    $('.p_desc').text(desc);
    $('.p_sector').text(Industry);
    $('.p_publisher').text(Publisher);
    $('.p_email').text(Email);
    $('.p_date').text(Date);

    if (media_file != '') {
        //$('.p_file').attr('download',true)	
        $('.p_file').attr('data-url', media_file);
    }
    $('.p_video').attr('src', media_presentation);
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
}
function UrlExists(url) {
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status != 404;
}
$(document).on('click', '.p_file', function (e) {
    var path = $(this).attr('data-url')
    e.preventDefault();  //stop the browser from following
    if (path == '') {

        return false;
    }
    if (!UrlExists(path)) {
        return false;
    }
    var a = document.createElement('A');
    a.href = path;
    a.download = path;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);

})
function preview_magazine() {
    let media_data = $('#media_data').val();

    var str = `<iframe src="` + media_data + `" style="height:96vh;" width="100%"></iframe>`;
    $('#preview_div').html(str);
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
}
function preview_event() {

    var title = ($("#title").length > 0) ? $('#title').val() : '';
    var event_type = ($("#eventType").length > 0) ? $('#eventType').val() : '';
    var timing = ($("#eventTime").length > 0) ? $('#eventTime').val() : '';
    var desc = ($("#evn_desc").length > 0) ? $('#evn_desc').val() : '';

    $('.p_title').text(title);
    $('.p_evtype').text(event_type);
    $('.p_time').text(timing);
    $('.p_desc').text(desc);

    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })

}
function preive_virtual_vid() {
    var furl = $('#vfile').val();
    var str = `<iframe width="100%" height="240" class="" src="` + furl + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    $('.ifram_div').html(str);
    $('#preview').modal({
        backdrop: 'static',
        keyboard: false
    })
}
function readURL(input, tagid = null) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            if (tagid == null) {
                $('#media_data').val(e.target.result)
            }
            else {
                $('#' + tagid).val(e.target.result)
            }


        };
        reader.readAsDataURL(input.files[0]);
    }
}

function reject_banner_logos() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/content-management/home/banners/reject_logo_banner/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                toastr["success"]("Rejected Successfully");
                window.history.back();
            }
        });
    } else {
        return false;
    }
}

function reject_promoted_video() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/reject_promoted/",
            type: "POST",
            data: { 'id': idvic },
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Rejected Successfully");
                    window.location.href = ajax_url + 'admin/content-management/home/promoted-videos';
                }
                else {

                }

            }
        });
    } else {
        return false;
    }
}

function reject_mkt() {

    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/reject_marketing_info/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Rejected Successfully");
                    window.history.back();
                }

            }
        });
    } else {
        return false;
    }
}

function reject_resource() {

    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/reject_resource/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Rejected Successfully");
                    window.history.back();
                } else {
                    toastr["error"]("Rejected Unsuccessfully");
                }

            }
        });
    } else {
        return false;
    }
}

function reject_adv() {

    var ajax_url = $('#ajax_url').val();

    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/reject_advertisement/" + idvic,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Rejected Successfully");
                    //window.history.back();	
                } else {
                    toastr["error"]("Rejecting Fail");
                }
            }
        });
    } else {
        return false;
    }
}

function reject_whoiswho() {

    var ajax_url = $('#ajax_url').val();

    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/reject_whoiswho/" + idvic,
            type: "POST",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Rejected Successfully");
                    window.location.href = ajax_url + 'admin/content-management/who-is-who/whoIsWho';
                } else {
                    toastr["error"]("Rejecting Fail");
                }
            }
        });
    } else {
        return false;
    }
}

function add_new_news() {
    if (window.location.href.indexOf("get-latest-news") > -1) {
        var route_url = "update_latest_news";
    } else {
        var route_url = "add_new_news";
    }
    showLoader();
    var ajax_url = $('#ajax_url').val();
    $.ajax({
        type: "post",
        url: ajax_url + "admin/content-management/home/latest-news/" + route_url,
        cache: false,
        dataType: "json",
        data: $('#addnews-form').serialize(),
        success: function (data) {
            hideLoader();
            $('#publish').modal('show');
        },
        error: function (jqXHR, exception) {
            hideLoader();
        },
    });
}

// function add_interviews() {
//     var ajax_url = $('#ajax_url').val();
//     $.ajax({
//         type: "post",
//         url: ajax_url + "admin/content-management/home/latest-news/add_interviews",
//         cache: false,
//         dataType: "json",
//         data: $('#addinterview-form').serialize(),
//         success: function (data) {
//             $('#publishinterview').modal('show');
//         },
//     });
// }

// function add_banner() {
//     var ajax_url = $('#ajax_url').val();
//     $.ajax({
//         type: "post",
//         url: ajax_url + "admin/content-management/home/banners/add_banner",
//         cache: false,
//         dataType: "json",
//         data: $('#addBanner-form').serialize(),
//         success: function (data) {
//             $('#publishbanners').modal('show');
//         },
//     });
// }

function update_status_interview(id, status) {
    var ajax_url = $('#ajax_url').val();
    if (id) {
        $.ajax({
            url: ajax_url + "admin/content-management/home/latest-news/update-status/" + id + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Status Updated Successfully");
                    window.location.href = ajax_url + 'admin/content-management/market-info/interviews';
                }
                else {
                    //toastr["error"]("Status Updated Successfully");  
                }

            }
        });
    } else {
        return false;
    }
}

function update_status_promoted(id, status) {
    var ajax_url = $('#ajax_url').val();
    if (id) {
        $.ajax({
            url: ajax_url + "admin/status_promoted_video/" + id + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    toastr["success"]("Status Updated Successfully");
                    window.location.href = ajax_url + 'admin/content-management/home/promoted-videos';
                } else {
                    toastr["error"]("Status Updated Unsuccessfully");
                }

            }
        });
    } else {
        return false;
    }
}

function update_status_banner(id, status) {
    var ajax_url = $('#ajax_url').val();
    var new_status = 'enable';
    if (status == 'enable') {
        new_status = 'disable';
    }
    if (id) {
        $.ajax({
            url: ajax_url + "admin/content-management/home/banners/update-status/" + id + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data) {
                    //$(this).attr('onclick',update_status_banner(id,new_status))
                    toastr["success"]("Status Updated Successfully");
                    window.location.href = "";
                } else {
                    toastr["error"]("Status Updated Unsuccessfully");
                }

            }
        });
    } else {
        return false;
    }
}


function delete_company_id() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/content-management/who-is-who/delete_by_id/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data == true) {
                    toastr["success"]("Deleted Successfully");
                    location.reload();
                } else {
                    toastr["error"]("Failed To Delete");
                }
                idvic = 0;
            }
        });
    } else {
        return false;
    }
}
function delete_videos() {
    var ajax_url = $('#ajax_url').val();
    if (idvic) {
        $.ajax({
            url: ajax_url + "admin/delete_video",
            type: "POST",
            dataType: "JSON",
            data: { 'id': idvic },
            success: function (data) {
                if (data == true) {
                    toastr["success"]("Deleted Successfully");
                    location.reload();
                } else {
                    toastr["error"]("Failed To Delete");
                }
                idvic = 0;
            }
        });
    } else {
        return false;
    }
}
$(document).ready(function () {

    $('#addinterviewsCloseModal').click(function () {
        $('#addinterview-form')[0].reset();
        let url
        if (window.location.href.indexOf("market-info") > -1) {
            url = ajax_url + 'admin/content-management/market-info/interviews';
        } else {
            url = ajax_url + 'admin/content-management/home/latest-interview';
        }
        window.location.replace(url);
    });
    $('#addNewsCloseModal').click(function () {
        $('#addnews-form')[0].reset();
        let url
        if (window.location.href.indexOf("market-info") > -1) {
            url = ajax_url + 'admin/content-management/market-info/news';
        } else {
            url = ajax_url + 'admin/content-management/home/latest-news';
        }
        window.location.replace(url);
    });
    $('#addBannerCloseModal').click(function () {
        $('#addBanner-form')[0].reset();
        let url = ajax_url + 'admin/content-management/home/banners';
        window.location.replace(url);
    });


    // Pagination
    $(".banner-pagination a").addClass("page-link");

});

function latestNewsTbl() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#latestNews").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "bFilter": false,
        "info": false,
        "lengthChange": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            hideLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_latestnews_list_json',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#ls_search_input").val(),
                    "filter_option": $("#ls_statusFilter").val(),
                    'section': 'news',
                    'length': '6',
                });
            }
        },
        columns: [{
            "data": "vic_bn_title",
            "name": "vic_bn_title",
        },
        {
            "data": "vic_bn_createdat",
            "name": "vic_bn_createdat",
        },
        {
            "data": "vic_updated_at",
            "name": "vic_updated_at",
            'render': function (data, type, row) {
                //console.log(row.idvic_blogs_news,row)
                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            "data": 'vic_modification_status',
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            }
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="latest-news/get-latest-news/` + row.idvic_blogs_news + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="modal" data-target="#deleteNewsModal"  onclick="content_id(` + row.idvic_blogs_news + `)" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            }
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function mkt_news() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#News").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        processing: false,
        serverSide: true,
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        ajax: {
            "url": ajax_url + 'admin/get_mktnews_list_json',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#nsinput_search").val(),
                    "filter_option": $("#nsstatusFilter").val(),
                    "sectorFilter": $("#nssectorFilter").val(),
                    "mkt": 'news'
                });
            }
        },
        columns: [{
            "data": "vic_news_category",
            "name": "vic_news_category",
            //    "width": "11vw"
        },
        {
            "data": "vic_bn_title",
            "name": "vic_bn_title",
            //    "width": "11vw"
        },
        {
            "data": "vic_bn_createdat",
            "name": "vic_bn_createdat",
            "width": "10vw"
        },
        {
            "data": "vic_updated_at",
            "name": "vic_updated_at",
            "width": "8vw",
            'render': function (data, type, row) {



                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/content-management/home/market-info/get-latest-news/` + row.idvic_blogs_news + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="modal" data-target="#deleteNewsModal"  onclick="content_id(` + row.idvic_blogs_news + `)" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function articles() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#articles").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "bFilter": false,
        "info": false,
        "lengthChange": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_mktnews_list_json',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#artinput_search").val(),
                    "filter_option": $("#artstatusFilter").val(),
                    "sectorFilter": $("#artsectorFilter").val(),
                    "mkt": 'article'
                });
            }
        },
        columns: [{
            "data": "vic_news_category",
            "name": "vic_news_category",
            "width": "11vw"
        },
        {
            "data": "vic_description",
            "name": "vic_description",
            "width": "11vw"
        },

        {
            "data": "vic_updated_at",
            "name": "vic_updated_at",
            "width": "8vw",
            'render': function (data, type, row) {

                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/edit_marketing_info/` + row.idvic_blogs_news + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="modal" data-target="#deleteModal"  onclick="content_id(` + row.idvic_blogs_news + `)" data-id="` + row.idvic_blogs_news + `" class="ml-3 delete_mkt_info"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function mktmagzintbl() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#magazine").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_mktnews_list_json',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#mgsearch_input").val(),
                    "filter_option": $("#mgstatusFilter").val(),
                    'mkt': 'magzine'
                });
            }
        },
        columns: [{
            "data": "vic_bn_title",
            "name": "vic_bn_title",
            "width": "11vw"
        },
        {
            "data": "vic_bn_createdat",
            "name": "vic_bn_createdat",
            "width": "11vw"
        },

        {
            "data": "vic_updated_at",
            "name": "vic_updated_at",
            "width": "8vw",
            'render': function (data, type, row) {

                if (row.MIN < 60 && row.MIN != null) {
                    return row.MIN + ' Minutes ago';
                } else if (row.hours > 24 && row.min > 60) {
                    return row.hours + ' Hours ago';
                } else if (row.DAY != null && row.DAY != 0) {
                    return row.DAY + ' Days ago';
                } else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/edit_marketing_info/` + row.idvic_blogs_news + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						
                        <a data-toggle="modal" data-target="#deleteNewsModal"  onclick="content_id(` + row.idvic_blogs_news + `)" data-id="` + row.idvic_blogs_news + `" class="ml-3"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function innov_tbl() {

    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#ResearchInnovations").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_resource_jsonlist',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#res_input_search").val(),
                    "filter_option": $("#res_statusFilter").val(),
                    'rec': 'innovation'
                });
            }
        },
        columns: [{
            "data": "vic_resource_title",
            "name": "vic_resource_title",
            "width": "11vw"
        },
        {
            "data": "vic_resource_desc",
            "name": "vic_resource_desc",
            "width": "11vw"
        },

        {
            "data": "vic_resource_date",
            "name": "vic_resource_date",
            "width": "8vw",
            'render': function (data, type, row) {

                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/edit/resource-library/` + row.idvic_resource_library + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="modal" data-target="#deleteModal"  onclick="content_id(` + row.idvic_resource_library + `)" data-id="` + row.idvic_resource_library + `"  class="ml-3 "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function caseTbl() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#caseStudy").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_resource_jsonlist',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#res_search_input").val(),
                    "filter_option": $("#res_statusFilter").val(),
                    'rec': 'case_study'
                });
            }
        },
        columns: [{
            "data": "vic_resource_title",
            "name": "vic_resource_title",
            "width": "11vw"
        },
        {
            "data": "vic_resource_desc",
            "name": "vic_resource_desc",
            "width": "11vw"
        },

        {
            "data": "vic_resource_date",
            "name": "vic_resource_date",
            "width": "8vw",
            'render': function (data, type, row) {

                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/edit/resource-library/` + row.idvic_resource_library + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a data-toggle="modal" data-target="#deleteModal"  onclick="content_id(` + row.idvic_resource_library + `)" data-id="` + row.idvic_resource_library + `"  class="ml-3 "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function whitepaperTbl() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#whitePaper").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_resource_jsonlist',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#wht_input_search").val(),
                    "filter_option": $("#wht_statusFilter").val(),
                    'rec': 'whitepapers'
                });
            }
        },
        columns: [{
            "data": "vic_resource_title",
            "name": "vic_resource_title",
            "width": "11vw"
        },
        {
            "data": "vic_resource_desc",
            "name": "vic_resource_desc",
            "width": "11vw"
        },

        {
            "data": "vic_resource_date",
            "name": "vic_resource_date",
            "width": "8vw",
            'render': function (data, type, row) {

                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/edit/resource-library/` + row.idvic_resource_library + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a data-toggle="modal" data-target="#deleteModal"  onclick="content_id(` + row.idvic_resource_library + `)" data-id="` + row.idvic_resource_library + `"  class="ml-3 "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function publicationTbl() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#publications").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {
                api.search(this.value).draw();
            });
        },
        oLanguage: {
            sProcessing: "loading..."
        },
        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_resource_jsonlist',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#res_search_input").val(),
                    "filter_option": $("#res_statusFilter").val(),
                    'rec': 'publication'
                });
            }
        },
        columns: [{
            "data": "vic_resource_title",
            "name": "vic_resource_title",
            "width": "11vw"
        },
        {
            "data": "vic_resource_desc",
            "name": "vic_resource_desc",
            "width": "11vw"
        },

        {
            "data": "vic_resource_date",
            "name": "vic_resource_date",
            "width": "8vw",
            'render': function (data, type, row) {

                if (row.MIN < 60) {
                    return row.MIN + ' Minutes ago';
                }
                if (row.hours < 24) {
                    return row.hours + ' Hours ago';
                }
                if (row.DAY != 0 && row.DAY != null) {
                    return row.DAY + ' Days ago';
                }
                else {
                    return '';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/edit/resource-library/` + row.idvic_resource_library + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a data-toggle="modal" data-target="#deleteModal"  onclick="content_id(` + row.idvic_resource_library + `)" data-id="` + row.idvic_resource_library + `"  class="ml-3 "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function eventTbl() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var tbl_obj = $("#events").DataTable({
        initComplete: function () {
            var api = this.api();
            $('#myTable_filter input').off('.DT').on('input.DT', function () {

                api.search(this.value).draw();
            });
        },

        language: {
            paginate: {
                next: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-left" aria-hidden="true"></i>'
            }
        },
        "initComplete": function (oSettings, json) {
            hideLoader();
        },
        "drawCallback": function (settings) {
            showLoader();
        },
        "info": false,
        "lengthChange": false,
        "bFilter": false,
        processing: false,
        serverSide: true,
        ajax: {
            "url": ajax_url + 'admin/get_events_jsonlist',
            "type": "POST",
            "data": function (d) {
                hideLoader();
                return $.extend({}, d, {
                    "search[value]": $("#evn_search_input").val(),
                    "eventfilter": $("#evn_statusFilter").val(),
                    "monthfilter": $("#evn_monthfilter").val(),
                    "yearfilter": $("#evn_yearfilter").val(),
                });
            }
        },
        columns: [{
            "data": "vic_eventtitle",
            "name": "vic_eventtitle",
            "width": "11vw"
        },
        {
            "data": "vic_eventtype",
            "name": "vic_eventtype",
            "width": "11vw"
        },

        {
            "data": "vic_date",
            "name": "vic_date",
            "width": "8vw"
        },
        {
            "data": "vic_eventtime",
            "name": "vic_eventtime",
            "width": "8vw"
        },
        {
            "data": "vic_modification_at",
            "name": "vic_modification_at",
            "width": "8vw",
            'render': function (data, type, row) {
                console.log(row.idvic_events, row)
                if (parseInt(row.MIN) < 60 && row.MIN != null) {
                    return row.MIN + ' Minutes ago';
                }
                if (parseInt(row.hours) < 24) {

                    return row.hours + ' Hours ago';
                }
                if (row.DAY == null && row.DAY == 0) {
                    return '';
                } else {
                    return row.DAY + ' Days ago';
                }
            }
        },
        {
            'render': function (data, type, row) {
                var isPublish = '';
                if (row.vic_modification_status == 'Published') {
                    isPublish = `<p class="text-green">` + row.vic_modification_status + `</p>`;
                } else if (row.vic_modification_status == 'Under Review') {
                    isPublish = `<p class="text-blue">` + row.vic_modification_status + `</p>`;
                } else {
                    isPublish = `<p class="text-red">` + row.vic_modification_status + `</p>`;
                }
                return isPublish;
            },
            "width": "6vw",
        },
        {
            "render": function (data, type, row) {
                return `<div class="action-btn-wrap">
						<a href="` + ajax_url + `admin/editEvents/` + row.idvic_events + `"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
						<a data-toggle="modal" data-target="#deleteModal" data-id="` + row.idvic_events + `" onclick="content_id(` + row.idvic_events + `)"  class="ml-3 delete_event"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
					</div>`;
            },
            "width": "3vw"
        },
        ],
        order: [
            [1, 'desc']
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        }

    });
    return tbl_obj;
}

function update_status_prom_video(id, status) {

    var ajax_url = $('#ajax_url').val();
    if (id) {

        $.ajax({
            url: ajax_url + "admin/content-management/home/promoted_video/update-status/" + id + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                toastr["success"]("Status Updated Successfully");
            }
        });
    } else {
        return false;
    }
}

function delete_prom_video() {

    var ajax_url = $('#ajax_url').val();

    if (idvic) {

        $.ajax({
            url: ajax_url + "admin/promoted_video/delete_promoted/" + idvic,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                if (data.status == false) {
                    toastr["error"](data.msg);
                } else {
                    toastr["success"]("Vidoe Deleted Successfully");
                    window.location.href = "";
                }

            }
        });
    } else {
        return false;
    }
}

function update_status_advertisment(id, status) {
    var ajax_url = $('#ajax_url').val();
    if (id) {

        $.ajax({
            url: ajax_url + "admin/content-management/home/advertisement/status_advertisement/" + id + "/" + status,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                toastr["success"]("Status Updated Successfully");
            }
        });
    } else {
        return false;
    }
}
/*==============Latest Interview Section=====================*/
$(document).on('keypress', '#ltnews_search_input', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#ltnews_statusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/latest_interview_search_list';
    obj.input = input;
    obj.drop = value;
    obj.type = 'interview';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#ltnews_statusFilter', function () {

    var value = $('#ltnews_search_input').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/latest_interview_search_list';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'interview';
    serachData(obj)
})
/*==============Latest Interview Section End=====================*/
/*==============Banner Section=====================*/
$(document).on('keypress', '#input_search', function (event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#statusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/banner_search';
    obj.input = input;
    obj.drop = value;
    obj.type = 'slider';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#statusFilter', function () {

    var value = $('#input_search').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/banner_search';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'slider';
    serachData(obj)
})
/*==============Banner Section End=====================*/
/*==============interview Section=====================*/
$(document).on('keypress', '#int_input_search', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#IntstatusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/latest_interview_search_list';
    obj.input = input;
    obj.drop = value;
    obj.type = 'interview';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#IntstatusFilter', function () {

    var value = $('#int_input_search').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/latest_interview_search_list';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'interview';
    serachData(obj)
})
/*==============interview Section End=====================*/
/*==============virtual Section=====================*/
$(document).on('keypress', '#vrtinput_search', function (event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#vrtstatusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/latest_interview_search_list';
    obj.input = input;
    obj.drop = value;
    obj.type = 'virtual';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#vrtstatusFilter', function () {

    var value = $('#vrtinput_search').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/latest_interview_search_list';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'virtual';
    serachData(obj)
})
/*==============virtual Section End=====================*/
/*==============Logo Section=====================*/
$(document).on('keypress', '#log_input_search', function (event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#logostatusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/banner_search';
    obj.input = input;
    obj.drop = value;
    obj.type = 'banner';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#logostatusFilter', function () {

    var value = $('#log_input_search').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/banner_search';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'banner';
    serachData(obj)
})
/*==============logo Section End=====================*/
/*==============Promoted Section=====================*/
$(document).on('keypress', '#promoted_input', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#promoted_statusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/promoted_video_search';
    obj.input = input;
    obj.drop = value;
    obj.limit = 3;
    obj.type = 'promoted_video';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#promoted_statusFilter', function () {

    var value = $('#promoted_input').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/promoted_video_search';
    obj.input = value;
    obj.drop = drop;
    obj.limit = 3;
    obj.type = 'promoted_video';
    serachData(obj)
})
/*==============Promoted Section End=====================*/
/*==============advertizment Section=====================*/
$(document).on('keypress', '#adv_input_serach', function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#adv_statusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/adv_video_search';
    obj.input = input;
    obj.drop = value;
    obj.limit = 3;
    obj.type = 'adv_video';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#adv_statusFilter', function () {

    var value = $('#adv_input_serach').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/adv_video_search';
    obj.input = value;
    obj.limit = 3;
    obj.drop = drop;
    obj.type = 'adv_video';
    serachData(obj)
})
/*==============advertizment Section End=====================*/
/*==============whoiswho Section=====================*/
$(document).on('keypress', '#who_input_search', function (event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#whostatusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/who_video_search';
    obj.input = input;
    obj.drop = value;
    obj.type = 'whoiswho';

    if (keycode == '13') {
        serachData(obj);
    }
})
$(document).on('change', '#whostatusFilter', function () {

    var value = $('#who_input_search').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/who_video_search';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'whoiswho';
    serachData(obj)
})
/*==============whoiswho Section End=====================*/
/*==============magazine Section=====================*/
$(document).on('keypress', '#mgsearch_input', function (event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    var value = $('#mgstatusFilter').val()
    var input = $(this).val()
    var obj = {};

    obj.url = ajax_url + 'admin/search_marketing_data';
    obj.input = input;
    obj.drop = value;
    obj.type = 'magazine';
    if (keycode == '13') {
        serachData(obj);
    }

})
$(document).on('change', '#mgstatusFilter', function () {

    var value = $('#mgsearch_input').val();
    var drop = $(this).val()

    var obj = {};
    obj.url = ajax_url + 'admin/search_marketing_data';
    obj.input = value;
    obj.drop = drop;
    obj.type = 'magazine';
    serachData(obj)
})
/*==============whoiswho Section End=====================*/
function serachData(obj) {
    if (obj.input == '' && obj.drop == '') {
        //$('#list_div').show()
        return false;
    }
    showLoader();
    $.ajax({
        type: "POST",
        url: obj.url,
        data: obj,
        dataType: 'json',
        success: function (data) {
            hideLoader();
            if (virtual_design(data) && obj.type == 'virtual') {
                $('#result_div').html('').html(virtual_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (interview(data) && obj.type == 'interview') {
                $('#result_div').html('').html(interview(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (banner_design(data) && obj.type == 'slider') {

                $('#result_div').html('').html(banner_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (logo_design(data) && obj.type == 'banner') {

                $('#result_div').html('').html(logo_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (prom_video_design(data) && obj.type == 'promoted_video') {

                $('#result_div').html('').html(prom_video_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (adv_videos_design(data) && obj.type == 'adv_video') {

                $('#result_div').html('').html(adv_videos_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (whoiswho_videos_design(data) && obj.type == 'whoiswho') {

                $('#result_div').html('').html(whoiswho_videos_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            }
            if (obj.type == 'magazine') {

                $('#result_div').html('').html(magazin_design(data))
                $('#list_div').hide()
                $('#result_div').show()
                return false;
            } else {
                $('#list_div').hide()
                $('#result_div').html('<h2 class="text-blue" style="margin:auto;">Result Not Found</h2>').show()
                //toastr["error"]("Data Not Found");
                $('.pagination').hide();
                $('input:text').val(null)
                $('select').prop('selectedIndex', 0);

            }

        },
        error: function (request, status, error) {
            hideLoader()
        }
    })
}

function magazin_design(data) {
    var str = '';


    $.each(data, function (k, v) {

        var isChecked = (v.vic_bn_status == 'active') ? 'checked' : '';
        var status_text = (v.vic_bn_status == 'active') ? 'Active' : 'Inactive';
        var lbl_color = '';
        if (v.vic_modification_status == 'Published') {
            lbl_color = '<span class="text-red text-green-light f-14">Published</span>';
        }
        else if (v.vic_modification_status == 'Rejected') {
            lbl_color = '<span class="text-red f-14">Rejected</span>';
        }
        else if (v.vic_modification_status == 'Under Review') {
            lbl_color = '<span class="text-blue f-14">Rejected</span>';
        }
        var functions = (v.vic_bn_status == 'active') ? "change_status_mkg(" + v.idvic_blogs_news + ",'inactive')" : "change_status_mkg(" + v.idvic_blogs_news + ",'active')";
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <img src="` + ajax_url + `upload/marketing_info/` + v.vic_bn_image + `" class="card-img2"/>
                            <div class="card-body text-center">
                                <a href="` + ajax_url + v.vic_bn_document_url + `" target="_blank" class="card-title f-14 text-blue cp">` + v.vic_bn_title + `</a>
                                <p class="card-text  fs-13 mb-2">`+ v.vic_bn_createdat + ' ' + lbl_color + `</p>

                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="` + ajax_url + `'admin/edit_marketing_info/'` + v.idvic_blogs_news + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>

                                    <a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                        <input type="checkbox" id="check1" class="mr-2" ` + isChecked + ` onclick="` + functions + `" >
                                        <label for="check1" class="m-0 text-blue">`+ status_text + `</label>
                                    </a>
                                    <a href="#" data-toggle="modal" onclick="content_id('` + v.idvic_blogs_news + `')" data-target="#deleteNewsModal"  class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;


    });

    if (str == '') {
        str = false;
    }

    return str;
}

function interview(data) {

    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_bn_status == 'active') {
            anch = `<a href="javascript:void(0)" onclick="update_status_interview(` + v.idvic_blogs_news + `, 'inactive')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2" checked="true"><label for="check1" class="m-0 text-blue">Active</label></a>`;
        } else {
            anch = `<a href="javascript:void(0)" onclick="update_status_interview(` + v.idvic_blogs_news + `, 'active')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2"><label for="check1" class="m-0 text-blue">Inactive</label></a>`;
        }

        var status = (v.vic_modification_status == 'Rejected') ? '<span class="text-red f-14">Rejected</span>' : v.vic_modification_status;
        var date = (v.vic_updated_at != '') ? v.vic_updated_at : v.vic_bn_createdat;
		var video_tag=''
		if (v.vic_blogs_news_video != '') {
			video_tag = ` <video width="100%" height="240" controls src="`+ajax_url+`upload/interviews/`+v.vic_blogs_news_video + `" id="" type="video/mp4"></video>`;
			
		}
		else if (v.vic_bn_youtubeURL != '') {
			video_tag = `<iframe width="100%" height="240" src="` + v.vic_bn_youtubeURL + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
			
		}
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            `+video_tag+`
                            <div class="card-body text-center">
                                <h6 class="card-title f-14 text-blue" title="2020 IDMA">` + v.vic_bn_title + `</h6>
                                <p class="card-text text-green-light fs-13 mb-2">` + v.vic_bn_createdat + ` ` + status + `</p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="` + ajax_url + `admin/edit_marketing_info/` + v.idvic_blogs_news + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
									` + anch + `
                                    <a href="#" data-toggle="modal" data-target="#deleteNewsModal" onclick="content_id(` + v.idvic_blogs_news + `)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function whoiswho_videos_design(data) {

    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_company_is_active == 'active') {
            anch = `<a href="javascript:void(0)" class="btn btn-card toggle-text">
						<input type="checkbox" id="check1" class="mr-2 update_status_who" checked="true" onclick="whoiswho_status(` + v.idvic_company + `,'inactive')">
						<label for="check" class="m-0 text-blue">Active</label>
					</a>`;
        } else {
            anch = `<a href="javascript:void(0)" class="btn btn-card toggle-text">
						<input type="checkbox" id="check1" class="mr-2 update_status_who" onclick="whoiswho_status(` + v.idvic_company + `,'active')">
						<label for="check" class="m-0 text-blue">Inactive</label>
					</a>`;
        }


        var status = (v.vic_company_status == 'Rejected') ? '<span class="text-red f-14">Rejected</span>' : v.vic_company_status;
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('` + ajax_url + `upload/company/` + v.vic_companylogo + `');">
                            </div>
                            <div class="card-body text-center">
							   	
                                <p class="card-text text-green-light fs-13 mb-2">` + v.vic_companyname + ` ` + v.vic_company_created_on + `  ` + status + `</p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="` + ajax_url + `admin/contentmanagement/WhoIsWhoController/get_company_details_by_ids/` + v.idvic_company + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
									` + anch + `   
                                    <a href="#" class="btn btn-card"  data-toggle="modal" data-target="#deleteNewsModal" onclick="content_id(` + v.idvic_company + `)"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function adv_videos_design(data) {
    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_advertisment_is_active == 'active') {
            anch = `<a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                            <input type="checkbox" onclick="update_status_advertisment(` + v.idvic_advertisment + `, 'inactive')" id="check1" class="mr-2" checked="true"><label for="check" class="m-0 text-blue">Active</label></a>`;
        } else {
            anch = `<a href="javascript:void(0)"  class="btn btn-card toggle-text">
                                            <input type="checkbox" onclick="update_status_advertisment(` + v.idvic_advertisment + `, 'active')" id="check1" class="mr-2"><label for="check" class="m-0 text-blue">Active</label></a>`;
        }

        var date = v.vic_advertisment_created_on;
        var sstatus = (v.vic_advertisment_status == 'Rejected') ? '<span class="text-red f-14">Rejected</span>' : v.vic_advertisment_status;
        if (v.vic_advertisment_status == 'Rejected') {
            sstatus = '<span class="text-red f-14">Rejected</span>';
        }
        else if (v.vic_advertisment_status == 'Under Review') {
            sstatus = '<span class="text-blue f-14">Under Review</span>'
        }
        else {
            sstatus = v.vic_advertisment_status;
        }
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('` + ajax_url + `upload/advertisment/` + v.vic_advertisment_img_path + `');">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text text-green-light fs-13 mb-2">` + v.vic_advertisment_created_on + ` ` + sstatus + `</p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="` + ajax_url + `admin/content-management/home/advertisement/get-advertisement-news/` + v.idvic_advertisment + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                    ` + anch + `
                                    <a href="#" data-toggle="modal" data-target="#deleteAdvertismentModal" onclick="content_id(` + v.idvic_advertisment + `)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function prom_video_design(data) {
    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_promoted_video_is_active == 'active') {
            anch = `<a href="javascript:void(0)" class="btn btn-card toggle-text"><input type="checkbox" id="check` + v.idvic_promoted_video + `" class="mr-2" checked="true" onclick="update_status_promoted(` + v.idvic_promoted_video + `,'disable')"><label for="check` + v.idvic_promoted_video + `" class="m-0 text-blue">Active</label></a>`;
        } else {
            anch = `<a href="javascript:void(0)" class="btn btn-card toggle-text"><input type="checkbox" id="check` + v.idvic_promoted_video + `" class="mr-2" onclick="update_status_promoted(` + v.idvic_promoted_video + `,'enable')"><label for="check` + v.idvic_promoted_video + `" class="m-0 text-blue">Inactive</label></a>`;
        }

        var date = (v.vic_updated_at != '') ? v.vic_updated_at : v.vic_bn_createdat;
        var sstatus = (v.vic_promoted_video_status == 'Rejected') ? '<span class="text-red f-14">Rejected</span>' : v.vic_promoted_video_status;
        if (v.vic_promoted_video_status == 'Rejected') {
            sstatus = '<span class="text-red f-14">Rejected</span>';
        }
        else if (v.vic_promoted_video_status == 'Under Review') {
            sstatus = '<span class="text-blue f-14">Under Review</span>';
        }
        else {
            sstatus = v.vic_promoted_video_status;
        }
        var vid_url = (v.vic_promoted_video_url != '') ? v.vic_promoted_video_url : ajax_url + 'upload/promoted/' + v.vic_promoted_upload_video;
        var video_tag = '';
        if (v.vic_promoted_video_url != '') {
            video_tag = `<iframe class="card-img" src="` + vid_url + `" autoplay="0" frameborder="0" allow="accelerometer; autoplay="0"; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
        }
        else if (v.vic_promoted_upload_video != '') {
            video_tag = `<video controls="true" class="embed-responsive-item">
						  <source src="`+ ajax_url + `upload/promoted/` + v.vic_promoted_upload_video + `" type="video/mp4" />
						</video>`;
        }
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
				<div class="interviews-card-wrapper w-100">
					<div class="card">
						`+ video_tag + `
						<div class="card-body text-center">
							<h6 class="card-title f-14 text-blue" title="2020 IDMA">` + v.vic_promoted_video_title + `</h6>
							<p class="card-text text-green-light fs-13 mb-2">` + v.vic_created_at + ` ` + sstatus + `</p>
							<div class="btn-group w-100" role="group" aria-label="Basic example">
								<a href="` + ajax_url + `admin/edit_promoted_video/` + v.idvic_promoted_video + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
								` + anch + `
								<a  href="javascript:void(0)" data-toggle="modal" data-target="#deleteLogoModal" onclick="content_id(` + v.idvic_promoted_video + `)" class="btn btn-card toggle-text"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function logo_design(data) {
    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_banner_is_active == 'enable') {
            anch = `<a href="javascript:void(0)" onclick="update_status_banner(` + v.vic_banner_id + `, 'disable')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2" checked="true"><label for="check" class="m-0 text-blue">Active</label></a>`;
        } else {
            anch = `<a href="javascript:void(0)" onclick="update_status_banner(` + v.vic_banner_id + `, 'enable')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2"><label for="check" class="m-0 text-blue">Inactive</label></a>`;
        }
        var sstatus = `<p class="card-text text-green-light fs-13 mb-2">Published</p>`;
        if (v.vic_banner_status == 'Rejected') {
            sstatus = `<span class="text-red f-14">Rejected</span>`;
        }
        else if (v.vic_banner_status == 'Published') {
            sstatus = `Published`;

        }
        else if (v.vic_banner_status == 'Under Review') {
            sstatus = `<span class="text-blue f-14">Under Review</span>`;
        }
        var date = (v.vic_updated_at != '') ? v.vic_updated_at : v.vic_bn_createdat;
        var status = (v.vic_banner_status == 'Rejected') ? '<span class="text-red f-14">Rejected</span>' : v.vic_banner_status;
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('` + ajax_url + `upload/company/` + v.vic_logo_image_path + `')">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-text text-green-light fs-13 mb-2">` + v.vic_banner_created_on + ` ` + sstatus + `</p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="` + ajax_url + `admin/content-management/home/logos/get_logo_by_id/` + v.vic_banner_id + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                    ` + anch + `
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#deleteLogoModal" onclick="content_id(` + v.vic_banner_id + `)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function banner_design(data) {
    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_banner_is_active == 'enable') {
            anch = `<a href="javascript:void(0)" onclick="update_status_banner(` + v.vic_banner_id + `, 'disable')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2" checked="true"><label for="check" class="m-0 text-blue">Active</label></a>`;
        } else {
            anch = `<a href="javascript:void(0)" onclick="update_status_banner(` + v.vic_banner_id + `, 'enable')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2"><label for="check" class="m-0 text-blue">Inactive</label></a>`;
        }
        var sstatus = `<p class="card-text text-green-light fs-13 mb-2">Published</p>`;
        if (v.vic_banner_status == 'Rejected') {
            sstatus = `<span class="text-red f-14">Rejected</span>`;
        }
        else if (v.vic_banner_status == 'Published') {
            sstatus = `Published`;

        }
        else if (v.vic_banner_status == 'Under Review') {
            sstatus = `<span class="text-blue f-14">Under Review</span>'`;
        }
        var date = (v.vic_updated_at != '') ? v.vic_updated_at : v.vic_bn_createdat;
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <div class="card-img" style="background: url('` + ajax_url + 'upload/banner/' + v.vic_banner_image + `');">
                            </div>
                            <div class="card-body text-center">
                                <h6 class="card-title f-14 text-blue" title="VICTAM and Animal Health and Nutrition">` + v.vic_banner_title + `</h6>
                                <p class="card-text text-green-light fs-13 mb-2">`+ v.vic_banner_created_on + ` ` + sstatus + `</p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="` + ajax_url + 'admin/content-management/home/banners/get_banner_by_id/' + v.vic_banner_id + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
                                    ` + anch + `
                                    <a href="#" data-toggle="modal" data-target="#deleteBannerModal" onclick="content_id(` + v.vic_banner_id + `)" class="btn btn-card"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function virtual_design(data) {
    var str = '';
    $.each(data, function (k, v) {
        var anch = '';
        if (v.vic_promoted_video_is_active == 'active') {
            anch = `<a href="javascript:void(0)" onclick="update_status_interview(` + v.idvic_promoted_video + `, 'inactive')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2 change_status" checked="true"><label for="check1" class="m-0 text-blue">Active</label></a>`;
        } else {
            anch = `<a href="javascript:void(0)" onclick="update_status_interview(` + v.idvic_promoted_video + `, 'active')" class="btn btn-card toggle-text"><input type="checkbox" id="check1" class="mr-2 change_status"><label for="check1" class="m-0 text-blue">Inactive</label></a>`;
        }

        var status_text = 'Inactive';
        var status_color = 'text-red';
        if (v.vic_promoted_video_is_active == 'active') {
            var ischecked = 'checked="true"';
            var status_text = 'Active';
            status_color = 'text-green-light';
        }
        str += `<div class="col-sm-3 pl-1 pr-3 mb-3">
                    <div class="interviews-card-wrapper w-100">
                        <div class="card">
                            <iframe class="card-img" src="` + v.vic_promoted_video_url + `" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <div class="card-body text-center">
                                <h6 class="card-title f-14 text-blue" title="2020 IDMA">` + v.vic_promoted_video_title + `</h6>
                                <p class="card-text `+ status_color + ` fs-13 mb-2">` + status_text + `</p>
                                <div class="btn-group w-100" role="group" aria-label="Basic example">
                                    <a href="`+ ajax_url + `admin/edit_videos/` + v.idvic_promoted_video + `" class="btn btn-card"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i>Edit</a>
									<a  class="btn btn-card toggle-text "><input type="checkbox"  data-id="`+ v.idvic_promoted_video + `" id="check1" class="mr-2 change_status"` + ischecked + `><label for="check" class="m-0 text-blue">` + status_text + `</label></a>
                                    <a  class="btn btn-card" data-toggle="modal" data-target="#deleteModal" onclick="content_id(`+ v.idvic_promoted_video + `)"><i class="fa fa-trash-o mr-2" aria-hidden="true"></i>Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
    });
    if (str == '') {
        str = false;
    }
    return str;
}

function whoiswho_status(id, status) {

    $.ajax({
        type: "post",
        url: ajax_url + "admin/change_status_whoiswho",
        dataType: "json",
        //$('#addinterview-form').serialize()+'&interviewvideo='+file,
        data: { 'id': id, 'status': status },
        success: function (data) {
            toastr["success"]("Change Status Successfully");
        },
    });
}

function change_status_mkg(id, status) {
    $.ajax({
        type: "get",
        url: ajax_url + "admin/edit_marketing_status/" + id + "/" + status,
        dataType: "json",
        success: function (data) {
            if (data) {
                toastr["success"]("Change Status Successfully");
                window.location.href = "";
            } else {
                toastr["error"]("Change Status Fail");
            }

        },
    });
}