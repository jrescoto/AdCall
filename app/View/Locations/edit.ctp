<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </dd>
		    <dd><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Region.region_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Region.region_id'))); ?></dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
            <?php echo $this->Form->create('Location');?>
            <?php
                echo $this->Form->input('location_id');
                echo $this->Form->input('name');
            ?>
                </div>
            </div>
            <div class="row">
                <div class="six columns offset-by-ten">
            <?php
                $options_end = array(
                    'label' => 'Submit',
                    'class' => 'button sixteen',
                    'div' => false
                );              
                echo $this->Form->end($options_end);
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
