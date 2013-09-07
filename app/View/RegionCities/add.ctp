<div class="row">
    <div class="four columns">
        <dl class="vertical tabs">
            <dd><?php echo $this->Html->link(__('List Cities/LGUs'), array('action' => 'index')); ?></li>
            <dd class="active"><?php echo $this->Html->link(__('Add New'), array('action' => 'add')); ?></li>
        </dl>
    </div>

    <div class="twelve columns">
        <div class="panel">
            <?php echo $this->Form->create('RegionCity');?>
                <?php
                    echo $this->Form->input('region_id', array(
                        'class' => 'select2',
                        //'style' => 'width: 350px',
                        'tabindex' => '2',
                    ));
                ?>
                <?php
                    if(empty($this->request->data)) {
                        echo $this->Form->input('RegionCity.0.name', array('id' => 'AddNewRegionCity_0'));
                    } else {
                        //echo 'invalidated';
                        foreach($this->request->data['RegionCity'] as $key => $region_city) {
                            if(!is_array($region_city)) {
                                continue;
                            } else {
                                echo $this->Form->input('RegionCity.' . $key . '.name', array('id' => 'AddNewRegionCity_' . $key));
                            }
                        }
                    }
                ?>
                <!--
                <a href="#" id="regionCityAddNewField">Add new field</a>
                -->
                <?php //endif; ?>
            <?php echo $this->Form->end(__('Submit'));?>
        </div>
    </div>
</div>

