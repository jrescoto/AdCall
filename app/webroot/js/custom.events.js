$(document).ready(function(){
    $("#CampaignExecutionStart").datepicker({
        //minDate: new Date(2012, 2 - 1, 14),
        minDate: +0,
        //maxDate: +0,
        dateFormat: "yy-mm-dd",
        onSelect: function(){
        }
    });
    $("#CampaignExecutionEnd").datepicker({
        //minDate: new Date(2012, 2 - 1, 14),
        minDate: +0,
        //maxDate: +0,
        dateFormat: "yy-mm-dd"
    });
    
    $("#CampaignSmsAlert").charCounter('160');
    $("#CampaignSmsAd").charCounter('160');


    /* moved to campaign_upload_contents
    
    if($('#CampaignCurrentAudioAd').length > 0)
    {
    	if($('#CampaignCurrentAudioAd').attr('checked'))
    		$('#CampaignAudioAd').attr('disabled', true);
    }
    		
    //$("#CampaignCurrentAudioAd").attr('checked');
    
    $("#CampaignCurrentAudioAd").click(function(){
    	if(!$(this).attr('checked'))
    	{
    		$('#CampaignAudioAd').attr('disabled', false);
    		//cont=$(toggle_audio_upload).appendTo('#CampaignUploadContentForm fieldset');
    		//$('#toggleAudioUpload').show('fast');
    	}
    	else
    	{
    		$('#CampaignAudioAd').attr('disabled', true);
    		$('#CampaignAudioAd').val('');
    		//$('#toggleAudioUpload').remove();
    		//$('#toggleAudioUpload').hide('fast');
    	}
    });
    */
    
    /* moved to campaign_target_profile.js
    $("#selectAgeRange").click(function(){
    	//$('#specifyAgeRangeInput').hide('slide', { direction: 'down' }, 'fast');
    	//if()
	    	$('#specifyAgeRangeInput').hide('fast');
	    	$('#selectAgeRangeOptions').show('slide', { direction: 'up' }, 'fast');
	    	$('#specifyAgeRangeInput :input').attr('disabled', true);
	    	$('#selectAgeRangeOptions :input').removeAttr('disabled');
    });
    
    $("#specifyAgeRange").click(function(){
    	//alert('test');
    	$('#selectAgeRangeOptions').hide('fast');
    	$('#specifyAgeRangeInput').show('slide', { direction: 'down' }, 'fast');
    	$('#selectAgeRangeOptions :input').attr('disabled', true);
    	$('#specifyAgeRangeInput :input').removeAttr('disabled');
    });
    */
    
    /**
    $("#CampaignAgeAll").click(function(){
    	if($(this).attr('checked'))
    		$('#selectAgeRangeOptions div :input').attr('checked', 'checked');
    	else
    		$('#selectAgeRangeOptions div :input').attr('checked', false);
    });
    */
    
    /* moved to campaign_target_profile.js
    $('#selectAgeRangeOptions div :input').each(function(index){
    	//console.log(index + ' : ' + $(this).attr('id'));
    	$(this).bind('click', function(){
   			var selected = $('#selectAgeRangeOptions div :input:checkbox:checked').map(function(){
				return this.value;
			}).get();
 
    		if($(this).attr('id') === 'CampaignAgeAll')
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
    				console.log(selected);
    				//ALL AGES option will always fall at index 4 since it is the last item and we're only checking when array has 5 checked items
    				if(jQuery.inArray('all', selected) == 4)
    					$('#CampaignAgeAll').attr('checked', false);
    				else
    					$('#CampaignAgeAll').attr('checked', true);
    			}
    			else
    			{
    				$('#CampaignAgeAll').attr('checked', false);
    			}
    		}
    	});
    });
    */
    
    
    $('#CampaignRegion').change(function(){
    	//console.log($(this).attr('value'));
    });
    
    $('#regionCityAddNewField').click(function(){
    	//var add_new_field = $('#newRegionCityName');
    	//cont=$(add_new_field).appendTo('.regionCities form fieldset');
    	//$('#newRegionCityName').append('.regionCities form');
    	var input_array = $('.regionCities form fieldset div :input:text').map(function(){
            console.log('debug: ' + this.id);
			return this.id;
		}).get();
    	console.log(input_array);
    	var add_new_region_city = $('#AddNewRegionCity_0').parent().clone(false);
    	$(add_new_region_city).find('input').attr('id', 'AddNewRegionCity_' + input_array.length);
    	$(add_new_region_city).find('input').attr('name', 'data[RegionCity][' + input_array.length + '][name]');
    	console.log(add_new_region_city.id);
    	$('.regionCities form fieldset').append(add_new_region_city);

		//console.log(input_array);
    	/**
		$(input_array).each(function(index, n){
			console.log(n + ' : ' + $('#' + n).attr('name'));
		});
		*/
		console.log('-------------');
    	//console.log($('#test').parent());
    	return false;
    });
    
    $('#CampaignLocationFilter').change(function(){
    	//console.log($(this).val());
    	if($(this).val() == 'all_cities_lgus') {
    		$('#CampaignRegions').val('').trigger('liszt:updated');
    		$('#CampaignRegionLabel').text('except from the following:');
    	}
    	
     	if($(this).val() == 'specific_cities_lgus') {
    		$('#CampaignRegions').val('').trigger('liszt:updated');
    		$('#CampaignRegionLabel').text('within the following Cities/LGUs:');
    	}   	
    });
    
    //$('.chzn-select').chosen();
    
});
