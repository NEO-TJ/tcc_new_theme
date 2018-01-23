<style>
	body{
		background-color: #f5f5f5;
	}
	.ui.button {
		width: 100%;
		text-decoration: none;
		cursor: pointer;
		display: inline-block;
		min-height: 1em;
		outline: 0;
		border: none;
		background: #e0e1e2;
		color: #fff;
		margin: 0 .25em 0 0;
		padding: .78571429em 1.5em;
		text-shadow: none;
		font-weight: 700;
		line-height: 1em;
		font-style: normal;
		text-align: center;
		border-radius: .28571429rem;
		user-select: none;
		-webkit-transition: opacity .1s ease,background-color .1s ease,color .1s ease,box-shadow .1s ease,background .1s ease;
		transition: opacity .1s ease,background-color .1s ease,color .1s ease,box-shadow .1s ease,background .1s ease;
		will-change: '';
	}
	.ui.facebook.button {
		background-color: #3b5998;
		text-shadow: none;
	}
	.ui.facebook.button:hover {
		background-color: #334d84;
		text-shadow: none;
	}
	.panel-default {
		border-color: #ddd;
	}
	.ui.facebook.button, .ui.google.plus.button, .ui.instagram.button, .ui.pinterest.button, .ui.twitter.button, .ui.vk.button, .ui.youtube.button {
		background-image: none;
		box-shadow: 0 0 0 0 rgba(34,36,38,.15) inset;
		color: #fff;
	}
	.panel-default>.panel-heading {
		background-image: url({{url('assets/image/login_bg.png')}});
	}
	.panel-heading {
		padding: 5px 5px;
	}
	.login_box {
		margin: 56px auto;
		padding: 15px 15px 0;
	}
	.t_mid {
		text-align: center;
	}
	.g_right {
		margin-top: -5px;
		float: right;
	}
	.logo-login{
		margin: 0 auto 20px auto;
	}
	.t_gray {
		color: #9e9e9e;
	}
	.login_box .sign_up_btn, .login_box .login_btn {
		background-color: #fff;
		color: #424242;
		padding: 10px 25px;
	}
	.form-horizontal .form-group {
		margin-right: -15px;
		margin-left: -15px;
	}
	.site-titles{
		margin-top: 10px;
		margin-bottom: 20px;
		color: #165a96;
	}
</style>

<div class="container" style="padding: 20px 0 60px;">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 ">
			<div class="panel panel-default login_box">

				<div class="panel-body">

					<?php if(!empty($success_msg)){ ?>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $success_msg ?>
						</div>
					<?php }elseif(!empty($error_msg)){ ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<?php echo $error_msg ?>
						</div>
					<?php }?>

					<div class="col-md-12">
						<h3 class="site-titles text-center" > รีเซ็ตรหัสผ่าน </h3>
					</div>

					<form class="form-horizontal" action="" method="post">

						<div class="form-group has-feedback">
							<div class="col-md-12">
								<input id="email" type="email" class="form-control" name="Email" 
								placeholder="Email" required>
								<?php echo form_error('email','<span class="help-block">','</span>'); ?>
							</div>
						</div>

						<hr>

						<div class="form-group">
							<div class="col-md-10">
								<div class='image' id='captchaImage'><?php echo $image ?></div>
							</div>
							<div class="col-md-2">
								<!-- Calling for refresh captcha image. -->
								<a href='#' class ='refresh' id='captchaRefresh'>
									<img id = 'ref_symbol' src ="<?php echo base_url('assets/images/refresh.png') ?>">
								</a>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12 ">
									<label for="captcha" class=" control-label">captcha</label>
									<input id="captcha" type="text" class="form-control" name="captcha" required>
									<?php echo form_error('captcha','<span class="help-block"><strong>','</strong></span>'); ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12 ">
								<input type="submit" name="forgotPasswordSubmit" class="btn btn-primary btn-block" value="ส่งรหัสผ่าน"/>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>