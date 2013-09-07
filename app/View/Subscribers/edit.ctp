<div class="subscribers form">
<?php echo $this->Form->create('Subscriber');?>
	<fieldset>
		<legend><?php echo __('Edit Subscriber'); ?></legend>
	<?php
		echo $this->Form->input('subscriber_id');
		echo $this->Form->input('msisdn');
		echo $this->Form->input('age');
		echo $this->Form->input('gender');
		echo $this->Form->input('region_city_id');
		echo $this->Form->input('active');
		echo $this->Form->input('date_on');
		echo $this->Form->input('date_off');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Subscriber.subscriber_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Subscriber.subscriber_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
