<div class="clients view">
<h2><?php  echo __('Client');?></h2>
	<dl>
		<dt><?php echo __('Client Id'); ?></dt>
		<dd>
			<?php echo h($client['Client']['client_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($client['Client']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($client['Client']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Added'); ?></dt>
		<dd>
			<?php echo h($client['Client']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
			<?php echo h($client['Client']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Client'), array('action' => 'edit', $client['Client']['client_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Client'), array('action' => 'delete', $client['Client']['client_id']), null, __('Are you sure you want to delete # %s?', $client['Client']['client_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clients'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Client'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Campaigns');?></h3>
	<?php if (!empty($client['Campaign'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Campaign Id'); ?></th>
		<th><?php echo __('Campaign Status Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Sms Ad'); ?></th>
		<th><?php echo __('Audo Ad'); ?></th>
		<th><?php echo __('Start'); ?></th>
		<th><?php echo __('End'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($client['Campaign'] as $campaign): ?>
		<tr>
			<td><?php echo $campaign['campaign_id'];?></td>
			<td><?php echo $campaign['status_id'];?></td>
			<td><?php echo $campaign['client_id'];?></td>
			<td><?php echo $campaign['user_id'];?></td>
			<td><?php echo $campaign['title'];?></td>
			<td><?php echo $campaign['sms_ad'];?></td>
			<td><?php echo $campaign['audio_ad'];?></td>
			<td><?php echo $campaign['start'];?></td>
			<td><?php echo $campaign['end'];?></td>
			<td><?php echo $campaign['created'];?></td>
			<td><?php echo $campaign['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'campaigns', 'action' => 'view', $campaign['campaign_id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'campaigns', 'action' => 'edit', $campaign['campaign_id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'campaigns', 'action' => 'delete', $campaign['campaign_id']), null, __('Are you sure you want to delete # %s?', $campaign['campaign_id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
