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
                    <h4 class="subheader">&nbsp;Register for Account</h4>
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
                        'label' => 'Register',
                        'class' => 'button sixteen',
                        'div' => false
                    );

                    echo $this->Form->end($options_end);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="three columns">
    </div>
</div>

<?php
    echo $this->Html->script('user_register');
    echo $this->Html->script('select2');
?>
