<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('View User'), array('action' => 'view', $this->Form->value('User.user_id')));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $this->Form->value('User.user_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Change User Password'), array('action' => 'change_password', $this->Form->value('User.user_id')));?></dd>
            <dd><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></dd>
        </dl>
    </div>
    <div class="twelve columns">
        <div class="panel">
        <?php
            echo $this->Form->create('User', array(
                    'inputDefaults' => array(
                        //'label' => false,
                        'div' => false,
                        'error' => array(
                            'wrap' => 'small',
                            'class' => 'error'
                        )
                    )
                ));
        ?>
        <div class="row">
            <div class="six columns">
            <?php
            echo $this->Form->input('user_id');
		    echo $this->Form->input('UserDetail.user_detail_id');
            if($current_user['role_id'] == 1)
                echo $this->Form->input('role_id', array('class' => 'sixteen'));
            ?>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('username');
            ?>
            </div>
        </div>

        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('email');
            ?>
            </div>
        </div>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('UserDetail.position');
            ?>
            </div>
        </div>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('UserDetail.company');
            ?>
            </div>
        </div>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('UserDetail.company_address');
            ?>
            </div>
        </div>
        <div class="row">
            <div class="sixteen columns">
            <?php
                echo $this->Form->input('UserDetail.mobile');
            ?>
            </div>
        </div>

        <br/><br/>
        <div class="row">
            <div class="five columns offset-by-six">
                <a href="#" class="secondary button sixteen">Clear</a>
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
                <!--<input class="button sixteen" type="submit" value="Submit" />-->
            </div>
        </div>
        </div>
    </div>
</div>
    <?php
        echo $this->Html->script('user_edit');
        echo $this->Html->script('select2');
    ?>
