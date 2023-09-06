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
	<div class="bg-white row rounded p-3 m-3 mb-5">
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
				<h4><?= $count_berjalan ?? 0 ?></h4>
			</div>
			<div>
				<small class="text-grey">Lunas</small>
				<h4><?= $count_lunas ?? 0 ?></h4>
			</div>
		</div>
		<p class="mt-2 text-grey text-end"><small><?= $ue->email ?? '' ?></small></p>
		<div class=" d-flex justify-content-end gap-4">
			<div id="btn-edit-profile"><span class="fa fa-pencil"></span></div>
			<div id="btn-logout"><span class="fa fa-door-open"></span></div>
		</div>
	</div>