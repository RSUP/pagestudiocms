<nav class="nav-menu-panel-right">

	<ul id="nav-sub-ui" class="nav-sub  <?php 
        if(segment(2) == '') echo 'active';
        switch (segment(2)) {
            case 'notifications' : 
            case 'forms' : 
            case 'icons' : 
            case 'buttons' : 
                echo 'active';
        }
    ?>">
		<li class="heading">UI</li>
		<li class="spacer"></li>
		<li class="">
        <?php 
        echo admin_primary_nav($this->template->template_data['admin_menu_items'], array(
            'menu_id' => '', 
            'menu_class' => '', 
            'has-sub' => ''
        ));
        ?>
        </li>
	</ul>
	<ul class="nav-sub <?php
        switch (segment(2)) {
            case 'filemanager' : 
            case 'galleries' : 
                echo 'active';
        }         
    ?>" id="nav-sub-media">
		<li class="heading">Media</li>
		<li class="description"><div class="alert alert-info">File manger is a built-in file browser. Anything uploaded there is made available throughout the CMS. Use it to manage all assets in one place.</div></li>
		<li class="<?php if(segment(2) == 'filemanager') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH) . '/filemanager'; ?>"><i class="fa fa-folder-o"></i> File Manager</a> <a class="nav-sub__config" href="" title="Settings"></a>
		</li>
		<li class="<?php if(segment(2) == 'galleries') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH) . '/galleries'; ?>"><i class="fa fa-picture-o"></i> Photo Gallery</a> <a class="nav-sub__config" href="" title="Settings"></a>
		</li>
	</ul>
	<ul class="nav-sub <?php
        switch (segment(2)) {
            case 'content' : 
                echo 'active';
        }         
    ?>" id="nav-sub-pages">
		<li class="heading">Pages</li>
		<li class="description"><div class="alert alert-info">Here you can do something to update something esle</a></li>
        <li class="line"></li>
        <li class="sub-heading sub-heading__line-before">Navigations</li>
        <?php echo list_navs(); ?>
        <li class="line"></li>
		<li class="sub-heading sub-heading__line-before">Pages</li>
        <li class="<?php if(segment(3) == 'entries') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH) . '/content/entries'; ?>"><i class="fa fa-files-o"></i> View All</a> <span class="nav-sub__config" data-toggle="tooltip" title="View all pages"></span></a>
		</li>
		<li class="line">&nbsp;</li>
		<li class="sub-heading sub-heading__line-before">Developer</li>
        <li class="<?php if(segment(3) == 'types') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/content/types') ?>"><i class="pe-7s-plugin"></i> Content Types</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(3) == 'snippets') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/content/snippets') ?>"><i class="fa fa-code"></i>Code Snippets</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(3) == 'categories') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/content/categories/groups') ?>"><i class="pe-7s-network"></i> Categories</a> <span class="nav-sub__config"></span>
		</li>
	</ul>
	<ul class="nav-sub" id="nav-sub-posts">
		<li class="heading">Posts</li>
		<li class="spacer"></li>
		<li>
			<a href="index.php?module=posts&amp;action=writepost">Add New</a> <span class="nav-sub__config"><i class="fa fa-plus-circle"></i></span>
		</li>
		<li class="active">
			<a href="index.php?module=posts&amp;action=viewposts">View All</a>
		</li>
	</ul>
	<ul class="nav-sub <?php
        switch (segment(2)) {
            case 'users' : 
            case 'profile' : 
                echo 'active';
        }         
    ?>" id="nav-sub-users">
		<li class="heading">Users</li>
        <li class="description"><div class="alert alert-info">Here you can manage the various user accounts associated with your site</a></li>
		<li class="sub-heading">Accounts</li>
		<li class="<?php if(segment(2) == 'users') echo 'active'; ?>">
			<a href=""><i class="pe-7s-users"></i> View All</a>
		</li>
		<li class="<?php if(segment(2) == 'profile') echo 'active'; ?>">
			<a href=""><i class="pe-7s-user"></i>My Profile</a> <span class="nav-sub__config"></span>
		</li>
		<li>
			<a href="#"><i class="fa fa-plus"></i> Add New</a> <span class="nav-sub__config"></span>
		</li>
		<li class="line"></li>
		<li class="sub-heading sub-heading__line-before">Groups</li>
        <li>
			<a href="#"><i class="fa fa-plus"></i> Add New</a> <span class="nav-sub__config"></span>
		</li>
	</ul>
    <ul class="nav-sub <?php
        switch (segment(2)) {
            case 'settings' : 
                echo 'active';
        }         
    ?>" id="nav-sub-settings">
		<li class="heading">Settings</li>
		<li class="spacer"></li>
		<li class="<?php if(segment(3) == 'general-settings') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/general-settings') ?>"><i class="pe-7s-tools"></i> General</a>
		</li>
		<li class="<?php if(segment(3) == 'notifications') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/notifications') ?>"><i class="pe-7s-bell"></i> Notifications</a>
		</li>
        <li class="<?php if(segment(3) == 'users') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/users') ?>"><i class="pe-7s-users"></i> Users</a> <span class="nav-sub__config"></span>
		</li>
		<li class="<?php if(segment(3) == 'analytics') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/analytics') ?>"><i class="pe-7s-graph1"></i> Analytics</a></span>
		</li>
        <li class="<?php if(segment(3) == 'themes') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/themes') ?>"><i class="pe-7s-paint"></i> Themes</a></span>
		</li>
		<li class="line"></li>
		<li class="sub-heading sub-heading__line-before">Developer</li>
        <li class="<?php if(segment(3) == 'clear-cache') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/clear-cache') ?>"><i class="pe-7s-gleam"></i> Cache</a> <span class="nav-sub__config"></span>
		</li>
		<li class="<?php if(segment(3) == 'code-injection') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/code-injection') ?>"><i class="fa fa-code"></i> Code Injection</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(3) == 'theme-editor') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/theme-editor') ?>"><i class="pe-7s-albums"></i> Theme Editor</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(3) == 'import-export') echo 'active'; ?>">
			<a href=""><i class="pe-7s-exapnd2"></i> Import / Export</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(3) == 'url-routes') echo 'active'; ?>">
			<a href=""><i class="pe-7s-shuffle"></i> URL Routes</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(3) == 'server-info') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH . '/settings/server-info') ?>"><i class="pe-7s-info"></i> Server Info</a> <span class="nav-sub__config"></span>
		</li>
	</ul>
</nav>