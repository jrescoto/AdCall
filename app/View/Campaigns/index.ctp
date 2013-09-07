<?php
    //debug($this);
?>
<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd class="active"><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index')); ?></li>
            <dd><?php echo $this->Html->link(__('New Campaign'), array('action' => 'add')); ?></li>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <div class="row">
                <div class="six columns">
                    <h5><?php echo __('Campaigns');?></h5>
                </div>
                <div class="ten columns">
                    <h5><input id="campaignSearch" type="hidden" class="sixteen" /></h5>
                </div>
            </div>
            <div class="row">
                <div class="sixteen columns">
                    <table class="sixteen">
                        <thead>
                            <tr>
                                <!--<th><?php echo $this->Paginator->sort('campaign_id');?></th>-->
                                <!--<th><?php echo $this->Paginator->sort('status_id');?></th>-->
                                <th><?php echo $this->Paginator->sort('title');?></th>
                                <!--<th><?php echo $this->Paginator->sort('sms_ad');?></th>-->
                                <!--<th><?php echo $this->Paginator->sort('audio_ad');?></th>-->
                                <th><?php echo $this->Paginator->sort('status_id');?></th>
                                <th><?php echo $this->Paginator->sort('start');?></th>
                                <th><?php echo $this->Paginator->sort('end');?></th>
                                <th class="actions"><?php echo __('Actions');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($campaigns as $campaign): ?>
                            <tr>
                                <!--<td><?php echo h($campaign['Campaign']['campaign_id']); ?>&nbsp;</td>-->
                                <!--<td><?php echo h($campaign['Campaign']['status_id']); ?>&nbsp;</td>-->
                                <td><?php echo h($campaign['Campaign']['title']); ?>&nbsp;</td>
                                <!--<td><?php echo h($campaign['Campaign']['sms_ad']); ?>&nbsp;</td>-->
                                <!--<td><?php echo h($campaign['Campaign']['audio_ad']); ?>&nbsp;</td>-->
                                <td><?php echo h($campaign['Status']['description']); ?>&nbsp;</td>
                                <td><?php echo h($campaign['Campaign']['start']); ?>&nbsp;</td>
                                <td><?php echo h($campaign['Campaign']['end']); ?>&nbsp;</td>
                                <td class="actions">
                                <?php
                                    echo $this->element(
                                        'actions', array(
                                            'role' => $current_user['role_id'],
                                            'user_id' => $current_user['user_id'],
                                            'content' => $campaign,
                                            'content_index' => 'Campaign',
                                            'content_id' => 'campaign_id',
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
                <div class="twelve columns">
                    <?php echo $this->element('paginator');?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
    echo $this->Html->script('select2');
    echo $this->Html->script('campaign_index');
?>
<?php echo $this->Js->writeBuffer(); ?>
