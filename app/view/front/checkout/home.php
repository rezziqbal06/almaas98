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
	<!-- <div class="kartu-detail mb-2">
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
	</div> -->

	<div class="kartu-detail mb-2">
		<form id="fbooking" action="" method="post">
			<div class="row">
				<input type="hidden" name="b_user_id" value="<?= $sess->user->id ?>">
				<input type="hidden" name="tgl_pesan" value="<?= date("Y-m-d H:i:s") ?>">
				<input type="hidden" name="total_harga" value="1.000.000">
				<input type="hidden" name="harga[]" value="1.000.000">
				<input type="hidden" name="status[]" value="booking">
				<div class="col-4 text-grey"><small>Kode</small></div>
				<div class="col-8"><small><?= $com->kode ?? '-' ?></small></div>
				<div class="col-4 text-grey"><small>Rumah</small></div>
				<div class="col-8"><small>Blok <?= $bpim->blok ?? '' ?> <?= $bpim->nomor ?? '' ?> - <?= $bpim->posisi ?? '' ?></small></div>
				<div class="col-4 text-grey"><small>Atas Nama</small></div>
				<div class="col-8"><small><?= $com->b_user_nama ?? '-' ?></small></div>
				<div class="col-4 text-grey"><small>Biaya</small></div>
				<div class="col-8"><small class="text-end"><b>Rp. 1.000.000</b></small></div>
				<div class="col-4 text-grey"><small>Status</small></div>
				<div class="col-8"><small class="text-primary"><?= $status ?? '-' ?></small></div>

				<hr class="mt-2">
				<?php if ($status == 'Menunggu pembayaran') : ?>
					<div class="col-12 mt-3 text-center mb-1"><small>Silakan Transfer Melalui</small></div>
				<?php endif ?>
				<div class="col-12 text-center">
					<img width="70px" src="<?= base_url("media/bank/") ?><?= $arm->icon ?>.png" alt="">
					<p><?= $arm->nomor ?? '' ?> a.n <?= $arm->nama ?? '' ?></p>
				</div>
			</div>
		</form>
	</div>
	<div class="kartu-detail">
		<form action="" method="post" id="fbukti">
			<div class="col-12">
				<p>Upload Bukti Pembayaran</p>
			</div>
			<input type="hidden" name="id" value="<?= $com->id ?>">
			<div class="col-md-4 mb-3">
				<input type="file" accept=".png, .jpg, .jpeg" id="ibukti" class="form-control" required>
			</div>
			<div class="col-md-4 mb-3">
				<img src="" id="img-ibukti" class="img-fluid rounded" alt="">
			</div>
			<div class="col-md-4 mb-3 d-grid">
				<a href="#" id="upload_bukti" data-id="<?= $produk->id ?>" class="btn btn-secondary"><b>Upload</b></a>
			</div>
		</form>
	</div>
</div>
<section>

</section>