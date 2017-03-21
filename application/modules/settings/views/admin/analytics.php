<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Analytics Configuration
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
                    
            <div class="col-md-8">
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
                                <?php echo form_label('GA Tracking Code:', 'ga_account_id'); ?>
                                <?php echo form_input(['name' => 'ga_account_id', 'id' => 'ga_account_id', 'class' => 'form-control form-control__large', 'value' => set_value('ga_account_id', isset($Settings->ga_account_id->value) ? $Settings->ga_account_id->value : '')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('GA Email:', 'ga_email'); ?>
                                <?php echo form_input(['name' => 'ga_email', 'id' => 'ga_email', 'class' => 'form-control form-control__large', 'value' => set_value('ga_email', isset($Settings->ga_email->value) ? $Settings->ga_email->value : '')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('GA Password:', 'ga_password'); ?>
                                <?php echo form_password(['name' => 'ga_password', 'id' => 'ga_password', 'class' => 'form-control form-control__large', 'value' => set_value('ga_password', isset($Settings->ga_password->value) ? $Settings->ga_password->value : '')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('GA Profile ID:', 'ga_profile_id'); ?>
                                <?php echo form_input(['name' => 'ga_profile_id', 'id' => 'ga_profile_id', 'class' => 'form-control form-control__large', 'value' => set_value('ga_profile_id', isset($Settings->ga_profile_id->value) ? $Settings->ga_profile_id->value : '')]); ?>
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