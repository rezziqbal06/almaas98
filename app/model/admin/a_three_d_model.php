<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `a_three_d` table
 *
 * @version 5.4.1
 *
 * @package Model\Front
 * @since 1.0.0
 */
class A_Three_D_Model extends \Model\A_Three_D_Concern
{

	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
		$this->point_of_view = 'admin';
	}

	public function getAll($is_active = 1)
	{
		$this->db->where('is_active', $is_active);
		return $this->db->get('', 0);
	}
}
