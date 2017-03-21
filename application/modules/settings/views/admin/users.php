<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Users Settings
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
                    
            <div class="col-md-6">
                <div class="heading">
                    <div class="text-right">
                        <a class="btn btn-default" href="#" onClick="$('#settings_form').submit();"><span>Save</span></a>
                    </div>
                </div>
                <div class="content">
                
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo validation_errors(); ?>

                    <?php echo form_open(null, 'id="settings_form"'); ?>
                        <div class="form">
                            <div class="form-group">
                                <?php echo form_label('Default User Group:', 'default_group'); ?>
                                <?php  echo form_dropdown('users[default_group]', option_array_value($Groups, 'id', 'name'), set_value('default_group', isset($Settings->default_group->value) ? $Settings->default_group->value : ''), 'class="form-control"'); ?>
                            </div>
                            <div class="form-group">
                                <label for="default_group">User Registration</lable>
                                <label class="radio-inline"><?php echo form_radio(['name' => 'users[enable_registration]', 'value' => '1', 'checked' => set_radio('users[enable_registration]', '1', ($Settings->enable_registration->value === '1') ? TRUE : FALSE)]); ?> Enabled</label>
                                <label class="radio-inline"><?php echo form_radio(['name' => 'users[enable_registration]', 'value' => '0', 'checked' => set_radio('users[enable_registration]', '0', ($Settings->enable_registration->value === '0') ? TRUE : FALSE)]); ?> Disabled</label>
                            </div>
                            <div class="form-group">
                                <label for="default_group">Require Email Activation</lable>
                                <label class="radio-inline"><?php echo form_radio(['name' => 'users[email_activation]', 'value' => '1', 'checked' => set_radio('users[email_activation]', '1', ($Settings->email_activation->value === '1') ? TRUE : FALSE)]); ?> Enabled</label>
                                <label class="radio-inline"><?php echo form_radio(['name' => 'users[email_activation]', 'value' => '0', 'checked' => set_radio('users[email_activation]', '0', ($Settings->email_activation->value === '0') ? TRUE : FALSE)]); ?> Disabled</label>
                            </div>
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
        
    });
</script>
<?php js_end(); ?>