<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `C_Jadwal` table
 *
 * @version 5.4.1
 *
 * @package Model\Front
 * @since 1.0.0
 */
class C_Jadwal_Model extends \Model\C_Jadwal_Concern
{


	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
		$this->point_of_view = 'admin';
	}


	private function join_company()
	{
		$this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_pengguna_id', 'left');
		$this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'a_kategori_id', 'left');

		return $this;
	}

	private function joins()
	{
		$this->db->from($this->tbl, $this->tbl_as);
		$this->join_company();

		return $this;
	}

	public function getAll()
	{
		return $this->db->where_as("$this->tbl_as.is_deleted", 1, 'AND', '<>')->get('', 0);
	}

	public function getHariIni($day = 1)
	{
		$this->db->select_as("$this->tbl_as.id", 'id', 0);
		$this->db->select_as("$this->tbl2_as.nama", 'nama', 0);
		$this->db->select_as("$this->tbl3_as.nama", 'kawasan', 0);
		$this->joins();
		if (strlen($day)) $this->db->where_as("$this->tbl_as.day", $day, "AND");
		$this->db->where("$this->tbl_as.is_deleted", $this->db->esc('0'));
		$this->db->order_by("$this->tbl3_as.nama", 'asc');
		return $this->db->get("object", 0);
	}
}
