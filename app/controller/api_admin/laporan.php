<?php
date_default_timezone_set('Asia/Jakarta');

class Laporan extends JI_Controller
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


		$a_kategori_id = $this->input->request('a_kategori_id', '');
		$sdate = $this->input->request('sdate', '');
		$edate = $this->input->request('edate', '');

		//Jumlah Surveyon
		$count_surveyon = [];
		$list_surveyon = $this->bum->listData($a_kategori_id, $sdate, $edate);
		if (isset($list_surveyon[0]->nama)) {
			$tempKawasan = '';
			$nomorSurveyon = 0;
			foreach ($list_surveyon as $k => $ls) {
				if ($k == 0) {
					$tempKawasan = $ls->kawasan;
					$count_surveyon[$nomorSurveyon] = new stdClass();
					$count_surveyon[$nomorSurveyon]->jumlah = 1;
					$count_surveyon[$nomorSurveyon]->kawasan = $tempKawasan;
				} else {
					if ($tempKawasan != $ls->kawasan) {
						$tempKawasan = $ls->kawasan;
						$nomorSurveyon++;
						$count_surveyon[$nomorSurveyon] = new stdClass();
						$count_surveyon[$nomorSurveyon]->jumlah = 1;
						$count_surveyon[$nomorSurveyon]->kawasan = $tempKawasan;
					} else {
						$count_surveyon[$nomorSurveyon]->jumlah++;
					}
				}
			}
		}

		//Omset per bulan
		$omset = $this->com->omset($a_kategori_id, $sdate, $edate);
		if (isset($omset[0]->omset)) {
			foreach ($omset as $o) {
				if (isset($o->omset)) $o->omset = str_replace(".00", '', $o->omset);
				if (isset($o->omset)) $o->omset = number_format($o->omset, 0, ',', '.');
			}
		}

		//Data Unit
		$unit = $this->bpim->getTersedia();
		$unit_tersedia = [];
		if (isset($unit[0]->harga)) {
			foreach ($unit as $k => $utr) {
				if (!isset($utr->order_unit_id)) {
					if (isset($utr->harga)) $utr->harga = str_replace(".00", '', $utr->harga);
					if (isset($utr->harga)) $utr->harga = number_format($utr->harga, 0, ',', '.');
					$unit_tersedia[] = $utr;
				}
			}
		}

		$unit_order = $this->com->unitTerjual($a_kategori_id, $sdate, $edate);
		$unit_booking = [];
		$unit_terjual = [];
		if (isset($unit_order[0]->total_harga)) {
			foreach ($unit_order as $k => $ut) {
				if (isset($ut->total_harga)) $ut->total_harga = str_replace(".00", '', $ut->total_harga);
				if (isset($ut->total_harga)) $ut->total_harga = number_format($ut->total_harga, 0, ',', '.');
				if ($ut->status == 'booking') {
					$unit_booking[] = $ut;
				} else {
					$unit_terjual[] = $ut;
				}
			}
		}
		$data['omset'] = $omset;
		$data['list_surveyon'] = $list_surveyon;
		$data['count_surveyon'] = $count_surveyon;
		$data['unit_booking'] = $unit_booking;
		$data['unit_terjual'] = $unit_terjual;
		$data['unit_tersedia'] = $unit_tersedia;
		$this->__json_out($data);
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
			if (isset($b_produk_id) && is_array($b_produk_id) && count($b_produk_id)) {
				$dip = [];
				foreach ($b_produk_id as $k => $v) {
					$dip[$k]['c_order_id'] = $res;
					$dip[$k]['b_produk_id'] = $v;
					$dip[$k]['b_produk_id_harga'] = $b_produk_id_harga[$k];
					$dip[$k]['qty'] = $qty[$k];
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
				$data['detail']->status = '<span class="badge badge-sm bg-gradient-secondary">' . $data['detail']->status . '</span>';
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
					if (isset($b_produk_id) && is_array($b_produk_id) && count($b_produk_id)) {
						$dip = [];
						foreach ($b_produk_id as $k => $v) {
							$dip[$k]['c_order_id'] = $id;
							$dip[$k]['b_produk_id'] = $v;
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

		$res = $this->com->update($id, array('is_deleted' => 1));
		if ($res) {
			$res_hapus = $this->copm->softDelByOrder($id);

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
