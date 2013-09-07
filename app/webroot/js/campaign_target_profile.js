$(document).ready(function(){

    var w = window.location;

    $('#CampaignGenderA').unwrap();
    $('legend').wrap('<h5/>');
    $('.error-message').removeClass('error-message').addClass('alert-box alert').wrap('<div class="sixteen" />');

    /*
     * enable this snippet to ensure that
     * enactive age option will disable input fields
     * so that they won't be included in passed data
     * for validation
     */
    $('ul.accordion').find('li').each(function(){
        if($(this).hasClass('active')){
            $(this).find('input').attr('disabled', false);
        }else{
            $(this).find('input').attr('disabled', true);
        }
    });


    $("#selectAgeRange").click(function(){
        $(this).parent().addClass('active');
        $('#specifyAgeRange').parent().removeClass('active');
        $('#specifyAgeRangeInput :input').attr('disabled', true);
        $('#selectAgeRangeOptions :input').removeAttr('disabled');
    });
    
    $("#specifyAgeRange").click(function(){
        $(this).parent().addClass('active');
        $('#selectAgeRange').parent().removeClass('active');
    	$('#selectAgeRangeOptions :input').attr('disabled', true);
    	$('#specifyAgeRangeInput :input').removeAttr('disabled');
    });


    $('#selectAgeRangeOptions div :input').each(function(index){
    	//console.log(index + ' : ' + $(this).attr('id'));
    	$(this).bind('click', function(){
   			var selected = $('#selectAgeRangeOptions div :input:checkbox:checked').map(function(){
				return this.value;
			}).get();
 
    		if($(this).attr('id') === 'CampaignAgeAllAges')
    		{
		    	if($(this).attr('checked'))
		    		$('#selectAgeRangeOptions div :input').attr('checked', 'checked');
		    	else
		    		$('#selectAgeRangeOptions div :input').attr('checked', false);
		    }
    		else
    		{
    			if(selected.length == 5)
    			{
    				//console.log(selected);
    				//ALL AGES option will always fall at index 4 since it is the last item and we're only checking when array has 5 checked items
    				if(jQuery.inArray('all_ages', selected) == 4)
    					$('#CampaignAgeAllAges').attr('checked', false);
    				else
    					$('#CampaignAgeAllAges').attr('checked', true);
    			}
    			else
    			{
    				$('#CampaignAgeAll').attr('checked', false);
    			}
    		}
    	});
    });
 
    $('select[id^=CampaignRegion]').select2({
        closeOnSelect : false
    });

    $('#CampaignRegionFilter').change(function(){
        //if($(this).val() == 0)
        locationSelectChangeEvent(0, $(this).val());
    });

     $('#CampaignRegionList').change(function(){
        var filter = $('#CampaignRegionFilter').val();
        //if(filter == 0)
        locationSelectChangeEvent(0, filter);
    });

    function locationSelectChangeEvent(param_id, filter){
        var location_id = param_id;
        var city_select_id = 'CampaignRegionCityList';
        var region_select_id = 'CampaignRegionList';
        var path = w.pathname;
        path = path.split('/');

        $.ajax({
            'url': '/' + path[1] + '/region_cities/get_cities',
            'type': 'POST',
            'datatype': 'json',
            'data': $('#' + region_select_id).serialize() + '&LocationId=' + location_id + '&filter=' + filter,
            'success': function(response){
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
                        //console.log(message);
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

    };

    $('#closeModal').click(function(e){
        e.preventDefault();
        //TODO
        //ajaxStop here
        $('#busyDataMining').trigger('reveal:close');
    });

    $('#submitFromModal').click(function(e){
        e.preventDefault();
        if($('#dataMineResultFilename').val().length > 0){
            $('#busyDataMining').trigger('reveal:close');
            $('#CampaignProfileSettingForm').submit();
            console.log('supplied');
        }else{
            $('#emptyFilename').slideDown('fast');
            console.log('not supplied');
        }
    });

    $('#dataMineResultFilename').change(function(){
        $('#CampaignFilename').val($(this).val());
    });

    //$('#data_mine').click(function(e){});
    $('#data_mine').click(function(e){
        e.preventDefault();
        $('#ageOptionError').hide();
        $('#locationError').hide();
        $('#ageFromError').hide();
        $('#ageToError').hide();
        $('#submitFromModal').attr('disabled', true);
        $('#closeModal').attr('disabled', true);
        $('#forcedClose').hide('fast');
        $(this).attr('disabled', true);
        $('#busyDataMining span').text('Data mining in progress...');
        $('#dataMineLoader').show('fast');
        $('#emptyFilename').hide('fast');
        $('#dataMineFields').hide('fast');

        $.when(validateForm())
            .then(function(response){
                response = $.parseJSON(response);
                if(response === 1){
                    $('#busyDataMining').reveal({
                        closeOnBackgroundClick: false,
                        //close: function(){data_mine_request.abort();},
                    });

                    $.when(dataMine())
                        .then(function(response){
                            response = $.parseJSON(response);
                            /*
                            $('#busyDataMining').reveal({
                                closeOnBackgroundClick: false,
                                //close: function(){data_mine_request.abort();},
                            });
                            */
                            if(response.success){
                                $('#dataMineLoader').hide('fast');
                                $('#busyDataMining span').text('Data mining complete.');
                                $('#dataMineResult span').text(response.text);
                                $('#submitFromModal').attr('disabled', false);
                                $('#closeModal').attr('disabled', false);
                                $('#data_mine').attr('disabled', false);
                                $('#dataMineFields').slideDown();
                            }else{
                                $('#dataMineLoader').hide('fast');
                                $('#busyDataMining span').text('Internal error has been encountered. Please try again.');
                                $('#closeModal').attr('disabled', false);
                                $('#data_mine').attr('disabled', false);
                            }

                        })
                        .fail(function(){
                            $('#forcedClose').fadeIn('fast');
                            $('#data_mine').attr('disabled', false);
                            console.log('error data mine');
                            console.log('modal forcefully closed');
                        });
                }else{
                    invalidate(response);
                    $('#data_mine').attr('disabled', false);
                }
            })
            .fail(function(error){
                //403, 404, 500
                console.log('error');
            });
    });

    function validateForm(){
        var path = w.pathname;
        path = path.split('/');

        return $.ajax({
            'url': '/' + path[1] + '/' + path[2] + '/validate_profile_setting/' + $('#CampaignCampaignId').val(),
            'type': 'POST',
            'datatype': 'json',
            'data': $('#CampaignProfileSettingForm').serialize(),
            });
    }

    function invalidate(response){
        $.each(response, function(field, error){
        //console.log(error);
            switch(field){
                case 'age_from':
                    $('#ageFromError').text(error);
                    $('#ageFromError').slideDown('fast');
                    break;
                case 'age_to':
                    $('#ageToError').text(error);
                    $('#ageToError').slideDown('fast');
                    break;
                case 'age':
                    $('#ageOptionError span').text(error);
                    $('#ageOptionError').slideDown('fast');
                    //$('#ageOptionError').show('fast');
                    break;
                case 'RegionList':
                case 'RegionCityList':
                    $('#locationError').slideDown('fast');
                    break;
            }
        });
    }

    function dataMine(){
        var data_mine_request;
        var path = w.pathname;
        path = path.split('/');

        data_mine_request =
            $.ajax({
                'url': '/' + path[1] + '/' + path[2] + '/data_mine/' + $('#CampaignCampaignId').val(),
                'type': 'POST',
                'datatype': 'json',
                'data': $('#CampaignProfileSettingForm').serialize(),
            });
        return data_mine_request;
    }

});
