<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Code Injection
                <small></small><br />
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
                    
            <div class="col-md-8">
                <div class="text-right">
                    <a class="btn btn-default" href="#" onClick="$('#settings_form').submit();"><span>Save</span></a>
                </div>
                <div class="heading">
                    <div class="alert alert-info">PageStudio allows you to inject code into the top and bottom of your template files without editing them. This allows for quick modifications to insert useful things like tracking codes and meta data.</div>
                    <br />
                </div>
                <div class="content">
                
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo validation_errors(); ?>

                    <?php echo form_open(null, 'id="settings_form"'); ?>
                        <div class="form">
                            <div class="form-group short-editor">
                                <label class="">Header</label>
                                <textarea class="form-control" id="header"></textarea>
                                <p class="help-block">Code here will be injected to the <code>{{ template:head }}</code> helper at the top of each page of your site</p>
                            </div>
                            <br />
                            <div class="form-group short-editor">
                                <label class="">Footer</label>
                                <textarea class="form-control" id="footer"></textarea>
                                <p class="help-block">Code here will be injected to the <code>{{ template:footer }}</code> helper at the bottom of each page of your site</p>
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
   $(document).ready( function() {
        var headerEditor = CodeMirror.fromTextArea(document.getElementById("header"), {
            lineNumbers: true,
            matchBrackets: true,
            // mode: "text/javascript",
            indentUnit: 2,
            indentWithTabs: true,
            enterMode: "keep",
            tabMode: "shift",
            // autofocus: true,
        });
        
        var footerEditor = CodeMirror.fromTextArea(document.getElementById("footer"), {
            lineNumbers: true,
            matchBrackets: true,
            // mode: "text/javascript",
            indentUnit: 2,
            indentWithTabs: true,
            enterMode: "keep",
            tabMode: "shift",
            // autofocus: true,
        });
    });
</script>
<?php js_end(); ?>