<?php
class Booking extends JI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->setTheme('front');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';

		$this->load('a_kategori_concern');
		$this->load('a_rekening_concern');
		$this->load('a_partner_concern');
		$this->load('b_produk_concern');
		$this->load('c_order_concern');
		$this->load('c_order_produk_concern');
		$this->load('b_produk_gambar_concern');
		$this->load('b_produk_item_concern');

		$this->load('front/a_kategori_model', 'akm');
		$this->load('front/a_rekening_model', 'arm');
		$this->load('front/a_partner_model', 'apm');
		$this->load('front/b_produk_model', 'bpm');
		$this->load('front/c_order_model', 'com');
		$this->load('front/c_order_produk_model', 'copm');
		$this->load('front/b_produk_gambar_model', 'bpgm');
		$this->load('front/b_produk_item_model', 'bpim');
	}

	public function index()
	{
		$data = $this->__init();
		// if (!$this->user_login) {
		// 	redir(base_url('login'), 0);
		// 	die();
		// }

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

	public function book($id)
	{
		$data = $this->__init();
		if (!$this->user_login) {
			$_SESSION['id_for_booking'] = $id;
			redir(base_url('login'), 0);
			die();
		}
		$produk = $this->bpm->id($id);
		if (!isset($produk->id)) {
			redir(base_url(''));
			die();
		}

		if (isset($produk->id)) $data['produk'] = $produk;
		if (isset($produk->luas_tanah)) $produk->luas_tanah = (int)$produk->luas_tanah;
		if (isset($produk->luas_bangunan)) $produk->luas_bangunan = (int)$produk->luas_bangunan;
		if (isset($produk->harga)) {
			$produk->harga_asli = $produk->harga;
			$produk->angsuran = $produk->harga / (3 * 12);
			$produk->angsuran = $this->__formatNominal((int) $produk->angsuran);
			$produk->harga = number_format($produk->harga, 0, ',', '.');
		}

		$bpgm = $this->bpgm->getByProduk($produk->id);
		if (isset($bpgm[0]->id)) $data['bpgm'] = $bpgm;

		$data['bpgm'] = $bpgm;

		$akm = $this->akm->id($produk->a_kategori_id);
		$data['akm'] = $akm;
		$bpim = $this->bpim->getAll(1, $id);
		$arm = $this->arm->getAll();
		$data['arm'] = $arm;
		$orders = $this->copm->getStock($id);
		if (isset($orders[0])) {
			$stoks = [];
			foreach ($orders as $o) {
				if (isset($o->gambar) && strlen($o->gambar) > 5) {
					$stoks['bpi-' . $o->b_produk_id] = $o->b_produk_id;
				}
			}
			if (count($stoks)) {
				foreach ($bpim as $k => $bp) {
					if (isset($stoks['bpi-' . $bp->id])) unset($bpim[$k]);
				}
			}
		}
		$data['bpim'] = $bpim;

		$this->setTitle('Booking ' . $produk->tipe . $this->config->semevar->site_suffix);
		$this->setDescription($this->convertToMetaDescription($produk->deskripsi) . $this->config->semevar->site_suffix);
		$this->setKeyword($produk->meta_keyword ?? '');
		$this->setOGImage(base_url($produk->gambar));

		unset($produk);
		unset($bpim);
		unset($bpm);
		unset($bpm_related);
		unset($arm);
		unset($akm);
		$this->putThemeContent("booking/home", $data);
		$this->putThemeContent("booking/home_modal", $data);
		$this->putJsContent("booking/home_bottom", $data);
		$this->loadLayout('col-1', $data);
		$this->render();
	}
}
