<?php

namespace Model;

register_namespace(__NAMESPACE__);
/**
 * Define all general method(s) and constant(s) for B_Produk table,
 *   can be inherited a Concern class also can be reffered as class constants
 *
 * @version 1.0.0
 *
 * @package Model\B_User
 * @since 1.0.0
 */
class C_Order_Concern extends \JI_Model
{
    public $tbl = 'c_order';
    public $tbl_as = 'co';
    public $tbl2 = 'c_order_produk';
    public $tbl2_as = 'cop';
    public $tbl3 = 'b_produk';
    public $tbl3_as = 'bp';
    public $tbl4 = 'b_produk_harga';
    public $tbl4_as = 'bph';
    public $tbl5 = 'b_user';
    public $tbl5_as = 'bu';
    public $tbl6 = 'b_produk_item';
    public $tbl6_as = 'bpi';
    public $tbl7 = 'a_pengguna';
    public $tbl7_as = 'ap';
    public $tbl8 = 'a_kategori';
    public $tbl8_as = 'ak';
    public $tbl9 = 'a_kategori';
    public $tbl9_as = 'ak2';

    const COLUMNS = [
        'kode',
        'b_user_id',
        'a_pengguna_id',
        'a_rekening_id',
        'tgl_pesan',
        'tgl_selesai',
        'cdate',
        'status',
        'total_harga',
        'metode',
        'metode_pembayaran',
        'diskon',
        'gambar',
        'catatan',
        'kunjungan_ke',
        'is_setor',
        'is_active',
        'is_deleted',
    ];
    const DEFAULTS = [
        0,
        0,
        0,
        0,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        1,
        0,
    ];
    const REQUIREDS = [
        'b_user_id',
        'tgl_pesan'
    ];
    const ALPHABET = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * Install HTML bootstrap label into certain columns
     *
     * @return object this current object
     */
    private function install_labels()
    {
        $this->labels['is_active'] = new \Seme_Flaglabel();
        $this->labels['is_active']->init_is_active();

        $this->labels['is_deleted'] = new \Seme_Flaglabel();
        $this->labels['is_deleted']->init_is_deleted();

        $this->labels['is_setor'] = new \Seme_Flaglabel();
        $this->labels['is_setor']->init_is_setor();

        return $this;
    }

    public function __construct()
    {
        parent::__construct();
        $this->install_labels()->db->from($this->tbl, $this->tbl_as);

        /** dont forget to define point_of_view property on your class model */
        $this->define_columns(self::COLUMNS, self::REQUIREDS, self::DEFAULTS);

        $this->datatables['admin'] = new \Seme_Datatable([
            ["$this->tbl_as.id", 'id', 'ID'],
            ["$this->tbl_as.kode", 'kode', 'Kode'],
            ["$this->tbl5_as.fnama", 'pembeli', 'Pembeli'],
            ["$this->tbl_as.kunjungan_ke", 'kunjungan_ke', 'Kunjungan Ke'],
            ["COALESCE(CONCAT('Blok ', $this->tbl6_as.blok,' - ',$this->tbl6_as.nomor), CONCAT('Blok ', $this->tbl2_as.blok,' - ',$this->tbl2_as.nomor))", 'produk', 'Produk'],
            ["$this->tbl2_as.tgl_pesan", 'tgl_pesan', 'Tanggal'],
            ["$this->tbl_as.total_harga", 'total_harga', 'Total Harga'],
            ["$this->tbl7_as.nama", 'marketing', 'Marketing'],
            ["$this->tbl_as.status", 'status', 'Status'],
            ["$this->tbl_as.is_setor", 'is_setor', 'Disetorkan']
        ]);

        // $this->datatables['download'] = new \Seme_Datatable([
        //     ["$this->tbl_as.fnama", 'fnama', 'Nama'],
        //     ["$this->tbl_as.telp", 'telp', 'Telp'],
        //     ["$this->tbl_as.email", 'email', 'Email'],
        //     ["$this->tbl_as.utype", 'utype', 'Utype'],
        //     ["$this->tbl2_as.provinsi", 'provinsi', 'Provinsi'],
        //     ["$this->tbl2_as.kabkota", 'kabkota', 'Kota'],
        //     ["$this->tbl2_as.kecamatan", 'kecamatan', 'Kecamatan'],
        //     ["$this->tbl2_as.alamat", 'alamat', 'Alamat'],
        //     ["$this->tbl2_as.alamat2", 'alamat2', 'Alamat 2'],
        //     ["$this->tbl2_as.kodepos", 'kodepos', 'Kodepos'],
        //     ["$this->tbl_as.is_active", 'is_active', 'Status']
        // ]);
    }
}
