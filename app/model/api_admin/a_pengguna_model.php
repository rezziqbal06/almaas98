<?php

namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `front` model for `a_pengguna` table
 *
 * @version 5.4.1
 *
 * @package Model\Front
 * @since 1.0.0
 */
class A_Pengguna_Model extends \Model\A_Pengguna_Concern
{
  public $tbl2 = 'a_jabatan';
  public $tbl2_as = 'j';
  public function __construct()
  {
    parent::__construct();
    $this->db->from($this->tbl, $this->tbl_as);
    $this->point_of_view = 'admin';
  }

  private function filters($a_pengguna_id = '', $keyword = '', $is_active = '', $a_unit_id = '')
  {
    if (strlen($a_pengguna_id)) {
      $this->db->where_as("$this->tbl_as.a_pengguna_id", $this->db->esc($a_pengguna_id));
    }
    if (strlen($is_active)) {
      $this->db->where_as("$this->tbl_as.is_active", $this->db->esc($is_active));
    }
    if (strlen($a_unit_id)) {
      $this->db->where_as("$this->tbl_as.a_unit_id", $this->db->esc($a_unit_id));
    }
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.nama", $keyword, "OR", "%like%", 1, 0);
      $this->db->where_as("$this->tbl_as.telp_hp", $keyword, "AND", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.a_jabatan_nama", $keyword, "AND", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.alamat", $keyword, "AND", "%like%", 0, 1);
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

  public function data($a_pengguna_id = "", $page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = '', $is_active = '', $a_unit_id = '')
  {
    $this->datatables[$this->point_of_view]->selections($this->db);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->filters($a_pengguna_id, $keyword, $is_active, $a_unit_id)->scoped();
    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }

  public function count($a_pengguna_id = '', $keyword = '', $is_active = '', $a_unit_id = '')
  {
    $this->db->select_as("COUNT($this->tbl_as.id)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->filters($a_pengguna_id, $keyword, $is_active, $a_unit_id)->scoped();
    $d = $this->db->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }

  public function checkusername($username, $id = 0)
  {
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->where("username", $username);
    if (!empty($id)) {
      $this->db->where("id", $id, 'AND', '!=');
    }
    $d = $this->db->from($this->tbl)->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }
  public function checktelp_hp($username, $id = 0)
  {
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->where("telp_hp", $username);
    if (!empty($id)) {
      $this->db->where("id", $id, 'AND', '!=');
    }
    $d = $this->db->from($this->tbl)->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }
  public function checkemail($email, $id = 0)
  {
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->where("email", $email);
    if (!empty($id)) {
      $this->db->where("id", $id, 'AND', '!=');
    }
    $d = $this->db->from($this->tbl)->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }
  public function checknamaperusahaan($np, $id = 0)
  {
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->where("nama_perusahaan", $np);
    if (!empty($id)) {
      $this->db->where("id", $id, 'AND', '!=');
    }
    $d = $this->db->from($this->tbl)->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }
  public function checkKode($id = 0)
  {
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->where("id", $id);
    $d = $this->db->from($this->tbl)->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }

  public function getByAgen($agen_id = "", $page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = "", $a_unit_id = "", $edate = "")
  {
    $this->db->flushQuery();
    $this->db->select('id')
      ->select('nama')
      ->select('telp_hp')
      ->select('alamat')
      ->select('provinsi')
      ->select('kabkota')
      ->select('kecamatan')
      ->select('kodepos')
      ->select('is_active');
    $this->db->from($this->tbl, $this->tbl_as);
    if (strlen($agen_id)) $this->db->where("a_pengguna_id", $agen_id);
    if (strlen($keyword) > 1) {
      $this->db->where("telp_hp", $keyword, "OR", "%like%", 1, 0);
      $this->db->where("nama", $keyword, "OR", "%like%", 0, 1);
    }
    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }
  public function countByAgen($agen_id = "", $keyword = "", $a_unit_id = "", $edate = "")
  {
    $this->db->flushQuery();
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where("is_karyawan", 0);
    if (strlen($agen_id)) $this->db->where("a_pengguna_id", $agen_id);
    if (strlen($keyword) > 1) {
      $this->db->where("telp_hp", $keyword, "OR", "%like%", 1, 0);
      $this->db->where("nama", $keyword, "OR", "%like%", 0, 1);
    }
    $d = $this->db->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }
  public function getKaryawan($page = 0, $pagesize = 10, $sortCol = "id", $sortDir = "ASC", $keyword = "", $a_unit_id = "", $edate = "")
  {
    $this->db->flushQuery();
    $this->db->select('id')
      ->select('nip')
      ->select('nama')
      ->select('a_jabatan_nama')
      ->select('a_company_nama')
      ->select('karyawan_status')
      ->select('is_active');
    $this->db->from($this->tbl, $this->tbl_as);
    if (strlen($a_unit_id)) {
      $this->db->where("a_unit_id", $a_unit_id);
    }
    if (strlen($keyword) > 0) {
      $this->db->where("username", $keyword, "OR", "%like%", 1, 0);
      $this->db->where("nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where("a_jabatan_nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where("a_company_nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where("email", $keyword, "OR", "%like%", 0, 1);
    }
    $this->db->order_by($sortCol, $sortDir)->limit($page, $pagesize);
    return $this->db->get("object", 0);
  }
  public function countKaryawan($keyword = "", $a_unit_id = "", $edate = "")
  {
    $this->db->flushQuery();
    $this->db->select_as("COUNT(*)", "jumlah", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where("is_karyawan", 1);
    if (strlen($a_unit_id)) {
      $this->db->where("a_unit_id", $a_unit_id);
    }
    if (strlen($keyword) > 0) {
      $this->db->where("username", $keyword, "OR", "%like%", 1, 0);
      $this->db->where("nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where("a_jabatan_nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where("a_company_nama", $keyword, "OR", "%like%", 0, 0);
      $this->db->where("email", $keyword, "OR", "%like%", 0, 1);
    }
    $d = $this->db->get_first("object", 0);
    if (isset($d->jumlah)) {
      return $d->jumlah;
    }
    return 0;
  }

  public function cari($keyword = "")
  {
    $this->db->select_as("$this->tbl_as.id", "id", 0);
    $this->db->select_as("$this->tbl_as.nama", "text", 0);
    // $this->db->select_as("CONCAT($this->tbl_as.nama,' - ', $this->tbl_as.email)", "text", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    if (strlen($keyword) > 0) {
      $this->db->where_as("$this->tbl_as.nama", ($keyword), "OR", "LIKE%%", 1, 0);
      $this->db->where_as("$this->tbl_as.username", ($keyword), "OR", "LIKE%%", 0, 0);
      $this->db->where_as("$this->tbl_as.email", ($keyword), "OR", "LIKE%%", 0, 1);
    }
    $this->db->where_as("$this->tbl_as.is_active", 1);
    $this->db->where_as("$this->tbl_as.is_deleted", $this->db->esc(0));

    $this->db->order_by("$this->tbl_as.nama", "asc");
    return $this->db->get('', 0);
  }

  public function getByNameAndtelp_hp($name = "", $telp_hp = "")
  {
    $this->db->flushQuery();
    $this->db->select('id')
      ->select('nama')
      ->select('telp_hp')
      ->select('alamat')
      ->select('provinsi')
      ->select('kabkota')
      ->select('kecamatan')
      ->select('kodepos')
      ->select('is_active');
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where("telp_hp", $telp_hp, "OR", "%like%", 1, 0);
    $this->db->where("nama", $name, "OR", "%like%", 0, 1);
    return $this->db->get_first("", 0);
  }
  public function cari_alamat($keyword = '')
  {
    $this->db->select_as("CONCAT($this->tbl_as.nama, ' | ',$this->tbl_as.provinsi,' - ',$this->tbl_as.kabkota,' - ',$this->tbl_as.kecamatan,' - ',$this->tbl_as.kelurahan,' - ',$this->tbl_as.kodepos,' - ',$this->tbl_as.kode_origin)", "text", 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->join($this->tbl2, $this->tbl2_as, 'id', $this->tbl_as, 'a_pengguna_id', 'left');
    if (strlen($keyword)) {
      $this->db->where_as("$this->tbl_as.nama", $keyword, "OR", "%like%", 1, 0);
      $this->db->where_as("$this->tbl_as.kelurahan", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.kecamatan", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.kabkota", $keyword, "OR", "%like%", 0, 0);
      $this->db->where_as("$this->tbl_as.provinsi", $keyword, "OR", "%like%", 0, 1);
    }
    $this->db->limit(5);
    return $this->db->get('', 0);
  }

  public function check_apikey($apikey)
  {
    $this->db->select('apikey');
    $this->db->where('apikey', $apikey);
    $d = $this->db->get_first('', 0);
    if (isset($d->apikey)) {
      return 1;
    }
    return 0;
  }
  public function getYangAdaNotifnya()
  {
    $this->db->select_as("$this->tbl_as.nama", 'nama', 0);
    $this->db->select_as("$this->tbl_as.fcm_token", 'fcm_token', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where_as("fcm_token", "", "AND", "!=");
    return $this->db->get();
  }

  public function getFcmTokenByJabatan($a_jabatan_nama)
  {
    $this->db->select_as("$this->tbl_as.nama", 'nama', 0);
    $this->db->select_as("$this->tbl_as.fcm_token", 'fcm_token', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where_as("a_jabatan_nama", $this->db->esc($a_jabatan_nama));
    $this->db->where_as("fcm_token", "", "AND", "!=");
    return $this->db->get();
  }

  public function getFcmTokenById($id)
  {
    $this->db->select_as("$this->tbl_as.nama", 'nama', 0);
    $this->db->select_as("$this->tbl_as.fcm_token", 'fcm_token', 0);
    $this->db->from($this->tbl, $this->tbl_as);
    $this->db->where_as("id", $this->db->esc($id));
    $this->db->where_as("fcm_token", "", "AND", "!=");
    return $this->db->get();
  }
}
