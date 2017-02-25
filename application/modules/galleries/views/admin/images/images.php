<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                <i class="icon x32 icon-media"></i>
                <?php echo $Gallery->title; ?> &ndash; Images
                <small>Gallery ID (#<?php echo $Gallery->id; ?>)</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
        
        <div class="row" style="padding:35px 25px 25px">       
        
            <ul id="sortable">
                <?php if ($Images->exists()): ?>
                    <?php foreach($Images as $Image):?>
                    <li class="js-sortable-enabled" data-sort-id="<?php echo $Image->id ?>">
                        <div class="gal-img-container">
                          <div class="gal-img-option">
                            <ul class="list-options">
                              <!-- <li><a href="<?php echo site_url(ADMIN_PATH . '/galleries/images/edit/'.$Image->id); ?>"> -->
                              <li>
                                <a href="#" class="js-edit-image"
                                    data-image-id="<?php echo isset($Image->id) ? $Image->id : ''?>"
                                    data-image-alt="<?php echo isset($Image->alt) ? $Image->alt : ''?>"
                                    data-image-credits="<?php echo isset($Image->credits) ? $Image->credits : ''?>"
                                    data-image-description="<?php echo isset($Image->description) ? $Image->description : ''?>"
                                    data-image-filename="<?php echo isset($Image->filename) ? $Image->filename : ''?>"
                                    data-image-hide="<?php echo isset($Image->hide) ? $Image->hide : 0 ?>"
                                    data-image-link="<?php echo isset($Image->link) ? $Image->link : ''?>"
                                    data-image-link_text="<?php echo isset($Image->link_text) ? $Image->link_text : ''?>"
                                    data-image-title="<?php echo isset($Image->title) ? $Image->title : ''?>">
                                    <i class="fa fa-pencil"></i> <span>Edit</span></a></li>
                              <li><a href="<?php echo site_url($Image->filename); ?>" download><i class="fa fa-cloud-download"></i> <span>Download</span></a></li>
                              <li><a href="#" class="delete js-delete-image" data-image-id="<?php echo isset($Image->id) ? $Image->id : ''?>"><i class="fa fa-trash"></i> <span>Delete</span></a></li>
                            </ul>
                          </div>
                          <div class="gal-image">
                            <a href="<?php echo site_url($Image->filename) ?>" data-fancybox="gallery" data-caption="<?php echo $Image->title; ?>" 
                                class="img-group-gallery cboxElement" title="<?php echo $Image->title; ?>" >
                                <img src="<?php echo image_thumb($Image->filename, 250, 200, true); ?>" class="img-responsive" alt="<?php echo $Image->title; ?>">
                            </a>
                          </div>
                          <div class="gal-img-desc" style="width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="<?php echo $Image->title; ?>">
                            <i class="fa fa-tags"></i> <?php echo $Image->title; ?>
                          </div>
                        </div>
                    </li><!--/ image -->
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- No images have been added. -->
                <?php endif; ?>
                <li class="ui-state-disabled">                
                    <a href="#" id="add_image" class="drag-drop-upload-btn">
                        <div class="drag-drop-upload-btn__inner">
                            <i class="pe-7s-up-arrow upload-link"></i><br />
                            <span>Click to Add Image</span>
                        </div>
                    </a>
                </li>
            </ul>

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

<!-- Edit Modal -->
<div class="modal fade box-modal" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header modal-header__tabbed right-tabs clearfix">                
            <div class="modal-title" id="lineModalLabel">My Modal</div>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Options</a></li>
                <li><a href="#tab2" data-toggle="tab">Settings</a></li>
            </ul>
        </div>
        <div class="modal-body">
            <div class="js-response"></div>
            <?php echo form_open(null, 'id="image_form"'); ?>
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <!-- content goes here -->
                        <div class="row">
                            <div class="col-lg-4">                                
                                <?php echo form_label('Image:', 'filename'); ?>
                                <a id="change_image" href="javascript:void(0)"><img id="image" src="" /></a>
                            </div>
                            <div class="col-lg-8">

                                <!-- Hidden fields -->
                                <div>
                                    <input type="hidden" value="<?php echo set_value('filename', ''); ?>" name="filename" id="filename" /> <!-- Actual image path -->
                                    <input type="hidden" value="<?php echo set_value('id', ''); ?>" name="id" id="id" />
                                </div>
                                
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Title:', 'title'); ?>
                                    <?php echo form_input(['name' => 'title', 'value' => set_value('title', ''), 'class' => 'form-control']); ?>
                                </div>

                                <div class="form-group">
                                    <?php echo form_label('Alternative Text:', 'alt'); ?>
                                    <?php echo form_input(['name' => 'alt', 'value' => set_value('alt', ''), 'class' => 'form-control']); ?>
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>

                                <div class="form-group">
                                    <?php echo form_label('Description:', 'description'); ?>
                                    <?php echo form_textarea(['name' => 'description', 'id' => 'description', 'rows' => 3, 'cols' => 40, 'value' => set_value('description', ''), 'class' => 'form-control']); ?>
                                </div>
                                
                                <div class="form-group">
                                    <?php echo form_label('Credits:', 'credits'); ?>
                                    <?php echo form_input(['name' => 'credits', 'value' => set_value('credits', ''), 'class' => 'form-control', 'placeholder' => 'The author name or URL']); ?> 
                                </div>
                                
                                <div class="form-group">
                                    <?php echo form_label('Link:', 'link'); ?>
                                    <?php echo form_input(['name' => 'link', 'value' => set_value('link', ''), 'class' => 'form-control', 'placeholder' => 'The full URL']); ?> 
                                </div>
                                
                                <div class="form-group">
                                    <?php echo form_label('Link Text:', 'link_text'); ?>
                                    <?php echo form_input(['name' => 'link_text', 'value' => set_value('link_text', ''), 'class' => 'form-control']); ?>
                                </div>

                                <div>
                                    <?php echo form_label('', '')?>
                                    <span>
                                        <label><?php echo form_checkbox(['name' => 'hide', 'id' => 'hide', 'value' => '1', 'checked' => set_checkbox('hide', '1', FALSE)]); ?> Hide Image <span class="help-block-inline">(Will not be shown in gallery)<span></label>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="tab2">
                        <!-- content goes here -->
                        <form>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Check me out
                            </label>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>

        </div>
        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Cancel</button>
                </div>
                <div class="btn-group btn-delete" role="group">
                    <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="saveImage" class="btn btn-default btn-hover-green js-save-image" data-action="save" role="button">Save</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<?php js_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        
        $( "#sortable" ).sortable({
            placeholder: "ui-state-highlight",
            items: "li:not(.ui-state-disabled)",
            update: function (event, ui) {
                var data = $( "#sortable" ).sortable('serialize', {
                    attribute: 'data-sort-id',//this will look up this attribute
                    key: 'order',//this manually sets the key
                    expression: /(.+)/ //expression is a RegExp allowing to determine how to split the data in key-value. In your case it's just the value
                });

                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url(ADMIN_PATH . '/galleries/images/order') ?>',
                    data: {"image_order": data},
                    dataType:'JSON', 
                    success: function(response){
                        if(response.length !== ''){
                            // console.log(response.status, response.result, response.message);
                            if(response.status == 'success'){
                                $.smkAlert({ text: response.message, type: 'success', time: true });
                            } else {
                                $.smkAlert({ text: response.message, type: 'danger', permanent: true });
                            }
                        } else {                
                            // console.log(response.status, response.message);
                            $.smkAlert({ text: 'Unable to communicate with the server', type:'danger', permanent: true });
                        }
                    }
                });
            }
        });
        $( "#sortable" ).disableSelection();

        // KCFinder add images
        $('#add_image').click( function() {
            window.KCFinder = {
                callBackMultiple: function(files) {
                    window.KCFinder = null;
                    $.post('<?php echo site_url(ADMIN_PATH . '/galleries/images/add'); ?>', {'files': files, 'gallery_id': <?php echo $Gallery->id; ?>}, function(files) {
                        // Refresh grid
                        window.location = '<?php echo site_url(ADMIN_PATH . '/galleries/images/index/'. $Gallery->id); ?>';
                        // $('.js-gallery-container').load("<?php echo current_url(); ?> .js-gallery-container > *", function(){ });
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

        // Edit modal settings 
        $('#change_image').click( function() {
            var new_image = '';
            window.KCFinder = {
                callBack: function(url) {
                    window.KCFinder = null;
                    $.post('<?php echo site_url(ADMIN_PATH . '/galleries/images/create-thumb/200/200'); ?>', {'image_path': url}, function(image_path) {
                        new_image = $('#image').attr('src', image_path);
                        $('#filename').attr('value', url);
                        
                        if (new_image != ''){
                            $.smkAlert({
                                text:'Image replaced', 
                                type:'success',
                                time: 2
                            });
                        }
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
        
        $('.js-edit-image').on('click', function(){
            var $modal = $('#editImageModal');
            $modal.modal({
                backdrop: 'static',
                keyboard: false
            }); 
            $modal.find('.modal-title').text('Edit Photo');
            
            var id          = $(this).data('image-id');
            var alt         = $(this).data('image-alt');
            var credits     = $(this).data('image-credits');
            var description = $(this).data('image-description');
            var filename    = $(this).data('image-filename');
            var hide        = $(this).data('image-hide');
            var link        = $(this).data('image-link');
            var link_text   = $(this).data('image-link_text');
            var title       = $(this).data('image-title');
            
            $modal.find('input[name="id"]').val(id);
            $modal.find('input[name="alt"]').val(alt);
            $modal.find('input[name="credits"]').val(credits);
            $modal.find('input[name="filename"]').val(filename);
            $modal.find('textarea[name="description"]').text(description);
            $modal.find('input[name="link"]').val(link);
            $modal.find('input[name="link_text"]').val(link_text);
            $modal.find('input[name="title"]').val(title);
            
            $.post('<?php echo site_url(ADMIN_PATH . '/galleries/images/create-thumb/200/200'); ?>', {'image_path': filename}, function(image_path) {
                $('#image').attr('src', image_path);
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
            CKEDITOR.instances['description'].updateElement(); // Ensures that the textarea is updated with new content
        });
        
        // Ajax form submission 
        $('.js-save-image').on('click', function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(ADMIN_PATH . '/galleries/images/edit'); ?>",
                data: $('#image_form').serialize(),
                dataType:'JSON', 
                success: function(response){
                    if(response.length !== ''){
                        // console.log(response.status, response.result, response.message);
                        if(response.status){
                            $('#editImageModal').modal('hide');
                            window.location = '<?php echo site_url(ADMIN_PATH . '/galleries/images/index/'. $Gallery->id); ?>';
                        } else {
                            $.smkAlert({ text: response.message, type: 'danger', permanent: true });
                        }
                    } else {                
                        // console.log(response.status, response.message);
                        $.smkAlert({ text: 'Unable to communicate with the server', type:'danger', permanent: true });
                    }
                }
            });
        });
        
        // Delete single image function 
        $('.js-delete-image').on('click', function(e){
            e.preventDefault();
            if (confirm('Delete cannot be undone! Are you sure you want to do this?\n\n NOTE: Images will remain on the server.'))
            {
                var imageId = $(this).data('image-id');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(ADMIN_PATH . '/galleries/images/delete'); ?>",
                    data: {"image_id": imageId},
                    dataType:'JSON', 
                    success: function(response){
                        if(response.length !== ''){
                            // console.log(response.status, response.result, response.message);
                            if(response.status === 'success'){
                                window.location = '<?php echo site_url(ADMIN_PATH . '/galleries/images/index/'. $Gallery->id); ?>';
                            } else {
                                $.smkAlert({ text: response.message, type: 'danger', permanent: true });
                            }
                        } else {                
                            // console.log(response.status, response.message);
                            $.smkAlert({ text: 'Unable to communicate with the server', type:'danger', permanent: true });
                        }
                    }
                });
            }
            else 
            {
                return false;
            }
        });
        
        // Check if we have any message from the session to show 
        var flashdata = '<?php echo $this->session->flashdata('message'); ?>';
        if(flashdata !== '') {
            $.smkAlert({ text: flashdata, type:'success', time: 4 });
        }
        
        // Clear the form in the modal window on close 
        // $('#editImageModal').on('hidden.bs.modal', function (e){
            // $(this)
                // .find("input,textarea,select").val('').end()
                // .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
        // });

    });
</script>
<?php js_end(); ?>
