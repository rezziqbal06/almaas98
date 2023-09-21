<?php
class Checkout extends JI_Controller
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

	public function detail($kode)
	{
		$data = $this->__init();
		if (!$this->user_login) {
			redir(base_url('login'), 0);
			die();
		}
		$com = $this->com->getByKode($kode);
		$copm = $this->copm->getByOrder($com->id);
		$bpim = $this->bpim->id($copm->b_produk_id);
		$data['bpim'] = $bpim;
		$data['copm'] = $copm;
		$data['com'] = $com;

		$status = 'Menunggu pembayaran';
		if (isset($com->gambar) && strlen($com->gambar) > 4) {
			$status = 'Menunggu konfirmasi admin';
			if (isset($com->is_setor) && $com->is_setor) {
				$status = 'Telah dibooking';
			}
		}

		$data['status'] = $status;
		$produk = $this->bpm->id($bpim->b_produk_id);
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

		$akm = $this->akm->id($produk->a_kategori_id);
		$data['akm'] = $akm;
		$arm = $this->arm->id($com->a_rekening_id);
		$data['arm'] = $arm;

		$this->setTitle('Pembayaran ' . $produk->tipe . $this->config->semevar->site_suffix);
		$this->setDescription($this->convertToMetaDescription($produk->deskripsi) . $this->config->semevar->site_suffix);
		$this->setKeyword($produk->meta_keyword ?? '');
		$this->setOGImage(base_url($produk->gambar));

		unset($produk);
		unset($bpm);
		unset($arm);
		unset($akm);
		$this->putThemeContent("checkout/home", $data);
		$this->putThemeContent("checkout/home_modal", $data);
		$this->putJsContent("checkout/home_bottom", $data);
		$this->loadLayout('col-1', $data);
		$this->render();
	}

	public function berhasil()
	{
		$data = $this->__init();
		if (!$this->user_login) {
			redir(base_url('login'), 0);
			die();
		}
		if (!isset($_SESSION['is_berhasil_upload'])) {
			redir(base_url('profil'));
			die();
		}
		unset($_SESSION['is_berhasil_upload']);


		$this->putThemeContent("checkout/berhasil", $data);
		$this->loadLayout('col-1', $data);
		$this->render();
	}
}
