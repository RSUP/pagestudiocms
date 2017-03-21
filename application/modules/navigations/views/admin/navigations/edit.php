<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Entries
                <small></small><br />
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
            <div class="col-lg-8">                
                <div class="box">
                    <div class="heading">
                        <h1><img alt="" src="<?php echo theme_url('assets/images/category.png'); ?>"> <?php echo ($edit_mode) ? 'Edit' : 'Add' ?> Navigation</h1>

                        <div class="buttons">
                            <a class="button" href="#" onClick="$('#form').submit();"><span>Save</span></a>
                            <a class="button" href="<?php echo site_url(ADMIN_PATH . '/navigations/index'); ?>"><span>Cancel</span></a>
                        </div>
                    </div>
                    <div class="content">

                        <?php echo form_open(null, 'id="form"')?>

                        <div class="form">
                            <div>
                                <?php echo form_label('Title:', 'title')?>
                                <?php echo form_input(array('name' => 'title', 'value' => set_value('title', isset($Group->title) ? $Group->title : '')))?>
                            </div>
                        </div>

                        <div class="clear"></div>

                        <?php echo form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
        
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->

<div class="options-pane">
</div>