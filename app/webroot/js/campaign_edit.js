$(document).ready(function(){
    $('.error-message').removeClass('error-message').addClass('alert-box alert').wrap('<div class="sixteen" />');

    $('#CampaignExecutionStart').datepicker({
        minDate: +0,
        //maxDate: +0,
        dateFormat: "yy-mm-dd"
    });
    $('#CampaignExecutionEnd').datepicker({
         minDate: +0,
        //maxDate: +0,
        dateFormat: "yy-mm-dd"
    });
});

