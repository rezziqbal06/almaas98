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
 * @package Pengaturan/ThreeD
 * @since 1.0.0
 */
class Three_D extends \JI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->setTheme('admin');
		$this->lib("seme_purifier");
		$this->load("a_three_d_concern");
		$this->load("admin/a_three_d_model", "atdm");
		$this->current_parent = 'pengaturan';
		$this->current_page = 'three_d';
	}
	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}


		$this->setTitle('3d Model ' . $this->config_semevar('site_suffix_admin', ''));

		$this->putThemeContent("pengaturan/three_d/home_modal", $data);
		$this->putThemeContent("pengaturan/three_d/home", $data);
		$this->putJsContent("pengaturan/three_d/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
	public function baru()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}
		$pengguna = $data['sess']->admin;


		$this->setTitle('3d Model Baru ' . $this->config_semevar('site_suffix', ''));

		$this->putThemeContent("pengaturan/three_d/baru_modal", $data);
		$this->putThemeContent("pengaturan/three_d/baru", $data);

		$this->putJsContent("pengaturan/three_d/baru_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
	public function edit($id)
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}
		$id = (int) $id;
		if ($id <= 0) {
			redir(base_url_admin('pengaturan/three_d/'));
			die();
		}
		$arm = $this->arm->id($id);
		if (!isset($arm->id)) {
			redir(base_url_admin('pengaturan/three_d/'));
			die();
		}

		// if (!isset($buam->id)) {
		// 	redir(base_url_admin('pengaturan/three_d/'));
		// 	die();
		// }

		$data['arm'] = $arm;


		$this->setTitle('3d Model Edit #' . $arm->id . ' ' . $this->config_semevar('site_suffix', ''));
		$this->putThemeContent("pengaturan/three_d/edit_modal", $data);
		$this->putThemeContent("pengaturan/three_d/edit", $data);
		$this->putJsContent("pengaturan/three_d/edit_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
