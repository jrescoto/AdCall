<div class="">
    <div class="container top-bar">
        <div class="row">
            <div class="sixteen columns">
                <nav class="top-bar">
                    <ul>
                        <!-- Title Area -->
                        <li class="name">
                        <h1>
                            <a class="logo" href="/AdCall/dashboard">
                            <?php echo $this->Html->image('smart_logo.png'); ?>
                            <span>
                                AdCall CMT
                            </span>
                            </a>
                        </h1>
                        </li>
                        <li class="toggle-topbar"><a href="#"></a></li>
                    </ul>
                    <section>
                        <ul class="right">
                            <?php if($logged_in): ?>
                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <?php
                                echo $this->Html->link(
                                    __('Campaigns'),
                                    array(
                                        'controller' => 'campaigns',
                                        'action' => 'index',
                                    ),
                                    array(
                                        'class' => 'campaigns'
                                    )
                                )
                                ?>
                                <ul class="dropdown">
                                    <li><?php echo $this->Html->link(__('List'), array('controller' => 'campaigns', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link(__('Add New'), array('controller' => 'campaigns', 'action' => 'add')); ?></li>
                                </ul>
                            </li>


                            <?php if($role == 1): ?>
                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <?php
                                echo $this->Html->link(
                                    __('Users'),
                                    array(
                                        'controller' => 'users',
                                        'action' => 'index',
                                    ),
                                    array(
                                        'class' => 'users'
                                    )
                                )
                                ?>
                                <ul class="dropdown">
                                    <li><?php echo $this->Html->link(__('List'), array('controller' => 'users', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link(__('Add New'), array('controller' => 'users', 'action' => 'add')); ?></li>
                                </ul>

                            </li>
                            <li class="divider"></li>
                            <li class="">
                                <?php
                                echo $this->Html->link(
                                    __('DBM'),
                                    array(
                                        'controller' => 'subscribers',
                                        'action' => 'index',
                                    ),
                                    array(
                                        'class' => 'subscribers'
                                    )
                                )
                                ?>
                            </li>


                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <a class="cmt_contents" href="#">Location Settings</a>
                                <ul class="dropdown">
                                    <li><?php echo $this->Html->link(__('Locations'), array('controller' => 'locations', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link(__('Regions'), array('controller' => 'regions', 'action' => 'index')); ?></li>
                                    <li><?php echo $this->Html->link(__('Cities/LGUs'), array('controller' => 'region_cities', 'action' => 'index')); ?></li>
                                </ul>
                            </li>
                            <?php endif; ?>

                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <?php
                                echo $this->Html->link(
                                    __('Metrics'),
                                    array(
                                        'controller' => 'metrics',
                                        'action' => 'index',
                                    ),
                                    array(
                                        'class' => 'statistics'
                                    )
                                )
                                ?>
                                <ul class="dropdown">
                                    <li><?php echo $this->Html->link(__('AdCall Stats and Reports'), array('controller' => 'metrics', 'action' => 'adcall')); ?></li>
                                    <?php if($role == 1): ?>
                                    <li><?php echo $this->Html->link(__('SMS Stats and Reports'), array('controller' => 'metrics', 'action' => 'sms')); ?></li>
                                    <?php endif; ?>
                                </ul>
                            </li>


                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <a href="#"><i class="foundicon-settings foundicon-settings-override"></i></a>
                                <ul class="dropdown">
                                    <li>
					                    <?php echo $this->Html->link(__('Profile'), array('controller' => 'users', 'action' => 'view', $user_id))?>
                                    </li>
                                    <li>
					                    <?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'))?>
                                    </li>
                                </ul>
                            </li>
                            <?php else: ?>
                            <li class="divider"></li>
                            <li class="has-dropdown">
                                <a href="#"><i class="foundicon-settings foundicon-settings-override"></i></a>
                                <ul class="dropdown">
                                    <li>
					                    <?php echo $this->Html->link(__('Register for Account'), array('controller' => 'users', 'action' => 'register'))?>
                                    </li>
                                    <li>
					                    <?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login'))?>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </section>
                </nav>
            </div>
        </div>
    </div>
</div>
