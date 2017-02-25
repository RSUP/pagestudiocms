<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                <i class="icon x32 icon-media"></i>
                <?php echo ($edit_mode) ? 'Edit' : 'Add' ?> Gallery
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
            
            <div class="buttons">
                <a class="button" href="#" onClick="$('#galleries_form').submit();"><span>Save</span></a>
            </div>
        </section>
        
        <br />                            
        
        <div class="row" style="padding:25px 25px">

            <?php echo form_open(null, 'id="galleries_form"')?>

                <?php echo form_label('Title:', 'title')?>
                <?php echo form_input(array('name' => 'title', 'value' => set_value('title', isset($Gallery->title) ? $Gallery->title : '')))?>

            <?php echo form_close(); ?>

        </div><!-- end padding -->
    </div><!-- end edit-pane -->
</div>

<!-- right-pane -->
<div class="options-pane">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            ...
        </div>
    </div>
</div><!-- // Apps pane -->  