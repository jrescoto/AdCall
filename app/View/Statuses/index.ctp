<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
		    <dd><?php echo $this->Html->link(__('New Status'), array('action' => 'add')); ?></dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
                    <h3><?php echo __('Statuses');?></h3>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('status_id');?></th>
                                <th><?php echo $this->Paginator->sort('description');?></th>
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($statuses as $status): ?>
                            <tr>
                                <td><?php echo h($status['Status']['status_id']); ?>&nbsp;</td>
                                <td><?php echo h($status['Status']['description']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $status['Status']['status_id'])); ?>
                                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $status['Status']['status_id'])); ?>
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $status['Status']['status_id']), null, __('Are you sure you want to delete # %s?', $status['Status']['status_id'])); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--
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
    -->
</div>



<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Status'), array('action' => 'add')); ?></li>
	</ul>
</div>
-->
