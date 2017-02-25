<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                <i class="icon x32 icon-media"></i>
                Image Edit
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
            
            <div class="buttons">
                <a class="button" href="#" onClick="$('#image_form').submit()"><span>Save</span></a>
                <a class="button" href="<?php echo site_url(ADMIN_PATH . '/galleries/images/index/' . $Image->gallery_id); ?>"><span>Cancel</span></a>
            </div>
        </section>
        
        <div class="row" style="padding:35px 25px">  
        
            <?php echo form_open(null, 'id="image_form"'); ?>
            <div>
                <?php echo form_label('<span class="required">*</span> Title:', 'title'); ?>
                <?php echo form_input(array( 'name' => 'title', 'value' => set_value('title', isset($Image->title) ? $Image->title : ''))); ?>
            </div>

            <div>
                <?php echo form_label('Alternative Text:', 'alt'); ?>
                <?php echo form_input(array( 'name' => 'alt', 'value' => set_value('alt', isset($Image->alt) ? $Image->alt : ''))); ?>
            </div>

            <div>
                <?php echo form_label('Image:', 'filename'); ?>
                <a id="change_image" href="javascript:void(0)"><img id="image" src="<?php echo image_thumb($Image->filename, 100, 100); ?>" /></a>
                <input type="hidden" value="<?php echo set_value('filename', isset($Image->filename) ? $Image->filename : ''); ?>" name="filename" id="filename" />
            </div>

            <div>
                <?php echo form_label('Description:', 'description'); ?>
                <div style="display: inline-block;">
                    <?php echo form_textarea(array( 'name' => 'description', 'id' => 'description', 'value' => set_value('description', isset($Image->description) ? $Image->description : ''))); ?>
                </div>
            </div>
            
            <div>
                <?php echo form_label('Credits:', 'credits'); ?>
                <?php echo form_input(array( 'name' => 'credits', 'value' => set_value('credits', isset($Image->credits) ? $Image->credits : ''))); ?> <span style="display: inline;" class="help">(The author name or URL)<span>
            </div>
            
            <div>
                <?php echo form_label('Link:', 'link'); ?>
                <?php echo form_input(array( 'name' => 'link', 'value' => set_value('link', isset($Image->link) ? $Image->link : ''))); ?> <span style="display: inline;" class="help">(The full URL)<span>
            </div>
            
            <div>
                <?php echo form_label('Link Text:', 'link_text'); ?>
                <?php echo form_input(array( 'name' => 'link_text', 'value' => set_value('link_text', isset($Image->link_text) ? $Image->link_text : ''))); ?> <span style="display: inline;" class="help"><span>
            </div>

            <div>
                <?php echo form_label('', '')?>
                <span>
                    <label><?php echo form_checkbox(array( 'name' => 'hide', 'id' => 'hide', 'value' => '1', 'checked' => set_checkbox('hide', '1', (isset($Image->hide) && $Image->hide) ? TRUE : FALSE))); ?> Hide Image <span style="display: inline;" class="help">(Will not be shown in gallery)<span></label>
                </span>
            </div>

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
<?php js_start(); ?>
<script type="text/javascript">
    $(document).ready( function() {

        $('#change_image').click( function() {
            window.KCFinder = {
                callBack: function(url) {
                    window.KCFinder = null;
                    $.post('<?php echo site_url(ADMIN_PATH . '/galleries/images/create-thumb'); ?>', {'image_path': url}, function(image_path) {
                        $('#image').attr('src', image_path);
                        $('#filename').attr('value', url);
                    });
                }
            };
            var left = (screen.width/2)-(800/2);
            var top = (screen.height/2)-(600/2);
            window.open(THEME_URL + '/assets/js/kcfinder/browse.php?type=images',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=1, scrollbars=0, width=800, height=600, top=' + top + ', left=' + left
            );
        });

        var thin_config = {
            toolbar : [
                { 
                    name: 'basicstyles', 
                    items: [ 'Format','Bold','Italic','-','NumberedList','BulletedList','-','Link','Unlink','-','Source' ]
                }
            ],
            entities : false,
            resize_maxWidth : '400px',
            width : '550px',
            height : '120px'
        };
        
        var thin_config = {
            toolbar : [
                { 
                    name: 'basicstyles', 
                    items: [ 'Format','Bold','Italic','-','NumberedList','BulletedList','-','Link','Unlink','-','Source' ]
                }
            ],
            entities : false,
            resize_maxWidth : '400px',
            width : '550px',
            height : '120px'
        };

        $('textarea#description').ckeditor(thin_config);
    });
</script>
<?php js_end(); ?>
