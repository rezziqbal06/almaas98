<style>
	.pe-1 {
		padding-left: 1rem !important;
	}

	.is_owner {
		color: var(--primary) !important;
	}

	option:disabled {
		background-color: #e2e2e2 !important;
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
					<div class="row">
						<div class="col-md-4 mb-2">
							<label for="ieb_user_id_cari" class="control-label">Cari Pembeli</label>
							<select id="ieb_user_id_cari" class="form-control select2"></select>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ieb_user_nama" class="control-label">Pembeli</label>
							<input id="ieb_user_nama" type="text" name="b_user_nama" class="form-control" required readonly>
							<input type="hidden" id="ieb_user_id" name="b_user_id">
						</div>
						<div class="col-md-4 mb-2">
							<label for="ietgl_pesan" class="control-label">Tanggal Pesan</label>
							<input id="ietgl_pesan" type="text" name="tgl_pesan" class="form-control datepicker" value="<?= date('Y-m-d') ?>" required />
						</div>
						<div class="col-md-3 mb-2 d-none">
							<label for="ietgl_selesai" class="control-label">Tanggal Selesai</label>
							<input id="ietgl_selesai" type="text" name="tgl_selesai" class="form-control datepicker" value="" />
						</div>
					</div>
				</div>

				<hr>
				<div class="form-group">
					<h5>Produk</h5>
					<div class="row mb-3">
						<div class="col-12 d-none">
							<button id="btn_add_produk" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Produk</button>
						</div>
					</div>
					<div>
						<div id="panel_qty" class="rounded border border-warning p-3">
							<div id="panel_produk">
							</div>
						</div>
					</div>
					<div class="row pt-2">
						<div class="col-md-6 mb-2">
							<label for="imetode" class="control-label">Metode Pembayaran</label>
							<select id="imetode" type="text" name="metode" class="form-control " required>
								<option value="">-- pilih metode --</option>
								<option value="Cash Keras">Cash Keras</option>
								<option value="Cash Bertahap">Cash Bertahap</option>
							</select>
						</div>
						<div class="col-md-6 mb-2">
							<label for="imetode_pembayaran" class="control-label">Metode Pembayaran</label>
							<select id="imetode_pembayaran" type="text" name="metode_pembayaran" class="form-control " required>
								<option value="">-- pilih metode pembayaran --</option>
								<option value="cash">Cash</option>
								<option value="transfer">Transfer</option>
							</select>
						</div>
						<div class="col-md-6 mb-2">
							<input id="idiskon" type="hidden" name="diskon" class="form-control " readonly />
						</div>
					</div>
					<div class="row pt-2">
						<div class="col-12">
							<div class=" panel_history" style="display: none;"></div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="iharga_0" data-count="0">Nominal</label>
							<input type="text" name="harga[]" id="iharga_0" data-count="0" class="form-control">
						</div>
						<div id="panel_a_rekening_id" class="col-md-6 mb-2" style="display: none;">
							<label for="ia_rekening_id" class="control-label">Rekening Tujuan</label>
							<select id="ia_rekening_id" type="text" name="a_rekening_id" class="form-control">
								<option value="">-- pilih rekening tujuan --</option>
								<?php if (isset($arm[0]->id)) : ?>
									<?php foreach ($arm as $k => $v) : ?>
										<option value="<?= $v->id ?>"><img src="<?= base_url("media/bank/$v->icon.png") ?>" width="50px" alt=""><?= strtoupper($v->icon) ?> - <?= $v->nomor ?> a.n <?= $v->nama ?></option>
									<?php endforeach ?>
								<?php endif ?>
							</select>
						</div>
						<div class="col-md-6 mb-2">
							<label for="igambar" class="control-label">Bukti Pembayaran/Transfer</label>
							<input id="igambar" type="file" name="gambar" accept=".png, .jpg, .jpeg" class="form-control">
						</div>
						<div class="col-md-2 mb-2">
							<img id="img-igambar" src="" alt="" class="img-fluid rounded">
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 mb-3">
							<label for="icatatan" data-count="0">Catatan</label>
							<textarea type="text" name="catatan" id="icatatan" data-count="0" class="form-control"><?= $com->catatan ?? '' ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row d-none">
						<div class="col-md-8">&nbsp;</div>
						<div class="col-md-4">
							<label for="itotal_harga">Total</label>
							<input type="text" id="ietotal_harga" class="form-control text-end text-bold" name="total_harga" readonly required>
						</div>
					</div>
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