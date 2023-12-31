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
class B_produk_Item_Model extends \Model\B_produk_Item_Concern
{
  public function __construct()
  {
    parent::__construct();
    $this->db->from($this->tbl, $this->tbl_as);
    $this->point_of_view = 'admin';
  }

  private function filters($keyword = '', $is_active = '')
  {
    // if (strlen($b_user_id)) {
    //   $this->db->where_as("$this->tbl_as.b_user_id", $this->db->esc($b_user_id));
    // }
    if (strlen($is_active)) {
      $this->db->where_as("$this->tbl_as.is_active", $this->db->esc($is_active));
    }
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.blok", $keyword, "OR", "%like%", 1, 0);
      $this->db->where_as("$this->tbl_as.nomor", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.posisi", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl3_as.nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl2_as.luas_bangunan", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl2_as.luas_tanah", $keyword, "AND", "%like%", 0, 1);
    }
    return $this;
  }

  private function join_company()
  {
    $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_produk_id', 'left');
    $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl2_as, 'a_kategori_id', 'left');

    return $this;
  }

  private function joins()
  {
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();

    return $this;
  }

  public function data($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '')
  {
    $this->datatables[$this->point_of_view]->selections($this->db);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->filters($keyword, $is_active)->scoped();
    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }

  public function count($b_user_id = '', $keyword = '', $is_active = '')
  {
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->filters($keyword, $is_active)->scoped();
    $d = $this->db->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }
  public function setMass($dis)
  {
    return $this->db->insert_multi($this->tbl, $dis);
  }

  public function cari($keyword = "")
  {
    $this->db->select_as("$this->tbl_as.id", "id", 0);
    $this->db->select_as("$this->tbl_as.nama", "text", 0);
    // $this->db->select_as("CONCAT($this->tbl_as.fnama,' - ', $this->tbl_as.email)", "text", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->join_company();
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.nama", ($keyword), "OR", "LIKE%%", 1, 0);
      $this->db->where_as("$this->tbl2_as.nama", ($keyword), "OR", "LIKE%%", 0, 1);
    }
    $this->db->order_by("$this->tbl_as.nama", "asc");
    return $this->db->get('', 0);
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
