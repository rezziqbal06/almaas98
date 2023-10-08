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
class C_Order_Model extends \Model\C_Order_Concern
{
  public function __construct()
  {
    parent::__construct();
    $this->db->from($this->tbl, $this->tbl_as);
    $this->point_of_view = 'admin';
  }

  private function filters($a_pengguna_id = '', $keyword = '', $is_active = '')
  {
    if (strlen($a_pengguna_id)) {
      $this->db->where_as("$this->tbl_as.a_pengguna_id", $this->db->esc($a_pengguna_id));
    }
    if (strlen($is_active)) {
      $this->db->where_as("$this->tbl_as.is_active", $this->db->esc($is_active));
    }
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.kode", $keyword, "OR", "%like%", 1, 0);
      $this->db->where_as("$this->tbl_as.total_harga", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.status", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl5_as.fnama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl3_as.nama", $keyword, "AND", "%like%", 0, 1);
    }
    return $this;
  }

  private function join_company()
  {
    $this->db->join($this->tbl2, $this->tbl2_as, 'c_order_id', $this->tbl_as, 'id', 'left'); //c_order_produk
    $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl_as, 'b_user_id', 'left');
    $this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl2_as, 'b_produk_id', 'left');
    $this->db->join($this->tbl7, $this->tbl7_as, 'id', $this->tbl_as, 'a_pengguna_id', 'left');
    $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl6_as, 'b_produk_id', 'left'); //b_produk_id
    $this->db->join($this->tbl8, $this->tbl8_as, 'id', $this->tbl3_as, 'a_kategori_id', 'left'); //a_kategori_id
    $this->db->join($this->tbl9, $this->tbl9_as, 'id', $this->tbl2_as, 'a_kategori_id', 'left'); //a_kategori_id
    return $this;
  }



  public function data($a_pengguna_id, $page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '')
  {
    $this->datatables[$this->point_of_view]->selections($this->db);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->filters($a_pengguna_id, $keyword, $is_active)->scoped();
    $this->db->group_by("$this->tbl_as.id")->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }

  public function count($a_pengguna_id = '', $keyword = '', $is_active = '')
  {
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->filters($a_pengguna_id, $keyword, $is_active)->scoped();
    // $this->db->group_by("$this->tbl_as.kode");
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

  public function countByUser($b_user_id = '', $is_deleted = 0)
  {
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where_as("$this->tbl_as.b_user_id", $this->db->esc($b_user_id));
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc($is_deleted));
    $d = $this->db->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }


  public function omset($a_kategori_id = '', $sdate = '', $edate = '')
  {
    $this->db->select_as("COUNT(*)", 'jumlah', 0);
    $this->db->select_as("DATE_FORMAT($this->tbl_as.tgl_pesan, '%M')", 'bulan', 0);
    $this->db->select_as("SUM($this->tbl_as.total_harga)", 'omset', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
    $this->db->where_as("YEAR($this->tbl_as.tgl_pesan)", "YEAR(" . $this->db->esc(date("Y-m-d")) . ")");
    if (strlen($a_kategori_id)) $this->db->where_as("$this->tbl3_as.a_kategori_id", $this->db->esc($a_kategori_id));
    if (strlen($sdate) == 10 && strlen($edate) == 10) {
      $this->db->between("DATE($this->tbl_as.tgl_pesan)", 'DATE("' . $sdate . '")', 'DATE("' . $edate . '")');
    } elseif (strlen($sdate) != 10 && strlen($edate) == 10) {
      $this->db->where_as("DATE($this->tbl_as.tgl_pesan)", 'DATE("' . $edate . '")', "AND", '<=');
    } elseif (strlen($sdate) == 10 && strlen($edate) != 10) {
      $this->db->where_as("DATE($this->tbl_as.tgl_pesan)", 'DATE("' . $sdate . '")', "AND", '>=');
    }
    $this->db->group_by("MONTH($this->tbl_as.tgl_pesan)");
    return $this->db->get("", 0);
  }

  public function unitTerjual($a_kategori_id = '', $sdate = '', $edate = '')
  {
    $this->db->select_as("COALESCE(CONCAT('Blok ', $this->tbl6_as.blok, ' ', $this->tbl6_as.nomor,' - ', $this->tbl6_as.posisi), CONCAT('Blok ', $this->tbl2_as.blok, ' ', $this->tbl2_as.nomor))", 'unit', 0);
    $this->db->select_as("$this->tbl6_as.id", 'unit_id', 0);
    $this->db->select_as("COALESCE($this->tbl6_as.nomor, $this->tbl2_as.nomor)", 'nomor', 0);
    $this->db->select_as("COALESCE($this->tbl6_as.blok, $this->tbl2_as.blok)", 'blok', 0);
    $this->db->select_as("$this->tbl6_as.posisi", 'posisi', 0);
    $this->db->select_as("$this->tbl3_as.tipe", 'tipe', 0);
    $this->db->select_as("COALESCE($this->tbl3_as.luas_tanah, $this->tbl2_as.lt,'')", 'luas_tanah', 0);
    $this->db->select_as("COALESCE($this->tbl3_as.luas_bangunan, $this->tbl2_as.lb,'')", 'luas_bangunan', 0);
    $this->db->select_as("$this->tbl3_as.lantai", 'lantai', 0);
    $this->db->select_as("COALESCE($this->tbl8_as.nama, $this->tbl9_as.nama)", 'kawasan', 0);
    $this->db->select_as("$this->tbl7_as.nama", 'marketing', 0);
    $this->db->select_as("$this->tbl5_as.fnama", 'konsumen', 0);
    $this->db->select_as("$this->tbl5_as.sumber_iklan", 'sumber_iklan', 0);
    $this->db->select_as("$this->tbl_as.tgl_pesan", 'tgl_pesan', 0);
    $this->db->select_as("$this->tbl_as.status", 'status', 0);
    $this->db->select_as("$this->tbl_as.total_harga", 'total_harga', 0);
    $this->db->select_as("$this->tbl2_as.harga_satuan", 'harga_satuan', 0);
    $this->db->select_as("$this->tbl2_as.is_custom", 'is_custom', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
    if (strlen($a_kategori_id)) $this->db->where_as("$this->tbl3_as.a_kategori_id", $this->db->esc($a_kategori_id));
    if (strlen($sdate) == 10 && strlen($edate) == 10) {
      $this->db->between("DATE($this->tbl_as.tgl_pesan)", 'DATE("' . $sdate . '")', 'DATE("' . $edate . '")');
    } elseif (strlen($sdate) != 10 && strlen($edate) == 10) {
      $this->db->where_as("DATE($this->tbl_as.tgl_pesan)", 'DATE("' . $edate . '")', "AND", '<=');
    } elseif (strlen($sdate) == 10 && strlen($edate) != 10) {
      $this->db->where_as("DATE($this->tbl_as.tgl_pesan)", 'DATE("' . $sdate . '")', "AND", '>=');
    }
    $this->db->order_by("$this->tbl_as.status", 'desc');
    return $this->db->get("", 0);
  }
}
