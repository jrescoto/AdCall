<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
            <dd class="active"><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <div class="row">
                <div class="sixteen columns">
                    <h5><?php echo __('Add New User');?></h5>
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
                    <h6 class="subheader">Role</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('role_id', array('label' => false, 'class' => 'eight'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Username</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('username', array('label' => false, 'class' => 'sixteen'));
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
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Confirm Password</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('confirm_password', array('label' => false, 'class' => 'sixteen', 'type' => 'password'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Email</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('email', array('label' => false, 'class' => 'sixteen'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Name</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('UserDetail.name', array('label' => false, 'class' => 'sixteen'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Position</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('UserDetail.position', array('label' => false, 'class' => 'sixteen'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Company</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('UserDetail.company', array('label' => false, 'class' => 'sixteen'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Company Address</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('UserDetail.company_address', array('label' => false, 'class' => 'sixteen'));
                    ?>
                </div>
            </div>
            <div class="row labelspacer">
                <div class="four columns emphasize">
                    <h6 class="subheader">Mobile Number</h6>
                </div>
                <div class="twelve columns" style="padding-top: 7px">
                    <?php
                        echo $this->Form->input('UserDetail.mobile', array('label' => false, 'class' => 'sixteen'));
                    ?>
                </div>
            </div>
            <br/>
            <br/>
            <div class="row"> 
                <div class="five columns offset-by-six">
                    <?php
                        echo $this->Html->Link(
                            'Clear',
                            array(
                                'action' => ''
                            ),
                            array(
                                'class' => 'secondary button sixteen'
                            )
                        );
                    ?>
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
                </div>
            </div>
    </div>
</div>
<?php
    echo $this->Html->script('user_add');
    echo $this->Html->script('select2');
?>
