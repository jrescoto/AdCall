<?php
    debug($campaign);
?>
<div class="row">
    <div class="four columns">
    <?php echo $this->element('navigation');?>
        <!--
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('View Campaign'), array('action' => 'view', $campaign['Campaign']['slug'])); ?></li>
            <dd><?php echo $this->Html->link(__('Edit Campaign'), array('action' => 'edit', $campaign['Campaign']['campaign_id'])); ?></li>
            <dd><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('Add New Campaign'), array('action' => 'add')); ?></li>
            <dd>
                <?php
                    if($current_user['role_id'] == 1)
                        echo $this->Form->postLink(__('Delete Campaign'), array('action' => 'delete', $campaign['Campaign']['campaign_id']), null, __('Are you sure you want to delete # %s?', $campaign['Campaign']['campaign_id']));
                ?>
            </dd>
        </dl>
        -->
    </div>
    <div class="twelve columns">
        <br/>
        <dl class="tabs four-up">
            <dd class="active"><a href="#details">Details</a></dd>
            <dd><a href="#contents">Contents</a></dd>
            <dd><a href="#profile_setting">Profile Setting</a></dd>
            <dd><a href="#lifecycle">Lifecycle</a></dd>
        </dl>
        <div style="padding-left: 10px">
        <ul class="tabs-content">
            <li class="active" id="detailsTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Title:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['Campaign']['title'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Author:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader">
                                <?php echo $this->Html->link($campaign['User']['username'], array('controller' => 'users', 'action' => 'view', $campaign['User']['user_id'])); ?>
                            </h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Client Name:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['Campaign']['client_name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Execution start:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['Campaign']['start'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Execution end:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['Campaign']['end'];?></h6>
                        </div>
                    </div>
                </div>
            </li>
            <li id="contentsTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>SMS Alert:</h6>
                        </div>
                        <div class="twelve columns">
                            <p class="subheader"><?php echo $campaign['Campaign']['sms_alert'];?></p>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>SMS Advertisement:</h6>
                        </div>
                        <div class="twelve columns">
                            <p class="subheader"><?php echo $campaign['Campaign']['sms_ad'];?></p>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Audio Advertisement:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['Campaign']['audio_ad'];?></h6>
                        </div>
                    </div>
                </div>
            </li>
            <li id="profile_settingTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Age:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['CampaignSetting']['age'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Gender:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['CampaignSetting']['gender'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Location:</h6>
                        </div>
                        <div class="twelve columns">
                            <p class="subheader"><?php echo $campaign['CampaignSetting']['location'];?></p>
                        </div>
                    </div>
                </div>
            </li>
            <li id="lifecycleTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="sixteen columns emphasize">
                            <h6>Module under construction</h6>
                        </div>
                    </div>
                    <!--
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Age:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['CampaignSetting']['age'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Gender:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $campaign['CampaignSetting']['gender'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Location:</h6>
                        </div>
                        <div class="twelve columns">
                            <p class="subheader"><?php echo $campaign['CampaignSetting']['location'];?></p>
                        </div>
                    </div>
                    -->
                </div>
            </li>
        </ul>
        </div>
        <hr/>
        <div class="row">
            <div class="six columns centered">
            <?php
                if(($campaign['Campaign']['status_id'] == 2 || $campaign['Campaign']['status_id'] == 3)
                    && $current_user['role_id'] == 1){
                    $label = null;
                    if($campaign['Campaign']['status_id'] == 2)
                        $label = 'Approve Campaign';

                    if($campaign['Campaign']['status_id'] == 3)
                        $label = 'Revert to Pending Status';

                    $options = array(
                        'class' => 'button sixteen',
                        'div' => false
                    );

                    echo $this->Form->postLink(
                        __($label),
                        array(
                            'action' => 'toggleApproval',
                            $campaign['Campaign']['campaign_id']
                        ),
                        $options,
                        null,
                        __('Are you sure you want to delete # %s?',
                        $campaign['Campaign']['campaign_id']
                        )
                    );

                }
            ?>

            </div>
        </div>
    </div>
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
?>
