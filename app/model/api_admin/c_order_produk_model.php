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
class C_Order_Produk_Model extends \Model\C_Order_Produk_Concern
{
  public function __construct()
  {
    parent::__construct();
    $this->db->from($this->tbl, $this->tbl_as);
    $this->point_of_view = 'admin';
  }

  private function filters($c_order_id = "", $keyword = '', $is_active = '')
  {
    if (strlen($c_order_id)) {
      $this->db->where_as("$this->tbl_as.c_order_id", $this->db->esc($c_order_id));
    }
    if (strlen($is_active)) {
      $this->db->where_as("$this->tbl_as.is_active", $this->db->esc($is_active));
    }
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.kode", $keyword, "OR", "%like%", 1, 0);
      $this->db->where_as("$this->tbl_as.total_harga", $keyword, "AND", "%like%", 0, 0);
      $this->db->where_as("$this->tbl5_as.fnama", $keyword, "AND", "%like%", 0, 0);
      $this->db->where_as("$this->tbl3_as.nama", $keyword, "AND", "%like%", 0, 1);
    }
    return $this;
  }

  private function join_company()
  {
    $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'c_order_id', 'left');
    $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'b_produk_id', 'left');
    $this->db->join($this->tbl4, $this->tbl4_as, 'id', $this->tbl3_as, 'b_produk_id', 'left');
    $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl2_as, 'b_user_id', 'left');
    $this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl2_as, 'a_pengguna_id', 'left');
    $this->db->join($this->tbl7, $this->tbl7_as, 'id', $this->tbl_as, 'a_kategori_id', 'left');
    return $this;
  }



  public function data($c_order_id = "", $page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '')
  {
    $this->datatables[$this->point_of_view]->selections($this->db);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->filters($c_order_id, $keyword, $is_active)->scoped();
    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }

  public function count($c_order_id = '', $keyword = '', $is_active = '')
  {
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->filters($c_order_id, $keyword, $is_active)->scoped();
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


  public function getByOrder($id)
  {
    $this->db->where('c_order_id', $id);
    return $this->db->get();
  }

  public function delByOrder($id)
  {
    $this->db->where('c_order_id', $id);
    return $this->db->delete($this->tbl);
  }

  public function softDelByOrder($id)
  {
    $this->db->where('c_order_id', $id);
    return $this->db->update($this->tbl, ['is_deleted' => 1], 0);
  }

  public function getAllGroupByUser()
  {
    $this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
    $this->db->select_as("$this->tbl5_as.id", 'b_user_id', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
    $this->db->group_by("$this->tbl5_as.id")->order_by("$this->tbl_as.id", "desc");
    return $this->db->get();
  }

  public function getByProduk($produk_id)
  {
    $this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
    $this->db->select_as("$this->tbl2_as.metode_pembayaran", 'metode_pembayaran', 0);
    $this->db->select_as("$this->tbl2_as.diskon", 'diskon', 0);
    $this->db->select_as("$this->tbl5_as.id", 'b_user_id', 0);
    $this->db->select_as("$this->tbl6_as.nama", 'a_pengguna_nama', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->db->where_as("$this->tbl_as.b_produk_id", $produk_id, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
    $this->db->order_by("$this->tbl_as.id", "asc");
    return $this->db->get();
  }

  public function getCustomByUserAndBlok($user_id, $blok)
  {
    $this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
    $this->db->select_as("$this->tbl2_as.metode_pembayaran", 'metode_pembayaran', 0);
    $this->db->select_as("$this->tbl2_as.diskon", 'diskon', 0);
    $this->db->select_as("$this->tbl5_as.id", 'b_user_id', 0);
    $this->db->select_as("$this->tbl6_as.nama", 'a_pengguna_nama', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->db->where_as("$this->tbl5_as.id", $user_id, "AND", "=");
    $this->db->where_as("CONCAT($this->tbl_as.blok,'',$this->tbl_as.nomor)", $this->db->esc($blok), "AND", "=");
    $this->db->where_as("$this->tbl_as.is_custom", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
    $this->db->order_by("$this->tbl_as.id", "asc");
    return $this->db->get();
  }

  public function getCustomByUserGroupByBlok($user_id)
  {
    $this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
    $this->db->select_as("$this->tbl2_as.metode_pembayaran", 'metode_pembayaran', 0);
    $this->db->select_as("$this->tbl2_as.diskon", 'diskon', 0);
    $this->db->select_as("$this->tbl5_as.id", 'b_user_id', 0);
    $this->db->select_as("$this->tbl6_as.nama", 'a_pengguna_nama', 0);
    $this->db->select_as("COALESCE($this->tbl7_as.nama,'')", 'kawasan', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->join_company();
    $this->db->where_as("$this->tbl5_as.id", $user_id, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_custom", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
    $this->db->order_by("$this->tbl_as.id", "asc")->group_by("$this->tbl_as.blok");
    return $this->db->get();
  }
}
