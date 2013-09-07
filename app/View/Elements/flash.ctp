<div class="row">
    <?php if($logged_in): ?>
        <!--<div class="four columns"></div>-->
        <div class="sixteen columns">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->Session->flash('auth');?>
        </div>
    <?php else: ?>
        <div class="three columns">
        </div>
        <div class="ten columns">
            <?php echo $this->Session->flash(); ?>
        </div>
        <div class="three columns">
        </div>
    <?php endif; ?>
</div>


