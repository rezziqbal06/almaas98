<!-- Login Container -->
<div id="login-container" class="animation-fadeIn" style="top: 10px;">
	<!-- Login Title -->
	<div class="login-title text-center">
		<img src="<?= $this->cdn_url($this->config->semevar->site_logo->path) ?>" class="img-responsive" />
	</div>
	<!-- END Login Title -->

	<div class="row p-5">
		<!-- Login Block -->
		<div class="col-12">
			<h1>Lupa Password</h1>
			<hr />
			<div id="flogin_info" class="alert alert-info" role="alert" style="<?php if (!isset($pesan_info)) echo 'display:none'; ?>"><?php if (isset($pesan_info)) echo $pesan_info; ?></div>
			<!-- Login Form -->
			<form action="<?= base_url("forgot_password"); ?>" method="post" id="forgot_password_form" class="">
				<div class="form-group">
					<div class="col-xs-12 mb-3">
						<label for="iemail">Masukan Email ketika daftar *</label>
						<div class="input-group">
							<span class="input-group-text"><i class="gi gi-envelope"></i></span>
							<input type="email" id="iemail" name="email" class="form-control input-lg" placeholder="Email" required />
						</div>
					</div>
					<div class="col-xs-12 text-right">
						<button type="submit" class="btn btn-sm btn-primary btn-submit">Kirim via Email <i class="fa fa-angle-right icon-submit"></i></button>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-12">
						<p>Jika anda memang telah terdaftar di sistem kami, link untuk reset password akan dikirimkan melalui email tersebut. Proses ini membutuhkan waktu yang bervariasi, pastikan untuk mengecek email di Inbox atau Spam secara berkala.</p>
					</div>
					<div class="col-xs-12 text-center">
						<a href="<?= base_url('Login') ?>"><small>Login</small></a>
						- <a href="<?= base_url('register') ?>"><small>Form Pendaftaran</small></a>
					</div>
				</div>
			</form>
			<!-- END Login Form -->



		</div>
	</div>
	<!-- END Login Block -->
	<?php $this->getThemeElement('page/html/footer', $__forward); ?>
</div>
<!-- END Login Container -->