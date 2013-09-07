<!--
<br/>
<br/>
<br/>
<br/>
-->
<br/>
<br/>
<?php echo $this->element('flash');?>
<div class="row">
    <div class="sixteen columns">
    </div>
</div>

<div class="row">
    <div class="three columns">
    </div>
    <div class="ten columns">
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
                    <h4 class="subheader">&nbsp;Login</h4>
                </div>
            </div>
            <?php
                echo $this->Form->create('User', array(
                    'inputDefaults' => array(
                        'div' => false,
                        'error' => array(
                            'wrap' => 'small',
                            'class' => 'error'
                        )
                    )
                ));
            ?>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Username</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('username', array('label' => false, 'class' => 'sixteen'));
                        //echo $this->Form->input('password', array('label' => false));
                        //next line has been added to identify w/c
                        //user detail will be edited in the controller (identified by user_detail_id primary key)
                        
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Password</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('password', array('label' => false, 'class' => 'sixteen'));
                        //echo $this->Form->input('password', array('label' => false));
                        //next line has been added to identify w/c
                        //user detail will be edited in the controller (identified by user_detail_id primary key)
                        
                    ?>
                </div>
            </div>
            <br/>
            <br/>
            <div class="row"> 
                <div class="six columns">
                    <?php
                    $options_end = array(
                        'label' => 'Login',
                        'class' => 'button sixteen',
                        'div' => false
                    );

                    echo $this->Form->end($options_end);
                    ?>
                </div>
                <div class="ten columns" style="text-align: right;padding-top: 10px">
                    <?php echo $this->Html->Link('Register for account.', array('action' => 'register'));?>
                </div>
            </div>
        </div>
    </div>
    <div class="three columns">
    </div>
</div>
