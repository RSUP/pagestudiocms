<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Notification Settings
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
                    
            <div class="col-md-6 col-sm-12">
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
                                <?php echo form_label('<span class="required">*</span> Notification Email:', 'notification_email'); ?>
                                <?php echo form_input(array('name' => 'notification_email', 'id' => 'notification_email', 'class' => 'form-control form-control__large', 'value' => set_value('notification_email', isset($Settings->notification_email->value) ? $Settings->notification_email->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Reply From Email:', 'mail_reply_email'); ?>
                                <?php echo form_input(array('name' => 'mail_reply_email', 'id' => 'mail_reply_email', 'class' => 'form-control', 'value' => set_value('mail_reply_email', isset($Settings->mail_reply_email->value) ? $Settings->mail_reply_email->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Email Protocol:', 'mail_protocol'); ?>
                                <?php echo form_input(array('name' => 'mail_protocol', 'id' => 'mail_protocol', 'class' => 'form-control', 'value' => set_value('mail_protocol', isset($Settings->mail_protocol->value) ? $Settings->mail_protocol->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Email Host:', 'mail_server'); ?>
                                <?php echo form_input(array('name' => 'mail_server', 'id' => 'mail_server', 'class' => 'form-control', 'value' => set_value('mail_server', isset($Settings->mail_server->value) ? $Settings->mail_server->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Email Outgoing Port:', 'mail_outgoing_port'); ?>
                                <?php echo form_input(array('name' => 'mail_outgoing_port', 'id' => 'mail_outgoing_port', 'class' => 'form-control', 'value' => set_value('mail_outgoing_port', isset($Settings->mail_outgoing_port->value) ? $Settings->mail_outgoing_port->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Email Login:', 'mail_login'); ?>
                                <?php echo form_input(array('name' => 'mail_login', 'id' => 'mail_login', 'class' => 'form-control', 'value' => set_value('mail_login', isset($Settings->mail_login->value) ? $Settings->mail_login->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Email Password:', 'mail_password'); ?>
                                <?php echo form_password(array('name' => 'mail_password', 'id' => 'mail_password', 'class' => 'form-control', 'value' => set_value('mail_password', isset($Settings->mail_password->value) ? $Settings->mail_password->value : ''))); ?>
                            </div>
                            <div class="form-group">
                                <label for="mail_send_as_html"><span class="required">*</span> Send as HTML?</lable>
                                <label class="radio-inline"><?php echo form_radio(array('name' => 'mail_send_as_html', 'value' => 'true', 'checked' => set_radio('mail_send_as_html', 'true', ($Settings->mail_send_as_html->value === 'true') ? TRUE : FALSE))); ?> Yes</label>
                                <label class="radio-inline"><?php echo form_radio(array('name' => 'mail_send_as_html', 'value' => 'false', 'checked' => set_radio('mail_send_as_html', 'false', ($Settings->mail_send_as_html->value === 'false') ? TRUE : FALSE))); ?> No</label>
                            </div>
                            <div class="form-group">
                                <?php echo form_label('<span class="required">*</span> Email Authentication Service:', 'mail_authen_srvc'); ?>
                                <?php echo form_input(array('name' => 'mail_authen_srvc', 'id' => 'mail_authen_srvc', 'class' => 'form-control', 'value' => set_value('mail_authen_srvc', isset($Settings->mail_authen_srvc->value) ? $Settings->mail_authen_srvc->value : ''))); ?>
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
        $( ".tabs" ).tabs();
    });
</script>
<?php js_end(); ?>