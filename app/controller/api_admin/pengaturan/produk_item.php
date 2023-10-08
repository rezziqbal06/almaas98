<?php
class Produk_Item extends JI_Controller
{
	var $media_pengguna = 'media/pengguna';

	public function __construct()
	{
		parent::__construct();
		$this->load('a_kategori_concern');
		$this->load('b_produk_concern');
		$this->load('b_produk_item_concern');
		$this->load('b_produk_gambar_concern');
		$this->load('c_order_produk_concern');
		$this->load("api_admin/a_kategori_model", 'akm');
		$this->load("api_admin/b_produk_model", 'bpm');
		$this->load("api_admin/b_produk_item_model", 'bpim');
		$this->load("api_admin/b_produk_gambar_model", 'bpgm');
		$this->load("api_admin/c_order_produk_model", 'copm');
		$this->lib("seme_upload", 'se');
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

	/**
	 * Give json data set result on datatable format
	 *
	 * @api
	 *
	 * @return void
	 */
	public function index()
	{
		$d = $this->__init();
		$data = array();
		$this->_api_auth_required($data, 'admin');

		$this->status = 200;
		$this->message = API_ADMIN_ERROR_CODES[$this->status];


		$is_active = $this->input->request('is_active', 1);
		if (strlen($is_active)) {
			$is_active = intval($is_active);
		}

		$admin_login = $d['sess']->user;
		$b_user_id = '';
		// Jika user adalah reseller, maka mengambil kustomernya
		// if (isset($admin_login->utype) && $admin_login->utype == 'agen') {
		// 	$b_user_id = $admin_login->id;
		// }

		$datatable = $this->bpim->datatable()->initialize();
		$dcount = $this->bpim->count($datatable->keyword(), $is_active);
		$ddata = $this->bpim->data(
			$datatable->page(),
			$datatable->pagesize(),
			$datatable->sort_column(),
			$datatable->sort_direction(),
			$datatable->keyword(),
			$is_active
		);

		foreach ($ddata as &$gd) {
			if (isset($gd->fnama)) {
				$gd->fnama = htmlentities(rtrim($gd->fnama, ' - '));
			}
			if (isset($gd->harga)) {
				$gd->harga = number_format($gd->harga, 0, ',', '.');
			}
			if (isset($gd->is_active)) {
				$gd->is_active = $this->bpim->label('is_active', $gd->is_active);
			}
			if (isset($gd->gambar)) {
				$gd->gambar = '<img src="' . base_url($gd->gambar) . '" class="img-fluid rounded" width="150"/>';
			}
		}

		$this->__jsonDataTable($ddata, $dcount);
	}

	/**
	 * Create new data
	 *
	 * @api
	 *
	 * @return void
	 */
	public function baru()
	{
		$d = $this->__init();
		$data = new \stdClass();
		if (!$this->bpim->validates()) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->bpim->validation_message();
			if (strlen($validation_message)) {
				$this->message = $validation_message;
			}
			$this->__json_out($data);
			die();
		}
		$this->bpim->columns['cdate']->value = 'NOW()';

		$res = $this->bpim->save();
		if ($res) {
			$this->status = 200;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		} else {
			$this->status = 110;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		}
		$this->__json_out($data);
	}

