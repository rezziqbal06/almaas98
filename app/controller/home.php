<?php
class Home extends JI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->setTheme('front');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';

		$this->load('a_kategori_concern');
		$this->load('a_banner_concern');
		$this->load('a_blog_concern');
		$this->load('b_produk_concern');

		$this->load('front/a_kategori_model', 'akm');
		$this->load('front/a_banner_model', 'abm');
		$this->load('front/a_blog_model', 'ablm');
		$this->load('front/b_produk_model', 'bpm');
	}

	function __formatNominal($nominal)
	{
		$formats = [
			1000000000 => 'miliar',
			1000000 => 'juta',
			1000 => 'ribu'
		];

		foreach ($formats as $divisor => $format) {
			if ($nominal >= $divisor) {
				$result = $nominal / $divisor;
				return number_format($result, 0) . ' ' . $format;
			}
		}

		return number_format($nominal, 0);
	}

	public function index()
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }
		$data['is_from_login'] = $this->input->request('first', 0);
		$this->setTitle("Beranda" . $this->config->semevar->site_suffix);
		$this->setOGImage(base_url("media/logo.png"));
		$bpm_popular = $this->bpm->getPopular();
		if (isset($bpm_popular[0]->id)) {
			foreach ($bpm_popular as $b) {
				if (isset($b->luas_bangunan)) $b->luas_bangunan = (int) $b->luas_bangunan;
				if (isset($b->luas_tanah)) $b->luas_tanah = (int) $b->luas_tanah;
				if (isset($b->harga)) {
					$b->harga = $b->harga / (3 * 12);
					$b->harga = $this->__formatNominal((int) $b->harga);
				}
			}
		}
		$data['bpm_popular'] = $bpm_popular;
		unset($bpm_popular);


		$akm = $this->akm->getAll();
		if (isset($akm[0]->id)) $data['akm'] = $akm;

		$data['akm'] = $akm;
		unset($akm);


		$abm = $this->abm->getAll();
		if (isset($abm[0]->id)) $data['abm'] = $abm;

		$data['abm'] = $abm;
		unset($abm);

		$ablm = $this->ablm->getAll(1, 0, 3);
		if (isset($ablm[0]->id)) $data['ablm'] = $ablm;

		foreach ($ablm as $a) {
			if (isset($a->cdate)) $a->cdate = $this->__dateIndonesia($a->cdate);
		}
		$data['ablm'] = $ablm;
		unset($ablm);

		// $data['jp'] = $this->input->request('jp', 2);

		$this->putThemeContent("home/home", $data);
		$this->putThemeContent("home/home_modal", $data);
		$this->putJsContent("home/home_bottom", $data);
		$this->loadLayout('col-1-bar', $data);
		$this->render();
	}
}
