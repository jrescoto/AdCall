<div class="subscriberDetails index">
	<h2><?php echo __('Subscriber Details');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('subscriber_detail_id');?></th>
			<th><?php echo $this->Paginator->sort('subscriber_id');?></th>
			<th><?php echo $this->Paginator->sort('full_name');?></th>
			<th><?php echo $this->Paginator->sort('age');?></th>
			<th><?php echo $this->Paginator->sort('address_line_1');?></th>
			<th><?php echo $this->Paginator->sort('address_line_2');?></th>
			<th><?php echo $this->Paginator->sort('region_id');?></th>
			<th><?php echo $this->Paginator->sort('region_city_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($subscriberDetails as $subscriberDetail): ?>
	<tr>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['subscriber_detail_id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subscriberDetail['Subscriber']['msisdn'], array('controller' => 'subscribers', 'action' => 'view', $subscriberDetail['Subscriber']['subscriber_id'])); ?>
		</td>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['full_name']); ?>&nbsp;</td>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['age']); ?>&nbsp;</td>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['address_line_1']); ?>&nbsp;</td>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['address_line_2']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($subscriberDetail['Region']['name'], array('controller' => 'regions', 'action' => 'view', $subscriberDetail['Region']['region_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($subscriberDetail['RegionCity']['name'], array('controller' => 'region_cities', 'action' => 'view', $subscriberDetail['RegionCity']['region_city_id'])); ?>
		</td>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['created']); ?>&nbsp;</td>
		<td><?php echo h($subscriberDetail['SubscriberDetail']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $subscriberDetail['SubscriberDetail']['subscriber_detail_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $subscriberDetail['SubscriberDetail']['subscriber_detail_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $subscriberDetail['SubscriberDetail']['subscriber_detail_id']), null, __('Are you sure you want to delete # %s?', $subscriberDetail['SubscriberDetail']['subscriber_detail_id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Subscriber Detail'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
