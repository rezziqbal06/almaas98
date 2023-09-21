<style>
	ul {
		list-style-type: disc !important;
	}

	.detail_produk {
		margin-top: 0px;
	}

	@media screen and (max-width: 765px) {
		.detail_produk {
			margin-top: -5em;
		}
	}
</style>
<!-- List Produk Popular -->

<div class="row" style="padding:2em 2em;">

	<div class="kartu-detail mb-2">
		<div class="row">
			<div class="col-12">
				<small>Booking Rumah Type <?= $produk->tipe ?? '' ?></small>
			</div>
		</div>
	</div>
	<div class="kartu-detail mb-2">
		<div class="row">
			<div class="col-4">
				<a href="<?= base_url($produk->gambar) ?>" target="_blank" class=""><img id="" class="img-fluid rounded w-100" src="<?= base_url($produk->gambar) ?>" data-zoom-image="<?= base_url($produk->gambar) ?>" alt="<?= $produk->nama ?>" style=""></a>
			</div>
			<div class="col-8">
				<small class="text-grey"><i class="fa fa-map-marker mb-2 me-1"></i> <?= $akm->nama ?? '' ?></small>
				<div class="d-flex justify-content-start flex-wrap text-grey">
					<div class="me-3"><i class="fa fa-bolt me-1"></i> <small><?= $produk->listrik ?? 1300 ?> watt</small></div>
					<div class="me-3"><i class="fa fa-bath me-1" style="vertical-align: baseline;"></i> <small><?= $produk->toilet ?? 1 ?></small></div>
					<div class="me-3"><i class="fa fa-bed me-1"></i> <small><?= $produk->kamar_tidur ?? 1 ?></small></div>
				</div>
				<hr>
				<h3 class="me-3 m-0 d-none"><b class="text-primary"><?= $produk->angsuran ?? 0 ?></b>/bulan</h3>
				<span class="text-grey" style="margin-top: -4px;">Rp. <?= $produk->harga ?? 0 ?> </span>
			</div>
		</div>
	</div>

	<div class="kartu-detail mb-2">
		<form id="fbooking" action="" method="post">
			<div class="row">
				<input type="hidden" name="b_user_id" value="<?= $sess->user->id ?>">
				<input type="hidden" name="tgl_pesan" value="<?= date("Y-m-d H:i:s") ?>">
				<input type="hidden" name="total_harga" value="1.000.000">
				<input type="hidden" name="harga[]" value="1.000.000">
				<input type="hidden" name="status[]" value="booking">
				<div class="col-2 text-grey"><small>Nama</small></div>
				<div class="col-10"><small><?= $sess->user->fnama ?? '-' ?></small></div>
				<div class="col-2 text-grey"><small>Telp</small></div>
				<div class="col-10"><small><?= $sess->user->telp ?? '-' ?></small></div>
				<div class="col-2 text-grey mb-1"><small>NIK</small></div>
				<div class="col-10 mb-1"><small><?= $sess->user->nik ?? '-' ?></small></div>
				<div class="col-12 text-grey vertical-top"><small>Blok Tersedia</small></div>
				<div class="col-12">
					<select name="b_produk_id[]" id="ib_produk_item_id" class="form-control select2">
						<?php if (isset($bpim) && count($bpim)) : ?>
							<?php foreach ($bpim as $k => $v) : ?>
								<option value="<?= $v->id ?>">Blok <?= $v->blok ?> <?= $v->nomor ?> - <?= $v->posisi ?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
				<div class="col-12 text-grey vertical-top mb-1"><small>Transfer Melalui</small></div>
				<div class="col-12">
					<?php if (isset($arm) && count($arm)) : ?>
						<?php foreach ($arm as $k => $v) : ?>
							<div class="form-check mb-2">
								<input class="form-check-input" type="radio" name="a_rekening_id" id="a_rekening_id<?= $k ?>" <?= $k == 0 ? 'checked' : '' ?>>
								<label class="form-check-label" for="a_rekening_id<?= $k ?>">
									<img width="70px" src="<?= base_url("media/bank/") ?><?= $v->icon ?>.png" alt="">
								</label>
							</div>
						<?php endforeach ?>
					<?php endif ?>

				</div>
			</div>
		</form>
	</div>
</div>
<section>
	<div class="row mb-3" style="padding: 0 2em;">
		<div class="col-md-6 mb-3 d-grid">
			<a href="#" id="booking" data-id="<?= $produk->id ?>" class="btn  <?= isset($is_sold) && $is_sold ? 'btn-secondary disabled' : 'btn-accent' ?>"><b><?= isset($is_sold) && $is_sold ? 'TELAH TERJUAL' : 'BOOKING' ?></b></a>
		</div>
		<div class="col-md-6 mb-3 mb-md-0 d-grid">
			<button id="siteplan" data-id="<?= $produk->a_kategori_id ?>" class="btn	 bg-secondary"><b>LIHAT KETERSEDIAAN (SITEPLAN)</b></button>
		</div>

	</div>
</section>