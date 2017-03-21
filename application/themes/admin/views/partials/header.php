<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php echo $this->template->metadata(); ?>
    
    <!--stylesheets
	============================================= -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"> -->
    <link href="<?php echo theme_url('assets/css/plugins/smoke/smoke.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo theme_url('assets/css/ui-icons.css'); ?>" media="screen" rel="stylesheet">
    <link href="<?php echo theme_url('assets/css/pe-icon-7-stroke.css'); ?>" media="screen" rel="stylesheet">
    <link href="<?php echo theme_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/plugins/icheck/all.css" rel="stylesheet">
    <link href="assets/css/plugins/icheck/square/blue.css" rel="stylesheet">

    <!-- Controller Defined Stylesheets -->
    <?php echo $this->template->stylesheets(); ?>

    <script type="text/javascript">
        var ADMIN_PATH = '<?php echo ADMIN_PATH; ?>';
        var ADMIN_URL = '<?php echo site_url(ADMIN_PATH); ?>';
        var THEME_URL = '<?php echo theme_url(); ?>';
    </script>

    <script src="<?php echo theme_url('assets/js/modernizr.custom.js'); ?>"></script> <!-- Modernizr -->
    
    <!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="">
	<link rel="apple-touch-icon" href="">
	<link rel="apple-touch-icon" sizes="72x72" href="">
	<link rel="apple-touch-icon" sizes="114x114" href="">

</head>
<body <?php 
    if ($this->template->segment(3) === 'login' || $this->template->segment(3) === 'forgot-password') {
        echo 'class="admin-login-page"';
    }
?>>
<?php if ($this->secure->is_auth()): ?>
<div class="hidden">
    <nav class="cd-nav">
        <ul class="cd-top-nav">
            <li><a class="settings-icon" target="_blank" href="<?php echo site_url(); ?>"><i class="fa fa-eye"></i>&nbsp;<span>Visit Site</span></a></li>
            <li><a class="settings-icon" href="<?php echo site_url(ADMIN_PATH .'/settings/general-settings'); ?>" title="Settings"><i class="fa fa-cog">&nbsp;</i><span>Settings</span></a></li>
        </ul>
    </nav>

	<main class="cd-main-content">

    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php echo (isset($this->secure->get_user_session()->photo)) ? site_url() . $this->secure->get_user_session()->photo : site_url() . ADMIN_NO_IMAGE;?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2><?php echo $this->secure->get_user_session()->first_name; ?></h2>
      </div>
    </div>

    <li><a href="<?php echo site_url(ADMIN_PATH . '/users/edit') .'/'. $this->secure->get_user_session()->id;?>">Edit Account</a></li>
    <li><a href="<?php echo site_url('users/logout'); ?>" title="Logout">Logout</a></li>
</div>

<!-- ======================================================================================== -->

<!-- ======================================================================================== -->

    <div class="wrapper">
        <!-- Add class .open-options-pane to open options-pane -->
        <!-- Add class .collapse-options-pane to close options-pane -->
        <?php $open_left_page = (isset($open_left_page)) ? $open_left_page : true; ?>
        <?php $open_options_page = (isset($open_options_page)) ? $open_options_page : false; ?>
        <div class="workspace <?php echo ($open_left_page) ? 'open-left-pane ' : ''; echo ($open_options_page) ? 'open-options-pane ' : '';?>">
        
            <?php echo theme_partial('main-navigation'); ?>

<?php endif; ?>