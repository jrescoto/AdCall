<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo __('Smart AdCall CMT:'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery-ui-1.8.20.custom.min');
		//echo $this->Html->script('custom.events');

		echo $this->Html->css('foundation.16cols');
		echo $this->Html->css('general_foundicons');
		echo $this->Html->css('app');
		echo $this->Html->css('jquery-ui-1.8.20.custom');
		echo $this->Html->css('select2');
		echo $this->Html->css('jplayer.blue.monday');

		echo $this->Html->script('modernizr.foundation.js');

        /*
		echo $this->Html->css('foundation.16cols');
		echo $this->Html->css('chosen');
		echo $this->Html->css('jquery-ui-1.8.20.custom');
		echo $this->Html->css('select2');
		echo $this->Html->css('general_foundicons');
		echo $this->Html->css('app');

		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery-ui-1.8.20.custom.min');
        
		echo $this->Html->script('select2');
		echo $this->Html->script('campaigns');
		echo $this->Html->script('users');
		echo $this->Html->script('regions');
		echo $this->Html->script('region.cities');
		echo $this->Html->script('custom.events');
		echo $this->Html->script('charcounter');
         */

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <?php
		//echo $this->Html->script('jquery');
    ?>
    <?php
        echo $this->element(
            'navbar', array(
                'role' => $current_user['role_id'],
                'user_id' => $current_user['user_id']
            )
        );
    ?>
    <!--
    <br/>
    <br/>
    <br/>
    <br/>
    -->
    <?php if($logged_in):?>
    <?php echo $this->element('current'); ?>
    <?php endif; ?>

    <div id="container">
        <?php echo $this->element('flash'); ?>
		<div id="content" style="padding: 0px">
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>

    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <div class="sixteen columns">
	    <?php echo $this->element('sql_dump'); ?>
    </div>
    <?php
		//echo $this->Html->script('foundation.min');
		//echo $this->Html->script('app');
        //echo $this->Html->script('select2');
		//echo $this->Html->script('campaigns');

    ?>

    <?php
        if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')){
            echo $this->Js->writeBuffer();
            // Writes cached scripts
        }
    ?>
</body>
</html>
