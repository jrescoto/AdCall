<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('List Cities/LGUs'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('Add New'), array('action' => 'add')); ?></li>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
                    <h5><?php echo __('Region Cities/LGUs');?></h5>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
                                <th><?php echo $this->Paginator->sort('name');?></th>
                                <th><?php echo $this->Paginator->sort('region_id');?></th>
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($regionCities as $regionCity): ?>
                            <tr>
                                <td><?php echo h($regionCity['RegionCity']['name']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $this->Html->link($regionCity['Region']['name'], array('controller' => 'regions', 'action' => 'view', $regionCity['Region']['region_id'])); ?>
                                </td>
                                <td class="actions">
                                    <?php
                                        echo $this->element(
                                            'actions', array(
                                                'role' => $current_user['role_id'],
                                                'user_id' => $current_user['user_id'],
                                                'content' => $regionCity,
                                                'content_index' => 'RegionCity',
                                                'content_id' => 'region_city_id',
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
?>

<?php echo $this->Js->writeBuffer(); ?>
