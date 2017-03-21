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
            <div class="col-lg-12">
                <div class="heading">
                   
                    <div class="buttons">
                        <ul id="add_entry_btn">
                            <li id="add_entry_li">
                                <a class="button" rel="#entry_content_types" id="add_entry" href="javascript:void(0);"><span>Add Entry</span></a>
                                <ul id="content_types_dropdown">
                                    <?php if ( ! empty($content_types_add_entry)): ?>
                                        <?php foreach($content_types_add_entry as $content_type_id => $content_type_title): ?>
                                            <li><a href="<?php echo site_url(ADMIN_PATH . '/content/entries/edit/' . $content_type_id); ?>"><?php echo $content_type_title; ?></a></li>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <li><div id="no_content_types_added">No content types added</div></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <li>
                                <a class="button delete" href="#"><span>Delete</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <?php echo form_open(null, 'id="form"'); ?>
                    <table class="table table-striped table-bordered table-hover" id="entries_table">
                        <thead>
                            <tr>
                                <th width="1" class="center"><input type="checkbox" onClick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></th>
                                <th><a rel="title" class="sortable" href="#">Title</a></th>
                                <th><a rel="slug" class="sortable" href="#">URI</a></th>
                                <th class="right"><a rel="id" class="sortable" href="#">#ID</a></th>
                                <th><a rel="content_types_title" class="sortable" href="#">Content Type</a></th>
                                <th><a rel="status" class="sortable" href="#">Status</a></th>
                                <th><a rel="modified_date" class="sortable" href="#">Last Modified</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($Entries->exists()): ?>
                                <?php foreach($Entries as $Entry): ?>
                                <tr>
                                    <td class="center"><input type="checkbox" value="<?php echo $Entry->id ?>" name="selected[]" /></td>
                                    <td>
                                        <div class="entry-title">
                                            <?php echo anchor(ADMIN_PATH . "/content/entries/edit/" . $Entry->content_type_id . "/" . $Entry->id, strip_tags($Entry->title)); ?><br />
                                        </div>
                                        <div class="action-links">
                                            <?php echo anchor(ADMIN_PATH . "/content/entries/edit/" . $Entry->content_type_id . "/" . $Entry->id, 'Edit', ['class' => 'edit']); ?>
                                            <?php if ($Entry->slug != ''): ?> | <?php echo anchor("$Entry->slug", 'View', ['target' => '_blank', 'class' => 'view']); ?> <?php endif; ?>
                                        </div>
                                    </td>
                                    <td><?php echo ($Entry->slug) ? '/'. $Entry->slug : ''; ?></td>
                                    <td class="right"><?php echo $Entry->id; ?></td>
                                    <td><?php echo $Entry->content_types_title; ?></td>
                                    <td><?php echo ucwords($Entry->status); ?></td>
                                    <td><?php echo date('m/d/Y h:i a', strtotime($Entry->modified_date)); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr class="center"><td colspan="8">No results found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?php echo form_close(); ?>
                </div>
                
            </div>
        </div>
        
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->

<div class="options-pane">
    <?php echo form_open(); ?>
    <div class="filter">
        <div class="forn-group">
            <label>Content Type:</label>
            <?php echo form_dropdown('filter[content_type_id]', $content_types_filter, set_filter('entries', 'content_type_id'), 'class="form-control"'); ?></td>
        </div>

        <div class="form-group">
            <div><label>Status:</label></div> 
            <?php echo form_dropdown('filter[status]', [''=>'', 'published'=>'Published', 'draft'=>'Draft', 'disabled' => 'Disabled'], set_filter('entries', 'status'), 'class="form-control"'); ?></td>
        </div>
        
        <div class="filter_buttons">
            <button name="submit" class="btn btn-default" type="submit"><span>Filter</span></button>
            <button name="clear_filter" value="1" class="btn btn-default" type="submit"><span>Clear</span></button>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php js_start(); ?>
<script type="text/javascript">
    $(document).ready( function() {
        $('#entries_table').dataTable({
            "iDisplayLength": 25,
            "aaSorting": [[0]]
        });
        
        // Sort By
        $('.sortable').click( function() {
            sort = $(this);

            if (sort.hasClass('asc'))
            {
                window.location.href = "<?php echo site_url(ADMIN_PATH . '/content/entries/index') . '?'; ?>&sort=" + sort.attr('rel') + "&order=desc";
            }
            else
            {
                window.location.href = "<?php echo site_url(ADMIN_PATH . '/content/entries/index') . '?';  ?>&sort=" + sort.attr('rel') + "&order=asc";
            }

            return false;
        });

        <?php if ($sort = $this->input->get('sort')): ?>
            $('a.sortable[rel="<?php echo $sort; ?>"]').addClass('<?php echo ($this->input->get('order')) ? $this->input->get('order') : 'asc' ?>');
        <?php else: ?>
            $('a.sortable[rel="modified_date"]').addClass('desc');
        <?php endif; ?>

        // Delete
        $('.delete').click( function() {
            if (confirm('Delete cannot be undone! Are you sure you want to do this?'))
            {
                $('#form').attr('action', '<?php echo site_url(ADMIN_PATH . '/content/entries/delete'); ?>').submit()
            }
            else
            {
                return false;
            }
        });

        $('#add_entry').click( function () {
            $('#content_types_dropdown').show();
            $('#add_entry').addClass('selected');
        });

        $(document).mouseup( function (e) {
            if ($('#content_types_dropdown').is(":visible") && $(e.target).parents('#add_entry_li').length == 0) {
                $('#add_entry').removeClass('selected');
                $('#content_types_dropdown').hide();
            }
        });
    });
</script>
<?php js_end(); ?>
