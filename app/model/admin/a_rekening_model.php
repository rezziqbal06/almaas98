<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `A_Rekening` table
 *
 * @version 5.4.1
 *
 * @package Model\Front
 * @since 1.0.0
 */
class A_Rekening_Model extends \Model\A_Rekening_Concern
{


	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
		$this->point_of_view = 'admin';
	}

	public function getAll()
	{
		return $this->db->where_as("$this->tbl_as.is_deleted", 1, 'AND', '<>')->get('', 0);
	}
}
