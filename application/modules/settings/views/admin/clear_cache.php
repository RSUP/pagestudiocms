<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Cache
                <small></small><br />
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
            <div class="col-lg-6">
                <div class="text-right">
                    <a class="btn btn-default" href="#" onClick="$('#cache_form').submit();"><span>Clear</span></a>
                </div>
                
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo validation_errors(); ?>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Clear Cached Data
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <?php echo form_open(null, 'id="cache_form"'); ?>
                            <table class="table table-striped table-hover table-padded">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onClick="$('input[name*=\'cache\']').attr('checked', this.checked);" CHECKED /></th>
                                        <th>Cache Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[settings]', 'value' => '1', 'checked' => set_checkbox('cache[settings]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Settings</td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[entries]', 'value' => '1', 'checked' => set_checkbox('cache[entries]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Entries</td>
                                    </tr> 
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[content_types]', 'value' => '1', 'checked' => set_checkbox('cache[content_types]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Content Types</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[snippets]', 'value' => '1', 'checked' => set_checkbox('cache[snippets]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Code Snippets</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[navigations]', 'value' => '1', 'checked' => set_checkbox('cache[navigations]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Navigations</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[categories]', 'value' => '1', 'checked' => set_checkbox('cache[categories]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Categories</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[images]', 'value' => '1', 'checked' => set_checkbox('cache[images]', '1', TRUE))); ?> 
                                        </td>
                                        <td>Images</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php echo form_checkbox(array('name' => 'cache[datamapper]', 'value' => '1', 'checked' => set_checkbox('cache[datamapper]', '1', TRUE))); ?> 
                                        </td>
                                        <td>DB Schema</td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php echo form_close(); ?>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->

