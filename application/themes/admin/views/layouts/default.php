<?php echo theme_partial('header'); ?>

<!-- #main section -->
    <section class="main_panes">
        <!-- left-pane -->
        <div class="left-pane">
            <div id="leftPane" class="scrollable">
                <!-- nav-menu-panel-right -->
                <?php echo theme_partial('main-navigation-inner'); ?>
                <!-- // nav-menu-panel-right -->
            </div>
        </div>
        <!-- // Apps pane -->
        
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo validation_errors(); ?>
        <?php echo  $content; ?>
    </section>

<?php echo theme_partial('footer'); ?>
