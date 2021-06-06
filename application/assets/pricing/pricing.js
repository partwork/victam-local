$( document ).ready(function() {

    $("#basic-feature").hide();
    $("#promo-feature").hide();
    $("#market-feature").hide();

    $(".Basic-btn").click(function(){
        $("#basic-feature").toggle();
        $("#promo-feature").hide();
        $("#market-feature").hide();
        var oldText = $(this).text();
        var newText = $(this).data('text');
        $(this).text(newText).data('text',oldText);
        $('.Promotional-btn').text("More +");
        $('.leader-btn').text("More +");

        window.scrollTo(0,document.body.scrollHeight);
    });   
    
    $(".Promotional-btn").click(function(){
        $("#basic-feature").hide();
        $("#promo-feature").toggle();
        $("#market-feature").hide();
        var oldText = $(this).text();
        var newText = $(this).data('text');
        $(this).text(newText).data('text',oldText);
        $('.Basic-btn').text("More +");
        $('.leader-btn').text("More +");

        window.scrollTo(0,document.body.scrollHeight);
    }); 
    
    $(".leader-btn").click(function(){
        $("#basic-feature").hide();
        $("#promo-feature").hide();
        $("#market-feature").toggle();
        var oldText = $(this).text();
        var newText = $(this).data('text');
        $(this).text(newText).data('text',oldText);
        $('.Basic-btn').text("More +");
        $('.Promotional-btn').text("More +");

        window.scrollTo(0,document.body.scrollHeight);
    });
});

 