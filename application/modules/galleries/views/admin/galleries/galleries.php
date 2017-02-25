<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                <i class="icon x32 icon-media"></i>
                Image Galleries				
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
        
        <br />                            
        <div class="hidden">
            <?php echo form_open(null, 'id="form"'); ?>
            <table class="list">
                <thead>
                    <tr>
                        <th width="1" class="center"><input type="checkbox" onClick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></th>
                        <th class="sortable">Title</th>
                        <th class="right">#ID</th>
                        <th class="right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($Galleries->exists()): ?>
                        <?php foreach($Galleries as $Gallery):?>
                        <tr>
                            <td class="center"><input type="checkbox" value="<?php echo $Gallery->id ?>" name="selected[]" /></td>
                            <td><?php echo $Gallery->title; ?></td>
                            <td class="right"><?php echo $Gallery->id; ?></td>
                            <td class="right">[ <a href="<?php echo site_url(ADMIN_PATH . '/galleries/edit/' . $Gallery->id) ?>">Rename</a> ] [ <a href="<?php echo site_url(ADMIN_PATH . '/galleries/images/index/' . $Gallery->id) ?>">Edit</a> ]</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="center" colspan="4">No galleries have been added.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php echo form_close(); ?>
        </div>
        
        <div class="row" style="padding:25px 25px">
                        
            <div class="js-sortable-gallery">
            
                <?php echo form_open(null, 'id="form"'); ?>
                
                    <?php if ($Galleries->exists()): ?>
                        <?php foreach($Galleries as $Gallery):?>
                        <div style="max-width: 250px;" class="col-md-3 col-sm-6 col-xs-12">
                            <div class="gal-img-container">
                              <div class="gal-img-option">
                                <ul class="list-options">
                                  <li><a href="#" 
                                        data-album-id="<?php echo $Gallery->id; ?>"
                                        data-album-title="<?php echo $Gallery->title; ?>" class="js-rename-album">
                                        <i class="fa fa-pencil"></i> <span>Rename</span></a></li>
                                  <li></li>
                                  <li><a href="#" data-album-id="<?php echo $Gallery->id; ?>" class="js-delete-album"><i class="fa fa-trash"></i> <span>Delete</span></a></li>
                                </ul>
                              </div>
                              <div class="gal-image">
                                <a href="<?php echo site_url(ADMIN_PATH . '/galleries/images/index/' . $Gallery->id) ?>" 
                                    class="img-group-gallery cboxElement" title="<?php echo $Gallery->title; ?>">
                                    <img src="https://placehold.it/250x200" class="img-responsive" alt="<?php echo $Gallery->title; ?>">
                                </a>
                              </div>
                                <!--
                                <div class="post-meta">
                                    <ul class="list-meta list-inline">
                                      <li><i class="fa fa-camera"></i> 117</li>
                                    </ul>
                                </div> 
                                -->
                              <div class="gal-img-desc">
                                <i class="fa fa-tags"></i> <?php echo $Gallery->title; ?>
                              </div>
                            </div>
                        </div><!--/ image -->
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- No galleries have been added. -->
                    <?php endif; ?>
        
                <?php echo form_close(); ?>

                <div style="max-width: 250px;" class="col-md-3 col-sm-6 col-xs-12">
                    <div class="upload-modal-toggle">
                        <a href="#" class="js-create-album">
                            <div class="upload-modal-toggle-link">
                                <i class="pe-7s-plus upload-link"></i><br />
                                <span>Click to Create Album</span>
                            </div>
                        </a>
                    </div>
                </div>

            </div><!-- sortable -->
        
    
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

<!-- SquareSpace like Modal -->
<div class="modal fade box-modal" id="albumModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <div class="modal-title" id="lineModalLabel">My Modal</div>
        </div>
        <div class="modal-body">
            
            <!-- content goes here -->
            <?php echo form_open(null, 'id="gallery_form"'); ?>
                <div class="hidden">                        
                    <input type="hidden" name="id" value="" />
                </div>
              <div class="form-group">
                <label for="title">Album Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Trip to the moon">
              </div>
            <?php echo form_close(); ?>

        </div>
        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Cancel</button>
                </div>
                <div class="btn-group btn-delete hidden" role="group">
                    <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default btn-hover-green js-save-album" data-action="save" role="button">Save</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<?php js_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        
        $('.js-sortable-gallery').sortable({placeholder: "ui-state-highlight",helper:'clone'});
        
        // Modal launcher 
        $('.js-create-album').on('click', function(){
            var $modal = $('#albumModal');
            $modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            $modal.find('.modal-title').text('Create New Photo Album');
        });
        
        // Modal launcher 
        $('.js-rename-album').on('click', function(){
            var $modal   = $('#albumModal');
            $modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            
            var albumId     = $(this).data('album-id');
            var albumTitle  = $(this).data('album-title');
            
            $modal.find('.modal-title').text('Edit Photo Album');
            $modal.find('input[name="id"]').val(albumId);
            $modal.find('input[name="title"]').val(albumTitle);
        });
        
        // Ajax form submission 
        $('.js-save-album').on('click', function(e){
            e.preventDefault();
            console.log($('#gallery_form').serialize());
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(ADMIN_PATH . '/galleries/edit'); ?>",
                data: $('#gallery_form').serialize(),
                dataType:'JSON', 
                success: function(response){
                    if(response.length !== ''){
                        console.log(response.status, response.result, response.message);
                        if(response.status === 'success'){
                            var $modal   = $('#albumModal');                            
                            
                            $modal.modal('hide');
                            $modal.find('.modal-title').text('MODAL');
                            $modal.find('input[name="id"]').val('');
                            $modal.find('input[name="title"]').val('');
                            
                            window.location = response.result.redirect;
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
        
        // Ajax delete form submission 
        $('.js-delete-album').on('click', function(e){
            e.preventDefault();
            if (confirm('Delete cannot be undone! Are you sure you want to do this?\n\n NOTE: Images will remain on the server.'))
            {
                var albumId     = $(this).data('album-id');
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(ADMIN_PATH . '/galleries/delete'); ?>",
                    data: {"selected": albumId},
                    dataType:'JSON', 
                    success: function(response){
                        if(response.length !== ''){
                            console.log(response.status, response.result, response.message);
                            if(response.status === 'success'){
                                window.location = response.result.redirect;
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
    });
</script>
<?php js_end(); ?>