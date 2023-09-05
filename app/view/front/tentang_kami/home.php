<style>
	.header-bg {
		background-image: url('media/header_bg.png');
		background-repeat: no-repeat;
		background-size: cover;
	}

	.map {
		width: 1080px;
		height: 450px;
	}

	@media only screen and (max-width:750px) {
		.map {
			width: 300px;
			height: 450px;
		}
	}
</style>
<section>
	<div class="mt-7">
		<div class="header-bg p-5 text-center">
			<h2><b>Tentang Kami</b></h2>
		</div>
	</div>
	<h2 class="mt-5 text-center"><?= $this->config->semevar->site_motto ?></h2>
	<p class="p-5" style="text-align: justify;"><?= $this->config->semevar->site_description ?></p>
	<div class="p-3 row">
		<div class="col-md-12 text-center">
			<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1259289545596!2d107.58069047462895!3d-6.994446668501102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9e8f96adf9b%3A0xcb6c062260d98aec!2sAlmaas%203!5e0!3m2!1sen!2sid!4v1693878596189!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</section>