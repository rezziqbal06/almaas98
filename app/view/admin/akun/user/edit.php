<div id="page-content">
	<!-- Static Layout Header -->
	<div class="content-header">
		<div class="row" style="">
			<div class="col-md-6">
				<div class="btn-group">
					<button type="button" onclick="history.back()" class="btn btn-info btn-submit"><i class="fa fa-arrow-left icon-submit"></i> Kembali</button>
				</div>
			</div>
			<div class="col-md-6">

			</div>
		</div>
	</div>

	<!-- Content -->
	<div class="card">

		<div class="card-header">
			<h6><strong><?= $this->getTitle() ?></strong></h6>
		</div>

		<div class="card-body">

			<form id="fedit" action="<?= base_url_admin() ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
				<div class="form-group row">

					<div class="col-md-4">
						<label for="ieis_active" class="control-label">Aktif?</label>
						<select id="ieis_active" name="is_active" class="form-control">
							<option value="1">Ya</option>
							<option value="0">Tidak</option>
						</select>
					</div>
					<div class="col-md-8">
						<label for="iefnama" class="control-label">Nama Lengkap*</label>
						<input type="text" name="fnama" id="iefnama" class="form-control" placeholder="Nama" required>
					</div>
					<div class="col-md-6 d-none">
						<label for="ienik" class="control-label">NIK*</label>
						<input type="number" name="nik" id="ienik" class="form-control" placeholder="Nama">
					</div>
					<?php if (isset($jabatans) && count($jabatans)) { ?>
						<div class="col-md-6">
							<label for="iea_jabatan_id" class="control-label">Profesi</label>
							<select name="a_jabatan_id" id="iea_jabatan_id" class="form-control select2" required>
								<?php foreach ($jabatans as $jb) { ?>
									<option value="<?= $jb->id ?>"><?= $jb->nama ?></option>
								<?php } ?>
							</select>
						</div>
					<?php } ?>
					<?php if (isset($units) && count($units)) { ?>
						<div class="col-md-6">
							<label for="iea_unit_id" class="control-label">Unit</label>
							<select name="a_unit_id" id="iea_unit_id" class="form-control select2" required>
								<?php foreach ($units as $un) { ?>
									<option value="<?= $un->id ?>"><?= $un->nama ?></option>
								<?php } ?>
							</select>
						</div>
					<?php } ?>

				</div>

				<!-- <div class="form-group row">
                    <div class="col-md-6">
                        <label for="iealamat_select" class="control-label">Cari Alamat</label>
                        <select id="iealamat_select" class="form-control select2"></select>
                    </div>
                </div> -->
				<div class="form-group row">
					<div class="col-md-4">
						<label for="ieprovinsi">Provinsi</label>
						<select id="ieprovinsi" class="form-control" name="provinsi"></select>
					</div>
					<div class="col-md-4">
						<label for="iekabkota">Kabupaten / Kota</label>
						<select id="iekabkota" class="form-control" name="kabkota"></select>
					</div>
					<div class="col-md-4">
						<label for="iekecamatan">Kecamatan</label>
						<select id="iekecamatan" class="form-control" name="kecamatan"></select>
					</div>
					<div class="col-md-4">
						<label for="iekelurahan">Desa / Kelurahan</label>
						<select id="iekelurahan" class="form-control" name="kelurahan"></select>
					</div>
					<div class="col-md-4">
						<label for="iekodepos" class="control-label">Kodepos</label>
						<input id="iekodepos" class="form-control " name="kodepos" placeholder="Kodepos">
					</div>
					<div class="col-md-6">
						<label for="iealamat">Alamat</label>
						<textarea id="iealamat" class="form-control" name="alamat" maxlength="30"></textarea>
					</div>
					<div class="col-md-6">
						<label for="iealamat2">Alamat2</label>
						<textarea id="iealamat2" class="form-control" name="alamat2" maxlength="30"></textarea>
					</div>
					<div class="col-md-12">
                        <label for="iepenilaian">Penilaian/Testimoni</label>
                        <textarea id="iepenilaian" class="form-control" name="penilaian" maxlength="300"></textarea>
                    </div>
				</div>
				<div class="form-group row">

				</div>
				<div class="form-group row">
					<div class="col-md-4">
						<label for="ieitelp" class="control-label">Telepon</label>
						<input id="ieitelp" type="number" class="form-control" name="telp" placeholder="Telepon" />
					</div>
					<div class="col-md-4">
						<label for="ieemail" class="control-label">Email</label>
						<input id="ieemail" type="email" class="form-control" name="email" placeholder="Email" />
					</div>
					<div class="col-md-4">
						<label for="ieusername" class="control-label">Username</label>
						<input id="ieusername" type="username" class="form-control" name="username" placeholder="Username" />
					</div>
					<div class="col-md-4">
						<label for="iesumber_iklan">Sumber Iklan</label>
						<select id="iesumber_iklan" class="form-control select2" name="sumber_iklan">
							<option value="Teman">Teman</option>
							<option value="Saudara">Saudara</option>
							<option value="Website Resmi Almaas">Website Resmi Almaas</option>
							<option value="Website Rumah.com">Website Rumah.com</option>
							<option value="Website Rumah123.com">Website Rumah123.com</option>
							<option value="Facebook">Facebook</option>
							<option value="Instagram">Instagram</option>
							<option value="Whatsapp">Whatsapp</option>
							<option value="Tiktok">Tiktok</option>
							<option value="Youtube">Youtube</option>
							<option value="Twitter">Twitter</option>
						</select>
					</div>
					<div class="col-md-4 panel-pembayaran mb-2">
						<label for="iktp" class="control-label">KTP</label>
						<input id="iktp" type="file" name="ktp" accept=".png, .jpg, .jpeg" class="form-control">
					</div>
					<div class="col-md-2 mb-2 mt-4">
						<img id="img-iktp" src="" alt="" class="img-fluid rounded">
					</div>
					<!-- <div class="col-md-4">
						<label for="iepassword" class="control-label">Password</label>
						<input id="iepassword" type="password" class="form-control" name="password" value="123456" placeholder="password" />
					</div> -->
				</div>
				<div class="form-group form-actions">
					<div class="col-xs-12 text-right">
						<div class="btn-group pull-right">
							<button type="submit" class="btn btn-primary btn-submit">
								Simpan Perubahan <i class="fa fa-save icon-submit"></i>
							</button>
						</div>
					</div>
				</div>

			</form>
		</div>

	</div>

</div>