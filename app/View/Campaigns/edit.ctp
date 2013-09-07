<?php
//debug($this);
?>
<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('View Campaign'), array('action' => 'view', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('Edit Details'), array('action' => 'edit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Upload/Edit Contents'), array('action' => 'upload_content', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Target Profile Setting'), array('action' => 'profile_setting', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Review and Submit'), array('action' => 'submit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index'));?></dd>
        </dl>
    </div>
    <div class="twelve columns">
        <div class="panel">
        <?php
            echo $this->Form->create('Campaign', array(
                    'inputDefaults' => array(
                        //'label' => false,
                        'div' => false,
                        'error' => array(
                            'wrap' => 'small',
                            'class' => 'error'
                        )
                    )
                ));
        ?>
        <div class="row">
            <div class="sixteen columns">
            <?php
            echo $this->Form->input('campaign_id');
            /*
            if($current_user['role_id'] == 1)
                echo $this->Form->input('status_id');
             */
            ?>
            </div>
        </div>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('client_name');
            ?>
            </div>
        </div>
        <br/>

        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('title', array('error' => array('wrap' => 'span', 'class' => 'error')));
            ?>
            </div>
        </div>
        <br/>

        <div class="row">
            <div class="eight columns">
            <?php
                echo $this->Form->input('execution_start');
            ?>
            </div>
            <div class="eight columns">
            <?php
                echo $this->Form->input('execution_end');
            ?>
            </div>
        </div>

        <br/><br/>
        <div class="row">
            <div class="five columns offset-by-six">
                <a href="#" class="secondary button sixteen">Clear</a>
            </div>
            <div class="five columns">
                <?php
                    $options_end = array(
                        'label' => 'Submit',
                        'id' => 'data_mine',
                        'class' => 'button sixteen',
                        'div' => false
                    );
                    echo $this->Form->end($options_end);
                ?>
                <!--<input class="button sixteen" type="submit" value="Submit" />-->
            </div>
        </div>
        </div>
    </div>
</div>
    <?php
        echo $this->Html->script('campaign_edit');
    ?>

