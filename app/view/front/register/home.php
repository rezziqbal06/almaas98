<style>
	.bg-form {
		background-color: var(--white);
		border-radius: 32px;
		margin-bottom: 32px;
	}

	@media screen and (max-width: 765px) {
		.bg-form {
			background-color: var(--white);
			border-top-left-radius: 32px;
			border-top-right-radius: 32px;
			border-bottom-right-radius: 0px;
			border-bottom-left-radius: 0px;
			margin-bottom: 0px;
		}
	}
</style>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6 text-center">
		<img src="<?= base_url("media/logo.png") ?>" alt="<?= $this->config->semevar->site_name ?>" class="img-fluid text-center mt-4 mb-5 p-5">
		<form id="form-register" class="p-4 bg-form text-start">
			<h3 class="text-primary mb-3 text-center">Daftar</h3>

			<div class="col-md-12 mb-2">
				<label for="ifnama" class="control-label">Nama Lengkap</label>
				<input id="ifnama" type="text" name="fnama" value="<?= $ue->fnama ?? '' ?>" class="form-control" required>
			</div>
			<div class="col-md-12 mb-2">
				<label for="inik" class="control-label">NIK</label>
				<input type="number" id="inik" class="form-control" name="nik" value="<?= $ue->nik ?? '' ?>" required>
			</div>
			<div class="col-md-12 mb-2">
				<label for="itelp" class="control-label">No. Telpon</label>
				<input type="number" id="itelp" class="form-control" name="telp" value="<?= $ue->telp ?? '' ?>" required>
			</div>
			<div class="col-md-12 mb-2">
				<label for="iemail" class="control-label">Email</label>
				<input type="email" id="iemail" class="form-control" name="email" value="<?= $ue->email ?? '' ?>" required>
			</div>
			<div class="col-md-12 mb-2">
				<label for="ipassword" class="control-label">Password Baru</label>
				<input id="ipassword" type="password" name="password" class="form-control" required>
			</div>
			<div class="col-md-12 mb-2">
				<label for="irepassword" class="control-label">Ulangi Password</label>
				<input id="irepassword" type="password" name="" class="form-control" required>
			</div>

			<div class="text-center mb-5">
				<button type="submit" class="btn btn-lg btn-lg bg-secondary w-100 mt-4 mb-0 btn-submit"><i class="icon-submit fa fa-register"></i> Daftar</button>
			</div>
			<a href="<?= base_url("login") ?>"><small>Sudah punya akun? login</small></a>
		</form>
	</div>
	<div class="col-md-3"></div>
</div>