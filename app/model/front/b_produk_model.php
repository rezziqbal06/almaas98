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
class B_Produk_Model extends \Model\B_Produk_Concern
{


	public function __construct()
	{
		parent::__construct();
		$this->db->from($this->tbl, $this->tbl_as);
		$this->point_of_view = 'admin';
	}

	public function getAll($is_active = 1, $is_all_columns = 0)
	{
		if ($is_all_columns) {
			$this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
		} else {
			$this->db->select_as('bp.id', 'id')->select_as('bp.nama', 'nama')->select_as('bp.slug', 'slug')->select_as('bp.gambar', 'gambar')->select_as('bp.a_kategori_id', 'a_kategori_id')->select_as('ak.nama', 'a_kategori_nama');
		}
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->join('a_kategori', 'ak', 'id', 'bp', 'a_kategori_id', 'left');
		$this->db->where('bp.is_active', $is_active);
		$this->db->where('bp.is_deleted', $this->db->esc(0));
		$this->db->order_by('bp.a_kategori_id', 'asc');
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

	public function getBySlug($slug = '')
	{
		$this->db->select_as($this->tbl_as . '.id', "id", 0)
			->select_as($this->tbl_as . '.slug', "slug", 0)
			->select_as($this->tbl_as . '.gambar', "gambar", 0)
			->select_as($this->tbl_as . '.nama', "nama", 0)
			->select_as($this->tbl_as . '.deskripsi', "deskripsi", 0)
			->select_as($this->tbl3_as . '.gambar', "three_d", 0)
			->select('luas_tanah')
			->select('luas_bangunan')
			->select('harga')
			->select('toilet')
			->select('kamar_tidur')
			->select_as("$this->tbl2_as.nama", "kawasan", 0)
			->select('a_kategori_id');
		$this->db->from("$this->tbl", "$this->tbl_as");
		$this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "a_kategori_id");
		$this->db->join($this->tbl3, $this->tbl3_as, "id", $this->tbl_as, "a_three_d_id");
		if (strlen($slug)) $this->db->where($this->tbl_as . '.slug', $slug);
		return $this->db->get_first('', 0);
	}

	public function getByKategori($a_kategori_id = '', $id = '')
	{
		$this->db->select('id')->select('nama')->select('slug')->select('gambar')->select('a_kategori_id');
		if (strlen($a_kategori_id)) $this->db->where('a_kategori_id', $a_kategori_id);
		if (strlen($id)) $this->db->where('id', $id, 'AND', '<>');
		$this->db->where('is_active', 1);
		$this->db->where('is_deleted', $this->db->esc(0));
		return $this->db->get('', 0);
	}

	public function getAllPermit($a_jabatan_id, $b_user_id, $type = "create")
	{
		$this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
		$this->db->from($this->tbl, $this->tbl_as);
		$this->db->join($this->tbl2, $this->tbl2_as, "a_kategori_id", $this->tbl_as, "id");
		$this->db->where("$this->tbl2_as.type", $type);
		$this->db->where_as("$this->tbl2_as.a_jabatan_id", $a_jabatan_id, 'OR', '=', 1, 0);
		$this->db->where_as("$this->tbl2_as.b_user_id", $b_user_id, 'OR', '=', 0, 1);
		$this->db->group_by("$this->tbl_as.id");
		return $this->db->get('', 0);
	}
}
