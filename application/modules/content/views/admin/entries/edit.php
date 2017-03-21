<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Edit <?php echo ($edit_mode) ? '- <span class="js-page-title">' . strip_tags($Entry->title) . '</span>' : ''; ?>
                <small>ID (#<?php echo $Entry->id?>)</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
            <div class="col-lg-12">
            
                <div class="box">
                    <div class="heading">
                        <div class="buttons">
                            <a class="js-edit-entry"><i class="fa fa-cog"></i></a>
                            <a class="button" href="javascript:void(0);" id="save"><span>Save</span></a>
                            <a class="button" href="javascript:void(0);" id="save_exit"><span>Save &amp; Exit</span></a>
                            <a class="button" href="<?php echo site_url(ADMIN_PATH . '/content/entries'); ?>"><span>Cancel</span></a>
                        </div>
                    </div>
                    <div class="content">

                        <?php if ($edit_mode && $Entry->slug != ''): ?>
                            <a style="float: right; z-index: 1; position: relative;" target="_blank" href="<?php echo site_url("$Entry->slug"); ?>"><img src="<?php echo theme_url('assets/images/preview-icon-medium.png') ?>" /></a>
                        <?php endif; ?>

                        <div class="fright" style="margin-top: 4px; margin-right: 10px;">
                            <a id="collapse_all" class="no_underline" href="javascript:void(0);">Collapse All</a> &nbsp;|&nbsp; <a id="expand_all" class="no_underline" href="javascript:void(0);">Expand All</a>
                        </div>

                        <?php echo form_open(null, 'id="entry_edit"'); ?>
                        <div class="tabs">
                            <ul class="htabs">
                                <li><a href="#content-tab">Content</a></li>
                                <?php if ($Content_type->category_group_id): ?>
                                    <li><a href="#categories-tab">Categories</a></li>
                                <?php endif; ?>
                                <li><a href="#page-tab">Page</a></li>
                                <?php if ($Content_type->enable_versioning): ?>
                                    <li><a href="#revisions-tab">Revisions</a></li>
                                <?php endif; ?>
                                <li><a href="#settings-tab">Settings</a></li>
                            </ul>
                            <!-- Content Tab -->
                            <div id="content-tab">
                                <div id="entry_fields">
                                    <div class="form-group">
                                        <?php echo form_label('<div class="arrow arrow_expand"></div><span class="required">*</span> Title', 'title'); ?>
                                        <div>
                                            <?php echo form_input(array('name'=>'title', 'id'=>'title', 'class' => 'form-control', 'value'=>set_value('title', !empty($Entry->title) ? $Entry->title : ''))); ?>
                                        </div>
                                    </div>

                                    <?php if ($Content_type->dynamic_route != ''): ?>
                                        <div class="form-group">
                                            <?php echo form_label('<div class="arrow arrow_expand"></div><span class="required">*</span> URL Title', 'url_title'); ?>
                                            <div>
                                                <?php echo form_input(array('name'=>'url_title', 'id'=>'url_title', 'value'=>set_value('url_title', !empty($Entry->url_title) ? $Entry->url_title : ''))); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty($Fields)): ?>
                                        <input type="hidden" name="deleted_fields" class="js-deleted-fields" value="" /> <!-- for Grid fields -->
                                        <?php echo $Fields; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Categories Tab -->
                            <?php if ($Content_type->category_group_id): ?>
                            <div id="categories-tab">
                                <div class="form format_list">
                                    <?php echo $categories_tree; ?>        
                                </div>
                            </div>
                            <?php endif; ?>
                            <!-- Page Tab -->
                            <div id="page-tab">
                                <div class="form">
                                    <div>
                                        <?php echo form_label('URL:', 'slug'); ?>
                                        <span style="line-height: 24px; "> <?php echo trim(site_url(), '/'); ?>/ </span>
                                        <?php echo form_input(array('name'=>'slug', 'id'=>'slug', 'value'=>set_value('slug', !empty($Entry->slug) ? $Entry->slug : ''))); ?>
                                    </div>
                                    <div>
                                        <?php echo form_label('Meta Title:<br /><span class="help">65 Characters Max</span>', 'meta_title'); ?>
                                        <?php echo form_input(array('name'=>'meta_title', 'id'=>'meta_title', 'class'=>'long', 'value'=>set_value('meta_title', !empty($Entry->meta_title) ? $Entry->meta_title : ''))); ?>
                                        <p id="meta_title_count" class="help-block">(<?php echo strlen(set_value('meta_title', !empty($Entry->meta_title) ? $Entry->meta_title : '')); ?> Chars)</p>
                                    </div>
                                    <div>
                                        <?php echo form_label('Keywords:<span class="help">250 Characters Max</span>', 'meta_keywords'); ?>
                                        <?php echo form_textarea(array('name'=>'meta_keywords', 'id'=>'meta_keywords', 'style'=>'height: 50px;','value'=>set_value('meta_keywords', !empty($Entry->meta_keywords) ? $Entry->meta_keywords : ''))); ?>
                                        <p id="meta_keywords_count" class="help-block">(<?php echo strlen(set_value('meta_keywords', !empty($Entry->meta_keywords) ? $Entry->meta_keywords : '')); ?> Chars)</p>
                                    </div>
                                    <div>
                                        <?php echo form_label('Description:<br /><span class="help">150 Characters Max</span>', 'meta_description'); ?>
                                        <?php echo form_textarea(array('name'=>'meta_description', 'id'=>'description_textarea', 'value'=>set_value('meta_description', !empty($Entry->meta_description) ? $Entry->meta_description : ''))); ?>
                                        &nbsp;<p id="meta_description_count" class="help" style="display: inline;">(<?php echo strlen(set_value('meta_description', !empty($Entry->meta_description) ? $Entry->meta_description : '')); ?> Chars)</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Revisions Tab -->
                            <?php if ($Content_type->enable_versioning): ?>
                            <div id="revisions-tab">
                                <?php $Entry_revisions = $Entry->get_entry_revisions(); $r = $Entry_revisions->result_count(); ?>
                                <table class="list">
                                    <thead>
                                        <tr>
                                            <th>Revision</th>
                                            <th>Author</th>
                                            <th>Date</th>
                                            <th class="right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($Entry_revisions->exists()): ?>
                                            <?php foreach($Entry_revisions as $Revision): ?>
                                                <tr>
                                                    <td>Revision <?php echo $r; ?></td>
                                                    <td><?php echo $Revision->author_name; ?></td>
                                                    <td><?php echo date('m/d/Y h:i a', strtotime($Revision->revision_date)); ?></td>
                                                    <td class="right">
                                                        <?php if ( ($revision_id == '' && $r == $Entry_revisions->result_count()) 
                                                            || $Revision->id == $revision_id): ?>
                                                            <strong>Currently Loaded</strong>
                                                        <?php else: ?>
                                                            [ <a href="<?php echo site_url(ADMIN_PATH . '/content/entries/edit/' . $Revision->content_type_id . '/' . $Revision->resource_id . '/' . $Revision->id); ?> ">Load Revision</a> ]</td>
                                                        <?php endif; ?>
                                                </tr>
                                                <?php $r--; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td class="center" colspan="4">No revisions have been saved.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                            <!-- Settings Tab -->
                            <div id="settings-tab">
                                <div class="form">
                                    <div class="form-control">
                                        <?php echo form_label('<span class="required">*</span> Status:', 'status'); ?>
                                        <?php echo form_dropdown('status', array('published'=>'Published', 'draft'=>'Draft', 'disabled' => 'Disabled'), set_value('status', !empty($Entry->status) ? $Entry->status : ''), 'id="status" class="form-control"')?>
                                    </div>
                                    <div class="form-control">
                                        <?php echo form_label('<span class="required">*</span> Date Created:', 'created_date'); ?>
                                        <?php echo form_input(array('name'=>'created_date', 'class'=>'datetime form-control', 'id'=>'created_date', 'value'=>set_value('created_date', !empty($Entry->created_date) ? date('m/d/Y h:i:s a', strtotime($Entry->created_date)) : date('m/d/Y h:i:s a')))); ?>
                                    </div>
                                    <div class="form-control">
                                        <?php echo form_label('<span class="required">*</span> Date Published:', 'published_date'); ?>
                                        <?php echo form_input(array('name'=>'published_date', 'class'=>'datetime form-control', 'id'=>'published_date', 'value'=>set_value('published_date', !empty($Entry->published_date) ? date('m/d/Y h:i:s a', strtotime($Entry->published_date)) : date('m/d/Y h:i:s a')))); ?>
                                    </div>
                                    <div class="form-control">
                                        <?php echo form_label('Author:', 'author_id'); ?>
                                        <?php if ($edit_mode): ?>
                                            <?php echo form_dropdown('author_id', $authors, set_value('author_id', !empty($Entry->author_id) ? $Entry->author_id : ''), 'id=\'author_id\'')?>
                                        <?php else: ?>
                                            <?php echo form_dropdown('author_id', $authors, $this->secure->get_user_session()->id, 'id=\'author_id\'')?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-control">
                                        <?php echo form_label('Entry Layout:', 'entry_layout'); ?>
                                        <?php echo form_dropdown('entry_layout', $theme_layouts, '', 'id="entry_layout"'); ?>
                                    </div>
                                    <div class="form-control">
                                        <?php echo form_label('Content Type Change:', 'content_type_id'); ?>
                                        <?php echo form_dropdown('content_type_change', $change_content_types, '', 'id="content_type_change"'); ?>
                                        <a class="btn btn-default" id="load_content_type"; href="javascript:void(0);">Load</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->

