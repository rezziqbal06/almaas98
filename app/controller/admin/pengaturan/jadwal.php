<?php

namespace Controller\Pengaturan;

register_namespace(__NAMESPACE__);

/**
 * Main Controller Class for User Modul
 *
 * Mostly for this controller will resulting HTTP Body Content in HTML format
 *
 * @version 1.0.0
 *
 * @package Partner\User
 * @since 1.0.0
 */
class Jadwal extends \JI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->lib("seme_purifier");
		$this->load("c_jadwal_concern");
		$this->load("a_pengguna_concern");
		$this->load("a_kategori_concern");
		$this->load("admin/c_jadwal_model", "cjm");
		$this->load("admin/a_pengguna_model", "apm");
		$this->load("admin/a_kategori_model", "akm");
		$this->current_parent = 'pengaturan';
		$this->current_page = 'jadwal';
	}
	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}

		$data['apm'] = $this->apm->getMarketing();
		$data['akm'] = $this->akm->getAll();


		$this->setTitle('Jadwal Piket ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/jadwal/home_modal", $data);
		$this->putThemeContent("pengaturan/jadwal/home", $data);
		$this->putJsContent("pengaturan/jadwal/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
