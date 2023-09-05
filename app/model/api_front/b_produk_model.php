<?php

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
    $this->point_of_view = 'front';
  }

  private function filters($keyword = '', $is_active = 1, $is_deleted = 0)
  {
    // if (strlen($b_user_id)) {
    //   $this->db->where_as("$this->tbl_as.b_user_id", $this->db->esc($b_user_id));
    // }
    if (strlen($is_active)) {
      $this->db->where_as("$this->tbl_as.is_active", $this->db->esc($is_active), "AND");
    }

    if (strlen($is_deleted)) {
      $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc($is_deleted), "AND");
    }
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.nama", $keyword, "OR", "%like%", 1, 0);
      $this->db->where_as("$this->tbl_as.luas_tanah", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.luas_bangunan", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.harga", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.tipe", $keyword, "AND", "%like%", 0, 1);
    }
    return $this;
  }

  private function join_company()
  {
    $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'a_unit_id', 'left');

    return $this;
  }

  private function joins()
  {
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();

    return $this;
  }

  public function data($b_user_id = "", $page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '')
  {
    $this->datatables[$this->point_of_view]->selections($this->db);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->filters($b_user_id, $keyword, $is_active)->scoped();
    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }

  public function count($b_user_id = '', $keyword = '', $is_active = '')
  {
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->filters($b_user_id, $keyword, $is_active)->scoped();
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

  public function getBySlug($slug)
  {
    $this->db->where('slug', $slug);
    return $this->db->get_first('', 0);
  }

  public function getByKategori($id)
  {
    if ($id != "all") $this->db->where('a_kategori_id', $id);
    $this->db->where('is_deleted', $this->db->esc(0));
    return $this->db->get('', 0);
  }

  public function getAll($keyword, $is_active = 1)
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
      ->select_as("COALESCE($this->tbl2_as.nama,'')", "kawasan", 0)
      ->select('a_kategori_id');
    $this->db->from("$this->tbl", "$this->tbl_as");
    $this->db->join($this->tbl2, $this->tbl2_as, "id", $this->tbl_as, "a_kategori_id");
    $this->filters($keyword, $is_active)->scoped();
    $this->db->order_by($this->tbl_as . '.count_read', 'desc');
    return $this->db->get('', 0);
  }
}
