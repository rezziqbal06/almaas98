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
						<div class="col-md-4 mb-2">
							<label for="ienama" class="control-label">Nama</label>
							<input id="ienama" type="text" name="nama" class="form-control" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ieslug" class="control-label">Slug</label>
							<input id="ieslug" type="text" name="slug" class="form-control" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="iea_kategori_id" class="control-label">Kawasan</label>
							<select id="iea_kategori_id" type="text" name="a_kategori_id" class="form-control select2" required>
								<?php if (isset($akm[0]->id)) : ?>
									<?php foreach ($akm as $k => $v) : ?>
										<option value="<?= $v->id ?>"><?= $v->nama ?></option>
									<?php endforeach ?>
								<?php endif ?>
							</select>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ietipe" class="control-label">Tipe Rumah</label>
							<select id="ietipe" type="text" name="tipe" class="form-control select2" required>
								<option value="60/60">60/60</option>
								<option value="60/62">60/62</option>
								<option value="72/64">72/64</option>
								<option value="90/70">90/70</option>
								<option value="90/72">90/72</option>
								<option value="90/77">90/77</option>
								<option value="100/80">100/80</option>
								<option value="100/84">100/84</option>
								<option value="100/86">100/86</option>
								<option value="100/88">100/88</option>
								<option value="110/190">110/190</option>
								<option value="120/100">120/100</option>
								<option value="120/109">120/109</option>
							</select>
						</div>
						<!-- <div class="col-md-4 mb-2">
							<label for="ieblok" class="control-label">Blok</label>
							<input id="ieblok" type="text" name="blok" class="form-control" placeholder="ex: A" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ienomor" class="control-label">Nomor</label>
							<input id="ienomor" type="text" name="nomor" class="form-control" required>
						</div> -->
						<div class="col-md-4 mb-2">
							<label for="ieluas_tanah" class="control-label">Luas Tanah (m<sup>2</sup>)</label>
							<input id="ieluas_tanah" type="text" name="luas_tanah" class="form-control" placeholder="ex: 5.6" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ieluas_bangunan" class="control-label">Luas Bangunan (m<sup>2</sup>)</label>
							<input id="ieluas_bangunan" type="text" name="luas_bangunan" class="form-control" placeholder="ex: 5.6" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ielantai" class="control-label">Lantai</label>
							<input id="ielantai" type="number" name="lantai" class="form-control" value="1" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="iekamar_tidur" class="control-label">Kamar</label>
							<input id="iekamar_tidur" type="number" name="kamar_tidur" class="form-control" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ietoilet" class="control-label">Toilet</label>
							<input id="ietoilet" type="number" name="toilet" class="form-control" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="iegarasi" class="control-label">Garasi</label>
							<input id="iegarasi" type="number" name="garasi" class="form-control">
						</div>
						<div class="col-md-4 mb-2">
							<label for="iea_three_d_id" class="control-label">3D Model House</label>
							<select id="iea_three_d_id" type="text" name="a_three_d_id" class="form-control select2">
								<?php if (isset($atdm[0]->id)) : ?>
									<?php foreach ($atdm as $k => $v) : ?>
										<option value="<?= $v->id ?>"><?= $v->deskripsi ?></option>
									<?php endforeach ?>
								<?php endif ?>
							</select>
						</div>
						<div class="col-md-4 mb-2">
							<label for="iestock_unit" class="control-label">Stock unit</label>
							<input id="iestock_unit" type="number" name="stock_unit" class="form-control" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 mb-2">
							<label for="ieharga" class="control-label">Harga</label>
							<input id="ieharga" type="text" name="harga" class="form-control currency" required>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ielistrik" class="control-label">Listrik</label>
							<select id="ielistrik" type="text" name="listrik" class="form-control select2" required>
								<option value="900">900</option>
								<option value="1300" selected>1300</option>
								<option value="2500">2500</option>
								<option value="3300">3300</option>
							</select>
						</div>
						<div class="col-md-4 mb-2">
							<label for="ieair" class="control-label">Air</label>
							<input id="ieair" type="text" name="air" class="form-control" value="Sibel">
						</div>
						<!-- <div class="col-md-4 mb-2">
							<label for="iestatus" class="control-label">Status Rumah/Kavling</label>
							<select id="iestatus" type="text" name="status" class="form-control select2" required>
								<option value="tersedia">tersedia</option>
								<option value="booking">booking</option>
								<option value="terjual">terjual</option>
							</select>
						</div> -->
					</div>
					<div class="row">
						<div class="col-md-3 mb-2">
							<label for="iegambar1" class="control-label">Gambar 1</label>
							<div class="input-group">

								<input id="iegambar1" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
								<div class="input-group-text">
									<input type="radio" name="is_cover" value="1">
								</div>
							</div>
							<img id="img-iegambar1" src="" alt="" class="img-fluid rounded mt-2">
						</div>
						<div class="col-md-3 mb-2">
							<label for="iegambar2" class="control-label">Gambar 2</label>
							<div class="input-group">
								<input id="iegambar2" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
								<div class="input-group-text">
									<input type="radio" name="is_cover" value="2">
								</div>
							</div>
							<img id="img-iegambar2" src="" alt="" class="img-fluid rounded mt-2">
						</div>
						<div class="col-md-3 mb-2">
							<label for="iegambar3" class="control-label">Gambar 3</label>
							<div class="input-group">
								<input id="iegambar3" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
								<div class="input-group-text">
									<input type="radio" name="is_cover" value="3">
								</div>
							</div>
							<img id="img-iegambar3" src="" alt="" class="img-fluid rounded mt-2">
						</div>
						<div class="col-md-3 mb-2">
							<label for="iegambar4" class="control-label">Gambar 4</label>
							<div class="input-group">
								<input id="iegambar4" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
								<div class="input-group-text">
									<input type="radio" name="is_cover" value="4">
								</div>
							</div>
							<img id="img-iegambar4" src="" alt="" class="img-fluid rounded mt-2">
						</div>
						<div class="col-md-3 mb-2">
							<label for="iegambar5" class="control-label">Gambar 5</label>
							<div class="input-group">
								<input id="iegambar5" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
								<div class="input-group-text">
									<input type="radio" name="is_cover" value="5">
								</div>
							</div>
							<img id="img-iegambar5" src="" alt="" class="img-fluid rounded mt-2">
						</div>
						<div class="col-md-12 mb-2">
							<label for="iedeskripsi" class="control-label">Deskripsi</label>
							<textarea name="deskripsi" id="iedeskripsi" class="form-control" cols="30" rows="10"></textarea>
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