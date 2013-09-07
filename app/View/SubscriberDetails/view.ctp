<div class="subscriberDetails view">
<h2><?php  echo __('Subscriber Detail');?></h2>
	<dl>
		<dt><?php echo __('Subscriber Detail Id'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['subscriber_detail_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscriber'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subscriberDetail['Subscriber']['msisdn'], array('controller' => 'subscribers', 'action' => 'view', $subscriberDetail['Subscriber']['subscriber_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Full Name'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Age'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['age']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Line 1'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['address_line_1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address Line 2'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['address_line_2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subscriberDetail['Region']['name'], array('controller' => 'regions', 'action' => 'view', $subscriberDetail['Region']['region_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Region City'); ?></dt>
		<dd>
			<?php echo $this->Html->link($subscriberDetail['RegionCity']['name'], array('controller' => 'region_cities', 'action' => 'view', $subscriberDetail['RegionCity']['region_city_id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Added'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
			<?php echo h($subscriberDetail['SubscriberDetail']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Subscriber Detail'), array('action' => 'edit', $subscriberDetail['SubscriberDetail']['subscriber_detail_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Subscriber Detail'), array('action' => 'delete', $subscriberDetail['SubscriberDetail']['subscriber_detail_id']), null, __('Are you sure you want to delete # %s?', $subscriberDetail['SubscriberDetail']['subscriber_detail_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscriber Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber Detail'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Subscribers'), array('controller' => 'subscribers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Subscriber'), array('controller' => 'subscribers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regions'), array('controller' => 'regions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region'), array('controller' => 'regions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
