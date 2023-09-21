<style>
	.size-profile {
		width: 200px;
		height: 200px;
	}

	.select2-container {
		z-index: 100000;
	}

	.circle {
		border-radius: 200px;
		color: white;
		font-weight: bold;
		display: table;
		width: 100px;
		height: 100px;
		text-align: center;
	}

	.circle p {
		vertical-align: middle;
		display: table-cell;
		font-size: 3em;
		font-family: none;
	}

	@media only screen and (max-width:600px) {
		.size-profile {
			width: 100px;
			height: 100px;
		}

		.profile-root {
			margin: 0px !important;
		}


	}
</style>
<div class="mx-2 profile-root ">
	<div class="p-3">
		<img src="<?= base_url() . "/media/background-profile.jpg" ?>" class="rounded img-fluid" width="100%" alt="Profil <?= $this->config->semevar->site_name ?>">
	</div>
	<?php //dd($ue); 
	?>
	<div class="bg-white row rounded p-3 mt-3 mb-3 me-3 ms-3">
		<div class="col-12">
			<h3 class="text-secondary m-0"><?= $ue->fnama ?? '' ?></h3>
			<p class="m-0 text-grey"><small><?= $ue->nik ?? '' ?> </small></p>
			<p class="m-0 text-grey"><small><?= $ue->telp ?? '' ?></small></p>
		</div>
		<div class="col-12 bg-background rounded-2 p-2 d-flex justify-content-around mt-2">
			<div>
				<small class="text-grey">Booking</small>
				<h4><?= $count_booking ?? 0 ?></h4>
			</div>
			<div>
				<small class="text-grey">Berjalan</small>
				<h4><?= $count_progress ?? 0 ?></h4>
			</div>
			<div>
				<small class="text-grey">Lunas</small>
				<h4><?= $count_order_done ?? 0 ?></h4>
			</div>
		</div>
		<p class="mt-2 text-grey text-end"><small><?= $ue->email ?? '' ?></small></p>
		<div class=" d-flex justify-content-end gap-4">
			<div id="btn-edit-profile"><span class="fa fa-pencil"></span></div>
			<div id="btn-logout"><span class="fa fa-door-open"></span></div>
		</div>
	</div>
	<?php if (isset($com[0])) : ?>
		<div class="bg-white rounded p-3 me-3 ms-3 mt-0 mb-5">
			<h4>Histori Transaksi</h4>
			<hr style="background-color:grey">
			<br>
			<?php foreach ($com as $k => $v) : ?>
				<a href="#" class="history_transaksi" data-status="<?= $v->status_transaksi ?>" data-kode="<?= $v->kode ?? '' ?>">
					<div class="row mb-2">
						<div class="col-2 col-mb-1 mb-3">
							<img src="<?= base_url($v->gambar_produk) ?>" alt="" class="img-fluid rounded">
						</div>
						<div class="col-10 col-mb-11 mb-3">
							<small class="text-grey"><?= $v->kode ?? '' ?></small>
							<p class="m-0">Blok <?= $v->blok ?? '' ?> <?= $v->nomor ?? '' ?> - <?= $v->posisi ?? '' ?> Type <?= $v->tipe ?? '' ?></p>
							<small><?= $v->status ?></small>
							<p class=" fs-6 mb-1 <?= $v->st_color ?>"><?= $v->status_transaksi ?></p>
						</div>
						<hr style="background-color:grey">
					</div>
				</a>
			<?php endforeach ?>
		</div>
	<?php endif ?>