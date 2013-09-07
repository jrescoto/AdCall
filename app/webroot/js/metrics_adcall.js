$(document).ready(function(){

    var w = window.location;

    $('#MetricsCampaign').select2({
        placeholder: "Select campaign",
        allowClear: true
        //minimumInputLength: 3,
    });

    $('#campaign').change(function(){
        //alert('alert');
        //alert($(this).val());
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



    $('#generate').on('click', function(){
        //console.log($('#campaigns').val());
        $('#notif').hide('fast');
        var dateformat = /^\d{4}\-\d{2}\-\d{2}$/;
        var path = w.pathname;
        path = path.split('/');

        if($('#MetricsCampaign').val().length == 0){
            $('#notif > span').text('Please select campaign first.');
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
        /*
        if($('#start').val().length == 0){
            $('#notif > span').text('Please specify start date.');
            $('#notif').slideDown('fast');
            return;
        }

        if($('#end').val().length == 0){
            $('#notif > span').text('Please specify end date.');
            $('#notif').slideDown('fast');
            return;
        }
        */

        $(this).prop('disabled', true);
        $('#download').prop('disabled', true);
        $('#loader').slideDown('fast');

        $('#notif').hide('fast');
        $('#result').empty();
        $.ajax({
            'url': '/' + path[1] + '/' + path[2] + '/adcall_reports/',
            'type': 'POST',
            'datatype': 'json',
            'data': $('#MetricsAdcallStatPdfForm').serialize(),
            'success': function(response){
                $('#loader').hide('fast');
                response = $.parseJSON(response);
                if(response.status === 'error'){
                    $('#notif > span').text(response.message);
                    $('#notif').slideDown('fast');
                }else{
                    $('#notif').hide('fast');
                    console.log(response);
                    $.each(response.data, function(index, data){
                        /*
                        $('#result').append(
                            '<div class="row">' +
                            '<div class="eight columns offset-by-one emphasize"><h6>' + data.title + '</h6></div>' +
                            '<div class="seven columns"><h6 class="subheader">' + data.value + '</h6></div>' +
                            '</div>'
                        );
                        */
                        switch(index){
                            case 0: $('#MetricsSmsAlertSent').val(data.value); break;
                            case 1: $('#Metrics10secAudio').val(data.value); break;
                            case 2: $('#Metrics60secCall').val(data.value); break;
                            case 3: $('#MetricsIncBillable').val(data.value); break;
                            default: break;
                        }

                        $('<div class="row">' +
                        '<div class="eight columns offset-by-one emphasize"><h6>' + data.title + '</h6></div>' +
                        '<div class="seven columns"><h6 class="subheader">' + data.value + '</h6></div>' +
                        '</div>').hide().appendTo($('#result')).slideDown('slow');
                    });
                }

                $('#generate').prop('disabled', false);
                $('#download').prop('disabled', false);
            },
            'error': function(message){
                $('#loader').hide('fast');
            }
        });

    });

    $('#download').on('click', function(e){
        e.preventDefault();
        $('#notif').hide('fast');
        $('#MetricsAdcallStatPdfForm').submit();

        /*
        if(!$.trim($('#result').html()).length){
            $('#notif > span').text('Please generate report first.');
            $('#notif').slideDown('fast');
        }else{
            console.log($('#result :input').serialize());
            window.open('/adcall_stat_pdf/' + $('#result :input').serialize());
            $('#notif').hide('fast');
        }
        */
        //alert('test');
    });



});
