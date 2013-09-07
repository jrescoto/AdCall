$(document).ready(function(){
    $('#CampaignStatusId').select2();
    $('select[id^=CampaignRegion]').select2({
        closeOnSelect : false
    });
    /*
    $('select[id^=CampaignRegionCityList]').select2({
        closeOnSelect : false
    });
    $('select[id^=CampaignRegionFilter]').select2();
    $('select[id^=CampaignRegionCityFilter]').select2();
    */

    $('select[id^=CampaignRegionList]').change(function(){
        var location_id = $(this).attr('id').replace('CampaignRegionList', '');
        var city_select_id = 'CampaignRegionCityList' + location_id;

        console.log(location_id);
        console.log(city_select_id);

        $.ajax({
            'url': '/AdCall/region_cities/get_cities',
            'type': 'POST',
            'datatype': 'json',
            'data': $(this).serialize() + '&LocationId=' + location_id,
            'success': function(response){
                console.log(response);
                var options = $.parseJSON(response);
                if(options === null){
                    $('#' + city_select_id)
                        .empty()
                        .select2({closeOnSelect:false});
                }else{
                    var region_ids = [];

                    $.each(options, function(index, value){
                        region_ids.push(index);
                    });

                    if($('#' + city_select_id + ' option').length == 0){
                         $.each(options, function(index, value){
                            $('#' + city_select_id)
                                .append($('<option></option>')
                                .attr('value', index)
                                .text(value));
                        });
                    }else{
                        var current_region_city_list = [];

                        $.each($('#' + city_select_id + ' option'), function(){
                            current_region_city_list
                                .push($(this)
                                .val());
                        });

                        $.each(options, function(index, value){
                            if(jQuery.inArray(index, current_region_city_list) == -1){
                                 $('#' + city_select_id)
                                    .append($('<option></option>')
                                    .attr('value', index).text(value));
                            }
                        });

                        $.each($('#' + city_select_id + ' option'), function(){
                            if(jQuery.inArray($(this).val(), region_ids) == -1){
                                $('#' + city_select_id + ' option[value="' + $(this).val() + '"]').remove();
                            }
                        });
                    }
                    $('#' + city_select_id).select2({closeOnSelect:false});
                }
            },
            'error': function(message){
                        console.log(message);
                switch(message.status){
                    case 403: 
                        console.log('HTTP error: ' + message.statusText);
                        break;
                    case 404:
                        console.log('HTTP error: URL not found');
                    default:
                        break;
                }
            }
        });
    });
});
