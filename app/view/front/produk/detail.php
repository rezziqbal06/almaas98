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
<a href="<?= base_url($produk->gambar) ?>" target="_blank" class="d-md-none"><img id="" class="display-gambar w-100" src="<?= base_url($produk->gambar) ?>" data-zoom-image="<?= base_url($produk->gambar) ?>" alt="<?= $produk->nama ?>" style="border-radius:0 0 32px 32px;"></a>

<div class="row detail_produk" style="padding:0 2em;">

	<div class="kartu-detail ">
		<div class="row">
			<div class="col-md-4">
				<a href="<?= base_url($produk->gambar) ?>" target="_blank" class="d-none d-md-block"><img id="" class="display-gambar w-100" src="<?= base_url($produk->gambar) ?>" data-zoom-image="<?= base_url($produk->gambar) ?>" alt="<?= $produk->nama ?>" style="border-radius:0 0 32px 32px;"></a>
			</div>
			<div class="col-md-8">
				<p class="fs-5 mt-2 mb-1"><b>Type <?= $produk->luas_tanah ?? '150' ?>/<?= $produk->luas_bangunan ?? '70' ?></b></p>
				<small class="text-grey"><i class="fa fa-map-marker mb-2 me-1"></i> <?= $produk->kawasan ?? '' ?></small>
				<div class="d-flex justify-content-start flex-wrap text-grey">
					<div class="me-3"><i class="fa fa-bolt me-1"></i> <small><?= $produk->listrik ?? 1300 ?> watt</small></div>
					<div class="me-3"><i class="fa fa-bath me-1" style="vertical-align: baseline;"></i> <small><?= $produk->toilet ?? 1 ?></small></div>
					<div class="me-3"><i class="fa fa-bed me-1"></i> <small><?= $produk->kamar_tidur ?? 1 ?></small></div>
				</div>
				<div class="mt-4"><?= $produk->deskripsi ?? '' ?></div>
				<hr>
				<h3 class="me-3 m-0"><b class="text-primary"><?= $produk->angsuran ?? 0 ?></b>/bulan</h3>
				<span class="text-grey" style="margin-top: -4px;">Rp. <?= $produk->harga ?? 0 ?> </span>
				<a href="#" class="float-end mt-3" id="simulasi">Lihat simulasi</a>
			</div>
		</div>
	</div>
</div>
<section class="mt-3">
	<div class="row mb-3" style="padding: 0 2em;">
		<div class="col-md-6 horizontal-list">
			<?php if (isset($bpgm)) : ?>
				<?php $i = 0; ?>
				<?php foreach ($bpgm as $k => $v) : ?>
					<a href="#" class="image-selected p-2" data-count="<?= $k ?>" class="p-2"><img id="gambar-item-<?= $k ?>" src="<?= base_url() . $v->gambar ?>" alt="Gambar <?= $produk->nama ?> <?= ($i + 1) ?>" height="100px" class="gambar-item rounded <?= $v->gambar == $produk->gambar ? 'selected' : '' ?>"></a>
					<?php $i++ ?>
				<?php endforeach ?>
			<?php endif ?>
		</div>
		<div class="col-md-6">
			<?php if (isset($produk->three_d) && strlen($produk->three_d)) : ?>
				<div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingThree">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								3D Model
							</button>
						</h2>
						<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<?= $produk->three_d ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	</div>
	<div class="row mb-3" style="padding: 0 2em;">
		<div class="col-md-6 mb-3 mb-md-0 d-grid">
			<button id="siteplan" data-id="<?= $produk->a_kategori_id ?>" class="btn btn-info bg-info"><b>LIHAT KETERSEDIAAN (SITEPLAN)</b></button>
		</div>
		<div class="col-md-6 d-grid">
			<button id="booking" data-id="<?= $produk->id ?>" class="btn  <?= isset($is_sold) && $is_sold ? 'btn-secondary disabled' : 'btn-accent' ?>"><b><?= isset($is_sold) && $is_sold ? 'TELAH TERJUAL' : 'BOOKING SEKARANG' ?></b></button>
		</div>
	</div>
</section>
<!-- 
<section>
	<div id="" class="row p-5">
		<h3>Produk Terkait</h3>
		<?php if (isset($bpm_related) && count($bpm_related)) : ?>
			<?php foreach ($bpm_related as $pr) : ?>
				<div class="col-6 col-md-3 p-3 kartu-produk" data-kategori-id="<?= $pr->a_kategori_id ?>">
					<a href="<?= base_url("produk/") ?><?= $pr->slug ?>" class="" data-id="<?= $pr->id ?>" data-kategori-id="<?= $pr->a_kategori_id ?>" alt="<?= $pr->nama ?>">
						<div class="kartu-gambar-produk">
							<img src="<?= base_url("") ?><?= $pr->gambar ?? '' ?>" alt="<?= $pr->nama ?? '' ?>" aria-describedby="<?= $pr->nama ?? '' ?>" class="img-fluid">
						</div>
						<p class="text-center mt-3"><b><?= $pr->nama ?></b></p>
					</a>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</section> -->