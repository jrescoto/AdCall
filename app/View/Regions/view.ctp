<?php
    //debug($region);
?>
<div class="row">
    <div class="four columns">
    <?php echo $this->element('navigation');?>
    </div>
    <div class="twelve columns">
        <br/>
        <dl class="tabs three-up">
            <dd class="active"><a href="#details">Details</a></dd>
            <dd><a href="#related">Related</a></dd>
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
                            <h6 class="subheader"><?php echo $region['Region']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Location:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $region['Location']['name'];?></h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Created:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader">
                                <?php echo $region['Region']['created']; ?>
                            </h6>
                        </div>
                    </div>
                    <div class="row labelspacer">
                        <div class="four columns emphasize">
                            <h6>Modified:</h6>
                        </div>
                        <div class="twelve columns">
                            <h6 class="subheader"><?php echo $region['Region']['modified'];?></h6>
                        </div>
                    </div>
                </div>
            </li>
            <li id="relatedTab">
                <div class="panel" style="background: #ffffff; border: 0px">
                    <br/>
                    <?php if(!empty($region['RegionCity'])):?>
                        <div class="row labelspacer">
                            <div class="two columns emphasize">
                                <h6>Count:</h6>
                            </div>
                            <div class="fourteen columns">
                                <h6 class="subheader">
                                    <?php echo count($region['RegionCity']) . ' region cities found.';?>
                                </h6>
                            </div>
                        </div>
                    <?php else: ?>
                    <div class="row labelspacer">
                        <div class="sixteen columns emphasize">
                            <h5 class="subheader">No region cities found.</h5>
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
