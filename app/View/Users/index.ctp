<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <div class="row">
                <div class="six columns">
                    <h5><?php echo __('Users');?></h5>
                </div>
                <div class="ten columns">
                    <h5><input id="UserSearch" type="hidden" class="sixteen" /></h5>
                </div>
            </div>

            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('role_id');?></th>
                                <th><?php echo $this->Paginator->sort('username');?></th>
                                <th><?php echo $this->Paginator->sort('email');?></th>
                                <th><?php echo $this->Paginator->sort('active');?></th>
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo h($user['Role']['description']); ?>&nbsp;</td>
                                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                                <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                                <td><?php echo h($user['User']['active']); ?>&nbsp;</td>
                                <td class="actions">
                                <?php
                                    echo $this->element(
                                        'actions', array(
                                            'role' => $current_user['role_id'],
                                            'user_id' => $current_user['user_id'],
                                            'content' => $user,
                                            'content_index' => 'User',
                                            'content_id' => 'user_id',
                                        )
                                    );
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns">
                    <?php echo $this->element('paginator'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
    echo $this->Html->script('select2');
    echo $this->Html->script('user_index');
?>

<?php echo $this->Js->writeBuffer(); ?>