	/**
	 * Get detailed information by idea
	 *
	 * @param  int   $id               ID value from a_fasilitas table
	 *
	 * @api
	 * @return void
	 */
	public function detail($id)
	{
		$d = $this->__init();
		$data = array();
		// if (!$this->admin_login) {
		// 	$this->status = 400;
		// 	$this->message = API_ADMIN_ERROR_CODES[$this->status];
		// 	header("HTTP/1.0 400 Harus login");
		// 	$this->__json_out($data);
		// 	die();
		// }
		$id = (int) $id;

		$this->status = 200;
		$this->message = API_ADMIN_ERROR_CODES[$this->status];
		$data = $this->bpim->id($id);
		$data->tipe_rumah = $this->bpm->id($data->b_produk_id);
		$data->kategori = $this->akm->id($data->tipe_rumah->a_kategori_id);
		if (isset($data->tipe_rumah->harga)) {
			$data->tipe_rumah->angsuran = $data->tipe_rumah->harga / (3 * 12);
			$data->tipe_rumah->angsuran = $this->__formatNominal((int) $data->tipe_rumah->angsuran);
			$data->tipe_rumah->harga = number_format($data->tipe_rumah->harga, 0, ',', '.');
		}
		if (!isset($data->id)) {
			$data = new \stdClass();
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		// dd(count($data->indikator));
		$this->__json_out($data);
	}

	/**
	 * Update data by supplied ID
	 *
	 * @param  int   $id               ID value from a_fasilitas table
	 *
	 * @api
	 *
	 * @return void
	 */
	public function edit($id = "")
	{
		$d = $this->__init();
		$data = array();

		$du = $_POST;
		$id = (int)$id;
		$id = isset($du['id']) ? $du['id'] : 0;
		$du = [];
		$du['b_produk_id'] = $_POST['b_produk_id'] ?? 0;
		$du['is_active'] = $_POST['is_active'];
		$du['nomor'] = $_POST['nomor'] ?? '';
		$du['blok'] = $_POST['blok'] ?? '';
		$du['posisi'] = $_POST['posisi'] ?? '';

		if (!$this->admin_login) {
			$this->status = 400;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			header("HTTP/1.0 400 Harus login");
			$this->__json_out($data);
			die();
		}

		$id = (int) $id;
		if ($id <= 0) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$bpim = $this->bpim->id($id);
		if (!isset($bpim->id)) {
			$this->status = 445;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		if (!$this->bpim->validates()) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->bpim->validation_message();
			if (strlen($validation_message)) {
				$this->message = $validation_message;
			}
			$this->__json_out($data);
			die();
		}
		if ($id > 0) {
			unset($du['id']);

			$res = $this->bpim->update($id, $du);
			if ($res) {

				$this->status = 200;
				$this->message = API_ADMIN_ERROR_CODES[$this->status];
			} else {
				$this->status = 901;
				$this->message = API_ADMIN_ERROR_CODES[$this->status];
			}
		} else {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$this->__json_out($data);
	}

	/**
	 * Delete data by supplied ID
	 *
	 * @param  int   $id               ID value from a_fasilitas table
	 *
	 * @api
	 *
	 * @return void
	 */
	public function hapus($id)
	{
		$d = $this->__init();

		$data = array();
		if (!$this->admin_login) {
			$this->status = 400;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			header("HTTP/1.0 400 Harus login");
			$this->__json_out($data);
			die();
		}

		$id = (int) $id;
		if ($id <= 0) {
			$this->status = 520;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}
		$pengguna = $d['sess']->admin;

		$bpim = $this->bpim->id($id);
		if (!isset($bpim->id)) {
			$this->status = 521;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}
		if (!empty($bpim->is_deleted)) {
			$this->status = 522;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$res = $this->bpim->update($id, array('is_deleted' => 1));
		if ($res) {
			$this->status = 200;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		} else {
			$this->status = 902;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		}
		$this->__json_out($data);
	}

	public function edit_foto($id)
	{
		$d = $this->__init();
		$data = array();
		if (!$this->admin_login) {
			$this->status = 400;
			$this->message = 'Harus login';
			header("HTTP/1.0 400 Harus login");
			$this->__json_out($data);
			die();
		}
		$id = (int) $id;
		$du = $_POST;
		if (!isset($du['id'])) $du['id'] = 0;
		if (empty($id)) {
			$id = (int) $du['id'];
			unset($du['id']);
		}
		$pengguna = $this->bpim->getById($id);
		if ($id > 0 && isset($pengguna->id)) {
			if (!empty($penguna_foto)) {
				if (strlen($pengguna->foto) > 4) {
					$foto = SEMEROOT . DIRECTORY_SEPARATOR . $pengguna->foto;
					if (file_exists($foto)) unlink($foto);
				}
				$du = array();
				$du['foto'] = $penguna_foto;
				$res = $this->bpim->update($id, $du);
				if ($res) {
					$this->status = 200;
					$this->message = 'Upload foto berhasil';
				} else {
					$this->status = 901;
					$this->message = 'Upload foto gagal';
				}
			} else {
				$this->status = 459;
				$this->message = 'Tidak ada file gambar yang terupload';
			}
		} else {
			$this->status = 550;
			$this->message = 'Dont hack this :P';
		}
		$this->__json_out($data);
	}

	//Temporary Select2 di Pengguna API
	public function select2()
	{
		$this->load("api_admin/b_user_model", 'bpm');
		$d = $this->__init();
		$keyword = $this->input->request('q');
		$ddata = $this->bpim->select2($keyword);
		$datares = array();
		$i = 0;
		foreach ($ddata as $key => $value) {
			$datares["results"][$i++] = array("id" => $value->id, "text" => $value->kode . " - " . $value->fnama);
		}
		header('Content-Type: application/json');
		echo json_encode($datares);
	}


	public function cari()
	{
		$keyword = $this->input->request("keyword");
		if (empty($keyword)) $keyword = "";
		$p = new stdClass();
		$p->id = 'NULL';
		$p->text = '-';
		$data = $this->bpim->cari($keyword);
		array_unshift($data, $p);
		$this->__json_select2($data);
	}

	/**
	 * Get detailed information by idea
	 *
	 * @param  int   $id               ID value from a_fasilitas table
	 *
	 * @api
	 * @return void
	 */
	public function get_spesifikasi($id, $qty)
	{
		$d = $this->__init();
		$data = array();
		if (!$this->admin_login) {
			$this->status = 400;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			header("HTTP/1.0 400 Harus login");
			$this->__json_out($data);
			die();
		}
		$id = (int) $id;
		if (!isset($qty) || !$qty) {
			$data = new \stdClass();
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$this->status = 200;
		$this->message = API_ADMIN_ERROR_CODES[$this->status];
		$data = $this->bpim->id($id);
		if (!isset($data->id)) {
			$data = new \stdClass();
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$spesifikasi = $this->bphm->getByProdukAndQty($id, $qty);
		foreach ($spesifikasi as $k => $v) {
			$arr_spec = json_decode($v->spesifikasi);
			$v->option = implode(" | ", $arr_spec);
		}
		$data->spesifikasi = $spesifikasi;
		$this->__json_out($data);
	}

	/**
	 * Get detailed information by idea
	 *
	 * @param  int   $id               ID value from a_fasilitas table
	 *
	 * @api
	 * @return void
	 */
	public function get_tersedia()
	{
		$d = $this->__init();
		$data = array();
		// if (!$this->admin_login) {
		// 	$this->status = 400;
		// 	$this->message = API_ADMIN_ERROR_CODES[$this->status];
		// 	header("HTTP/1.0 400 Harus login");
		// 	$this->__json_out($data);
		// 	die();
		// }
		$b_user_id = $this->input->request('b_user_id');
		if (!isset($b_user_id)) {
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$this->status = 200;
		$this->message = API_ADMIN_ERROR_CODES[$this->status];
		$ordered = $this->copm->getAllGroupByUser();
		$produk_item = $this->bpim->getAll();
		$custom_ordered = $this->copm->getCustomByUserGroupByBlok($b_user_id);
		foreach ($custom_ordered as $co) {
			if (!isset($co->blok)) $co->blok = '';
			if (!isset($co->nomor)) $co->nomor = '';
			$co->id = 'kustom-' . $co->blok . $co->nomor;
			$co->harga = $co->lt * $co->harga_satuan;
			$co->harga = number_format($co->harga, 0, ',', '.');
		}
		foreach ($produk_item as $k => $v) {
			$v->status = "tersedia";
			$v->b_user_id = null;
			if (isset($v->harga)) $v->harga = number_format($v->harga, 0, ',', '.');
			if (count($ordered)) {
				foreach ($ordered as $o) {
					if ($o->b_produk_id == $v->id) {
						$v->status = $o->status;
						$v->b_user_id = $o->b_user_id;
						// break;
					}
				}
			}
		}
		if (count($custom_ordered) > 0) {
			$produk_item = array_merge($custom_ordered, $produk_item);
		}
		$data = $produk_item;
		$this->__json_out($data);
	}
}
