<style>
	.blog-item {
		border-radius: 32px;
		position: relative;
	}

	.blog-tgl {
		position: absolute;
		z-index: 4;
		background-color: var(--secondary);
		color: white;
		padding: 8px;
		margin-top: 16px;
		margin-left: 16px;
		border-radius: 16px;
	}

	.custom-bg {
		background: url('media/header.png') no-repeat right top / 70%;
	}

	h1 {
		font-size: 5rem;
		margin-top: -1.5rem;
	}

	/* 
	.parent {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		grid-template-rows: repeat(4, 1fr);
		gap: 16px;
	} */

	.kartu {
		background-color: white;
		border-radius: 16px;
		padding: 2rem;
	}



	/* Facebook Gradient */
	.facebook {
		background: linear-gradient(135deg, #3b5998, #8b9dc3);
		-webkit-background-clip: text;
		background-clip: text;
		color: transparent;
		display: inline-block;
	}

	/* Instagram Gradient */
	.instagram {
		background: linear-gradient(135deg, #f58529, #d62976, #962fbf, #4f5bd5);
		-webkit-background-clip: text;
		background-clip: text;
		color: transparent;
		display: inline-block;
	}

	/* Youtube Gradient */
	.youtube {
		background: linear-gradient(135deg, rgb(181, 9, 0), rgb(220, 62, 0));
		-webkit-background-clip: text;
		background-clip: text;
		color: transparent;
		display: inline-block;
	}

	/* WhatsApp Gradient */
	.whatsapp {
		background: linear-gradient(135deg, #25D366, #128C7E);
		-webkit-background-clip: text;
		background-clip: text;
		color: transparent;
		display: inline-block;
	}

	.text-justify {
		text-align: justify;
	}

	.rumah-bg {
		background: url('media/rumah.jpg') no-repeat center center / 100%;
	}

	iframe {
		height: 28.5rem !important;
	}

	@media screen and (max-width: 765px) {
		h1 {
			font-size: 3rem;
			margin-top: -1rem;
		}

		.custom-bg {
			background: url('media/header.png') no-repeat right top / 120%;
		}
	}
</style>
<div class="row bg-primary p-3 mt-n2 d-none" style="margin-top: -16px;">
	<h3 class="mb-3 text-white <?= $sess->user->fnama ?? 'd-none' ?>">Halo, <?= $sess->user->fnama ?? '' ?></h3>
	<div class="col-12 mb-3">
		<input id="cari_quiz" type="text" class="form-control bg-white p-3" placeholder="Cari Rumah" style="border:none; border-radius:16px; color:white;">
	</div>
	<div class="col-12">
		<?php $text = ["Termurah", "Terluas", "36", "2 lantai",  "70", "2 kamar"]; ?>
		<?php $icon = ["money", "arrows-alt", "expand", "building", "expand", "bed"]; ?>
		<div class="d-flex flex-wrap" style="justify-content: start;">
			<?php foreach ($text as $k => $t) : ?>
				<div class="pe-3 ps-3 pt-1 pb-1 m-1 " style="border-radius: 32px;background-color:#D9D9D940;color:white;"><a href="<?= base_url("explore/") ?>?f=<?= $t ?>"><i class="fa fa-<?= $icon[$k] ?> me-1"></i> <span><?= $t ?></span></a></div>
			<?php endforeach ?>
		</div>
	</div>
</div>

<div class="p-5 bg-white custom-bg" style="margin-top: -7rem;">
	<div class="row w-100">
		<div data-aos="fade-down" class="col-md-6" style="margin-top: 15em;">
			<h4>TEMPATI</h4>
			<h1><b>RUMAH IMPIANMU</b></h1>

		</div>
		<div class="col-md-3"></div>
	</div>
	<div data-aos="fade-down" class="row w-100 mt-5">
		<div class="col-md-4">
			<p><?= $this->config->semevar->site_motto ?? '' ?></p>
		</div>
		<div class="col-md-4">
			<hr>
		</div>
	</div>
</div>

<!-- Tentang Kami -->

<div class="row p-3 mt-5">
	<div class="col-md-9">
		<div class="row">
			<div data-aos="fade-down" class="col-md-8 mb-2 mb-md-4">
				<div class="kartu">
					<h2 class="mb-2"><?= $this->config->semevar->site_motto ?></h2>
					<p class="text-justify"><?= $this->config->semevar->site_description ?></p>
				</div>
			</div>
			<div data-aos="fade-down" class="col-md-4 mb-2 mb-md-4">
				<div class="kartu">
					<?php if (isset($testimoni) && count($testimoni)) : ?>
						<h4 class="text-center mb-3">Testimoni</h4>
						<div id="testimoni" class="">
							<?php foreach ($testimoni as $k => $v) : ?>
								<div class="text-center">
									<i class="fa fa-user text-light fa-3x mb-2"></i>
									<br>
									<small class="text-warning"><?= $v->fnama ?></small>
									<p><?= $v->penilaian ?></p>
								</div>
							<?php endforeach ?>
						</div>
					<?php endif ?>
				</div>
			</div>
			<div data-aos="fade-up" data-aos="fade-down" class="col-md-4 mb-2 mb-md-0">
				<div class="kartu rumah-bg h-100"></div>
			</div>
			<div data-aos="fade-up" class="col-md-8 mb-2 mb-md-0">
				<div class="kartu h-100">
					<h3 class="mb-4 ">Kenali kami lebih dekat</h3>
					<div class="d-flex justify-content-around align-middle p-4">
						<a href="<?= $this->config->semevar->site_ig ?? '' ?>" target="_blank"><i class="fa fa-instagram fa-3x instagram "></i></a>
						<a href="<?= $this->config->semevar->site_fb ?? '' ?>" target="_blank"><i class="fa fa-facebook fa-3x facebook "></i></a>
						<a href="<?= $this->config->semevar->site_yt ?? '' ?>" target="_blank"><i class="fa fa-youtube fa-3x youtube "></i></a>
						<a href="https://wa.me/<?= $this->config->semevar->site_wa ?? '' ?>" target="_blank"><i class="fa fa-whatsapp whatsapp fa-3x" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div data-aos="fade-left" class="col-md-3 ">
		<div class="kartu">
			<iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1259289545596!2d107.58069047462895!3d-6.994446668501102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9e8f96adf9b%3A0xcb6c062260d98aec!2sAlmaas%203!5e0!3m2!1sen!2sid!4v1693878596189!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</div>


<!-- List Kustomer -->
<section class="row p-3 p-md-5">
	<h6>Sering dilihat</h6>
	<div id="panel_produk" class="horizontal-list">
		<?php if (isset($bpm_popular) && count($bpm_popular)) : ?>
			<?php foreach ($bpm_popular as $produk) : ?>
				<div class="p-2 me-3 kartu-produk" data-kategori-id="<?= $produk->a_kategori_id ?>">
					<a href="<?= base_url("produk/") ?><?= $produk->slug ?>" class="" data-id="<?= $produk->id ?>" data-kategori-id="<?= $produk->a_kategori_id ?>" alt="<?= $produk->nama ?>">
						<div class="kartu-gambar-produk">
							<img src="<?= base_url("") ?><?= $produk->gambar ?? '' ?>" alt="<?= $produk->nama ?? '' ?>" aria-describedby="<?= $produk->nama ?? '' ?>" class="img-fluid">
						</div>
						<p class="fs-5 mt-2 mb-1"><b>Type <?= $produk->tipe ?? '' ?></b></p>
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


<?php if (isset($abm) && count($abm)) : ?>
	<div id="banner" class="">
		<?php foreach ($abm as $k => $v) : ?>
			<a href="<?= base_url('banner/') . $v->slug ?>">
				<img src="<?= base_url("$v->gambar") ?>" class="d-block w-100" alt="<?= $v->nama ?>">
			</a>
		<?php endforeach ?>
	</div>
	<div class="carousel-indicators ">
		<ul></ul>
	</div>
<?php endif ?>
<!-- 
<div id="tentang_kami" class="row p-3 mt-3 text-center">
	<div class="col-12">
		<img src="<?= base_url("media/logo.png") ?>" alt="Logo Almaas 98" class="img-fluid" width="30%">
		<h4><?= $this->config->semevar->site_motto ?? '' ?></h4>
		<a href="<?= base_url("tentang_kami") ?>" class="text-info">Lihat profil</a>
	</div>
</div> -->

<?php if (isset($ablm) && count($ablm)) : ?>
	<div id="blog" class="row p-3 mb-3">
		<?php foreach ($ablm as $k => $a) : ?>
			<div class="col-md-4">
				<a href="<?= base_url('blog/' . $a->slug) ?>" class="" alt="<?= $a->judul ?>">
					<div class="blog-tgl"><b><?= $a->cdate ?></b></div>
					<img src="<?= base_url($a->gambar) ?>" alt="<?= $a->judul ?>" class="blog-item img-fluid">
					<div class="blog-desc p-3">
						<span class="text-primary"><?= $a->kategori ?></span>
						<h3><?= $a->judul ?></h3>
					</div>
				</a>
			</div>
		<?php endforeach ?>
		<div class="col-12 text-end">
			<a href="<?= base_url("blog") ?>">Selengkapnya</a>
		</div>
	</div>
<?php endif ?>