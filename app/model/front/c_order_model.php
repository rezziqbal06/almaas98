<?php

namespace Model\Front;

register_namespace(__NAMESPACE__);
/**
 * Scoped `api_front` model for `c_order` table
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
        $this->point_of_view = 'front';
    }

    private function _filter($b_user_id = '', $keyword = '', $is_active = '', $sdate = '', $edate = '', $service = "", $b_user_id_agen = '')
    {
        if (strlen($b_user_id)) $this->db->where_as("$this->tbl_as.b_user_id", $this->db->esc($b_user_id));
        if (strlen($b_user_id_agen)) $this->db->where_as("$this->tbl_as.b_user_id_agen", $this->db->esc($b_user_id_agen));
        if (strlen($sdate) == 10 && strlen($edate) == 10) {
            $this->db->between("DATE($this->tbl_as.cdate)", 'DATE("' . $sdate . '")', 'DATE("' . $edate . '")');
        } elseif (strlen($sdate) == 10 && strlen($edate) != 10) {
            $this->db->where_as("DATE($this->tbl_as.cdate)", 'DATE("' . $sdate . '")', 'AND', '>=', 0, 0);
        } elseif (strlen($sdate) != 10 && strlen($edate) == 10) {
            $this->db->where_as("DATE($this->tbl_as.cdate)", 'DATE("' . $edate . '")', 'AND', '<=', 0, 0);
        }
        if (strlen($is_active)) {
            $this->db->where_as("$this->tbl_as.is_active", $this->db->esc($is_active));
        }
        if (strlen($service)) {
            $this->db->where_as("$this->tbl_as.service", $this->db->esc($service));
        }
        if (strlen($keyword) > 0) {
            $this->db->where("no_resi", $keyword, "OR", "%like%", 1, 0);
            $this->db->where_as("$this->tbl_as.kode", $keyword, "OR", "%like%", 0, 0);
            $this->db->where("waktu_pickup", $keyword, "OR", "%like%", 0, 0);
            $this->db->where("$this->tbl_as.telp", $keyword, "OR", "%like%", 0, 0);
            $this->db->where_as("COALESCE($this->tbl2_as.fnama,'-')", $keyword, "OR", "%like%", 0, 0);
            $this->db->where("tgl_pickup", $keyword, "OR", "%like%", 0, 1);
        }
        return $this;
    }

    public function data($b_user_id = '', $page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '', $sdate = "", $edate = "", $service = "")
    {
        $this->datatables['download']->selections($this->db);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'b_user_id', 'left');
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl_as, 'b_user_id_penerima', 'left');
        $this->db->join($this->tbl4, $this->tbl4_as, 'b_user_id', $this->tbl2_as, 'id', 'left');
        $this->db->join($this->tbl5, $this->tbl5_as, 'b_user_id', $this->tbl3_as, 'id', 'left');
        $this->scoped()->_filter($b_user_id, $keyword, $is_active, $sdate, $edate, $service);
        $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
        return $this->db->get("object", 0);
    }

    public function getByKode($kode)
    {
        $this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
        $this->db->select_as("$this->tbl5_as.fnama", 'b_user_nama', 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl_as, 'b_user_id', 'left');
        $this->db->where_as("$this->tbl_as.kode", $this->db->esc($kode));
        return $this->db->get_first();
    }

    public function getByUser($id)
    {
        $this->db->select_as("$this->tbl_as.*, $this->tbl_as.id", 'id', 0);
        $this->db->select_as("$this->tbl6_as.blok", 'blok', 0);
        $this->db->select_as("$this->tbl6_as.nomor", 'nomor', 0);
        $this->db->select_as("$this->tbl6_as.posisi", 'posisi', 0);
        $this->db->select_as("$this->tbl3_as.tipe", 'tipe', 0);
        $this->db->select_as("$this->tbl3_as.gambar", 'gambar_produk', 0);
        $this->db->from($this->tbl, $this->tbl_as);
        $this->db->join($this->tbl2, $this->tbl2_as, 'c_order_id', $this->tbl_as, 'id', 'left'); //c_order_produk
        $this->db->join($this->tbl6, $this->tbl6_as, 'id', $this->tbl2_as, 'b_produk_id', 'left'); //b_produk_item
        $this->db->join($this->tbl3, $this->tbl3_as, 'id', $this->tbl6_as, 'b_produk_id', 'left'); //b_produk
        $this->db->join($this->tbl5, $this->tbl5_as, 'id', $this->tbl_as, 'b_user_id', 'left');
        $this->db->where_as("$this->tbl_as.b_user_id", $this->db->esc($id));
        return $this->db->get();
    }

    public function getAllOrders($b_user_id)
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
        $this->db->where_as("$this->tbl_as.b_user_id", $this->db->esc($b_user_id));
        $this->db->where_as("$this->tbl_as.is_active", 1, "AND", "=");
        $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0), "AND", "=");
        $this->db->group_by("CONCAT($this->tbl_as.b_user_id,'-',$this->tbl2_as.b_produk_id)");
        return $this->db->get("", 0);
    }
}
