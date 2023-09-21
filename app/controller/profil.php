<?php
class Profil extends JI_Controller
{
	var $media_pengguna = 'media/pengguna/';

	public function __construct()
	{
		parent::__construct();
		$this->setTheme('front');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';
		$this->load('a_kategori_concern');
		$this->load('b_user_concern');
		$this->load('c_order_concern');
		$this->load('c_order_produk_concern');

		// $this->load('front/a_pengguna_model', 'apm');
		// $this->load('front/a_company_model', 'acm');
		$this->load('front/a_kategori_model', 'ajm');
		$this->load('front/b_user_model', 'bum');
		$this->load('front/c_order_model', 'com');
		$this->load('front/c_order_produk_model', 'copm');
	}

	public function index()
	{
		$data = $this->__init();

		if (!$this->user_login) {
			redir(base_url('login'));
			die();
		}

		$user_exist = $this->bum->getUserById($data['sess']->user->id);
		if (isset($user_exist)) $data['ue'] = $user_exist;
		unset($user_exist);

		$com = $this->com->getByUser($data['sess']->user->id);
		if (isset($com[0]->id)) {
			foreach ($com as $k => $v) {
				$v->status_transaksi = 'Menunggu Pembayaran';
				$v->st_color = 'text-danger';
				if (isset($v->is_setor) && $v->is_setor) {
					$v->status_transaksi = 'Pembayaran Terkonfirmasi';
					$v->st_color = 'text-success';
				} else if (strlen($v->gambar) > 5) {
					$v->status_transaksi = "Menunggu Konfirmasi Admin";
					$v->st_color = 'text-info';
				}
			}
		}

		$data['com'] = $com;

		$data['count_booking'] = 0;
		$data['count_progress'] = 0;
		$data['count_order_done'] = 0;

		$orders = $this->com->getAllOrders($data['sess']->user->id);
		if (isset($orders[0]->metode)) {
			foreach ($orders as $o) {
				$diskon = $this->diskon_by_posisi[strtolower($o->metode)][$o->posisi] ?? 0;
				$nominal_diskon = $diskon ? $o->harga - ($o->harga * $diskon / 100) : $o->harga;
				$o->total = (int) $o->total;
				if ($o->status == 'booking') {
					$data['count_booking']++;
				} else if ($o->total >= $nominal_diskon) {
					$data['count_order_done']++;
				} else {
					$data['count_progress']++;
				}
			}
		}



		$this->setTitle('Profil ' . $this->config->semevar->site_suffix);
		$this->putThemeContent("profil/home_modal", $data);
		$this->putThemeContent("profil/home", $data);

		$this->putJsReady("profil/home_bottom", $data);
		$this->loadLayout('col-1-bottom-nav', $data);
		$this->render();
	}
	public function edit_foto()
	{
		$data = $this->__init();
		if (!$this->user_login) {
			redir(base_url('login'));
			die();
		}
		$admin_id = $data['sess']->user->id;

		$data['notif'] = 'Error: Gagal ubah foto profil';
		$foto = $this->__uploadFoto($admin_id); //handling file upload
		if (strlen($foto) > 3) {
			//delete existing foto
			$admin_foto = $data['sess']->user->foto;
			if (strlen($admin_foto) > 3) {
				$admin_foto = str_replace('//', '/', $admin_foto);
				$admin_foto_path = SEMEROOT . DIRECTORY_SEPARATOR . $admin_foto;
				if (file_exists($admin_foto_path)) unlink($admin_foto_path);
			}

			//set to current session
			$data['sess']->user->foto = '';
			$this->setKey($data['sess']);

			//replace double slash
			$foto = str_replace('//', '/', $foto);

			//update new foto to database;
			$du = array('foto' => $foto);
			$res = $this->apm->update($admin_id, $du);
			if ($res) {
				$data['sess']->user->foto = $foto;
				$this->setKey($data['sess']);
				$data['notif'] = 'Berhasil';
			}
		}

		$this->setTitle('Profil Saya ' . $this->config->semevar->site_suffix);
		$this->putThemeContent("profil/home_modal", $data);
		$this->putThemeContent("profil/home", $data);

		$this->putThemeContent("profil/home_modal", $data);
		$this->putThemeContent("profil/home", $data);

		$this->putJsReady("profil/home_bottom", $data);
		$this->loadLayout('col-1-bar', $data);
		$this->render();
	}
}