<!-- Edit Modal -->
<div class="modal right fade box-modal" id="editEntryModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header modal-header__tabbed right-tabs clearfix">                
            <div class="modal-title" id="lineModalLabel">My Modal</div>

            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Details</a></li>
                <?php if ($Content_type->category_group_id): ?>
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <?php endif; ?>
                <li><a href="#tab2" data-toggle="tab">Media</a></li>
                <?php if ($Content_type->enable_versioning): ?>
                <li><a href="#tab3" data-toggle="tab">Revision</a></li>
                <?php endif; ?>
                <li><a href="#tab4" data-toggle="tab">Settings</a></li>
            </ul>
        </div>
        <div class="modal-body">
            <div class="js-response"></div>
            <?php echo form_open(null, 'id="entry_edit_form"'); ?>
            <div class="tabbable"> <!-- Only required for left/right tabs -->
                <div class="tab-content">
                    <!-- Page Tab -->
                    <div class="tab-pane active" id="tab1">
                        <!-- content goes here -->
                        <div class="row">                            
                            <div class="col-lg-12">

                                <form class="form">
                                    <div class="form-group">
                                        <?php echo form_label('URL:', 'slug'); ?>
                                        <span style="line-height: 24px; "> <?php echo trim(site_url(), '/'); ?>/ </span>
                                        <?php echo form_input(array('name'=>'slug', 'id'=>'slug', 'class'=>'form-control', 'value'=>set_value('slug', !empty($Entry->slug) ? $Entry->slug : ''))); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Meta Title', 'meta_title'); ?>
                                        <?php echo form_input(array('name'=>'meta_title', 'id'=>'meta_title', 'class'=>'form-control', 'value'=>set_value('meta_title', !empty($Entry->meta_title) ? $Entry->meta_title : ''))); ?>
                                        <p class="help-block">65 Characters Max (<span id="meta_title_count"><?php echo strlen(set_value('meta_title', !empty($Entry->meta_title) ? $Entry->meta_title : '')); ?>) Chars</span></p>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Keywords', 'meta_keywords'); ?>
                                        <?php echo form_textarea(array('name'=>'meta_keywords', 'id'=>'meta_keywords', 'class'=>'form-control', 'style'=>'height: 80px;','value'=>set_value('meta_keywords', !empty($Entry->meta_keywords) ? $Entry->meta_keywords : ''))); ?>
                                        <p class="help-block">250 Characters Max <span id="meta_keywords_count">(<?php echo strlen(set_value('meta_keywords', !empty($Entry->meta_keywords) ? $Entry->meta_keywords : '')); ?> Chars)</span></p>
                                    </div>
                                    <div class="form-group">
                                        <?php echo form_label('Description:<br /><span class="help">150 Characters Max</span>', 'meta_description'); ?>
                                        <?php echo form_textarea(array('name'=>'meta_description', 'id'=>'description_textarea', 'class'=>'form-control', 'value'=>set_value('meta_description', !empty($Entry->meta_description) ? $Entry->meta_description : ''))); ?>
                                        <p id="meta_description_count" class="help-block" style="display: inline;">(<?php echo strlen(set_value('meta_description', !empty($Entry->meta_description) ? $Entry->meta_description : '')); ?> Chars)</p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    
                    <!-- Categories Tab -->
                    <?php if ($Content_type->category_group_id): ?>
                    <div class="tab-pane" id="details">
                        <div class="form format_list">
                            <?php echo $categories_tree; ?>        
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="tab-pane" id="tab2">
                        <!-- content goes here -->
                        <form>

                        </form>
                    </div>
                    
                    <div class="tab-pane" id="tab3">
                        <!-- content goes here -->
                        <form>
                            <!-- Revisions Tab -->
                            <?php if ($Content_type->enable_versioning): ?>
                            <div id="revisions-tab">
                                <?php $Entry_revisions = $Entry->get_entry_revisions(); $r = $Entry_revisions->result_count(); ?>
                                <table class="list">
                                    <thead>
                                        <tr>
                                            <th>Revision</th>
                                            <th>Author</th>
                                            <th>Date</th>
                                            <th class="right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($Entry_revisions->exists()): ?>
                                            <?php foreach($Entry_revisions as $Revision): ?>
                                                <tr>
                                                    <td>Revision <?php echo $r; ?></td>
                                                    <td><?php echo $Revision->author_name; ?></td>
                                                    <td><?php echo date('m/d/Y h:i a', strtotime($Revision->revision_date)); ?></td>
                                                    <td class="right">
                                                        <?php if ( ($revision_id == '' && $r == $Entry_revisions->result_count()) 
                                                            || $Revision->id == $revision_id): ?>
                                                            <strong>Currently Loaded</strong>
                                                        <?php else: ?>
                                                            [ <a href="<?php echo site_url(ADMIN_PATH . '/content/entries/edit/' . $Revision->content_type_id . '/' . $Revision->resource_id . '/' . $Revision->id); ?> ">Load Revision</a> ]</td>
                                                        <?php endif; ?>
                                                </tr>
                                                <?php $r--; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td class="center" colspan="4">No revisions have been saved.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                        </form>
                    </div>
                   
                    <div class="tab-pane" id="tab4">
                        <form class="form">
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Status:', 'status'); ?>
                                <?php echo form_dropdown('status', array('published'=>'Published', 'draft'=>'Draft', 'disabled' => 'Disabled'), set_value('status', !empty($Entry->status) ? $Entry->status : ''), 'id="status" class="form-control"')?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Date Created:', 'created_date'); ?>
                                <?php echo form_input(array('name'=>'created_date', 'class'=>'datetime form-control', 'id'=>'created_date', 'value'=>set_value('created_date', !empty($Entry->created_date) ? date('m/d/Y h:i:s a', strtotime($Entry->created_date)) : date('m/d/Y h:i:s a')))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Date Published:', 'published_date'); ?>
                                <?php echo form_input(array('name'=>'published_date', 'class'=>'datetime form-control', 'id'=>'published_date', 'value'=>set_value('published_date', !empty($Entry->published_date) ? date('m/d/Y h:i:s a', strtotime($Entry->published_date)) : date('m/d/Y h:i:s a')))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Author:', 'author_id'); ?>
                                <?php if ($edit_mode): ?>
                                    <?php echo form_dropdown('author_id', $authors, set_value('author_id', !empty($Entry->author_id) ? $Entry->author_id : ''), 'id=\'author_id\'')?>
                                <?php else: ?>
                                    <?php echo form_dropdown('author_id', $authors, $this->secure->get_user_session()->id, 'id=\'author_id\'')?>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Entry Layout:', 'entry_layout'); ?>
                                <?php echo form_dropdown('entry_layout', $theme_layouts, '', 'id="entry_layout"'); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('Content Type Change:', 'content_type_id'); ?>
                                <?php echo form_dropdown('content_type_change', $change_content_types, '', 'id="content_type_change"'); ?>
                                <a class="btn btn-default" id="load_content_type"; href="javascript:void(0);">Load</a>
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

<div class="options-pane">
</div>
editEntryModal
<?php js_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        // Auto fill short name based on title
        $('#title').keyup( function(e) {
			var url_route = '<?php echo ( ! empty($Content_type->static_route)) ? $Content_type->static_route . '/' : ''; ?>';
			var slug = $(this).val().toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-_]/g, '');
			var new_url = url_route + slug;
            $('#slug').val(new_url);
            $('.js-page-title').text($(this).val());
        });

        $( ".tabs" ).tabs();

        $( ".datetime" ).datetimepicker({
            showSecond: true,
            timeFormat: 'hh:mm:ss tt',
            ampm: true
        });

        // Wrap datepicker popup with a class smoothness for styleing
        $('body').find('#ui-datepicker-div').wrap('<div class="smoothness"></div>');

        $("#load_content_type").click( function() {

            if ($('#content_type_change').val() == '')
            {
                alert('No content type was selected.');
            }
            else
            {
                response = confirm('Changing the content type will only carry over content from fields with matching short tags in both content types.\nAny current unsaved data will be lost.\n\n Are you sure you want to continue?');

                if (response)
                {
                    window.location = "<?php echo site_url(ADMIN_PATH . '/content/entries/edit'); ?>/" + $('#content_type_change').val() + "/<?php echo $Entry->id; ?>/convert";
                }
            }
        });

        $("#save, #save_exit").click( function() {

            response = true;

            if ($('#status').val() != '<?php echo empty($Entry->status) ? 'published' : $Entry->status; ?>' && $('#status').val() != 'published')
            {
                response = confirm('When changing the page type from published ensure you do not have any published navigations or links to this page.\n\n Are you sure you want to continue?');
            }

            if (response)
            {
                if ($(this).attr('id') == 'save_exit')
                {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'save_exit',
                        value: '1'
                    }).appendTo('#entry_edit');

                    $('#entry_edit').submit();
                }
                else
                {
                    $('#entry_edit').submit();
                }
            }
        });

        // Count meta title characters
        $('#meta_title').keyup( function() {
            $('#meta_title_count').html('(' + $(this).val().length + ' Chars)');
        });

        // Count keyword characters
        $('#meta_keywords').keyup( function() {
            $('#meta_keywords_count').html('(' + $(this).val().length + ' Chars)');
        });

        // Count description characters
        $('#description_textarea').keyup( function() {
            $('#meta_description_count').html('(' + $(this).val().length + ' Chars)');
        });

        // Expand / Collapse entry fields
        $('#entry_fields > div > label').click( function() {
            if($(this).next('div').is(":visible"))
            {
                $(this).next('div').slideUp();
                $('div', this).removeClass('arrow_expand').addClass('arrow_collapse');
            }
            else
            {
                $(this).next('div').slideDown();
                $('div', this).removeClass('arrow_collapse').addClass('arrow_expand');
            }
        });

        <?php if ( ! $edit_mode): ?>
            // Auto Generate Url Title
            $('#title').keyup( function(e) {
                $('#url_title').val($(this).val().toLowerCase().replace(/\s+/g, '-').replace(/[^a-z0-9\-_]/g, ''))
            });
        <?php endif; ?>

        heading_pos = $('.heading').offset().top;
        position_top = false;

        $(window).scroll(function () {
            if (heading_pos - $(window).scrollTop() <= 0) {
                if (!position_top) {
                    $('.heading').addClass('position_top');
                    $('.content').addClass('position_top');
                    position_top = true;
                }
            } else {
                if (position_top) {
                    $('.heading').removeClass('position_top');
                    $('.content').removeClass('position_top');
                    position_top = false;
                }
            }
        });

        $('#collapse_all').click( function() {
            $('.arrow_expand').trigger('click');
        });

        $('#expand_all').click( function() {
            $('.arrow_collapse').trigger('click');
        });
        
        // -------------------------------------------------------------
        // 1.4.0 stuff 
        // -------------------------------------------------------------
        $('.js-edit-entry').on('click', function(){
            var $modal = $('#editEntryModal');
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

            $('textarea#description').ckeditor(thin_config);
            CKEDITOR.instances['description'].updateElement(); // Ensures that the textarea is updated with new content
        });
        
        // Ajax form submission 
        $('.js-save-entry').on('click', function(e){
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
                            window.location = '<?php echo site_url(ADMIN_PATH . '/galleries/images/index/'. $Entry->id); ?>';
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
        $('.js-delete-entry').on('click', function(e){
            e.preventDefault();
            if (confirm('Delete cannot be undone! Are you sure you want to do this?'))
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
                                window.location = '<?php echo site_url(ADMIN_PATH . '/content/entries/edit/'. $Entry->id .'/'. $Entry->id .'/'); ?>';
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
