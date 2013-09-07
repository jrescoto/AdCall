<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('List Subscribers'), array('action' => 'index')); ?></li>
            <!--<dd><?php echo $this->Html->link(__('New Subscriber'), array('action' => 'add')); ?></li>-->
            <dd><?php echo $this->Html->link(__('Custom Search'), array('action' => 'custom_search')); ?></li>
            <dd><?php echo $this->Html->link(__('Scope'), array('action' => 'custom_search')); ?></li>
        </dl>
    </div>

    <div class="twelve columns"> <!-- start nine columns -->
        <div class="panel">
            <div class="row">
                <div class="eight columns">
                    <h5><?php echo __('Subscribers');?></h5>
                </div>
                <div class="eight columns">
                    <h5><input id="subscriberSearch" type="hidden" class="sixteen" /></h5>
                </div>
                <!--
                <div class=" columns">
                    <?php
                        /*
                        echo $this->Html->link(
                            '<i class="foundicon-search foundicon-search-override"></i>',
                            array('action' => 'view', '1'), array('escape' => false, 'class' => 'has-tip', 'title' => 'view')
                        );
                         */
                    ?>
                </div>
                -->

            </div>
            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
			                    <th><?php echo $this->Paginator->sort('msisdn');?></th>
			                    <th><?php echo $this->Paginator->sort('age');?></th>
			                    <th><?php echo $this->Paginator->sort('gender');?></th>
			                    <th><?php echo $this->Paginator->sort('region_city_id');?></th>
			                    <th><?php echo $this->Paginator->sort('active');?></th>
			                    <!--<th><?php echo $this->Paginator->sort('date_on');?></th>-->
			                    <!--<th><?php echo $this->Paginator->sort('date_off');?></th>-->
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($subscribers as $subscriber): ?>
                            <tr>
                                <td><?php echo h($subscriber['Subscriber']['msisdn']); ?>&nbsp;</td>
                                <td><?php echo h($subscriber['Subscriber']['age']); ?>&nbsp;</td>
                                <td><?php echo h($subscriber['Subscriber']['gender']); ?>&nbsp;</td>
                                <td>
                                    <?php echo $this->Html->link($subscriber['RegionCity']['name'], array('controller' => 'region_cities', 'action' => 'view', $subscriber['RegionCity']['region_city_id'])); ?>
                                </td>
                                <td><?php echo h($subscriber['Subscriber']['active']); ?>&nbsp;</td>
                                <!--<td><?php echo h($subscriber['Subscriber']['date_on']); ?>&nbsp;</td>-->
                                <!--<td><?php echo h($subscriber['Subscriber']['date_off']); ?>&nbsp;</td>-->

                                <td class="actions">
                                    <?php
                                        echo $this->element(
                                            'actions', array(
                                                'role' => $current_user['role_id'],
                                                'user_id' => $current_user['user_id'],
                                                'content' => $subscriber,
                                                'content_index' => 'Subscriber',
                                                'content_id' => 'subscriber_id',
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
    echo $this->Html->script('select2');
    echo $this->Html->script('subscriber_index');
?>

<?php echo $this->Js->writeBuffer(); ?>
