<?php
//debug($this->request->data);
//debug($this->validationErrors);
?>
<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('View User'), array('action' => 'view', $this->Form->value('User.user_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $this->Form->value('User.user_id')));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('Change User Password'), array('action' => 'change_password', $this->Form->value('User.user_id')));?></dd>
            <dd><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></dd>
        </dl>
    </div>
    <div class="twelve columns">
        <div class="panel">
        <?php
            echo $this->Form->create('User', array(
                    'inputDefaults' => array(
                        //'label' => false,
                        'div' => false,
                        'error' => array(
                            'wrap' => 'small',
                            'class' => 'error'
                        )
                    )
                ));
        ?>
        <div class="row">
            <div class="sixteen columns">
            <?php
            echo $this->Form->input('user_id');
            ?>
            </div>
        </div>
        <br/>
        <?php if($current_user['role_id'] != 1): ?>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('current_password', array('type' => 'password'));
            ?>
            </div>
        </div>
        <?php endif;?>


        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('new_password', array('type' => 'password'));
                //echo $this->Form->input('change_password', array('type' => 'password'));
            ?>
            </div>
        </div>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('confirm_new_password', array('type' => 'password'));
            ?>
            </div>
        </div>
        <br/><br/>
        <div class="row">
            <div class="five columns offset-by-six">
                <a href="#" class="secondary button sixteen">Clear</a>
            </div>
            <div class="five columns">
                <?php
                    $options_end = array(
                        'label' => 'Submit',
                        'class' => 'button sixteen',
                        'div' => false
                    );
                    echo $this->Form->end($options_end);
                ?>
                <!--<input class="button sixteen" type="submit" value="Submit" />-->
            </div>
        </div>
        </div>
    </div>
</div>
    <?php
        echo $this->Html->script('user_edit');
        echo $this->Html->script('select2');
    ?>




<!--
<div class="users form">
	<dl>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
	</dl>
	
	&nbsp;
	&nbsp;
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Change password'); ?></legend>
	<?php
		//debug($current_user);
		if($current_user['role_id'] == 1)
		{
			echo $this->Form->input('user_id');
			echo $this->Form->input('new_password', array('type' => 'password'));
			echo $this->Form->input('confirm_new', array('type' => 'password'));
		}
		else
		{
			echo $this->Form->input('user_id');
			echo $this->Form->input('current_password', array('type' => 'password'));
			echo $this->Form->input('new_password', array('type' => 'password'));
			echo $this->Form->input('confirm_new', array('type' => 'password'));
		}
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['user_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['user_id']), null, __('Are you sure you want to delete # %s?', $user['User']['user_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List User Details'), array('controller' => 'user_details', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New User Detail'), array('controller' => 'user_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Campaigns'), array('controller' => 'campaigns', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Campaign'), array('controller' => 'campaigns', 'action' => 'add')); ?> </li>
	</ul>
</div>
-->
