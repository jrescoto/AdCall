<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('List Locations'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?></li>
        </dl>
    </div>

    <div class="twelve columns"> <!-- start nine columns -->
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
                    <h5><?php echo __('Locations');?></h5>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('name');?></th>
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($locations as $location): ?>
                            <tr>
                                <td><?php echo h($location['Location']['name']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php
                                        echo $this->element(
                                            'actions', array(
                                                'role' => $current_user['role_id'],
                                                'user_id' => $current_user['user_id'],
                                                'content' => $location,
                                                'content_index' => 'Location',
                                                'content_id' => 'location_id',
                                            )
                                        );
                                    ?>
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
    </div><!-- end nine columns -->
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
?>
