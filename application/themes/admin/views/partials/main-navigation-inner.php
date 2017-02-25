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
		<li class="spacer"></li>
		<li class="<?php if(segment(2) == 'filemanager') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH) . '/filemanager'; ?>">Media Manager</a> <a class="nav-sub__config" href="#navPaneModal" data-toggle="modal" title="Settings"><i class="fa fa-picture-o"></i></a>
		</li>
		<li class="<?php if(segment(2) == 'galleries') echo 'active'; ?>">
			<a href="<?php echo site_url(ADMIN_PATH) . '/galleries'; ?>">Photo Gallery</a> <a class="nav-sub__config" href="gallery.php" title="Settings"><i class="pe-7s-photo"></i></a>
		</li>
	</ul>
	<ul class="nav-sub" id="nav-sub-pages">
		<li class="heading">Pages</li>
		<li class="spacer"></li>
		<li class="tree">
			<ol class="tree-sortable ui-sortable">
				<li>
					<div class="ui-sortable-handle">
						<span class="disclose"><span></span></span><a href="site-preview.php">Home</a> <a class="nav-sub__config" href="#navPaneModal" data-toggle="modal" title="Settings"><i class="fa fa-cog"></i></a>
					</div>
					<ol>
						<li id="list_2">
							<div class="ui-sortable-handle">
								<span class="disclose"><span></span></span><a data-toggle="offcanvas" href="#">About Our Company</a>
							</div>
							<ol>
								<li id="list_3">
									<div class="ui-sortable-handle">
										<span class="disclose"><span></span></span>Sub Item 1.2
									</div>
								</li>
							</ol>
						</li>
					</ol>
				</li>
				<li id="list_4">
					<div class="ui-sortable-handle">
						<span class="disclose"><span></span></span>Item 2
					</div>
				</li>
				<li>
					<div class="ui-sortable-handle">
						<span class="disclose"><span></span></span><a href="">Company Mission</a> <a class="nav-sub__config" href="#navPaneModal" data-toggle="modal" title="Settings"><i class="fa fa-cog"></i></a>
					</div>
				</li>
				<li id="list_5">
					<div class="ui-sortable-handle">
						<span class="disclose"><span></span></span>Item 3
					</div>
					<ol>
						<li class="mjs-nestedSortable-no-nesting" id="list_6">
							<div class="ui-sortable-handle">
								<span class="disclose"><span></span></span>Sub Item 3.1 (no nesting)
							</div>
						</li>
						<li id="list_7">
							<div class="ui-sortable-handle">
								<span class="disclose"><span></span></span>Sub Item 3.2
							</div>
							<ol>
								<li id="list_8">
									<div class="ui-sortable-handle">
										<span class="disclose"><span></span></span>Sub Item 3.2.1
									</div>
								</li>
							</ol>
						</li>
					</ol>
				</li>
				<li id="list_9">
					<div class="ui-sortable-handle">
						<span class="disclose"><span></span></span>Item 4
					</div>
				</li>
				<li id="list_10">
					<div class="ui-sortable-handle">
						<span class="disclose"><span></span></span>Item 5
					</div>
				</li>
			</ol>
		</li>
		<li class="line">&nbsp;</li>
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
		<li class="spacer"></li>
		<li>
			<a href="#">Add New</a> <span class="nav-sub__config"><i class="fa fa-plus-circle"></i></span>
		</li>
		<li class="<?php if(segment(1) == 'users') echo 'active'; ?>">
			<a href="users.php">View All</a>
		</li>
		<li class="<?php if(segment(1) == 'profile') echo 'active'; ?>">
			<a href="profile.php">Your Profile</a> <span class="nav-sub__config"><i class="fa fa-user"></i></span>
		</li>
	</ul>
    <ul class="nav-sub <?php
        switch (segment(1)) {
            case 'users' : 
            case 'profile' : 
                echo 'active';
        }         
    ?>" id="nav-sub-settings">
		<li class="heading">Settings</li>
		<li class="spacer"></li>
		<li class="<?php if(segment(1) == 'general') echo 'active'; ?>">
			<a href="users.php">General</a>
		</li>
		<li class="<?php if(segment(1) == 'analytics') echo 'active'; ?>">
			<a href="">Analytics</a></span>
		</li>
		<li class="sub-heading">Sub Settings</li>
		<li class="<?php if(segment(1) == 'email') echo 'active'; ?>">
			<a href=""><i class="fa fa-envelope-o"></i> Social Portal</a> <span class="nav-sub__config"></span>
		</li>
        <li class="<?php if(segment(1) == 'email') echo 'active'; ?>">
			<a href="profile.php"><i class="fa fa-envelope-o"></i> Email</a> <span class="nav-sub__config"></span>
		</li>
	</ul>
</nav>