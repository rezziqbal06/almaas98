<style>
	.pe-1 {
		padding-left: 1rem !important;
	}
</style>
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
				<div class="form-group">
					<input type="hidden" name="id" id="ieid">

					<div class="row">
						<div class="col-md-12 mb-2">
							<label for="ieb_produk_id" class="control-label">Tipe Rumah</label>
							<select id="ieb_produk_id" type="text" name="b_produk_id" class="form-control select2" required>
								<?php if (isset($bpm[0]->id)) : ?>
									<?php foreach ($bpm as $k => $v) : ?>
										<option value="<?= $v->id ?>">Tipe <?= $v->luas_tanah ?>/<?= $v->luas_bangunan ?> - Rp. <?= number_format($v->harga, 0, ',', '.') ?> - <?= $v->kawasan ?></option>
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

				<!-- <hr>
				<div class="form-group">
					<h5>Spesifikasi</h5>
					<div class="row mb-3">
						<div class="col-12">
							<button id="btn_add_spec" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Spesifikasi</button>
						</div>
					</div>
					<div>
						<div id="panel_qty" class="rounded border border-warning p-3">
							<div id="panel_spesifikasi">


							</div>
							<div id="ps_qty" class="row">
								<div class="col-md-4">
									<div class="input-group mb-3">
										<input type="text" id="ispec_qty" name="spec[]" class="form-control" placeholder="Ex: Warna" value="QTY" readonly>
										<input type="hidden" id="icount_spec_qty" name="count_spec[]" value="qty" class="form-control" placeholder="Ex: Warna" value="qty" readonly>
										<button class="btn btn-danger btn-remove-spec d-none" type="button" data-count="qty"><i class="fa fa-minus"></i></button>
										<button class="btn btn-primary btn-add-spec-qty-detail" type="button" data-count="qty"><i class="fa fa-plus"></i></button>
									</div>
								</div>
								<div class="col-md-8">
									<div id="psd_qty">
										<div id="sd_qty_0" class="input-group mb-3">
											<input type="number" id="ispec_detail_from_qty_0" name="spec_detail_from_qty[]" class="form-control input-spec" data-count="qty" data-count-detail="0" readonly placeholder="">
											<select name="spec_detail_operator_qty[]" class="bg-dark text-white form-select input-group-text input-spec" id="ispec_detail_operator_qty_0" data-count="qty" data-count-detail="0">
												<option value="<">
													< </option>
												<option value="-"> - </option>
												<option value=">"> > </option>
											</select>
											<input type="number" id="ispec_detail_to_qty_0" name="spec_detail_to_qty[]" class="form-control pe-1 input-spec" data-count="qty" data-count-detail="0" placeholder="">
											<button class="btn btn-danger btn-remove-spec-detail" type="button" data-count="qty" data-count-detail="0"><i class="fa fa-minus"></i></button>
											<div class="input-group-text bg-light">
												<input type="checkbox" id="icheck_spec_detail_qty_0" data-count="qty" data-count-detail="0" value="" class="check-spec-filter">
											</div>
										</div>
									</div>
								</div>
								<hr>
							</div>
						</div>

					</div>
					<div class="row mb-3 mt-3">
						<div class="col-12">
							<button id="btn_price_setting" class="btn btn-warning pull-right"><i class="fa fa-calculator"></i> Setting Harga</button>
						</div>
					</div>

					<div class="row mb-3">
						<div id="panel_spec"></div>
						<div id="panel_price" class="col-md-12" style="overflow-x: scroll;"></div>
					</div>
				</div> -->

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