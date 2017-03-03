<section class="login-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="row-height row-table">
                <div class="col-md-6 col-sm-12 col-md-push-6 col-height login-page-form-column">
                    <div class="inside-full-height">
                        <div class="login-form-wrapper">
                            <div class="back-to-site">
                                <a href="<?php echo site_url(); ?>"><span>&laquo;</span> Back to my website</a>
                            </div>
                            <div class="">
                                <div class="form-wrap">
                                    <h1>Log in</h1>
                                
                                    <?php echo form_open('', 'class="admin-login-form"'); ?>

                                        <?php echo validation_errors(); ?>
                                        <?php echo $this->session->flashdata('message'); ?>

                                            <div class="form-group">
                                                <?php echo form_label('Email', 'email', ['class' => 'hidden']); ?>
                                                <?php echo form_input(['id' => 'email', 'name' => 'email', 'value' => set_value('email'), 'class' => 'form-control', 'placeholder' => 'Email']); ?>
                                            </div>

                                            <div class="form-group">
                                                <?php echo form_label('Password', 'password', ['class' => 'hidden']); ?>
                                                <?php echo form_password(['id' => 'password', 'name' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']); ?>
                                            </div>

                                            <div class="">
                                                <div class="fleft">
                                                    <label><input name="remember_me" class="remember_me" type="checkbox" value="1" /> Remember me</label>
                                                </div>
                                                <div class="fright">
                                                    <button class="btn btn-black btn-block" type="submit">LOG IN</button>
                                                </div>
                                            </div>
                                            
                                            <?php echo anchor(ADMIN_PATH . '/users/forgot-password', 'Forgot your password?', ['class' => 'forget']) ?>
                                        <hr />

                                    <?php echo form_close(); ?>
                                    
                                </div>
                            </div> <!-- /.col-xs-12 -->

                            <footer id="footer">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p>&copy; <?php echo date('Y') ?> <strong><a href="http://pagestudiocms.com" target="_blank">Page Studio CMS</a>. </strong>v <?php echo CC_VERSION ?></p>
                                        </div>
                                    </div>
                                </div>
                            </footer>
                        </div> <!-- /.login-form-wrapper -->
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-12 col-md-pull-6 col-height login-page-cta-column">
                    <div class="inside-full-height">
                        <br />
                        <br />
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>