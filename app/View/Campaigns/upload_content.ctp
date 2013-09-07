<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('View Campaign'), array('action' => 'view', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Edit Details'), array('action' => 'edit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('Upload/Edit Contents'), array('action' => 'upload_content', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Target Profile Setting'), array('action' => 'profile_setting', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Review and Submit'), array('action' => 'submit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index'));?></dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <?php echo $this->Form->create('Campaign', array('type' => 'file'));?>
            <?php echo $this->Form->input('campaign_id');?>

            <div class="row">
            <?php //echo $this->Form->input('title');?>
                <div class="four columns emphasize">
                    <h6>Campaign Title:</h6>
                </div>
                <div class="twelve columns">
                    <h6 class="subheader"><?php echo $campaign_title;?></h6>
                </div>
            </div>
            <br/>
            <br/>
            <br/>

            <div class="row">
            <?php echo $this->Form->input('sms_alert', array('type' => 'textarea'));?>
            <br/>
            </div>

            <div class="row">
            <?php echo $this->Form->input('sms_ad', array('type' => 'textarea'));?>
            <br/>
            </div>

            <?php if(empty($this->request->data['Campaign']['audio_ad'])):?>
                <div class="row">
                    <div class="sixteen columns">
                        <?php echo $this->Form->input('audio_ad', array('type' => 'file')); ?>
                    </div>
                </div>
            <?php else: ?>
                <br/>
                <?php if(isset($this->request->data['Campaign']['current_audio_ad'])): ?>
                    <?php echo $this->Form->input('audio_for_player', array('type' => 'hidden', 'value' => $this->request->data['Campaign']['audio_ad']));?>
                    <?php $checked = ($this->request->data['Campaign']['current_audio_ad'] == 1) ? true : false; ?>
                    <div class="row">
                        <!--
                        <div class="eight columns">
                        <?php
                            echo $this->Form->input(
                                'current_audio_ad',
                                array(
                                    'type' => 'checkbox',
                                    'checked' => $checked,
                                    'label' => 'Retain audio file ' . $this->request->data['Campaign']['audio_ad']
                                )
                            );
                        ?>
                        </div>
                        -->
                        <div class="sixteen columns">
                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div id="jp_container_1" class="jp-audio">
                                <div class="jp-type-single">
                                    <div class="jp-gui jp-interface">
                                        <ul class="jp-controls">
                                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                                            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                                        </ul>
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                        <div class="jp-time-holder">
                                            <div class="jp-current-time"></div>
                                            <div class="jp-duration"></div>
                                        </div>
                                    </div>
                                    <div class="jp-title">
                                        <ul>
                                            <li>
                                            <?php
                                            echo $this->Form->input(
                                                'current_audio_ad',
                                                array(
                                                    'type' => 'checkbox',
                                                    'checked' => $checked,
                                                    'label' => 'Retain audio file ' . $this->request->data['Campaign']['audio_ad']
                                                )
                                            );
                                            ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="jp-no-solution">
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php else: ?>
                    <div class="row">
                    <?php echo $this->Form->input('audio_for_player', array('type' => 'hidden', 'value' => $this->request->data['Campaign']['audio_ad']));?>
                        <!--
                        <div class="eight columns">
                        <?php
                            echo $this->Form->input(
                                'current_audio_ad',
                                array(
                                    'type' => 'checkbox',
                                    'checked' => true,
                                    'label' => 'Retain audio file ' . $this->request->data['Campaign']['audio_ad']
                                )
                            );
                        ?>
                        </div>
                        -->
                        <div class="sixteen columns">
                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div id="jp_container_1" class="jp-audio">
                                <div class="jp-type-single">
                                    <div class="jp-gui jp-interface">
                                        <ul class="jp-controls">
                                            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
                                            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
                                            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
                                            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
                                            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
                                            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
                                        </ul>
                                        <div class="jp-progress">
                                            <div class="jp-seek-bar">
                                                <div class="jp-play-bar"></div>
                                            </div>
                                        </div>
                                        <div class="jp-volume-bar">
                                            <div class="jp-volume-bar-value"></div>
                                        </div>
                                        <div class="jp-time-holder">
                                            <div class="jp-current-time"></div>
                                            <div class="jp-duration"></div>
                                        </div>
                                    </div>
                                    <div class="jp-title">
                                        <ul>
                                            <li>
                                            <?php
                                            echo $this->Form->input(
                                                'current_audio_ad',
                                                array(
                                                    'type' => 'checkbox',
                                                    'checked' => true,
                                                    'label' => 'Retain audio file ' . $this->request->data['Campaign']['audio_ad']
                                                )
                                            );
                                            ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="jp-no-solution">
                                        <span>Update Required</span>
                                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>
                <br/>
                <br/>
                <div class="row">
                    <div class="two columns" style="padding-top: 5px">
                        <label>Audio Ad:</label>
                    </div>
                    <div class="fourteen columns">
                        <?php echo $this->Form->input('audio_ad', array('type' => 'file', 'label' => false)); ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="five columns offset-by-eleven">
                    <?php
                        $options_end = array(
                            'label' => 'Submit',
                            'class' => 'button sixteen',
                            'div' => false
                        );
                        echo $this->Form->end($options_end);
                    ?>
                    <!--<input class="button sixteen" type="submit" value="Submit"/>-->
                </div>
            </div>

            <?php //echo $this->Form->end(__('Submit'));?>
        </div>
    </div>
    <?php
        echo $this->Html->script('campaign_upload_contents');
        echo $this->Html->script('select2');
        echo $this->Html->script('charcounter');
        echo $this->Html->script('jquery.jplayer.min.js');
    ?>
</div>
