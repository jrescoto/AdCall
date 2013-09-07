<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?></dd>
            <dd class="active"><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?></dd>
            <dd><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </dd>
            <dd><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </dd>
            <dd><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </dd>
            <dd><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </dd>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <?php echo $this->Form->create('Region');?>
                <!--
                <fieldset>
                    <legend><?php echo __('Add Region'); ?></legend>
                -->
                <?php
                    echo $this->Form->input('location_id');
                    echo $this->Form->input('name');
                ?>
                <!--
                </fieldset>
                -->
            <?php echo $this->Form->end(__('Submit'));?>
        </div>
    </div>
</div>


<!--
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Regions'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
