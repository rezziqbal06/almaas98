<?php
class Pegawai extends JI_Controller
{
	var $media_pengguna = 'media/pengguna';

	public function __construct()
	{
		parent::__construct();
		$this->load('a_pengguna_concern');
		$this->load("api_admin/a_pengguna_model", 'apm');
		$this->lib("seme_upload", 'se');
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

		/** advanced filter is_active */
		$a_unit_id = $this->input->request('a_unit_id', '');
		if (strlen($a_unit_id)) {
			$a_unit_id = intval($a_unit_id);
		}
		$is_active = $this->input->request('is_active', '');
		if (strlen($is_active)) {
			$is_active = intval($is_active);
		}

		$admin_login = $d['sess']->user;
		$b_user_id = '';
		// Jika user adalah reseller, maka mengambil kustomernya
		// if (isset($admin_login->utype) && $admin_login->utype == 'agen') {
		// 	$b_user_id = $admin_login->id;
		// }

		$datatable = $this->apm->datatable()->initialize();
		$dcount = $this->apm->count($b_user_id, $datatable->keyword(), $is_active, $a_unit_id);
		$ddata = $this->apm->data(
			$b_user_id,
			$datatable->page(),
			$datatable->pagesize(),
			$datatable->sort_column(),
			$datatable->sort_direction(),
			$datatable->keyword(),
			$is_active,
			$a_unit_id
		);

		foreach ($ddata as &$gd) {
			if (isset($gd->a_jabatan_nama) && $gd->a_jabatan_nama == "Admin") {
				unset($gd);
			}
			if (isset($gd->fnama)) {
				$gd->fnama = htmlentities(rtrim($gd->fnama, ' - '));
			}
			if (isset($gd->is_active)) {
				$gd->is_active = $this->apm->label('is_active', $gd->is_active);
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
		if (!$this->apm->validates()) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$validation_message = $this->apm->validation_message();
			if (strlen($validation_message)) {
				$this->message = $validation_message;
			}
			$this->__json_out($data);
			die();
		}
		$this->apm->columns['password']->value = md5('123456');
		$this->apm->columns['username']->value = strtolower(str_replace(" ", '', $this->apm->columns['nama']->value));

		$res = $this->apm->save();
		if ($res) {
			$this->lib("conumtext");
			$this->status = 200;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$token = $this->conumtext->genRand($type = "str", 9, 9);
			// $update_apikey = $this->apm->update($res, ['apikey' => $token]);
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
		$data = $this->apm->id($id);
		if (!isset($data->id)) {
			$data = new \stdClass();
			$this->status = 441;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}
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
	public function edit($id)
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
		// $id = $this->input->request('id', 0);
		$id = (int) $id;
		if ($id <= 0) {
			$this->status = 444;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$apm = $this->apm->id($id);
		if (!isset($apm->id)) {
			$this->status = 445;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$du = $_POST;
		$new_password = '';
		$re_password = '';
		if (isset($du['new_password'])) $new_password = $du['new_password'];
		if (isset($du['re_password'])) $re_password = $du['re_password'];

		if (strlen($new_password)) {
			if ($new_password != $re_password) {
				$this->status = 446;
				$this->message = 'Ulang password tidak sesuai';
				$this->__json_out($data);
				die();
			} else {
				$du['password'] = md5($new_password);
			}
		}

		if (isset($du['new_password'])) unset($du['new_password']);
		if (isset($du['re_password'])) unset($du['re_password']);

		$resUpload = $this->se->upload_file('gambar', 'pengguna', $id);
		if ($resUpload->status == 200) {
			$du['foto'] = $resUpload->file;
		}
		$res = $this->apm->update($id, $du);
		if ($res) {
			$this->status = 200;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		} else {
			$this->status = 901;
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

		$apm = $this->apm->id($id);
		if (!isset($apm->id)) {
			$this->status = 521;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}
		if (!empty($apm->is_deleted)) {
			$this->status = 522;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
			$this->__json_out($data);
			die();
		}

		$res = $this->apm->del($id);
		if ($res) {
			$this->status = 200;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		} else {
			$this->status = 902;
			$this->message = API_ADMIN_ERROR_CODES[$this->status];
		}
		$this->__json_out($data);
	}
	public function editpass($id = "")
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
		unset($du['id']);
		if ($id > 0) {
			if (strlen($du['password'])) {
				$du['password'] = md5($du['password']);
				$res = $this->apm->update($id, $du);
				$this->status = 200;
				$this->message = 'Perubahan berhasil diterapkan';
			} else {
				$this->status = 901;
				$this->message = 'Password terlalu pendek';
			}
		} else {
			$this->status = 447;
			$this->message = 'ID Pengguna tidak valid';
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
		$pengguna = $this->apm->getById($id);
		if ($id > 0 && isset($pengguna->id)) {
			if (!empty($penguna_foto)) {
				if (strlen($pengguna->foto) > 4) {
					$foto = SEMEROOT . DIRECTORY_SEPARATOR . $pengguna->foto;
					if (file_exists($foto)) unlink($foto);
				}
				$du = array();
				$du['foto'] = $penguna_foto;
				$res = $this->apm->update($id, $du);
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
		$this->load("api_admin/b_user_model", 'apm');
		$d = $this->__init();
		$keyword = $this->input->request('q');
		$ddata = $this->apm->select2($keyword);
		$datares = array();
		$i = 0;
		foreach ($ddata as $key => $value) {
			$datares["results"][$i++] = array("id" => $value->id, "text" => $value->kode . " - " . $value->fnama);
		}
		header('Content-Type: application/json');
		echo json_encode($datares);
	}

	public function hak_akses()
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
		$this->load('api_admin/a_pengguna_module_model', 'apmm');
		$a_pengguna_id			= $_POST['a_pengguna_id'];
		$a_modules_identifier	= $_POST['a_modules_identifier'];

		$this->apmm->updateModule(array('tmp_active' => 'N'), $a_pengguna_id);

		foreach ($a_modules_identifier as $ami) {
			$arr							= array();
			$arr['a_pengguna_id']			= $a_pengguna_id;
			$arr['a_modules_identifier']	= $ami;
			$arr['rule']					= 'allowed';
			$arr['tmp_active']				= 'Y';

			$check_ami = $this->apmm->check_access($a_pengguna_id, $ami);
			if ($check_ami == 0) {
				$this->apmm->set($arr);
			} else {
				$this->apmm->updateModule($arr, $a_pengguna_id, $ami);
			}
		}

		$res = $this->apmm->delModule($a_pengguna_id);

		if ($res) {
			$this->status 	= 200;
			$this->message 	= 'Berhasil disimpan';
		} else {
			$this->status 	= 901;
			$this->message 	= 'Terjadi kesalahan dalam proses';
		}

		$this->__json_out($data);
	}
	public function pengguna_module()
	{
		$this->load('api_admin/a_pengguna_module_model', 'apmm');
		$d 			= $this->__init();
		$id			= $this->input->post('id');
		$ddata 		= $this->apmm->pengguna_module($id);
		$datares 	= array();
		$i 			= 0;
		foreach ($ddata as $key => $value) {
			$datares[$i++] = $value->a_modules_identifier;
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
		$data = $this->apm->cari($keyword);
		array_unshift($data, $p);
		$this->__json_select2($data);
	}

	public function changePass($id = "")
	{
		$d = $this->__init();
		$data = array();

		$du = $_POST;
		// dd($du);
		// if (!$this->user_login) {
		// 	$this->status = 400;
		// 	$this->message = API_ADMIN_ERROR_CODES[$this->status];
		// 	header("HTTP/1.0 400 Harus login");
		// 	$this->__json_out($data);
		// 	die();
		// }

		$is_reset = false;
		if (isset($du['is_reset'])) {
			$is_reset = $du['is_reset'];
			unset($du['is_reset']);
		}

		// dd($du['is_reset']);
		$id = (int) $id;
		// $du = $_POST;
		$id =  isset($du['id']) ? $du['id'] : 0;
		unset($du['id']);
		if ($id > 0) {
			$dtuser = $this->apm->id($id);
			// dd(["old" => $dtuser->password, "conf" => md5($du['old_pass'])]);
			if ($is_reset) {
				if (strlen($du['new_pass'])) {
					$du['password'] = md5($du['new_pass']);
					unset($du['old_pass']);
					unset($du['new_pass']);
					unset($du['confirm_new_pass']);
					$res = $this->apm->update($id, $du);
					$this->status = 200;
					$this->message = 'Perubahan berhasil diterapkan';
				} else {
					$this->status = 901;
					$this->message = 'Password terlalu pendek';
				}
			} else {
				if ($dtuser->password == md5($du['old_pass'])) {
					if (strlen($du['new_pass'])) {
						$du['password'] = md5($du['new_pass']);
						unset($du['old_pass']);
						unset($du['new_pass']);
						unset($du['confirm_new_pass']);
						$res = $this->apm->update($id, $du);
						$this->status = 200;
						$this->message = 'Perubahan berhasil diterapkan';
					} else {
						$this->status = 901;
						$this->message = 'Password terlalu pendek';
					}
				} else {
					$this->status = 402;
					$this->message = 'Password salah';
				}
			}
		} else {
			$this->status = 447;
			$this->message = 'ID Pengguna tidak valid';
		}
		$this->__json_out($data);
	}

	public function update_token()
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
		$token = $this->input->post('token', '');
		if (!strlen($token)) {
			$this->status = 401;
			$this->message = "Token Tidak ada";
			$this->__json_out($data);
			die();
		}

		$res = $this->apm->update($d['sess']->admin->id, ["fcm_token" => $token]);
		if ($res) {
			$this->status = 200;
			$this->message = 'Perubahan berhasil diterapkan';
		} else {
			$this->status = 901;
			$this->message = 'Gagal update token';
		}

		$this->__json_out($data);
	}
}
