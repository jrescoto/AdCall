<div class="subscriberDetails form">
<?php echo $this->Form->create('SubscriberDetail');?>
	<fieldset>
		<legend><?php echo __('Edit Subscriber Detail'); ?></legend>
	<?php
		echo $this->Form->input('subscriber_detail_id');
		echo $this->Form->input('subscriber_id');
		echo $this->Form->input('full_name');
		echo $this->Form->input('age');
		echo $this->Form->input('address_line_1');
		echo $this->Form->input('address_line_2');
		echo $this->Form->input('region_id');
		echo $this->Form->input('region_city_id');
		//echo $this->Form->input('date_added');
		//echo $this->Form->input('timestamp');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SubscriberDetail.subscriber_detail_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SubscriberDetail.subscriber_detail_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Subscriber Details'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
