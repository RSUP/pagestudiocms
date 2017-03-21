<!-- workspace -->
<div class="edit-pane">
    <div id="editPane">

        <section class="content-header">
            <h1>
                File Manager
                <small></small><br />
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row clearfix" style="padding:10px 15px">    
            <div class="col-lg-12 filemanager_container embed-responsive">
                <iframe id="glu" class="" src="<?php echo BASE_URL . APPPATH . 'third_party/file_manager/dialog.php'; ?>" width="100%" height="500" frameborder="0" onload="resize_iframe()"></iframe>
            </div><!-- // .col-lg-12 -->
        </div>
        
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->


<?php js_start(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var height = $(window).height() - 120;
        $('.filemanager_container').height(height);
            
        $(window).resize(function(){
            var height = $(window).height() - 120;
            $('.filemanager_container').height(height);
        });
    });
</script>
<?php js_end(); ?>