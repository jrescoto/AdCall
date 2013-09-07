<?php
/*
    //$select_age_active = $specify_age_active = null;
    $disable_age_range_input = true;
    //$selected_age_range = null;
    if(empty($this->data['CampaignAgeRange'])){
        //$select_age_active = 'active';
    }else{
        if($this->data['CampaignAgeRange']['0']['type'] == 0){
            $select_age_active = 'active';
            foreach($this->data['CampaignAgeRange'] as $index => $value){
                $age_range = array($value['low'], $value['high']);
                //$selected_age_range[] = implode('_', $age_range);
            }
        }else{
            //$select_age_active = '';
            //$specify_age_active = 'active';
            $disable_age_range_input = false;
        }
    }
 */
?>

<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('View Campaign'), array('action' => 'view', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Edit Details'), array('action' => 'edit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Upload/Edit Contents'), array('action' => 'upload_content', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd class="active"><?php echo $this->Html->link(__('Target Profile Setting'), array('action' => 'profile_setting', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('Review and Submit'), array('action' => 'submit', $this->Form->value('Campaign.campaign_id')));?></dd>
            <dd><?php echo $this->Html->link(__('List Campaigns'), array('action' => 'index'));?></dd>
        </dl>
    </div>

    <div class="twelve columns"> <!-- start div twelve columns -->
        <div class="panel"> <!-- start div panel -->
            <?php
                echo $this->Form->create('Campaign', array(
                        'type' => 'file',
                        'class' => '',
                        'inputDefaults' => array(
                            'fieldset' => false
                        )
                    )
                );
            ?>
		    <?php echo $this->Form->input('campaign_id'); ?>
		    <?php echo $this->Form->input('CampaignSetting.campaign_setting_id'); ?>
            <?php echo $this->Form->input('filename', array('type' => 'hidden'));?>
            <div class="panel">
                <ul class="accordion">
                    <li class="<?php echo $select_age_active; ?>">
                        <div class="title" id="selectAgeRange">
                            <h5>Select Age Range</h5>
                        </div>
                        <div class="content" id="selectAgeRangeOptions">
                        <?php
                            echo $this->Form->input(
                                'age', array(
                                    //'label' => __('Ages', true),
                                    'type' => 'select',
                                    'multiple' => 'checkbox',
                                    'options' => array(
                                        '18_24' => '18 - 24',
                                        '25_35' => '25 - 35',
                                        '35_45' => '35 - 45',
                                        '45_60' => '45 - 60',
                                        '60_up' => '60 and above',
                                        'all_ages' => 'ALL ages'
                                    ),
                                    'selected' => $selected_age_range
                                )
                            );
                        ?>
                        <br/>
                            <div id="ageOptionError" class="alert-box alert" style="display: none;">
                                <span></span>
                            </div>
                        </div>
                    </li>
                    <li class="<?php echo $specify_age_active; ?>">
                        <div class="title" id="specifyAgeRange">
                            <h5>Specify Age Range</h5>
                        </div>
                        <div class="content" id="specifyAgeRangeInput">
                            <div class="row">
                                <div class="eight columns">
                                <?php
                                    echo $this->Form->input('age_from', array('style' => array(''), 'disabled' => $disable_age_range_input));
                                ?>
                                </div>

                                <div class="eight columns">
                                <?php
                                    echo $this->Form->input('age_to', array('style' => array(''), 'disabled' => $disable_age_range_input));
                                ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="eight columns">
                                    <div id="ageFromError" class="alert-box alert" style="display: none">
                                        <span></span>
                                    </div>
                                </div>
                                <div class="eight columns">
                                    <div id="ageToError" class="alert-box alert" style="display: none">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="panel">
            <?php
                $options = array('A' => 'All', 'M' => 'Male', 'F' => 'Female');
                $attributes = array(
                );
                echo $this->Form->input(
                    'gender',
                    array(
                        'options' => $options,
                        'default' => $selected_gender,
                        'separator' => '<br/>',
                        'type' => 'radio',
                    )
                );
            ?>	
            </div>

            <div class="panel">
                <div class="row">
                    <div class="sixteen columns">
                        <h5>Location</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="eight columns" style="padding: 5px">
                    <?php
                        echo $this->Form->select(
                            'Campaign.RegionFilter',
                            array(
                                0 => 'Specific regions',
                                1 => 'Include all regions except'
                            ),
                            array(
                                'default' => $region_filter,
                                'placeholder' => "Select Regions filter",
                                'style' => array('width: 100%'),
                            )
                           
                        );
                        echo '&nbsp;';
                        echo $this->Form->input(
                            'Campaign.RegionList',
                            array(
                                'label' => false,
                                'placeholder' => "Select Regions",
                                'multiple' => true,
                                'style' => array('width: 100%'),
                                'type' => 'select',
                                'options' => $regions,
                                'selected' => $selected_regions
                            )
                        );
                    ?>
                    </div>
                    <div class="eight columns" style="padding: 5px">
                    <?php
                        echo $this->Form->select(
                            'Campaign.RegionCityFilter',
                            array(
                                0 => 'Specific cities/lgus',
                                1 => 'Include all cities/lgus except'
                            ),
                            array(
                                'default' => $region_city_filter,
                                'placeholder' => "Select Cities/LGUs filter",
                                'style' => array('width: 100%'),
                            )
                        );
                        echo '&nbsp;';
                        echo $this->Form->input(
                            'Campaign.RegionCityList',
                            array(
                                'label' => false,
                                'placeholder' => "Select Cities/LGUs",
                                'multiple' => true,
                                'style' => array('width: 100%'),
                                'type' => 'select',
                                'options' => $cities_lgus,
                                'selected' => $selected_cities
                            )
                        );

                    ?>
                    </div>
                </div>
                &nbsp;

                <div class="row">
                    <div class="sixteen columns">
                    <div id="locationError" class="alert-box alert" style="display: none">
                        <span>Please fill necessary fields above.</span>
                    </div>
                    </div>
                </div>
                <?php //endif;?>
            </div>

            <div class="panel">
                <div class="row">
                    <div class="sixteen columns">
                        <div id="forcedClose" class="alert-box alert" style="display: none">
                            An error has occured. Please try again later.
                        </div>
                    </div>
                </div>
                <div class="row">
                <?php
                    $options_end = array(
                        'label' => 'Process',
                        'id' => 'data_mine',
                        'class' => 'button sixteen',
                        'div' => array(
                            'class' => 'six columns centered'
                        )
                    );
                    echo $this->Form->end($options_end);
                    /*
                    if(array_key_exists('RegionList', $this->validationErrors['Campaign']) ||
                        array_key_exists('RegionCityList', $this->validationErrors['Campaign'])):
                    */
                ?>
                        <!--<button id="data_mine" class="button sixteen">Process</button>-->
                </div>
                <!--
                <div class="row">
                    <div id="busy-indicator" class="two columns centered">
                        Loading...
                    </div>
                </div>
                -->
            </div>
        <?php //echo $this->Form->end(__('Submit'));?>

	    </div> <!-- end div main panel -->
    </div> <!-- end div twelve columns -->

    <div id="busyDataMining" class="reveal-modal">                                                                                      
        <div class="row" style="border-bottom: solid 1px #2ba6cb">
            <div class="fifteen columns">
                <h5><span>Data mining in progress...</span></h5>
            </div>
            <div id="dataMineLoader" class="one columns">
            </div>
        </div>

        <div class="row">
            <div class="sixteen columns">
                <div id="emptyFilename" class="alert-box alert" style="display: none">Please provide filename.</div>
            </div>
        </div>

        <div id="dataMineFields" class="panel">
            <div class="row">
                <div class="three columns emphasize">
                    <h6>Result:</h6>
                </div>
                <div id="dataMineResult" class="thirteen columns">
                    <h6 class="subheader"><span></span></h6>
                </div>
            </div>

            <div class="row">
                <div class="three columns emphasize">
                    <h6>Filename:</h6>
                </div>
                <div class="thirteen columns">
                    <h6 class="subheader"><input id="dataMineResultFilename" class="ten"/></h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="five columns offset-by-six">
                <button id="submitFromModal" disabled="disabled" class="small button sixteen">Save</button>
            </div>
            <div class="five columns">
                <button id="closeModal" disabled="disabled" class="small button sixteen">Re-profile</button>
            </div>
        </div>
        <!--<a class="close-reveal-modal">×</a>-->
    </div>  
    <?php
        //echo $this->Html->script('foundation.min');

        echo $this->Html->script('foundation.min');
        echo $this->Html->script('app');
        echo $this->Html->script('select2');
        echo $this->Html->script('campaign_target_profile');
    ?>
</div>
