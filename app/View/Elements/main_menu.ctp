<div class="row">
	<div class="twelve columns">
    <ul class="nav-bar">
		<?php if($role == 1): ?>
            <?php if(strcmp('Dashboard', $this->viewPath) == 0): ?>
			<li class="active"><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'dashboard', 'action' => 'index')); ?></li>
            <?php else: ?>
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'dashboard', 'action' => 'index')); ?></li>
            <?php endif; ?>

            <li><?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'view', $user_id)); ?></li>

            <?php if(strcmp('Users', $this->viewPath) == 0): ?>
			<li class="active"><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?></li>
            <?php else: ?>
			<li><?php echo $this->Html->link(__('Users'), array('controller' => 'users', 'action' => 'index')); ?></li>
            <?php endif; ?>

            <!--
            <?php if(strcmp('Roles', $this->viewPath) == 0): ?>
			<li class="active"><?php echo $this->Html->link(__('Roles'), array('controller' => 'Roles', 'action' => 'index')); ?></li>
            <?php else: ?>
			<li><?php echo $this->Html->link(__('Roles'), array('controller' => 'Roles', 'action' => 'index')); ?></li>
            <?php endif; ?>
            -->

            <?php if(strcmp('Campaigns', $this->viewPath) == 0): ?>
			<li class="active"><?php echo $this->Html->link(__('Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?></li>
            <?php else: ?>
			<li><?php echo $this->Html->link(__('Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?></li>
            <?php endif; ?>

            <?php if(strcmp('Regions', $this->viewPath) == 0): ?>
			<li class="active"><?php echo $this->Html->link(__('Regions'), array('controller' => 'regions', 'action' => 'index')); ?></li>
            <?php else: ?>
			<li><?php echo $this->Html->link(__('Regions'), array('controller' => 'regions', 'action' => 'index')); ?></li>
            <?php endif; ?>

            <?php if(strcmp('Statuses', $this->viewPath) == 0): ?>
			<li class="active"><?php echo $this->Html->link(__('Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?></li>
            <?php else: ?>
			<li><?php echo $this->Html->link(__('Statuses'), array('controller' => 'statuses', 'action' => 'index')); ?></li>
            <?php endif; ?>

		<?php else: ?>
			<li><?php echo $this->Html->link(__('Dashboard'), array('controller' => 'users', 'action' => 'index')); ?></li>
			<?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'view', $user_id)); ?>
			<?php echo $this->Html->link(__('Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?>
		<?php endif;?>
	</div>
</div>
