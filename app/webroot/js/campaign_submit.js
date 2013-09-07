$(document).ready(function(){

    var w = window.location;

    $('#submitForApproval').click(function(e){
        return;
        e.preventDefault();
        $.ajax({
            'url': w.pathname + '/validate_for_submit/' + $('#CampaignCampaignId').val(),
            'type': 'POST',
            'datatype': 'json',
            'data': $('#CampaignSubmitForm').serialize(),
            'success': function(response){
                console.log(response);
            },
            'error': function(message){
                message = $.parseJSON(message);
                console.log(message);
            }
        });
    });
});
