<?php
    /*
     * Element actions 
     *
     * templating action commands in AdCall/<controller>/index view
     * @param content - array
     * @param content_index - Model name
     * @param content_id - Model primary key
     *
     * e.g.
     * content - $user
     * content_index - User
     * content_id - user_id
     *
     * access - $content[$content_index][$content_id]
     * access - $user['User']['user_id']
     */
?>

<?php
    //View link
    echo $this->Html->link(
        '<i class="foundicon-search foundicon-search-override"></i>',
        array('action' => 'view', $content[$content_index][$content_id]), array('escape' => false, 'class' => 'has-tip', 'title' => 'view')
    );
?>

<?php
    //Edit link
    echo $this->Html->link(
        '<i class="foundicon-edit foundicon-edit-override"></i>',
        array('action' => 'edit', $content[$content_index][$content_id]), array('escape' => false, 'class' => 'has-tip', 'title' => 'edit')
    );
?>

<?php
    //Delete post-link
    if($role == 1){
        echo $this->Form->postLink(
            '<i class="foundicon-trash foundicon-remove-override"></i>',
            array(
                'action' => 'delete',
                $content[$content_index][$content_id]
            ),
            array('escape' => false, 'class' => 'has-tip', 'title' => 'delete'),
            __(
                'Are you sure you want to delete # %s?',
                $content[$content_index][$content_id]
            )
        );
    }
?>

<?php
    if(in_array($content_index, array('User', 'Subscriber'))){
        $flag = ($content[$content_index]['active'] == 1) ? 0 : 1;
        $text = ($content[$content_index]['active'] == 1) ? 'deactivate' : 'activate';
        $icon = ($content[$content_index]['active'] == 1) ? '<i class="foundicon-lock foundicon-lock-override"></i>' : '<i class="foundicon-unlock foundicon-unlock-override"></i>';

        echo $this->Form->postLink(
            $icon,
            array(
                'action' => 'toggleActive',
                $content[$content_index][$content_id],
                $flag),
            array('escape' => false, 'class' => 'has-tip', 'title' => $text),
            __(
                "Are you sure you want to {$text} # %s?",
                $content[$content_index][$content_id]
            )
        );
    }
?>

