var ajax_url = $('#ajax_url').val();
$(document).ready(function() {
    $('#closemodal').click(function() {
        $('#congrats').modal('hide');
        location.href = ajax_url + 'subscription';
    });
}); 