<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('List Regions'), array('action' => 'index')); ?></dd>
            <dd><?php echo $this->Html->link(__('New Region'), array('action' => 'add')); ?></dd>
            <dd><?php echo $this->Html->link(__('List Locations'), array('controller' => 'locations', 'action' => 'index')); ?> </dd>
            <dd><?php echo $this->Html->link(__('New Location'), array('controller' => 'locations', 'action' => 'add')); ?> </dd>
            <dd><?php echo $this->Html->link(__('List Region Cities'), array('controller' => 'region_cities', 'action' => 'index')); ?> </dd>
            <dd><?php echo $this->Html->link(__('New Region City'), array('controller' => 'region_cities', 'action' => 'add')); ?> </dd>
        </dl>
    </div>

    <div class="twelve columns"> <!-- start nine columns -->
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
                    <h5><?php echo __('Regions');?></h5>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
                                <!--<th><?php echo $this->Paginator->sort('region_id');?></th>-->
                                <th><?php echo $this->Paginator->sort('name');?></th>
                                <th><?php echo $this->Paginator->sort('location_id');?></th>
                                <!--<th><?php echo $this->Paginator->sort('created');?></th>-->
                                <!--<th><?php echo $this->Paginator->sort('modified');?></th>-->
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($regions as $region): ?>
                        <tr>
                            <!--<td><?php echo h($region['Region']['region_id']); ?>&nbsp;</td>-->
                            <td><?php echo h($region['Region']['name']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($region['Location']['name'], array('controller' => 'locations', 'action' => 'view', $region['Location']['location_id'])); ?>
                            </td>
                            <!--<td><?php echo h($region['Region']['created']); ?>&nbsp;</td>-->
                            <!--<td><?php echo h($region['Region']['modified']); ?>&nbsp;</td>-->
                            <td class="actions">
                                <?php
                                echo $this->element(
                                    'actions', array(
                                        'role' => $current_user['role_id'],
                                        'user_id' => $current_user['user_id'],
                                        'content' => $region,
                                        'content_index' => 'Region',
                                        'content_id' => 'region_id',
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
    </div><!-- end nine columns -->
</div>
<?php echo $this->Js->writeBuffer(); ?>
