<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                General Settings
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
                    
            <div class="col-md-6 col-sm-12">
                <div class="heading">
                    <div class="buttons text-right">
                        <a class="btn btn-default" href="#" onClick="$('#settings_form').submit();"><span>Save</span></a>
                    </div>
                </div>
                <div class="content">
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo validation_errors(); ?>

                    <?php echo form_open(null, 'id="settings_form"'); ?>
                            <div class="form">
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Site Name:', 'sitename'); ?>
                                    <?php echo form_input(array('name' => 'site_name', 'id' => 'sitename', 'class'=>'form-control', 'value' => set_value('site_name', isset($Settings->site_name->value) ? $Settings->site_name->value : ''))); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Site Description:', 'sitedescription'); ?>
                                    <?php echo form_textarea(array('name' => 'site_description', 'id' => 'sitedescription', 'class'=>'form-control', 'value' => set_value('site_description', isset($Settings->site_description->value) ? $Settings->site_description->value : ''))); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Site Homepage:', 'site_homepage'); ?>
                                    <?php  echo form_dropdown('content[site_homepage]', option_array_value($Entries, 'id', 'title'), set_value('site_homepage', isset($Settings->site_homepage->value) ? $Settings->site_homepage->value : ''), 'class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Custom 404:', 'custom_404'); ?>
                                    <?php  echo form_dropdown('content[custom_404]', option_array_value($Entries, 'id', 'title'), set_value('custom_404', isset($Settings->custom_404->value) ? $Settings->custom_404->value : ''), 'class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Theme:', 'theme'); ?>
                                    <?php  echo form_dropdown('theme', $themes, set_value('theme', isset($Settings->theme->value) ? $Settings->theme->value : ''), 'id="theme" class="form-control"'); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Default Layout:', 'layout'); ?>
                                    <?php  echo form_dropdown('layout', $layouts, set_value('layout', isset($Settings->layout->value) ? $Settings->layout->value : ''), 'id="theme_layout" class="form-control"'); ?>
                                    <span id="layout_ex" class="ex"></span>
                                </div>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Admin Toolbar:', 'enable_admin_toolbar'); ?>
                                    <span>
                                        <label><?php echo form_radio(array('name' => 'enable_admin_toolbar', 'value' => '1', 'checked' => set_radio('enable_admin_toolbar', '1', ( ! empty($Settings->enable_admin_toolbar->value)) ? TRUE : FALSE))); ?> Yes</label>
                                        <label><?php echo form_radio(array('name' => 'enable_admin_toolbar', 'value' => '0', 'checked' => set_radio('enable_admin_toolbar', '0', (empty($Settings->enable_admin_toolbar->value)) ? TRUE : FALSE))); ?> No</label>
                                    </span>
                                </div>
                                <?php if ($this->Group_session->type == SUPER_ADMIN): ?>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Enable Logging:', 'enable_logging'); ?>
                                    <span>
                                        <label><?php echo form_radio(array('name' => 'enable_logging', 'value' => '1', 'checked' => set_radio('enable_logging', '1', ( ! empty($Settings->enable_logging->value)) ? TRUE : FALSE))); ?> Yes</label>
                                        <label><?php echo form_radio(array('name' => 'enable_logging', 'value' => '0', 'checked' => set_radio('enable_logging', '0', (empty($Settings->enable_logging->value)) ? TRUE : FALSE))); ?> No</label>
                                    </span>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->Group_session->type == SUPER_ADMIN): ?>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Enable Profiler:', 'enable_profiler'); ?>
                                    <span>
                                        <label><?php echo form_radio(array('name' => 'enable_profiler', 'value' => '1', 'checked' => set_radio('enable_profiler', '1', ( ! empty($Settings->enable_profiler->value)) ? TRUE : FALSE))); ?> Yes</label>
                                        <label><?php echo form_radio(array('name' => 'enable_profiler', 'value' => '0', 'checked' => set_radio('enable_profiler', '0', (empty($Settings->enable_profiler->value)) ? TRUE : FALSE))); ?> No</label>
                                    </span>
                                </div>
                                <?php endif; ?>
                                <?php if ($this->Group_session->type == SUPER_ADMIN): ?>
                                <div class="form-group">
                                    <?php echo form_label('<span class="required">*</span> Suspend Site:', 'suspend'); ?>
                                    <span>
                                        <label><?php echo form_radio(array('name' => 'suspend', 'value' => '1', 'checked' => set_radio('suspend', '1', ( ! empty($Settings->suspend->value)) ? TRUE : FALSE))); ?> Yes</label>
                                        <label><?php echo form_radio(array('name' => 'suspend', 'value' => '0', 'checked' => set_radio('suspend', '0', (empty($Settings->suspend->value)) ? TRUE : FALSE))); ?> No</label>
                                    </span>
                                </div>
                                <?php endif; ?>
                            </div>

                    <?php echo form_close(); ?>

                </div>
            </div>

        </div>
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->
        
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
    $(document).ready(function() {

        $('#theme').change( function() {

            $('#theme_layout').html('');
            $('#layout_ex').html('Loading Layouts...');

            $.post('<?php echo site_url(ADMIN_PATH . '/settings/general-settings/theme-ajax'); ?>', {theme: $('#theme').val()}, function(response) {
                if (response.status == 'OK')
                {
                    $.each(response.layouts, function(i , val) {
                        $('#theme_layout').append('<option value="' + val + '">' + val + '</option>');
                    });
                    $('#layout_ex').html('');
                }
                else
                {
                    $('#layout_ex').html(response.message);
                }
            }, 'json');

            $('#editor_stylesheet_path').html('<?php echo base_url('themes/') . '/'; ?>' + $('#theme').val() + '/');
        });
    });
</script>
<?php js_end(); ?>