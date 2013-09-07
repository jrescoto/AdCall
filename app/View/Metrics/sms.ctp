<?php
    //debug($codes);
?>
<div class="row">
    <div class="sixteen columns">
        <div class="panel" style="padding: 30px">
            <div class="row">
                <div class="sixteen columns">
                    <div id="notif" class="alert-box alert sixteen" style="display: none">
                        <span></span>
                    </div>
                </div>
            </div>


            <div class="row">
                <?php
                    echo $this->Form->create('Metrics', array(
                            'inputDefaults' => array(
                                //'label' => false,
                                'div' => false,
                                'error' => array(
                                    'wrap' => 'small',
                                    'class' => 'error'
                                )
                            ),
                            'action' => 'sms_stat_pdf',
                            'target' => '_blank'
                        ));
                ?>

                <div class="eight columns">
                <?php
                    echo $this->Form->input(
                        'codes',
                        array(
                            'label' => false,
                            'options' => $codes,
                            'style' => array('width: 100%'),
                            'multiple' => 'multiple'
                        )
                    );
                ?>
                </div>
                <div class="three columns">
                <?php
                    echo $this->Form->input(
                        'start',
                        array(
                            'label' => false,
                            'class' => array('sixteen'),
                            'value' => 'Start date'
                        )
                    );
                ?>
                </div>
                <div class="three columns">
                <?php
                    echo $this->Form->input(
                        'end',
                        array(
                            'label' => false,
                            'class' => array('sixteen'),
                            'value' => 'End date'
                        )
                    );
                ?>
                </div>
                <div class="one columns">
                <?php
                    echo $this->Form->button(
                        '<i class="foundicon-right-arrow"></i>',
                        array(
                            'id' => 'generate',
                            'type' => 'button',
                            'escape' => false,
                            'class' => 'small secondary button has-tip sixteen',
                            'title' => 'generate',
                            'style' => 'height: 32px'
                        )
                    );
                ?>
                </div>
                <div class="one columns">
                <?php
                    echo $this->Form->button(
                        '<i class="foundicon-inbox"></i>',
                        array(
                            'id' => 'download',
                            'type' => 'button',
                            'escape' => false,
                            'class' => 'small secondary button has-tip sixteen',
                            'title' => 'download PDF',
                            'style' => 'height: 32px'
                        )
                    );
                ?>
                </div>
            </div>
            <?php echo $this->Form->end();?>

            <br/>
            <div class="row">
                <div id="loader" class="sixteen columns centered" style="">
                    <div style="width: 40%; text-align: right; float: left">
                    <?php echo $this->Html->image('paginate.gif')?>
                    </div>
                    <div style="width: 60%; float: right; text-align: left; padding-top: 10px; font-size: 12px;">
                        <span>Loading. Please wait...</span>
                    </div>
                </div>
            </div>

            <br/>
            <br/>
            <br/>
            <div id="result">
            </div>
        </div>
    </div>
</div>

<?php
    echo $this->Html->script('metrics_sms');
    //echo $this->Html->script('foundation.min');
    //echo $this->Html->script('app');
    echo $this->Html->script('select2');
?>
