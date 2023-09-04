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
		$this->current_page = '3D Model';
	}
	public function index()
	{
		$data = $this->__init();
		if (!$this->admin_login) {
			redir(base_url_admin('login'));
			die();
		}


		$this->setTitle('3d Model ' . $this->config_semevar('admin_site_suffix', ''));

		$this->putThemeContent("pengaturan/three_d/home_modal", $data);
		$this->putThemeContent("pengaturan/three_d/home", $data);
		$this->putJsContent("pengaturan/three_d/home_bottom", $data);
		$this->loadLayout('col-2-left', $data);
		$this->render();
	}
}
