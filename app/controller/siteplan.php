<?php
class Siteplan extends JI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->setTheme('front');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';

		$this->load('a_kategori_concern');
		$this->load('a_banner_concern');
		$this->load('a_partner_concern');
		$this->load('b_produk_concern');
		$this->load('b_produk_gambar_concern');
		$this->load("c_order_concern");

		$this->load('front/a_kategori_model', 'akm');
		$this->load('front/a_banner_model', 'abm');
		$this->load('front/a_partner_model', 'apm');
		$this->load('front/b_produk_model', 'bpm');
		$this->load('front/b_produk_gambar_model', 'bpgm');
		$this->load("admin/c_order_model", "com");
	}

	public function index()
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }

		$akm = $this->akm->getAll();
		foreach ($akm as $k => $a) {
			if (!isset($a->siteplan) || strlen($a->siteplan) < 3) {
				unset($akm[$k]);
			}
		}
		$data['akm'] = $akm;

		$this->current_page = 'siteplan';
		$this->setTitle("Siteplan " . $this->config->semevar->site_suffix);

		$this->putThemeContent("siteplan/home", $data);
		$this->putThemeContent("siteplan/home_modal", $data);
		$this->putJsContent("siteplan/home_bottom", $data);
		$this->loadLayout('col-1-bottom-nav', $data);
		$this->render();
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

	public function detail($id)
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }

		$bpm = $this->bpm->getAll(1, 1);
		$data['bpm'] = $bpm;
		$akm = $this->akm->id($id);
		if (isset($akm->data_siteplan) && strlen($akm->data_siteplan) > 5) {
			$data_siteplan = json_decode($akm->data_siteplan);
			$orders = $this->com->getAllOrders();
			foreach ($data_siteplan as $ds) {
				if (!isset($ds->data)) continue;
				foreach ($orders as $o) {
					if (stripos($ds->data, "ID-" . $o->b_produk_id) !== false) {
						$o->status = $o->status == 'pembayaran' ? 'terjual' : $o->status;
						$ds->status = $o->status;
						$ds->b_user_id = $o->b_user_id;
						$ds->posisi = $o->posisi;
					}
				}
			}
			$akm->data_siteplan = json_encode($data_siteplan);
		}
		$data['akm'] = $akm;
		$this->setTitle($akm->nama . $this->config->semevar->site_suffix);
		$this->setDescription($this->convertToMetaDescription($akm->deskripsi) . $this->config->semevar->site_suffix);
		$this->setKeyword('Siteplan perumahan, residence');
		$this->setOGImage(base_url($akm->gambar));


		unset($akm);
		unset($bpm);
		$this->putThemeContent("siteplan/detail", $data);
		$this->putThemeContent("siteplan/detail_modal", $data);
		$this->putJsContent("siteplan/detail_bottom", $data);
		$this->loadLayout('col-1', $data);
		$this->render();
	}
}
