<?php
    if ($this->input->get('redirect')) {
        $action = site_url('login') . '?redirect=' . $this->input->get('redirect');
    } else {
        $action = site_url('login');
    }
?>
<div class="container">
	<div class="row">
		<div class="col-md-6 animated hidden-xs" style="padding-top:100px">
			<h1 class="site-name">
				<span>A</span>lways
				<span>R</span>eliable 
				<span>K</span>eys
			</h1>
			<p>We have been working very hard to create a complete and comprehensive application for Automotive Security Professionals. To learn more please contact us at <a href="mailto:contact@arksecurity.com" target="_blank">contact@arksecurity.com</a></p>
		</div>
		<div class="col-md-6">
			<h1 class="site-name visible-xs">
				<span>A</span>lways
				<span>R</span>eliable 
				<span>K</span>eys
			</h1>
			<form method="post" action="<?php echo $action; ?>" id="User_Login_Form">
				<div class="panel panel-body login-form animated">
					<div class="text-center">
						<h1 style="color:#fff;padding: 15px 0;">Fill in the form below to get instant access now!</h1>
					</div>
					<?php $this->load->view('alert_view'); ?>
					<div class="form-group has-feedback has-feedback-left">
						<input type="text" class="form-control input-lg" placeholder="Username / Email" name="txt_username" id="txt_username">
						<div class="form-control-feedback">
							<i class="icon-user text-muted"></i>
						</div>
					</div>

					<div class="form-group has-feedback has-feedback-left">
						<input type="password" class="form-control input-lg" placeholder="Password" name="txt_password" id="txt_password">
						<div class="form-control-feedback">
							<i class="icon-lock2 text-muted"></i>
						</div>
					</div>

					<div class="form-group login-options">
						<div class="row">
							<div class="col-sm-6">
								<label class="checkbox-inline">
									<input type="checkbox" class="styled" checked="checked" name="remember" id="remember" value="1">Remember
								</label>
							</div>

							<div class="col-sm-6 text-right">
								<a href="<?php echo site_url('forgot_password'); ?>">Forgot password?</a>
							</div>
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn bg-blue btn-block btn_login">Login <i class="icon-arrow-right14 position-right"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>