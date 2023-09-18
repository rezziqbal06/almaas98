<?php
class Home extends JI_Controller
{
	var $diskon_by_posisi = [
		'cash keras' => ['sayap' => 15, 'utama' => 10, 'hook' => 7],
		'cash bertahap' => ['sayap' => 10, 'utama' => 5, 'hook' => 2]
	];
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->current_parent = 'dashboard';
		$this->current_page = 'dashboard';

		$this->load('a_kategori_concern');
		$this->load('a_banner_concern');
		$this->load('a_partner_concern');
		$this->load('b_produk_concern');
		$this->load('b_user_concern');
		$this->load('c_order_concern');
		$this->load('c_order_produk_concern');
		$this->load('c_jadwal_concern');

		$this->load('admin/a_kategori_model', 'akm');
		$this->load('admin/a_banner_model', 'abm');
		$this->load('admin/a_partner_model', 'apm');
		$this->load('admin/b_produk_model', 'bpm');
		$this->load('admin/b_user_model', 'bum');
		$this->load('admin/c_order_model', 'com');
		$this->load('admin/c_order_produk_model', 'copm');
		$this->load('admin/c_jadwal_model', 'cjm');
	}

	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'), 0);
			die();
		}

		$data['count_produk'] = $this->bpm->countAll();
		$data['count_kustomer'] = $this->bum->countAll();
		$data['count_booking'] = 0;
		$data['count_progress'] = 0;
		$data['count_order_done'] = 0;

		$orders = $this->com->getAllOrders();
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
		$bulan = [];
		$omset = [];
		$jumlah = [];
		$chart = $this->com->chart('');
		if (isset($chart[0])) {
			foreach ($chart as $c) {
				// if (isset($c->omset)) {
				// 	$c->omset = number_format((float) $c->omset, 0, ',', '.');
				// }
				$bulan[] = $c->bulan;
				$omset[] = $c->omset;
				$jumlah[] = $c->jumlah;
			}
		}
		$data['chart'] = new stdClass();
		$data['chart']->bulan = json_encode($bulan);
		$data['chart']->omset = json_encode($omset);
		$data['chart']->jumlah = json_encode($jumlah);
		$orders = $this->copm->getBulanIni();
		foreach ($orders as $o) {
			if (isset($o->sub_harga)) {
				$o->sub_harga = number_format((float) $o->sub_harga, 0, ',', '.');
			}
			if ($o->tgl_pesan == "0000-00-00 00:00:00") $o->tgl_pesan = "";
			if ($o->tgl_selesai == "0000-00-00 00:00:00") $o->tgl_selesai = "";

			if (isset($o->tgl_pesan) && strlen($o->tgl_pesan)) {
				$o->tgl_pesan = $this->__dateIndonesia($o->tgl_pesan);
			}
			if (isset($o->tgl_selesai) && strlen($o->tgl_selesai)) {
				$o->tgl_selesai = $this->__dateIndonesia($o->tgl_selesai);
			}

			if (isset($o->status)) {
				switch ($o->status) {
					case "pending":
						$o->status_badge = '<span class="badge badge-sm bg-gradient-secondary">' . $o->status . '</span>';
						break;
					case "progress":
						$o->status_badge = '<span class="badge badge-sm bg-gradient-info">' . $o->status . '</span>';
						break;
					case "done":
						$o->status_badge = '<span class="badge badge-sm bg-gradient-success">selesai</span>';
						break;
					case "cancel":
						$o->status_badge = '<span class="badge badge-sm bg-gradient-danger">' . $o->status . '</span>';
						break;
					default:
						$o->status_badge = '<span class="badge badge-sm bg-gradient-info">Pending</span>';
						break;
				}
			}
		}
		$data['orders'] = $orders;

		$day = date("N");
		$jadwal_hari_ini = $this->cjm->getHariIni($day);
		$data['jadwal_hari_ini'] = $jadwal_hari_ini;
		$this->setTitle('Dashboard ' . $this->config->semevar->site_suffix);

		$this->putJsFooter($this->cdn_url('skin/admin/') . 'js/pages/index');

		$this->putThemeContent("home/home", $data);
		$this->putJsContent("home/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}

	public function edit()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'), 0);
			die();
		}
		$this->current_parent = '';
		$this->current_page = 'edit';

		$this->setTitle('Edit Profil ' . $this->config->semevar->site_suffix);

		$this->putJsFooter($this->cdn_url('skin/admin/') . 'js/pages/index');

		$this->putThemeContent("akun/pengguna/edit", $data);
		$this->putJsContent("akun/pengguna/edit_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
