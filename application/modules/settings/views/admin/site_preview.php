<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">

        <div class="canvas clearfix" style="
            background-color: #fbfbfb;
            width: 100%;">
            <!-- 
            When the .editor-active class is assigned to the .preview-canvas add 
            the following css:
            -->
            <div class="page-editor-iframe-container" style="">
                <div class="row">
                    <div class="col-lg-12 filemanager_container">
                        <iframe id="live-editor-iframe" src="<?php echo site_url(); ?>" width="100%" height="500" frameborder="0" onload="resize_preview_iframe()"></iframe>
                    </div><!-- // .col-lg-12 -->
                </div><!-- /.row -->
            </div>
        </div>
    </div><!-- end edit-pane -->
</div><!-- end edit-pane -->

