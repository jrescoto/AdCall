<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index'));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add')); ?> </dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <?php echo $this->Form->create('Campaign');?>
                <br/>
                <div class="row">
                    <div class="sixteen columns">
                        <?php
                            echo $this->Form->input('title');
                        ?>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="sixteen columns">
                        <?php
                            echo $this->Form->input('client_name');
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
                                'class' => 'button sixteen',
                                'div' => false
                            );
                            echo $this->Form->end($options_end);
                        ?>
                        <!--<input class="button sixteen" type="submit" value="Submit" />-->
                    </div>
                </div>

            <?php //echo $this->Form->end(__('Submit'));?>
        </div>
    </div>
    <?php
        echo $this->Html->script('campaign_add');
    ?>
</div>

