<?php
class Notfound extends JI_Controller
{
	public function __constructx()
	{
		parent::__construct();
		$this->setTheme('front');
	}
	public function index()
	{
		$data = $this->__init();
		$this->setTheme('front');
		header("HTTP/1.0 404 Not Found");

		$this->setTitle("Tidak ditemukan" . $this->config->semevar->site_suffix);
		//$this->putThemeContent("notfound",$data);
		$this->loadLayout('notfound', $data);
		$this->render();
	}
}
