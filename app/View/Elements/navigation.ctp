<?php
    $controller = $this->request->params['controller'];
    $primary_key = Inflector::singularize($controller);
    $class = Inflector::classify($controller);
    //debug($this->viewVars);
    //debug($controller)
    //$content = ($this->viewVars[lcfirst($class)]);
    $content = ($this->viewVars[strtolower($class)]);
    //debug($this->request->params);
    //debug($controller);
    //debug(Inflector::humanize($primary_key));
    //debug($content[$class]);
?>
<dl class="vertical tabs">
    <dd class="active"><?php echo $this->Html->link(__('View ' . Inflector::humanize($primary_key)), array('action' => 'view', $content[$class][$primary_key . '_id'])); ?></li>
    <dd><?php echo $this->Html->link(__('Edit ' . Inflector::humanize($primary_key)), array('action' => 'edit', $content[$class][$primary_key . '_id'])); ?></li>
    <dd><?php echo $this->Html->link(__('List ' . Inflector::humanize(Inflector::pluralize($primary_key))), array('action' => 'index')); ?></li>
    <dd><?php echo $this->Html->link(__('Add New ' . Inflector::humanize($primary_key)), array('action' => 'add')); ?></li>
    <dd>
        <?php
            if($current_user['role_id'] == 1)
                echo $this->Form->postLink(
                    __('Delete ' . Inflector::humanize($primary_key)),
                    array(
                        'action' => 'delete',
                        $content[$class][$primary_key . '_id']),
                        null,
                        __('Are you sure you want to delete # %s?',
                        $content[$class][$primary_key . '_id']
                    )
                );
        ?>
    </dd>
</dl>
