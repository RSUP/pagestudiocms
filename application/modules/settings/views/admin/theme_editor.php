<!-- workspace -->
<div class="edit-pane">

    <div id="editPane">
        <section class="content-header">
            <h1>
                Theme Editor
                <small></small><br />
            </h1>
            <ol class="breadcrumb">
                <?php echo isset($breadcrumb) ? $breadcrumb : ''; ?>
            </ol>
        </section>
    
        <div class="row" style="padding:35px 25px">
                    
            <div class="col-md-12">
                <div class="text-right">
                    <?php if ($file_writable && $file_readable && $files_found): ?>
                        <div class="buttons">
                            <a class="btn btn-default" href="#" onClick="$('#form').submit();"><span>Save</span></a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="heading">
                    
                </div>
                <div class="content">
                    <?php echo $this->session->flashdata('message'); ?>
                    <?php echo validation_errors(); ?>
                
                    <?php if ( ! $file_writable &&  ($files_found && $file_readable)): ?>
                        <p class="attention">The current file does not have writable permissions.</p>
                    <?php endif; ?>
                    <div id="file_explorer">
                        <ul id="tree1">
                            <li>
                                <div class="title">Stylesheets</div>
                                <?php if ( ! empty($stylesheets)): ?>
                                <ul>
                                    <?php foreach($stylesheets as $stylesheet): ?>
                                        <li>
                                            <a <?php echo ($stylesheet['theme_path'] == $file) ? 'class="selected"' : ''; ?> href="<?php echo site_url(ADMIN_PATH . '/settings/theme-editor/index/' . $stylesheet['hash']); ?>">
                                                <?php echo $stylesheet['title']; ?>
                                                <div class="filepath"><?php echo $stylesheet['relative_path']; ?></div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </li>

                            <li>
                                <div class="title">Layouts</div>
                                <?php if ( ! empty($layouts)): ?>
                                <ul>
                                    <?php foreach($layouts as $layout): ?>
                                        <li>
                                            <a <?php echo ($layout['theme_path'] == $file) ? 'class="selected"' : ''; ?> href="<?php echo site_url(ADMIN_PATH . '/settings/theme-editor/index/' . $layout['hash']); ?>">
                                                <?php echo $layout['title']; ?>
                                                <div class="filepath"><?php echo $layout['relative_path']; ?></div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </li>

                            <li>
                                <div class="title">Partials</div>
                                <?php if ( ! empty($partials)): ?>
                                <ul>
                                    <?php foreach($partials as $partial): ?>
                                        <li>
                                            <a <?php echo ($partial['theme_path'] == $file) ? 'class="selected"' : ''; ?> href="<?php echo site_url(ADMIN_PATH . '/settings/theme-editor/index/' . $partial['hash']); ?>">
                                                <?php echo $partial['title']; ?>
                                                <div class="filepath"><?php echo $partial['relative_path']; ?></div>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </li>

                            <li>
                                <div class="title">JavaScripts</div>
                                <?php if ( ! empty($javascripts)): ?>
                                <ul>
                                    <li>
                                        <?php foreach($javascripts as $javascript): ?>
                                            <a <?php echo ($javascript['theme_path'] == $file) ? 'class="selected"' : ''; ?> href="<?php echo site_url(ADMIN_PATH . '/settings/theme-editor/index/' . $javascript['hash']); ?>">
                                                <?php echo $javascript['title']; ?>
                                                <div class="filepath"><?php echo $javascript['relative_path']; ?></div>
                                            </a>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </div>
                    <div style="margin-right: 230px;">
                        <?php if ( ! $files_found): ?>
                            <p class="attention">No files were found for this theme.</p>
                        <?php elseif ( ! $file_readable): ?>
                            <p class="error">The attempted file does not exist or does not have readable permissions.</p>
                        <?php else: ?>
                            <?php echo form_open(null, 'id="form"'); ?>
                                <?php echo form_textarea(array('name'=>'code', 'id'=>'code', 'value'=>set_value('code', $code))); ?>
                            <?php echo form_close(); ?>
                            <?php js_start(); ?>
                            <script type="text/javascript">
                                $(document).ready( function() {
                                    var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                                        lineNumbers: true,
                                        matchBrackets: true,
                                        mode: "<?php echo $mode; ?>",
                                        indentUnit: 4,
                                        indentWithTabs: true,
                                        enterMode: "keep",
                                        tabMode: "shift"
                                    });
                                    
                                    $.fn.extend({
                                        treed: function (o) {
                                          
                                          var openedClass = 'glyphicon-minus-sign';
                                          var closedClass = 'glyphicon-plus-sign';
                                          
                                          if (typeof o != 'undefined'){
                                            if (typeof o.openedClass != 'undefined'){
                                            openedClass = o.openedClass;
                                            }
                                            if (typeof o.closedClass != 'undefined'){
                                            closedClass = o.closedClass;
                                            }
                                          };
                                          
                                            //initialize each of the top levels
                                            var tree = $(this);
                                            tree.addClass("tree");
                                            tree.find('li').has("ul").each(function () {
                                                var branch = $(this); //li with children ul
                                                branch.prepend("<i class='indicator " + closedClass + "'></i>");
                                                branch.addClass('branch');
                                                branch.on('click', function (e) {
                                                    if (this == e.target) {
                                                        var icon = $(this).children('i:first');
                                                        icon.toggleClass(openedClass + " " + closedClass);
                                                        $(this).children().children().toggle();
                                                    }
                                                })
                                                branch.children().children().toggle();
                                            });
                                            //fire event from the dynamically added icon
                                          tree.find('.branch .indicator').each(function(){
                                            $(this).on('click', function () {
                                                $(this).closest('li').click();
                                            });
                                          });
                                            //fire event to open branch if the li contains an anchor instead of text
                                            tree.find('.branch>a').each(function () {
                                                $(this).on('click', function (e) {
                                                    $(this).closest('li').click();
                                                    e.preventDefault();
                                                });
                                            });
                                            //fire event to open branch if the li contains a button instead of text
                                            tree.find('.branch>button').each(function () {
                                                $(this).on('click', function (e) {
                                                    $(this).closest('li').click();
                                                    e.preventDefault();
                                                });
                                            });
                                        }
                                    });

                                    //Initialization of treeviews
                                    // $('#tree1').treed();
                                    $('#tree1').treed({openedClass:'fa fa-folder-open', closedClass:'fa fa-folder-o'});
                                    $('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});
                                });
                            </script>
                            <?php js_end(); ?>
                        <?php endif; ?>
                    </div>
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
