<div class="row bg-primary p-3 mt-n2" style="margin-top: -16px;">
	<div class="col-12 mb-3">
		<input id="cari_quiz" type="text" class="form-control bg-white p-3" placeholder="Cari Rumah" style="border:none; border-radius:16px; color:white;">
	</div>
	<div class="col-12">
		<?php $text = ["Termurah", "Terluas", "36", "2 lantai",  "70", "2 kamar"] ?>
		<?php $icon = ["money", "arrows-alt", "expand", "building", "expand", "bed"] ?>
		<div class="d-flex flex-wrap" style="justify-content: start;">
			<?php foreach ($text as $k => $t) : ?>
				<div class="pe-3 ps-3 pt-1 pb-1 m-1 " style="border-radius: 32px;background-color:#D9D9D940;color:white;"><a href="<?= base_url("explore/") ?>?f=<?= $t ?>"><i class="fa fa-<?= $icon[$k] ?> me-1"></i> <span><?= $t ?></span></a></div>
			<?php endforeach ?>
		</div>
	</div>
</div>
<!-- List Kustomer -->
<section class="row p-3 p-md-5">
	<h6>Popular</h6>
	<div id="panel_produk" class="horizontal-list">
		<?php if (isset($bpm_popular) && count($bpm_popular)) : ?>
			<?php foreach ($bpm_popular as $produk) : ?>
				<div class="p-2 me-3 kartu-produk" data-kategori-id="<?= $produk->a_kategori_id ?>">
					<a href="<?= base_url("produk/") ?><?= $produk->slug ?>" class="" data-id="<?= $produk->id ?>" data-kategori-id="<?= $produk->a_kategori_id ?>" alt="<?= $produk->nama ?>">
						<div class="kartu-gambar-produk">
							<img src="<?= base_url("") ?><?= $produk->gambar ?? '' ?>" alt="<?= $produk->nama ?? '' ?>" aria-describedby="<?= $produk->nama ?? '' ?>" class="img-fluid">
						</div>
						<p class="fs-5 mt-2 mb-1"><b>Type <?= $produk->luas_tanah ?? '150' ?>/<?= $produk->luas_bangunan ?? '70' ?></b></p>
						<small class="text-grey"><i class="fa fa-map-marker mb-2"></i> <?= $produk->kawasan ?? '' ?></small>
						<div class="d-flex justify-content-start flex-wrap">
							<div class="me-3"><b class="text-primary"><?= $produk->harga ?></b>/bulan</div>
							<div class="me-3"><i class="fa fa-bath" style="vertical-align: baseline;"></i> <small><?= $produk->toilet ?? 1 ?></small></div>
							<div class="me-3"><i class="fa fa-bed"></i> <small><?= $produk->kamar_tidur ?? 1 ?></small></div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		<?php endif ?>
	</div>
</section>


<div id="banner" class="">
	<?php if (isset($abm) && count($abm)) : ?>
		<?php foreach ($abm as $k => $v) : ?>
			<a href="<?= base_url('banner/') . $v->slug ?>">
				<img src="<?= base_url("$v->gambar") ?>" class="d-block w-100" alt="<?= $v->nama ?>">
			</a>
		<?php endforeach ?>
	<?php endif ?>
</div>
<div class="carousel-indicators">
	<ul></ul>
</div>