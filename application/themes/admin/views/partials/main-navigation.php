<?php 
// echo admin_primary_nav($this->template->template_data['admin_menu_items'], array(
    // 'menu_id' => '', 
    // 'menu_class' => '', 
    // 'has-sub' => ''
// ));
?>
<nav class="nav-menu-panel-left" id="main_navigation">
	<ul class="nav-main">
		<li class="first <?php 
        if(segment(2) == '') echo 'active'; ?>">
			<!--
            <a href="/" class="dashboard" data-toggle="tab" data-placement="right" title="Toggle Search"><i class="icon flat icon-dashboard-o"></i> </a>
            -->
            <a aria-expanded="true" data-toggle="tab" href="#nav-sub-ui"><i class="icon flat icon-dashboard-o"></i></a>
		</li>
		<li class="<?php 
            switch (segment(2)) {
                case 'galleries' : 
                case 'filemanager' : 
                    echo 'active';
            }
        ?>">
			<a aria-expanded="false" data-toggle="tab" href="#nav-sub-media"><i class="icon flat icon-picture-o"></i></a>
		</li>
		<li class="<?php 
           if(segment(2) == 'content' && segment(3) == 'entries') echo 'active';
        ?>">
			<a aria-expanded="false" data-toggle="tab" href="#nav-sub-pages"><i class="icon flat icon-pages"></i></a>
		</li>
		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#nav-sub-posts"><i class="icon flat icon-plus-circle-o"></i></a>
		</li>
		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#"><i class="icon flat icon-comment-o"></i></a>
		</li>
		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#nav-sub-users"><i class="icon flat icon-user"></i></a>
		</li>
		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#nav-sub-calendar"><i class="icon flat icon-calendar-o"></i></a>
		</li>
		<li class="">
			<a aria-expanded="false" data-toggle="tab" href="#nav-sub-settings"><i class="icon flat icon-cog-o"></i></a>
		</li>
	</ul>
	<div class="nav-menu-panel-bottom">
		<div class="system-info rotate">
			<a href="http://pagestudiocms.com/" target="_blank">Page&nbsp;Studio&nbsp;CMS<br />
			<span class="version">v <?php echo CC_VERSION ?></span></a>
		</div>
		<div class="social-links">
			<a href="<?php echo site_url('users/logout'); ?>" title="Logout"><i class="icon flat icon-power-off"></i></a>
		</div>
	</div>
</nav>