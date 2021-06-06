$(document).ready(function() {

    $('.menu-item-drp').each(function() {
        var $menuItem = $(this);
        $("a.menu-item-link-dropdown", $menuItem).click(function(e) {
            // var $currentItem = $(this);
            // $($currentItem).find(".down-arrow").toggleClass("rotate-arrow");
            e.preventDefault();
            $subMenuItem = $(".sub-menu-items-wrap", $menuItem);
            $subMenuItem.slideToggle();
            $(".sub-menu-items-wrap").not($subMenuItem).slideUp();
            return false;
        });
    });

    $(function() {
        $('.menu-items-wrap .menu-item').on('click', function() {
            $(".menu-items-wrap").find('.menu-item.active').removeClass('active');
            $(this).toggleClass('active');
        });

        $('.sub-menu-items-wrap .sub-menu-item').on('click', function() {
            $(".sub-menu-items-wrap").find('.sub-menu-item.active').removeClass('active');
            $(this).toggleClass('active');
        });

        $('.menu-item-link-dropdown').on('click', function() {
            $(".menu-item-drp").find('.menu-item-link-dropdown.active').removeClass('active');
            $(this).toggleClass('active');
        });
    });

    $(".menu-close-icon").on('click', function() {
        // $(".h-small-menu").toggle();
        // $(".side-menu-wrapper").toggleClass("w-22vw");
        $(".menu-close-wrap").toggleClass("ml-10r");
        $(".menu-close-icon").toggleClass("rotate-180");
        $(".body-wrapper").toggleClass("pl-24vw");
        $(".big-side-menu").toggleClass("m-left-25");
        $(".small-side-menu").toggleClass("m-left-10");
        $(".small-sub-menu-items-wrap").hide();
    });

    $(document).click(function() {
        $(".home-sub-menu").hide();
        $(".mi-sub-menu").hide();
        $(".rl-sub-menu").hide();
        $(".ve-sub-menu").hide();
    });

    $(".small-sub-menu-items-wrap").hide();
    $(".home-menu").on('click', function() {
        $(".home-sub-menu").toggle(50);
        $(".mi-sub-menu").hide();
        $(".rl-sub-menu").hide();
        $(".ve-sub-menu").hide();
    });
    $(".mi-menu").on('click', function() {
        $(".mi-sub-menu").toggle(50);
        $(".home-sub-menu").hide();
        $(".rl-sub-menu").hide();
        $(".ve-sub-menu").hide();
    });
    $(".rl-menu").on('click', function() {
        $(".rl-sub-menu").toggle(50);
        $(".home-sub-menu").hide();
        $(".mi-sub-menu").hide();
        $(".ve-sub-menu").hide();
    });
    $(".ve-menu").on('click', function() {
        $(".ve-sub-menu").toggle(50);
        $(".home-sub-menu").hide();
        $(".rl-sub-menu").hide();
        $(".mi-sub-menu").hide();
    });

    if (window.location.href.indexOf("home") > -1) {
        $("#homeMenuItem").click();
    }
    if (window.location.href.indexOf("market-info") > -1 || window.location.href.indexOf("edit_marketing_info") > -1) {
        $("#marketMenuItem").click();
    } else if (window.location.href.indexOf("resource-library") > -1) {
        $("#resourceMenuItem").click();
    } else if (window.location.href.indexOf("virtual-entertainment") > -1 || window.location.href.indexOf("edit_videos") > -1) {
        $("#virtualEntertainment").click();
    }

    timeout = setInterval(get_count, 5000);

    $('#navbarDropdown').click(function() {
        $('#loading').show();
        var ajax_url = $('#ajax_url').val();
        $.ajax({
            url: ajax_url + "notification/get_notification/",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#loading').hide();
                $(".notify-drp-body").empty();
                $(".notify-drp-body").append(data.value);
            }
        });
    })

});

function get_count()
{
    var ajax_url = $('#ajax_url').val();
    $.ajax({
        url: ajax_url + "notification/get_count/",
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data['0'].count != 0)
            $('#unread-count').html(data['0'].count);
        }
    });
}