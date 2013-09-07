<?php
    //debug($regionCity);
?>
<div class="row">
    <div class="four columns">
    <?php echo $this->element('navigation');?>
    </div>
    <div class="twelve columns">
        <br/>
        <dl class="tabs three-up">
            <dd class="active"><a href="#details">Details</a></dd>
            <dd><a href="#subscribers">Related Subscribers</a></dd>
        </dl>
        <div style="padding-left: 10px">
        <ul class="tabs-content">
            <li class="active" id="detailsTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Name:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $regionCity['RegionCity']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Region:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $regionCity['Region']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Created:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader">
                                <?php echo $regionCity['RegionCity']['created']; ?>
                            </h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Modified:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $regionCity['RegionCity']['modified'];?></h6>
                        </div>
                    </div>
                </div>
            </li>
            <li id="subscribersTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <?php if(!empty($regionCity['Subscriber'])):?>
                        <div class="row labelspacer">
                            <div class="two columns emphasize">
                                <h6>Count:</h6>
                            </div>
                            <div class="fourteen columns">
                                <h6 class="subheader">
                                    <?php echo count($regionCity['Subscriber']) . ' subscribers found.';?>
                                </h6>
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="row labelspacer">
                        <div class="sixteen columns emphasize">
                            <h5 class="subheader">No subscribers found.</h5>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </li>
        </ul>
        </div>
        <hr/>
    </div>
</div>
<?php
    echo $this->Html->script('foundation.min');
    echo $this->Html->script('app');
?>
