<?php
date_default_timezone_set('Asia/Jakarta');

class Order extends JI_Controller
{
	var $media_pengguna = 'media/pengguna';
	var $diskon_by_posisi = [
		'cash keras' => ['sayap' => 15, 'utama' => 10, 'hook' => 7],
		'cash bertahap' => ['sayap' => 10, 'utama' => 5, 'hook' => 2]
	];

	public function __construct()
	{
		parent::__construct();
		$this->load('a_pengguna_concern');
		$this->load('a_rekening_concern');
		$this->load('b_produk_concern');
		$this->load('b_produk_harga_concern');
		$this->load('b_produk_gambar_concern');
		$this->load('b_produk_item_concern');
		$this->load('b_user_concern');
		$this->load('c_order_concern');
		$this->load('c_order_produk_concern');
		$this->load("api_admin/a_pengguna_model", 'apm');
		$this->load("api_admin/a_rekening_model", 'arm');
		$this->load("api_admin/b_produk_model", 'bpm');
		$this->load("api_admin/b_produk_harga_model", 'bphm');
		$this->load("api_admin/b_produk_gambar_model", 'bpgm');
		$this->load("api_admin/b_produk_item_model", 'bpim');
		$this->load("api_admin/b_user_model", 'bum');
		$this->load("api_admin/c_order_model", 'com');
		$this->load("api_admin/c_order_produk_model", 'copm');
		$this->lib("seme_upload", 'se');
	}

