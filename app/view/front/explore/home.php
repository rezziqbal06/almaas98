<style>
	.pill {
		border-radius: 32px;
		background-color: #D9D9D940;
		color: var(--dark-accent);
	}

	.pill.active {
		border-radius: 32px;
		background-color: var(--primary);
		color: white !important;
	}
</style>
<div class="row p-3 mt-2" style="margin-top: -16px;">
	<div class="col-10 col-md-11 mb-3">
		<input id="cari_quiz" type="text" class="form-control bg-white p-3" placeholder="Cari Rumah" style="border:none; border-radius:16px;">
	</div>
	<div class="col-2 col-md-1 mb-3">
		<div class="p-2 text-center" id="bfilter" style="cursor: pointer"><img src="<?= base_url("media/sliders.svg") ?>" alt=""></div>
	</div>
	<div class="col-12 mt-3">
		<?php $text = ["reset", "Termurah", "Terluas", "36", "2 lantai",  "70", "2 kamar"]; ?>
		<?php $key = ["reset", "sort_harga", "sort_luas_bangunan", "tipe", "lantai", "tipe", "kamar_tidur"]; ?>
		<?php $value = ["", "asc", "desc", "36", "2", "70", "2"]; ?>
		<?php $icon = ["times", "money", "arrows-alt", "expand", "building", "expand", "bed"]; ?>
		<div class="d-flex flex-wrap" style="justify-content: start;">
			<?php foreach ($text as $k => $t) : ?>
				<div class="pe-3 ps-3 pt-1 pb-1 m-1 pill" data-key="<?= $key[$k] ?>" data-value="<?= $value[$k] ?>" data-text="<?= $t ?>"><a href="#"><i class="fa fa-<?= $icon[$k] ?> me-1 filter-common"></i> <span><?= $t ?></span></a></div>
			<?php endforeach ?>
		</div>
	</div>
</div>

<!-- List Produk -->
<section class="row p-3 p-md-5">
	<div id="panel_produk" class="row">

	</div>
</section>