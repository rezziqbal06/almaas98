<?php

namespace Model;

register_namespace(__NAMESPACE__);
/**
 * Define all general method(s) and constant(s) for a_rekening table,
 *   can be inherited a Concern class also can be reffered as class constants
 *
 * @version 1.0.0
 *
 * @package Model\B_User
 * @since 1.0.0
 */
class A_Rekening_Concern extends \JI_Model
{
    public $tbl = 'a_rekening';
    public $tbl_as = 'ak';
    public $tbl2 = 'b_produk';
    public $tbl2_as = 'bp';
    // public $tbl3 = 'a_company';
    // public $tbl3_as = 'ac';

    const COLUMNS = [
        'nama',
        'icon',
        'nomor',
        'is_active',
        'is_deleted',
    ];
    const DEFAULTS = [
        '',
        '',
        '',
        1,
        0,
    ];
    const REQUIREDS = [
        'nama',
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
            ["$this->tbl_as.nama", 'nama', 'Atas Nama'],
            ["$this->tbl_as.nomor", 'nomor', 'Nomor Rekening'],
            ["$this->tbl_as.icon", 'icon', 'Bank'],
            ["$this->tbl_as.is_active", 'is_active', 'Status']
        ]);

        // $this->datatables['front'] = new \Seme_Datatable([
        //     ["$this->tbl_as.id", 'id', 'ID'],
        //     ["$this->tbl_as.fnama", 'fnama', 'Nama'],
        //     ["$this->tbl_as.telp", 'telp', 'Telp'],
        //     ["$this->tbl_as.email", 'email', 'Email'],
        //     ["$this->tbl_as.utype", 'utype', 'Utype'],
        //     ["$this->tbl_as.is_active", 'is_active', 'Status']
        // ]);

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
