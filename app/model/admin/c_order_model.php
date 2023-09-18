<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `C_Order` table
 *
 * @version 5.4.1
 *
 * @package Model\Front
 * @since 1.0.0
 */
class C_Order_Model extends \Model\C_Order_Concern
{


	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
		$this->point_of_view = 'admin';
	}

	public function getAll()
	{
		$this->db->where('is_active', 1);
		return $this->db->get('');
	}


	public function countAll($status = "")
	{
		$this->db->select_as("COUNT(*)", 'jumlah', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		if (strlen($status)) $this->db->where_as("$this->tbl_as.status", $this->db->esc($status));
		$this->db->order_by("$this->tbl_as.id", "desc");
		$d = $this->db->get_first("object", 0);
		if (isset($d->jumlah)) {
			return $d->jumlah;
		}
		return 0;
	}

	public function getAllOrders()
	{
		$this->db->select_as("SUM($this->tbl_as.total_harga)", 'total', 0);
		$this->db->select_as("MAX($this->tbl_as.b_user_id)", 'b_user_id', 0);
		$this->db->select_as("MAX($this->tbl_as.status)", 'status', 0);
		$this->db->select_as("$this->tbl_as.metode", 'metode', 0);
		$this->db->select_as("$this->tbl2_as.b_produk_id", 'b_produk_id', 0);
		$this->db->select_as("$this->tbl3_as.harga", 'harga', 0);
		$this->db->select_as("$this->tbl6_as.posisi", 'posisi', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->join($this->tbl2, $this->tbl2_as, 'c_order_id', $this->tbl_as, 'id', 'left');
		$this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl2_as, 'b_produk_id', 'left');
		$this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl6_as, 'b_produk_id', 'left');
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		$this->db->group_by("CONCAT($this->tbl_as.b_user_id,'-',$this->tbl2_as.b_produk_id)");
		return $this->db->get("", 0);
	}

	public function chart($status = "")
	{
		$this->db->select_as("COUNT(*)", 'jumlah', 0);
		$this->db->select_as("DATE_FORMAT($this->tbl_as.tgl_pesan, '%b')", 'bulan', 0);
		$this->db->select_as("SUM($this->tbl_as.total_harga)", 'omset', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		$this->db->where_as("YEAR($this->tbl_as.tgl_pesan)", "YEAR(" . $this->db->esc(date("Y-m-d")) . ")");
		if (strlen($status)) $this->db->where_as("$this->tbl_as.status", $this->db->esc($status));
		$this->db->group_by("MONTH($this->tbl_as.tgl_pesan)");
		return $this->db->get("", 0);
	}
}
