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
class B_Produk_Item_Concern extends \JI_Model
{
    public $tbl = 'b_produk_item';
    public $tbl_as = 'bpi';
    public $tbl2 = 'b_produk';
    public $tbl2_as = 'bp';
    public $tbl3 = 'a_kategori';
    public $tbl3_as = 'ak';
    public $tbl4 = 'c_order';
    public $tbl4_as = 'co';
    public $tbl5 = 'c_order_produk';
    public $tbl5_as = 'cop';

    const COLUMNS = [
        'b_produk_id',
        'blok',
        'nomor',
        'posisi',
        'cdate',
        'is_active',
        'is_deleted'
    ];
    const DEFAULTS = [
        0,
        '',
        '',
        '',
        null,
        1,
        0
    ];
    const REQUIREDS = [
        'b_produk_id',
        'blok',
        'nomor'
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
            ["$this->tbl_as.blok", 'blok', 'Blok'],
            ["$this->tbl_as.nomor", 'nomor', 'Nomor'],
            ["$this->tbl_as.posisi", 'posisi', 'Posisi'],
            ["$this->tbl3_as.nama", 'kategori', 'Kawasan'],
            ["$this->tbl2_as.harga", 'harga', 'Harga'],
            ["$this->tbl2_as.tipe", 'tipe', 'Tipe'],
            ["$this->tbl2_as.luas_tanah", 'luas_tanah', 'LT'],
            ["$this->tbl2_as.luas_bangunan", 'luas_bangunan', 'LB'],
            ["$this->tbl_as.is_active", 'is_active', 'Status']
        ]);
    }
}
