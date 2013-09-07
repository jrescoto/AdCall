<?php
    //debug($subscriber);
?>
<div class="row">
    <div class="four columns">
        <?php echo $this->element('navigation'); ?>
        <!--
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('View Subscriber'), array('action' => 'view', $subscriber['Subscriber']['subscriber_id'])); ?></li>
            <dd><?php echo $this->Html->link(__('Edit Subscriber'), array('action' => 'edit', $subscriber['Subscriber']['subscriber_id'])); ?></li>
            <dd><?php echo $this->Html->link(__('List Subscriber'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('Add New Subscriber'), array('action' => 'add')); ?></li>
            <dd>
                <?php
                    if($current_user['role_id'] == 1)
                        echo $this->Form->postLink(__('Delete Subscriber'), array('action' => 'delete', $subscriber['Subscriber']['subscriber_id']), null, __('Are you sure you want to delete # %s?', $subscriber['Subscriber']['subscriber_id']));
                ?>
            </dd>
        </dl>
        -->
    </div>
    <div class="twelve columns">
        <br/>
        <dl class="tabs three-up">
            <dd class="active"><a href="#details">Details</a></dd>
            <dd><a href="#related_campaigns">Related Campaigns</a></dd>
        </dl>
        <div style="padding-left: 10px">
        <ul class="tabs-content">
            <li class="active" id="detailsTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Msisdn:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $subscriber['Subscriber']['msisdn'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Age:</h6>
                        </div>
                        <div class="twelve columns">
                        <h6 class="subheader"><?php echo $subscriber['Subscriber']['age'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Gender:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $subscriber['Subscriber']['gender'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Location:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $subscriber['RegionCity']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Status:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $subscriber['Subscriber']['active'] == 0 ? 'inactive' : 'active';?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Opt-in Date:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $subscriber['Subscriber']['date_on'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Opt-out Date:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $subscriber['Subscriber']['date_off'];?></h6>
                        </div>
                    </div>

                </div>
            </li>
            <li id="related_campaignsTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="sixteen columns emphasize">
                            <h6 class="subheader">Module is under construction.</h6>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        </div>
        <hr/>
    </div>
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
?>
