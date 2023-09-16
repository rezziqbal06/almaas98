<!-- modal option -->
<div id="modal_option" class="modal fade " role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Aksi </h2>
				<h5 id="t"></h5>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12 btn-group-vertical">
						<!-- <a id="adetail" href="#" class="btn btn-info btn-left"><i class="fa fa-info"></i> Detail</a> -->
						<a id="aedit" href="#" class="btn btn-primary btn-left"><i class="fa fa-pencil"></i> Edit</a>
						<button id="bhapus" type="button" class="btn btn-danger btn-left btn-submit"><i class="fa fa-trash-o icon-submit"></i> Hapus</button>
					</div>
				</div>
				<div class="row" style="margin-top: 1em; ">
					<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
					<div class="col-xs-12 btn-group-vertical" style="">
						<button type="button" class="btn btn-default btn-block text-left" data-dismiss="modal" id="btn_close_modal"><i class="fa fa-close"></i> Tutup</button>
					</div>
				</div>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>

<!-- modal tambah -->
<div id="modal_tambah" class="modal fade " role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Tambah</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form action="" method="POST" id="ftambah">
					<div class="row">
						<div class="form-group">
							<div class="row">
								<div class="col-md-12 mb-2">
									<label for="ia_pengguna_id" class="control-label">Nama</label>
									<select id="ia_pengguna_id" type="text" name="a_pengguna_id" class="form-control " required>
										<?php if (isset($apm[0]->id)) : ?>
											<?php foreach ($apm as $k => $v) : ?>
												<option value="<?= $v->id ?>"><?= $v->nama ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="col-md-12 mb-2">
									<label for="ia_kategori_id" class="control-label">Kawasan</label>
									<select id="ia_kategori_id" type="text" name="a_kategori_id" class="form-control " required>
										<?php if (isset($akm[0]->id)) : ?>
											<?php foreach ($akm as $k => $v) : ?>
												<option value="<?= $v->id ?>"><?= $v->nama ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="col-md-12 mb-2">
									<label for="iday">Hari</label>
									<select id="iday" class="form-control " name="day" style="width: 100%" required>
										<option value="1">Setiap Senin</option>
										<option value="2">Setiap Selasa</option>
										<option value="3">Setiap Rabu</option>
										<option value="4">Setiap Kamis</option>
										<option value="5">Setiap Jum'at</option>
										<option value="6">Setiap Sabtu</option>
										<option value="7">Setiap Minggu</option>
									</select>
								</div>
								<div class="col-md-2 mb-2">
									<label for="iis_active" class="control-label">Status</label>
									<select name="is_active" id="iis_active" class="form-control">
										<option value="1">Aktif</option>
										<option value="0">Draft</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 1em; ">
						<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
						<div class="col-xs-12 btn-group-vertical" style="">
							<button type="submit" class="btn btn-default btn-block text-left" data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>

<!-- modal edit -->
<div id="modal_edit" class="modal fade " role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Edit</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form action="" method="POST" id="fedit">
					<div class="row">
						<div class="form-group">
							<input type="hidden" name="id" id="ieid">
							<div class="row">
								<div class="col-md-12 mb-2">
									<label for="iea_pengguna_id" class="control-label">Nama</label>
									<select id="iea_pengguna_id" type="text" name="a_pengguna_id" class="form-control " required>
										<?php if (isset($apm[0]->id)) : ?>
											<?php foreach ($apm as $k => $v) : ?>
												<option value="<?= $v->id ?>"><?= $v->nama ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="col-md-12 mb-2">
									<label for="iea_kategori_id" class="control-label">Kawasan</label>
									<select id="iea_kategori_id" type="text" name="a_kategori_id" class="form-control " required>
										<?php if (isset($akm[0]->id)) : ?>
											<?php foreach ($akm as $k => $v) : ?>
												<option value="<?= $v->id ?>"><?= $v->nama ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="col-md-12 mb-2">
									<label for="ieday">Hari</label>
									<select id="ieday" class="form-control " name="day" style="width: 100%" required>
										<option value="1">Setiap Senin</option>
										<option value="2">Setiap Selasa</option>
										<option value="3">Setiap Rabu</option>
										<option value="4">Setiap Kamis</option>
										<option value="5">Setiap Jum'at</option>
										<option value="6">Setiap Sabtu</option>
										<option value="7">Setiap Minggu</option>
									</select>
								</div>
								<div class="col-md-2 mb-2">
									<label for="ieis_active" class="control-label">Status</label>
									<select name="is_active" id="ieis_active" class="form-control">
										<option value="1">Aktif</option>
										<option value="0">Draft</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top: 1em; ">
						<div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
						<div class="col-xs-12 btn-group-vertical" style="">
							<button type="submit" class="btn btn-default btn-block text-left" data-dismiss="modal"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
				<!-- END Modal Body -->
			</div>
		</div>
	</div>
</div>