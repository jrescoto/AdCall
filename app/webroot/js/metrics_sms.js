$(document).ready(function(){

    var w = window.location;
    
    $('#MetricsCodes').val('15').select2({
        placeholder: "Select codes",
        closeOnSelect: false
    });

    $('#MetricsStart').datepicker({
        //minDate: +0,
        //maxDate: +0,
        dateFormat: "yy-mm-dd"
    });

    $('#MetricsEnd').datepicker({
        //minDate: +0,
        //maxDate: +0,
        dateFormat: "yy-mm-dd"
    });

    $('#MetricsStart').focusout(function(){
        $(this).val('Start date');
    });

    $('#MetricsStart').focus(function(){
        $(this).val('');
    });

    $('#MetricsEnd').focusout(function(){
        $(this).val('End date');
    });

    $('#MetricsEnd').focus(function(){
        $(this).val('');
    });

    $('#generate').click(function(e){
        e.preventDefault();
        $('#notif').hide('fast');
        var dateformat = /^\d{4}\-\d{2}\-\d{2}$/;
        var path = w.pathname;
        path = path.split('/');

        //console.log($('#MetricsCodes').val());
        if(!$('#MetricsCodes').val()){
            $('#notif > span').text('Please select code delimeter(s) first.');
            $('#notif').slideDown('fast');
            $(this).prop('disabled', false);
            return;
        }

        if(!$('#MetricsStart').val().match(dateformat)){
            $('#notif > span').text('Please populate start date correctly.');
            $('#notif').slideDown('fast');
            $(this).prop('disabled', false);
            return;
        }

        if(!$('#MetricsEnd').val().match(dateformat)){
            $('#notif > span').text('Please populate end date correctly.');
            $('#notif').slideDown('fast');
            $(this).prop('disabled', false);
            return;
        }

        if(parseInt(Date.parse($('#MetricsEnd').val())) < parseInt(Date.parse($('#MetricsStart').val()))){
            $('#notif > span').text('End date must be ahead or equal to start date.');
            $('#notif').slideDown('fast');
            $(this).prop('disabled', false);
            return;
        }

        $(this).prop('disabled', true);
        $('#download').prop('disabled', true);
        $('#loader').slideDown('fast');

        $('#notif').hide('fast');
        $('#result').empty();

        $.ajax({
            'url': '/' + path[1] + '/' + path[2] + '/sms_reports/',
            'type': 'POST',
            'datatype': 'json',
            'data': $('#metrics').serialize(),
            'success': function(response){
                //console.log(response);
                $('#loader').hide('fast');
                //TODO
                //process server response here
                $('#generate').prop('disabled', false);
                $('#download').prop('disabled', false);
            },
            'error': function(message){
                console.log(message);
            }
        });
    });

    $('#download').on('click', function(e){
        e.preventDefault();
        $('#notif').hide('fast');
        $('#MetricsSmsStatPdfForm').submit();

        /*
        if(!$.trim($('#result').html()).length){
            $('#notif > span').text('Please generate report first.');
            $('#notif').slideDown('fast');
        }else{
            console.log($('#result :input').serialize());
            window.open('//adcall_stat_pdf/' + $('#result :input').serialize());
            $('#notif').hide('fast');
        }
        */
        //alert('test');
    });




});
