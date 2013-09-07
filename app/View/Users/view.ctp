<?php
    //debug($user);
?>
<div class="row">
    <div class="four columns">
        <?php echo $this->element('navigation');?>
        <!--
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('View User'), array('action' => 'view', $user['User']['user_id'])); ?></li>
            <dd><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['user_id'])); ?></li>
            <dd><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('Add New User'), array('action' => 'add')); ?></li>
            <dd>
                <?php
                    if($current_user['role_id'] == 1)
                        echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['user_id']), null, __('Are you sure you want to delete # %s?', $user['User']['user_id']));
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
                            <h6>Role:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['Role']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Username:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['User']['username'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Email:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader">
                                <?php echo $user['User']['email']; ?>
                            </h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Name:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['UserDetail']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Position:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['UserDetail']['position'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Company:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['UserDetail']['company'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Company Address:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['UserDetail']['company_address'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Mobile Number:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $user['UserDetail']['mobile'];?></h6>
                        </div>
                    </div>
                </div>
            </li>
            <li id="related_campaignsTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <?php if(!empty($user['Campaign'])):?>
                        <?php foreach($user['Campaign'] as $campaign): ?>
                        <div class="row labelspacer">
                            <div class="two columns emphasize">
                                <h6>Title:</h6>
                            </div>
                            <div class="fourteen columns">
                                <h6 class="subheader">
                                    <?php
                                        echo $this->Html->link(
                                            $campaign['title'],
                                            array(
                                                'controller' => 'campaigns',
                                                'action' => 'view',
                                                $campaign['campaign_id']
                                            )
                                        );
                                    ?>
                                </h6>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <div class="row labelspacer">
                        <div class="sixteen columns emphasize">
                            <h5 class="subheader">No related campaigns found.</h5>
                        </div>
                    </div>
                    <?php endif; ?>
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
