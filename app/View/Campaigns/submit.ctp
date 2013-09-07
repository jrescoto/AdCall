<?php
    //debug($this->request->data);
    debug($this->validationErrors);
?>
<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('View Campaign'), array('action' => 'view', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Edit Details'), array('action' => 'edit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Upload/Edit Contents'), array('action' => 'upload_content', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Target Profile Setting'), array('action' => 'profile_setting', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('Review and Submit'), array('action' => 'submit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index'));?></dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <h5>Details</h5>
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
                    <h6>Client:</h6>
                </div>
                <div class="twelve columns">
                    <h6 class="subheader"><?php echo $campaign['Campaign']['title'];?></h6>
                </div>
            </div>

            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>Execution Start:</h6>
                </div>
                <div class="twelve columns">
                    <h6 class="subheader"><?php echo $campaign['Campaign']['start'];?></h6>
                </div>
            </div>

            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>Execution End:</h6>
                </div>
                <div class="twelve columns">
                    <h6 class="subheader"><?php echo $campaign['Campaign']['end'];?></h6>
                </div>
            </div>

            <br/>
            <hr/>
            <?php echo $this->Form->create('Campaign', array('type' => 'file'));?>
            <?php echo $this->Form->input('campaign_id');?>
            <h5>Contents</h5>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>SMS Alert:</h6>
                </div>
                <div class="twelve columns">
                    <?php echo $this->Form->input('sms_alert', array('type' => 'hidden', 'label' => false, 'readonly' => 'readonly'));?>
                    <h6 class="subheader">
                        <?php echo $this->request->data['Campaign']['sms_alert'];?>
                    </h6>
                </div>
            </div>

            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>SMS Advertisement:</h6>
                </div>
                <div class="twelve columns">
                    <?php echo $this->Form->input('sms_ad', array('type' => 'hidden', 'label' => false, 'readonly' => 'readonly'));?>
                    <h6 class="subheader">
                        <?php echo $this->request->data['Campaign']['sms_ad'];?>
                    </h6>
                </div>
            </div>

            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>Audio Ad:</h6>
                </div>
                <div class="twelve columns">
                    <?php echo $this->Form->input('audio_ad', array('type' => 'hidden', 'label' => false)); ?>
                    <h6 class="subheader">
                        <?php echo $this->request->data['Campaign']['audio_ad'];?>
                    </h6>
                </div>
            </div>
            <?php if(!empty($this->validationErrors['Campaign'])):?>
            <div class="sixteen columns alert-box alert">
                Please upload necessary contents.
            </div>
            <?php endif;?>

            <br/>
            <hr/>
            <h5>Profile Setting</h5>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>Age:</h6>
                </div>
                <div class="twelve columns">
                    <?php echo $this->Form->input('CampaignSetting.age', array('type' => 'hidden', 'label' => false));?>
                    <h6 class="subheader"><?php echo $this->request->data['CampaignSetting']['age'];?></h6>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>Gender:</h6>
                </div>
                <div class="twelve columns">
                    <?php echo $this->Form->input('CampaignSetting.gender', array('type' => 'hidden', 'label' => false));?>
                    <h6 class="subheader"><?php echo $this->request->data['CampaignSetting']['gender'];?></h6>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6>Location:</h6>
                </div>
                <div class="twelve columns">
                    <?php echo $this->Form->input('CampaignSetting.location', array('type' => 'hidden', 'label' => false));?>
                    <h6 class="subheader"><?php echo $this->request->data['CampaignSetting']['location'];?></h6>
                </div>
            </div>

            <br/>
            <?php if(!empty($this->validationErrors['CampaignSetting'])):?>
            <div class="sixteen columns alert-box alert">
                Profile setting has not been set yet.
            </div>
            <?php endif;?>

            <br/>
            <br/>
            <br/>
            <br/>
            <div class="row">
                <?php
                    $options_end = array(
                        'label' => 'Submit for Approval',
                        'id' => 'data_mine',
                        'class' => 'button sixteen',
                        'div' => array(
                            'class' => 'six columns centered'
                        )
                    );
                    echo $this->Form->end($options_end);
                ?>
                    <!--!<button id="submitForApproval" type="submit" class="button sixteen">Submit For Approval</button>-->
            </div>

            <?php //echo $this->Form->end(__('Submit'));?>
        </div>
    </div>
    <?php
        echo $this->Html->script('campaign_submit');
    ?>
</div>
