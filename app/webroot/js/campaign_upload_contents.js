$(document).ready(function(){

    var w = window.location;

    $('.error-message').removeClass('error-message').addClass('alert-box alert').wrap('<div class="sixteen" />');

    $('#CampaignStatusId').select2();

    $("#CampaignSmsAlert").charCounter('160');
    $("#CampaignSmsAd").charCounter('160');

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

    var counter = 0;
    var interval;
    $('#jquery_jplayer_1').jPlayer({
        ready: function(){
            $(this).jPlayer("setMedia", {
				//mp3:"http://www.jplayer.org/audio/mp3/TSP-01-Cro_magnon_man.mp3"
                //mp3:"../../audio/CP_3_Reggae Birthday Song.mp3"
                mp3: "../../audio/" + "CP_" + $('#CampaignCampaignId').val() + "_" + $('#CampaignAudioForPlayer').val()
            });
        },
        play: function(){
            //$(this).jPlayer("stop")
            interval = setInterval(function(){
                counter++;
                //console.log(counter);
                if(counter == 11){
                    $('#jquery_jplayer_1').jPlayer("stop");
                    clearInterval(interval);
                }
            }, 1000);
        },
        pause: function(){
            clearInterval(interval);
            counter = 0;
            $(this).jPlayer('stop');
        },
        //size: {width:"100%"},
		swfPath: "../../js/Jplayer.swf",
		supplied: "mp3",
		wmode: "window"
    });

    //console.log($('#CampaignAudioForPlayer'));

});


























