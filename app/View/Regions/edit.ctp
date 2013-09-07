<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?></dd>
		    <dd><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Region.region_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Region.region_id'))); ?></dd>
            <dd><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </dd>
            <dd><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </dd>
            <dd><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </dd>
            <dd><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
        <?php echo $this->Form->create('Region');?>
        <?php
            echo $this->Form->input('region_id');
            echo $this->Form->input('location_id');
            echo $this->Form->input('name');
        ?>
        <?php echo $this->Form->end(__('Submit'));?>
        </div>
    </div>
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
    echo $this->Html->script('select2');
    echo $this->Html->script('regions');
?>
