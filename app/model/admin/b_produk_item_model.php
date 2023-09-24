<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `B_Produk_Item` table
 *
 * @version 5.4.1
 *
 * @package Model\Front
 * @since 1.0.0
 */
class B_Produk_Item_Model extends \Model\B_Produk_Item_Concern
{


	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
		$this->point_of_view = 'admin';
	}

	public function getAll()
	{
		$this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
		$this->db->select_as("$this->tbl2_as.harga", 'harga', 0);
		$this->db->select_as("$this->tbl3_as.nama", 'kawasan', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "b_produk_id", "left");
		$this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl2_as, "a_kategori_id", "left");
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		return $this->db->get('', 0);
	}

	public function countAll()
	{
		$this->db->select_as("COUNT(*)", 'jumlah', 0);
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		$d = $this->db->get_first("object", 0);
		if (isset($d->jumlah)) {
			return $d->jumlah;
		}
		return 0;
	}

	public function getByKawasan($id)
	{
		$this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
		$this->db->select_as("$this->tbl2_as.harga", 'harga', 0);
		$this->db->select_as("$this->tbl2_as.luas_tanah", 'luas_tanah', 0);
		$this->db->select_as("$this->tbl2_as.luas_bangunan", 'luas_bangunan', 0);
		$this->db->select_as("$this->tbl2_as.kamar_tidur", 'kamar_tidur', 0);
		$this->db->select_as("$this->tbl2_as.toilet", 'toilet', 0);
		$this->db->select_as("$this->tbl2_as.lantai", 'lantai', 0);
		$this->db->select_as("$this->tbl2_as.tipe", 'tipe', 0);
		$this->db->select_as("$this->tbl2_as.garasi", 'garasi', 0);
		$this->db->select_as("$this->tbl2_as.harga", 'harga', 0);
		$this->db->select_as("$this->tbl3_as.nama", 'kawasan', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "b_produk_id", "left");
		$this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl2_as, "a_kategori_id", "left");
		$this->db->where_as("$this->tbl2_as.a_kategori_id", $this->db->esc($id), "AND", "=");
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		return $this->db->get('', 0);
	}

	public function getTersedia()
	{
		$this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
		$this->db->select_as("CONCAT('Blok ', $this->tbl_as.blok, ' ', $this->tbl_as.nomor,' - ', $this->tbl_as.posisi)", 'unit', 0);
		$this->db->select_as("$this->tbl2_as.harga", 'harga', 0);
		$this->db->select_as("$this->tbl2_as.tipe", 'tipe', 0);
		$this->db->select_as("$this->tbl2_as.luas_tanah", 'luas_tanah', 0);
		$this->db->select_as("$this->tbl2_as.luas_bangunan", 'luas_bangunan', 0);
		$this->db->select_as("$this->tbl2_as.lantai", 'lantai', 0);
		$this->db->select_as("$this->tbl3_as.nama", 'kawasan', 0);
		$this->db->select_as("COALESCE($this->tbl5_as.id, null)", 'order_unit_id', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "b_produk_id", "left");
		$this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl2_as, "a_kategori_id", "left");
		$this->db->join($this->tbl5, $this->tbl5_as, "b_produk_id", $this->tbl_as, "id", "left");
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		return $this->db->get('', 0);
	}
}
