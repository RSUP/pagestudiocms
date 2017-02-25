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
    <div id="ajax_status">
        <table id="ajax_status_frame">
            <tr>
                <td>
                    <div id="ajax_status_animation"><img src="<?php echo theme_url('assets/images/ajax-loader.gif'); ?>" /></div>
                    <div id="ajax_status_text"></div>
                </td>
            </tr>
        </table>
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
	});
    </script>
</body>
</html>