	public function __generateKodeProduk($sitename)
	{
		$last_id = $this->com->last_id();
		$words = preg_split('/[^a-zA-Z0-9]+/', $sitename);
		$acronym = '';
		// Iterate over the words and extract the first character
		foreach ($words as $word) {
			$acronym .= strtoupper(substr($word, 0, 1));
		}

		$tgl = date("Ymd");

		return "ORD-$acronym-$tgl-$last_id";
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

		$admin_login = $d['sess']->admin;
		$a_pengguna_id = '';
		if (isset($admin_login->a_jabatan_nama) && strtolower($admin_login->a_jabatan_nama) == 'marketing') {
			$a_pengguna_id = $admin_login->id;
		}

		$datatable = $this->com->datatable()->initialize();
		$dcount = $this->com->count($a_pengguna_id, $datatable->keyword(), $is_active);
		$ddata = $this->com->data(
			$a_pengguna_id,
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
			if (isset($gd->is_active)) {
				$gd->is_active = $this->com->label('is_active', $gd->is_active);
			}

			if (isset($gd->is_setor)) {
				$gd->is_setor = $this->com->label('is_setor', $gd->is_setor);
			}
			if (isset($gd->total_harga)) {
				$gd->total_harga = number_format((int) $gd->total_harga, 0, ',', '.');
			}
			if (isset($gd->tgl_pesan) && strlen($gd->tgl_pesan)) {
				if ($gd->tgl_pesan == "0000-00-00 00:00:00") $gd->tgl_pesan = "";
				$gd->tgl_pesan = $this->__dateIndonesia($gd->tgl_pesan);
			}
			if (isset($gd->tgl_selesai) && strlen($gd->tgl_selesai)) {
				if ($gd->tgl_selesai == "0000-00-00 00:00:00") $gd->tgl_selesai = "";
				$gd->tgl_selesai = $this->__dateIndonesia($gd->tgl_selesai);
			}
			switch ($gd->status) {
				case "pembayaran":
					$gd->status = '<span class="badge badge-sm bg-gradient-danger">' . $gd->status . '</span>';
					break;
				case "booking":
					$gd->status = '<span class="badge badge-sm bg-gradient-info">' . $gd->status . '</span>';
					break;
				case "selesai":
					$gd->status = '<span class="badge badge-sm bg-gradient-success">selesai</span>';
					break;
				case "cancel":
					$gd->status = '<span class="badge badge-sm bg-gradient-danger">' . $gd->status . '</span>';
					break;
				case "survey":
					$gd->status = '<span class="badge badge-sm bg-gradient-secondary">' . $gd->status . '</span>';
					break;
				case "pending":
					$gd->status = '<span class="badge badge-sm bg-gradient-danger">Menunggu Persetujuan</span>';
					break;
				default:
					$gd->status = '<span class="badge badge-sm bg-gradient-info">Pending</span>';
					break;
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
		if (!$this->com->validates()) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->com->validation_message();
			if (strlen($validation_message)) {
				$this->message = $validation_message;
			}
			$this->__json_out($data);
			die();
		}

		$kode = $this->__generateKodeProduk($this->config_semevar("site_name"));
		$this->com->columns['kode']->value = $kode;
		$this->com->columns['cdate']->value = 'NOW()';
		$total_harga = $this->input->post('total_harga');
		$this->com->columns['total_harga']->value = (int) str_replace('.', '', $total_harga);
		$status = $this->input->post('status');
		if (!isset($status[0])) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->com->validation_message();
			$this->__json_out($data);
			die();
		}
		$this->com->columns['status']->value = $status[0] ?? 'pembayaran';
		$this->com->columns['a_pengguna_id']->value = $d['sess']->admin->id;
		$tgl_pesan = $this->com->columns['tgl_pesan']->value;
		$waktu_pesan = date("H:i:s");
		$this->com->columns['tgl_pesan']->value = $tgl_pesan . ' ' . $waktu_pesan;
		$b_user_id = $this->input->post('b_user_id');
		$jumlah_kunjungan = $this->com->countByUser($b_user_id);
		$this->com->columns['kunjungan_ke']->value = ++$jumlah_kunjungan;


		$status_for_notif = ucfirst($this->com->columns['status']->value);

		$user = $this->bum->id($b_user_id);
		$b_user_nama = $this->input->post("b_user_nama");
		if (!$b_user_id || $user->fnama != $b_user_nama) {
			if (!$b_user_nama) {
				$this->status = 444;
				$this->message = API_ADMIN_ERROR_CODES[$this->status];
				$validation_message = $this->com->validation_message();
				$this->__json_out($data);
				die();
			}
			$res_user = $this->bum->set(['fnama' => $b_user_nama]);
			if (!$res_user) {
				$this->status = 444;
				$this->message = API_ADMIN_ERROR_CODES[$this->status];
				$validation_message = $this->com->validation_message();
				$this->__json_out($data);
				die();
			}
			$this->com->columns['b_user_id']->value = $res_user;
			$this->com->columns['a_pengguna_id']->value = $d['sess']->admin->id;
		} else {
		}

		$res = $this->com->save();
		if ($res) {
			$resUpload = $this->se->upload_file('gambar', 'bukti', $res);
			if ($resUpload->status == 200) {
				$this->com->update($res, ['gambar' => $resUpload->file]);
			}
			//Upload Produk
			$b_produk_id = $this->input->post('b_produk_id');
			$b_produk_id_harga = $this->input->post('b_produk_id_harga');
			$harga = $this->input->post('harga');
			$qty = $this->input->post('qty');
			if (isset($status) && is_array($status) && count($status)) {
				$dip = [];
				foreach ($status as $k => $v) {
					$dip[$k]['c_order_id'] = $res;
					$dip[$k]['b_produk_id'] = $b_produk_id[$k] ?? 0;
					$dip[$k]['b_produk_id_harga'] = $b_produk_id_harga[$k] ?? 0;
					$dip[$k]['qty'] = $qty[$k] ?? 1;
					$dip[$k]['status'] = $status[$k];
					$dip[$k]['sub_harga'] = (int) str_replace('.', '', $harga[$k]);
					$dip[$k]['tgl_pesan'] = $this->input->post('tgl_pesan');
					$dip[$k]['cdate'] = "NOW()";
				}
				$res_produk = $this->copm->setMass($dip);
				if ($res_produk) {
					$this->status = 200;
					$this->message = API_ADMIN_ERROR_CODES[$this->status];
				} else {
					$this->status = 110;
					$this->message = API_ADMIN_ERROR_CODES[$this->status];

					$res_hapus = $this->com->del($res);
				}
			}

			$produk_item_id = $dip[0]['b_produk_id'] ?? 0;
			$produk_item = $this->bpim->id($produk_item_id);

			// Notifikasi ke Direktur
			$title = "Survey Baru";
			$message = "Alhamdulillah terdapat $status_for_notif baru";
			if (isset($produk_item->id)) {
				$message .= " - Blok $produk_item->blok $produk_item->nomor - $produk_item->posisi";
			}
			$type = 'artikel';
			$link = base_url_admin("order");
			$image = $this->cdn_url("media/logo.png");
			$payload = new stdClass();
			$payload->judul = $title;
			$payload->deskripsi = $message;
			$payload->jenis = $type;
			$payload->link = $link;
			$payload->gambar = $image;

			//get user yang ada notifnya
			$fcm_tokens = [];
			$user = $this->apm->getFcmTokenByJabatan('Direktur');
			foreach ($user as $a) {
				if (strlen($a->fcm_token) > 9) {
					$fcm_tokens[] = $a->fcm_token;
				}
			}

			$res_notif = 'NOT TRIGGERED';
			if (count($fcm_tokens)) $res_notif = $this->__pushNotif("android", $fcm_tokens, $title, $message, $type, $image, $payload);

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
		if (!$this->admin_login) {
			$this->status = 400;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			header("HTTP/1.0 400 Harus login");
			$this->__json_out($data);
			die();
		}
		$id = (int) $id;

		$this->status = 200;
		$this->message = API_ADMIN_ERROR_CODES[$this->status];
		$data['detail'] = $this->com->id($id);
		if (!isset($data['detail']->id)) {
			$data = new \stdClass();
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}
		$pengguna = $this->apm->id($data['detail']->a_pengguna_id);
		if (isset($pengguna->nama)) $data['detail']->marketing = $pengguna->nama;

		$pembeli = $this->bum->id($data['detail']->b_user_id);
		if (isset($pembeli->fnama)) $data['detail']->pembeli = $pembeli->fnama;

		if (isset($data['detail']->a_rekening_id)) {
			$rekening = $this->arm->id($data['detail']->a_rekening_id);
			if (isset($rekening->nama)) $data['detail']->nama_rekening = $rekening->nama;
			if (isset($rekening->nomor)) $data['detail']->nomor_rekening = $rekening->nomor;
			if (isset($rekening->icon)) $data['detail']->icon_rekening = $rekening->icon;
		}

		if (isset($data['detail']->total_harga)) {
			$data['detail']->total_harga = number_format((int) $data['detail']->total_harga, 0, ',', '.');
		}

		if (isset($data['detail']->tgl_pesan)) {
			$data['detail']->tgl_pesan = $this->__dateIndonesia($data['detail']->tgl_pesan, "hari_tanggal_jam");
		}

		if (isset($data['detail']->is_setor)) {
			$data['detail']->is_setor = $this->com->label('is_setor', $data['detail']->is_setor);
		}

		switch ($data['detail']->status) {
			case "pembayaran":
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-danger">' . $data['detail']->status . '</span>';
				break;
			case "booking":
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-info">' . $data['detail']->status . '</span>';
				break;
			case "selesai":
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-success">selesai</span>';
				break;
			case "cancel":
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-danger">' . $data['detail']->status . '</span>';
				break;
			case "survey":
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-secondary">' . $data['detail']->status . '</span>';
				break;
			case "pending":
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-danger">Menunggu Persetujuan</span>';
				break;
			default:
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-info">Pending</span>';
				break;
		}

		$produk = $this->copm->data($id);
		foreach ($produk as $k => $p) {

			if (isset($p->sub_harga)) {
				$p->sub_harga = number_format((int) $p->sub_harga, 0, ',', '.');
			}

			if (isset($p->harga)) {
				$p->harga = number_format((int) $p->harga, 0, ',', '.');
			}
		}
		$data['produk'] = $produk;

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
		$id = (int) $id;
		$id = isset($du['id']) ? $du['id'] : $id;

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

		$com = $this->com->id($id);
		if (!isset($com->id)) {
			$this->status = 445;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		if (!$this->com->validates()) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->com->validation_message();
			if (strlen($validation_message)) {
				$this->message = $validation_message;
			}
			$this->__json_out($data);
			die();
		}

		$status = $this->input->post('status');
		if (!isset($status[0])) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->com->validation_message();
			$this->__json_out($data);
			die();
		}
		$du['status'] = $status[0] ?? 'pending';
		$tgl_pesan = $du['tgl_pesan'];
		$waktu_pesan = date("H:i:s");
		$du['tgl_pesan'] = $tgl_pesan . ' ' . $waktu_pesan;

		$total_harga = $this->input->post('total_harga');
		$du['total_harga'] = (int) str_replace('.', '', $total_harga);

		$b_user_id = $this->input->post('b_user_id');
		$user = $this->bum->id($b_user_id);
		$b_user_nama = $this->input->post("b_user_nama");
		if (!$b_user_id || $user->fnama != $b_user_nama) {
			if (!$b_user_nama) {
				$this->status = 444;
				$this->message = API_ADMIN_ERROR_CODES[$this->status];
				$validation_message = $this->com->validation_message();
				$this->__json_out($data);
				die();
			}
			$res_user = $this->bum->set(['fnama' => $b_user_nama]);
			if (!$res_user) {
				$this->status = 444;
				$this->message = API_ADMIN_ERROR_CODES[$this->status];
				$validation_message = $this->com->validation_message();
				$this->__json_out($data);
				die();
			}
			$du['b_user_id'] = $res_user;
		}
		unset($du['b_produk_id']);
		unset($du['harga']);
		unset($du['qty']);
		unset($du['b_user_nama']);
		if ($id > 0) {
			unset($du['id']);
			$resUpload = $this->se->upload_file('gambar', 'kategori', $id);
			if ($resUpload->status == 200) {
				$du['gambar'] = $resUpload->file;
			}
			$res = $this->com->update($id, $du);
			if ($res) {
				//Upload Produk

				$res_hapus = $this->copm->delByOrder($id);
				if ($res_hapus) {
					$b_produk_id = $this->input->post('b_produk_id');
					$b_produk_id_harga = $this->input->post('b_produk_id_harga');
					$harga = $this->input->post('harga');
					$qty = $this->input->post('qty');
					if (isset($status) && is_array($status) && count($status)) {
						$dip = [];
						foreach ($status as $k => $v) {
							$dip[$k]['c_order_id'] = $id;
							$dip[$k]['b_produk_id'] = $b_produk_id[$k] ?? 0;
							$dip[$k]['b_produk_id_harga'] = $b_produk_id_harga[$k] ?? 0;
							$dip[$k]['qty'] = $qty[$k] ?? 1;
							$dip[$k]['status'] = $status[$k];
							$dip[$k]['sub_harga'] = (int) str_replace('.', '', $harga[$k]);
							$dip[$k]['tgl_pesan'] = $this->input->post('tgl_pesan');
							$dip[$k]['cdate'] = "NOW()";
						}
						$res_produk = $this->copm->setMass($dip);
						if ($res_produk) {
							$this->status = 200;
							$this->message = API_ADMIN_ERROR_CODES[$this->status];
						} else {
							$this->status = 110;
							$this->message = API_ADMIN_ERROR_CODES[$this->status];

							$res_hapus = $this->com->del($res);
						}
					}
				}


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

		$com = $this->com->id($id);
		if (!isset($com->id)) {
			$this->status = 521;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}
		if (!empty($com->is_deleted)) {
			$this->status = 522;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$res = $this->com->del($id);
		if ($res) {
			$res_hapus = $this->copm->delByOrder($id);

			$this->status = 200;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		} else {
			$this->status = 902;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
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
	public function set_status()
	{
		$d = $this->__init();
		$id = $this->input->post('id');

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

		$copm = $this->copm->id($id);
		if (!isset($copm->id)) {
			$this->status = 521;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$com = $this->com->id($copm->c_order_id);
		if (!isset($com->id)) {
			$this->status = 521;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$status = $this->input->post('status');
		$du = [];
		$du['status'] = $status;
		if ($status == "done" || $status == "cancel") {
			$du["tgl_selesai"] = date("Y-m-d", strtotime($this->input->post('tgl_selesai'))) ?? date("Y-m-d H:i:s");
		} else {
			$du["tgl_selesai"] = null;
		}
		$res = $this->copm->update($id, $du);
		if ($res) {
			$copm = $this->copm->getByOrder($com->id);
			$status_order = 'done';
			$tgl_selesai = $du['tgl_selesai'];
			foreach ($copm as $s) {
				if (!isset($s->tgl_selesai) || $s->tgl_selesai == "0000-00-00 00:00:00") {
					$tgl_selesai = null;
				}
				if ($s->status == 'progress' || $s->status == 'pending') {
					$status_order = "progress";
				}
			}
			$res = $this->com->update($com->id, array('status' => $status_order, "tgl_selesai" => $tgl_selesai));
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
		$pengguna = $this->com->getById($id);
		if ($id > 0 && isset($pengguna->id)) {
			if (!empty($penguna_foto)) {
				if (strlen($pengguna->foto) > 4) {
					$foto = SEMEROOT . DIRECTORY_SEPARATOR . $pengguna->foto;
					if (file_exists($foto)) unlink($foto);
				}
				$du = array();
				$du['foto'] = $penguna_foto;
				$res = $this->com->update($id, $du);
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
		$ddata = $this->com->select2($keyword);
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
		$data = $this->com->cari($keyword);
		array_unshift($data, $p);
		$this->__json_select2($data);
	}

	public function get_history()
	{
		$data = array();
		$this->status = 200;
		$this->message = API_ADMIN_ERROR_CODES[$this->status];
		$produk_id = $this->input->request("produk_id", '');
		$metode = $this->input->request("metode", '');
		$harga = 0;
		$diskon = 0;
		$posisi = '';

		if (!strlen($produk_id)) {
			$this->status = 401;
			$this->message = "Produk ID Tidak Valid";
			$this->__json_out($data);
			die();
		}

		$bpim = $this->bpim->id($produk_id);
		$bpm = $this->bpm->id($bpim->b_produk_id);
		if (isset($bpim->posisi)) $posisi = $bpim->posisi;
		if (isset($bpm->harga)) $harga = $bpm->harga;

		$copm = $this->copm->getByProduk($produk_id);
		$total = 0;
		foreach ($copm as $k => $v) {
			if (isset($v->metode) && $k == 1) $metode = $v->metode;
			$total += $v->sub_harga;
			if (isset($v->sub_harga)) $v->sub_harga = number_format($v->sub_harga, 0, ',', '.');
		}

		$diskon = $this->diskon_by_posisi[strtolower($metode)][$posisi] ?? 0;
		$nominal_diskon = $diskon ? $harga - ($harga * $diskon / 100) : $harga;

		$sisa = $nominal_diskon - $total;
		if (isset($harga)) $harga = number_format($harga, 0, ',', '.');
		if (isset($total)) $total = number_format($total, 0, ',', '.');
		if (isset($sisa)) $sisa = number_format($sisa, 0, ',', '.');
		if (isset($nominal_diskon)) $nominal_diskon = number_format($nominal_diskon, 0, ',', '.');

		$data['harga'] = $harga;
		$data['posisi'] = $posisi;
		$data['metode'] = $metode;
		$data['diskon'] = $diskon;
		$data['nominal_diskon'] = $nominal_diskon;
		$data['sisa'] = $sisa;
		$data['total'] = $total;
		$data['history'] = $copm;
		$this->__json_out($data);
	}

	public function set_setor($id)
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

		$this->status = 200;
		$this->message = 'Batal Disetorkan';
		$detail = $this->com->id($id);
		if (!isset($detail->id)) {
			$data = new \stdClass();
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$is_setor = 0;
		if ($detail->is_setor == 0) {
			$this->message = 'Berhasil Disetorkan';
			$is_setor = 1;

			// Notifikasi ke Marketing Terkait
			$kode = $detail->kode ?? '';
			$status = $detail->status ?? 'booking';
			$status = ucfirst($status);
			$title = "$status Berhasil";
			$message = "Alhamdulillah order $kode telah dikonfirmasi";

			$type = 'setor';
			$link = base_url_admin("order");
			$image = $this->cdn_url("media/logo.png");
			$payload = new stdClass();
			$payload->judul = $title;
			$payload->deskripsi = $message;
			$payload->jenis = $type;
			$payload->link = $link;
			$payload->gambar = $image;

			$fcm_tokens = [];
			$user = $this->apm->getFcmTokenById($detail->a_pengguna_id ?? 0);
			foreach ($user as $a) {
				if (strlen($a->fcm_token) > 9) {
					$fcm_tokens[] = $a->fcm_token;
				}
			}

			$user = $this->bum->getFcmTokenById($detail->b_user_id ?? 0);
			foreach ($user as $a) {
				if (strlen($a->fcm_token) > 9) {
					$fcm_tokens[] = $a->fcm_token;
				}
			}

			$res_notif = 'NOT TRIGGERED';
			if (count($fcm_tokens)) $res_notif = $this->__pushNotif("android", $fcm_tokens, $title, $message, $type, $image, $payload);
		}
		$res = $this->com->update($id, ['is_setor' => $is_setor]);
		if (!$res) {
			$this->status = 900;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		}

		// dd(count($data->indikator));
		$this->__json_out($data);
	}
}
