<div class="statuses form">
<?php echo $this->Form->create('Status');?>
	<fieldset>
		<legend><?php echo __('Edit Status'); ?></legend>
	<?php
		echo $this->Form->input('status_id');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Status.status_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Status.status_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Statuses'), array('action' => 'index'));?></li>
	</ul>
</div>
