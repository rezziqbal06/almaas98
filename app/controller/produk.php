<?php
class Produk extends JI_Controller
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
		$this->load('b_produk_item_concern');
		$this->load('b_produk_gambar_concern');

		$this->load('front/a_kategori_model', 'akm');
		$this->load('front/a_banner_model', 'abm');
		$this->load('front/a_partner_model', 'apm');
		$this->load('front/b_produk_model', 'bpm');
		$this->load('front/b_produk_item_model', 'bpim');
		$this->load('front/b_produk_gambar_model', 'bpgm');
	}

	public function index()
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }
		$data['filter'] = $this->input->request('f', '');

		$this->current_page = 'explore';
		$this->setTitle("Beranda" . $this->config->semevar->site_suffix);

		$this->putThemeContent("explore/home", $data);
		$this->putThemeContent("explore/home_modal", $data);
		$this->putJsContent("explore/home_bottom", $data);
		$this->loadLayout('col-1-bar', $data);
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

	public function detail($slug)
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }

		$produk = $this->bpm->getBySlug($slug);
		if (isset($produk->id)) $data['produk'] = $produk;
		if (isset($produk->luas_tanah)) $produk->luas_tanah = (int)$produk->luas_tanah;
		if (isset($produk->luas_bangunan)) $produk->luas_bangunan = (int)$produk->luas_bangunan;
		if (isset($produk->harga)) {
			$produk->harga_asli = $produk->harga;
			$produk->angsuran = $produk->harga / (3 * 12);
			$produk->angsuran = $this->__formatNominal((int) $produk->angsuran);
			$produk->harga = number_format($produk->harga, 0, ',', '.');
		}
		$bpm_related = $this->bpm->getByKategori($produk->a_kategori_id, $produk->id);
		if (isset($bpm_related[0]->id)) $data['bpm_related'] = $bpm_related;

		$data['bpm_related'] = $bpm_related;
		unset($bpm_related);

		$bpgm = $this->bpgm->getByProduk($produk->id);
		if (isset($bpgm[0]->id)) $data['bpgm'] = $bpgm;

		$data['bpgm'] = $bpgm;

		$akm = $this->akm->id($produk->a_kategori_id);
		$is_sold = true;
		$data_siteplan = '';
		if (isset($akm->data_siteplan)) $data_siteplan = $akm->data_siteplan;
		$tipe = "TP-" . $produk->tipe;
		// dd($tipe . $data_siteplan);
		// if (strlen($data_siteplan)) $data_siteplan = json_decode($data_siteplan);
		// foreach ($data_siteplan as $ds) {
		// 	if (isset($ds->data) && stripos($ds->data, $tipe) !== false && $ds->status == 'tersedia') {
		// 		$is_sold = false;
		// 		break;
		// 	}
		// }
		$unit_tersedia = $this->bpim->getTersedia($produk->id);
		foreach ($unit_tersedia as $kt => $vt) {
			if (!isset($vt->order_unit_id)) {
				$is_sold = false;
				break;
			}
		}


		$data['is_sold'] = $is_sold;
		$this->setTitle($produk->tipe . $this->config->semevar->site_suffix);
		$this->setDescription($this->convertToMetaDescription($produk->deskripsi) . $this->config->semevar->site_suffix);
		$this->setKeyword($produk->meta_keyword ?? '');
		$this->setOGImage(base_url($produk->gambar));

		unset($produk);
		unset($bpm);
		unset($bpm_related);
		unset($akm);
		$this->putThemeContent("produk/detail", $data);
		$this->putThemeContent("produk/detail_modal", $data);
		$this->putJsContent("produk/detail_bottom", $data);
		$this->loadLayout('col-1', $data);
		$this->render();
	}
}
