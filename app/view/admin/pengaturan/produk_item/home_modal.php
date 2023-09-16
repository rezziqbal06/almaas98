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
									<label for="ib_produk_id" class="control-label">Tipe Rumah</label>
									<select id="ib_produk_id" type="text" name="b_produk_id" class="form-control " required>
										<?php if (isset($bpm[0]->id)) : ?>
											<?php foreach ($bpm as $k => $v) : ?>
												<option value="<?= $v->id ?>">Tipe <?= $v->luas_tanah ?>/<?= $v->luas_bangunan ?> - Rp. <?= number_format($v->harga, 0, ',', '.') ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="col-md-6 mb-2">
									<label for="iblok" class="control-label">Blok</label>
									<select id="iblok" name="blok" type="text" class="form-control select2">
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
										<option value="J">J</option>
										<option value="K">K</option>
										<option value="L">L</option>
										<option value="M">M</option>
										<option value="N">N</option>
										<option value="O">O</option>
										<option value="P">P</option>
										<option value="Q">Q</option>
										<option value="R">R</option>
										<option value="S">S</option>
										<option value="T">T</option>
										<option value="U">U</option>
										<option value="V">V</option>
										<option value="W">W</option>
										<option value="X">X</option>
										<option value="Y">Y</option>
										<option value="Z">Z</option>
									</select>
								</div>
								<div class="col-md-6 mb-2">
									<label for="inomor" class="control-label">Nomor</label>
									<input id="inomor" name="nomor" type="text" class="form-control" placeholder="ex: 48">
								</div>
								<div class="col-md-6 mb-2">
									<label for="iposisi" class="control-label">Posisi</label>
									<select id="iposisi" name="posisi" type="text" class="form-control select2">
										<option value="sayap">sayap</option>
										<option value="utama">utama</option>
										<option value="hook">hook</option>
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
									<label for="ieb_produk_id" class="control-label">Tipe Rumah</label>
									<select id="ieb_produk_id" type="text" name="b_produk_id" class="form-control " required>
										<?php if (isset($bpm[0]->id)) : ?>
											<?php foreach ($bpm as $k => $v) : ?>
												<option value="<?= $v->id ?>">Tipe <?= $v->luas_tanah ?>/<?= $v->luas_bangunan ?> - Rp. <?= number_format($v->harga, 0, ',', '.') ?></option>
											<?php endforeach ?>
										<?php endif ?>
									</select>
								</div>
								<div class="col-md-6 mb-2">
									<label for="ieblok" class="control-label">Blok</label>
									<select id="ieblok" type="text" name="blok" class="form-control select2">
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
										<option value="J">J</option>
										<option value="K">K</option>
										<option value="L">L</option>
										<option value="M">M</option>
										<option value="N">N</option>
										<option value="O">O</option>
										<option value="P">P</option>
										<option value="Q">Q</option>
										<option value="R">R</option>
										<option value="S">S</option>
										<option value="T">T</option>
										<option value="U">U</option>
										<option value="V">V</option>
										<option value="W">W</option>
										<option value="X">X</option>
										<option value="Y">Y</option>
										<option value="Z">Z</option>
									</select>
								</div>
								<div class="col-md-6 mb-2">
									<label for="ienomor" class="control-label">Nomor</label>
									<input id="ienomor" type="text" name="nomor" class="form-control" placeholder="ex: 48">
								</div>
								<div class="col-md-6 mb-2">
									<label for="ieposisi" class="control-label">Posisi</label>
									<select id="ieposisi" type="text" name="posisi" class="form-control select2">
										<option value="sayap">sayap</option>
										<option value="utama">utama</option>
										<option value="hook">hook</option>
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