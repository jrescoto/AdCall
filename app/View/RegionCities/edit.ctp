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
        <?php echo $this->Form->create('RegionCity');?>
            <div class="row">
                <div class="sixteen columns">
                <?php
                    echo $this->Form->input('region_city_id');
                ?>
                </div>
            <?php
                echo $this->Form->input('region_id');
                echo $this->Form->input('name');
                echo $this->Form->input('tags');
            ?>
            <?php echo $this->Form->end(__('Submit'));?>
            </div>
        </div>
    </div>
</div>
<?php
    echo $this->Html->script('select2');
    echo $this->Html->script('region.cities');
?>




<!--

<div class="regionCities form">
<?php echo $this->Form->create('RegionCity');?>
	<fieldset>
		<legend><?php echo __('Edit Region City'); ?></legend>
	<?php
		echo $this->Form->input('region_city_id');
		echo $this->Form->input('region_id');
		echo $this->Form->input('name');
		//echo $this->Form->input('date_added');
		//echo $this->Form->input('timestamp');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RegionCity.region_city_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('RegionCity.region_city_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Region Cities'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriber Details'), array('controller' => 'subscriber_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber Detail'), array('controller' => 'subscriber_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
