    <?php if ($this->secure->is_auth()): ?>
        <footer class="footer hidden">  
                <ul>
                    <li><a href="http://anibor.digeryuzu.com"><span id="user"><font>Welcome, Admin</font></span></a></li>
                    <li><a href="#"><span id="setting"></span></a></li>
                    <li><a href="#"><span id="exit"></span></a></li>
                </ul>
            </footer>
        </div>
    </div>
    <?php endif; ?>
    <!-- -->
    <div id="ajax_status" class="hidden">
        <table id="ajax_status_frame">
            <tr>
                <td>
                    <div id="ajax_status_animation"><img src="<?php echo theme_url('assets/images/ajax-loader.gif'); ?>" /></div>
                    <div id="ajax_status_text"></div>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Global modals -->

    <!-- Default navigation Modal -->
    <div class="modal fade box-modal" id="defaultNavigationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title" id="lineModalLabel">My Modal</div>
            </div>
            <div class="modal-body">
                
                <!-- content goes here -->
                <?php echo form_open(null, 'id="default_navigation_form"'); ?>
                    <div class="hidden">                        
                        <input type="hidden" name="id" value="" />
                    </div>
                  <div class="form-group">
                    <label for="title">Album Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Trip to the moon">
                  </div>
                <?php echo form_close(); ?>

            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Cancel</button>
                    </div>
                    <div class="btn-group btn-delete hidden" role="group">
                        <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-hover-green js-save-album" data-action="save" role="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    
    <!-- Default navigation Modal -->
    <div class="modal fade box-modal" id="addEditNavigationModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <div class="modal-title" id="lineModalLabel">My Modal</div>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <?php echo form_open(null, '')?>
                <div class="form">
                    <div class="form-group">
                        <?php echo form_label('Title', 'title')?>
                        <?php echo form_input(['name' => 'title', 'value' => '', 'class' => 'form-control', 'placeholder' => 'New'])?>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Cancel</button>
                    </div>
                    <div class="btn-group btn-delete hidden" role="group">
                        <button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default btn-hover-green js-save-album" data-action="save" role="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    
    <!-- Controller Defined JS Files -->
    <?php echo $this->template->javascripts(); ?>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    
    <script src="<?php echo theme_url('assets/js/plugins/smoke/smoke.min.js'); ?>"></script>
    <script src="<?php echo theme_url('assets/js/plugins/slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?php echo theme_url('assets/js/plugins/dataTables/jquery.dataTables.js'); ?>"></script>
    <script src="<?php echo theme_url('assets/js/plugins/dataTables/dataTables.bootstrap.js'); ?>"></script>
    
    <!-- jQuery UI -->
    <script src="<?php echo theme_url('assets/js/plugins/jquery-ui/jquery-ui-custom.min.js'); ?>"></script>
    
    <script src="<?php echo theme_url('assets/js/plugins/sortable/jquery.mjs.nestedSortable.js'); ?>"></script>

    <script src="<?php echo theme_url('assets/js/app.js'); ?>"></script>
    <script src="<?php echo theme_url('assets/js/custom.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo theme_url('assets/js/helpers.js'); ?>"></script>
    
    <script type="text/javascript">
    $(document).ready(function(){
		// $('ol.tree-sortable').nestedSortable({
		// 	forcePlaceholderSize: true,
		// 	handle: 'div',
		// 	helper:	'clone',
		// 	items: 'li',
		// 	opacity: .6,
		// 	placeholder: 'placeholder',
		// 	revert: 250,
		// 	tabSize: 25,
		// 	tolerance: 'pointer',
		// 	toleranceElement: '> div',
		// 	maxLevels: 3,
        // 
		// 	isTree: true,
		// 	expandOnHover: 700,
		// 	startCollapsed: true
		// });

		$('.disclose').on('click', function() {
			$(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
		});
        
        $('.nav-sub__config').on('click', function(e){
            console.log('Navigation modal triggered.');
        });
        
        // Modal launcher 
        $('.js-nav-modal-trigger').on('click', function(){
            var $modal   = $('#defaultNavigationModal');
            $modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            
            var albumId     = $(this).data('album-id');
            var albumTitle  = $(this).data('album-title');
            
            $modal.find('.modal-title').text('Configure Primary Navigation');
            $modal.find('input[name="id"]').val(albumId);
            $modal.find('input[name="title"]').val(albumTitle);
        });
        
        // Modal launcher 
        $('.js-add-edit-navigation-trigger').on('click', function(){
            var $modal   = $('#addEditNavigationModal');
            $modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            $modal.find('input[name="id"]').val('');
            $modal.find('input[name="title"]').val('');
            
            var navId = $(this).data('nav-id');
            var navTitle = $(this).data('nav-title');
            if (navId) {
                $modal.find('.modal-title').text('Edit Navigation #' + navId);
                $modal.find('input[name="id"]').val(navId);
                $modal.find('input[name="title"]').val(navTitle);
            } else {
                $modal.find('.modal-title').text('Add Navigation');
            }
        });
        
        // Edit navigation modal 
        $('.site-pages-tree').on('click', '*', function(e){
            e.preventDefault();
            var obj         = $(this);
            var entry_id    = '';
            var nav_id      = '';
            if(obj.is('a')){
                entry_id = obj.data('entry-id');
                nav_id   = obj.data('nav-id');
                console.log(entry_id, nav_id);
                $(location).attr('href','<?php echo site_url(ADMIN_PATH . '/content/entries/edit')?>/' + entry_id + '/' + entry_id);
            }
        });
	});
    </script>
</body>
</html>
