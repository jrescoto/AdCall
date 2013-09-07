<?php
    //print Configure::version();
    //debug($this->request->params);
    $index_active = $add_active = $edit_active = $view_active = null;
    switch(strtolower($this->request->params['action'])){
        case 'view': $view_active = 'active'; break;
        case 'add': $add_active = 'active'; break;
        case 'index': $index_active = 'active'; break;
        case 'edit':
        case 'upload_content':
        case 'profile_setting':
        case 'submit':
            $edit_active = 'active';
            break;
    }
?>
<!--
<div class="row">
    <div class="sixteen columns">
        <div class="panel">
        </div>
    </div>
</div>
-->
<?php //debug($this);?>
<div class="row">
    <div class="fifteen columns">
        <!--
        <h3 style="display: inline"><?php echo $this->name?></h3>&nbsp;/&nbsp;<h4 style="display: inline" class="subheader"><?php echo $this->request->params['action'];?></h4>
        -->
        <?php if(strcmp('CakeError', $this->name) != 0): ?>
            <h3 style="display: inline"><?php echo $this->name?></h3>
        <? endif; ?>
        <!--
        <div class="panel">
        -->
        <!--
        </div>
        -->
    </div>
    <div class="one columns">
        <div id="busy-indicator">
            Loading
        </div>
    </div>
</div>


<?php //if(strcmp($this->request->params['controller'], 'dashboard') != 0): ?>
<?php if(!in_array($this->request->params['controller'], array('dashboard', 'metrics'))): ?>
<!--
<div class="row">
    <div class="sixteen columns">
            <ul class="nav-bar2">
                <li class="<?php echo $index_active; ?>">
                    <?php echo $this->Html->link(__('List'), array('action' => 'index')); ?>
                </li>
                <li class="<?php echo $view_active; ?>">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view')); ?>
                </li>
                <li class="<?php echo $add_active; ?>">
                    <?php echo $this->Html->link(__('Add New'), array('action' => 'add')); ?>
                </li>
                <li class="<?php echo $edit_active; ?>">
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'index')); ?>
                </li>
            </ul>
    </div>
</div>
-->
<?php endif;?>
<br/>
<br/>
