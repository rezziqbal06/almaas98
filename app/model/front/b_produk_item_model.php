<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `b_user` table
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

	public function getAll($is_active = 1, $b_produk_id = '')
	{

		$this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->where('bpi.is_active', $is_active);
		$this->db->where('bpi.is_deleted', $this->db->esc(0));
		if (strlen($b_produk_id)) $this->db->where_as('bpi.b_produk_id', $this->db->esc($b_produk_id));
		return $this->db->get('', 0);
	}

	public function getPopular($is_active = 1)
	{
		$this->db->select_as($this->tbl_as . '.id', "id", 0)
			->select_as($this->tbl_as . '.slug', "slug", 0)
			->select_as($this->tbl_as . '.gambar', "gambar", 0)
			->select_as($this->tbl_as . '.nama', "nama", 0)
			->select('luas_tanah')
			->select('luas_bangunan')
			->select('harga')
			->select('toilet')
			->select('kamar_tidur')
			->select_as("$this->tbl2_as.nama", "kawasan", 0)
			->select('a_kategori_id');
		$this->db->from("$this->tbl", "$this->tbl_as");
		$this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "a_kategori_id");
		$this->db->where_as($this->tbl_as . '.is_active', $this->db->esc($is_active));
		$this->db->where_as($this->tbl_as . '.is_deleted', $this->db->esc(0));
		$this->db->order_by($this->tbl_as . '.count_read', 'desc');
		return $this->db->get('', 0);
	}


	public function getTersedia($b_produk_id)
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
		if (strlen($b_produk_id)) $this->db->where_as("$this->tbl_as.b_produk_id", $this->db->esc($b_produk_id), "AND", "=");
		$this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
		$this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
		return $this->db->get('', 0);
	}
}
