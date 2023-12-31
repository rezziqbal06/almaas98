<?php

namespace Model;

register_namespace(__NAMESPACE__);
/**
 * Define all general method(s) and constant(s) for C_Jadwal table,
 *   can be inherited a Concern class also can be reffered as class constants
 *
 * @version 1.0.0
 *
 * @package Model\B_User
 * @since 1.0.0
 */
class C_Jadwal_Concern extends \JI_Model
{
    public $tbl = 'c_jadwal';
    public $tbl_as = 'cj';
    public $tbl2 = 'a_pengguna';
    public $tbl2_as = 'ap';
    public $tbl3 = 'a_kategori';
    public $tbl3_as = 'ak';

    const COLUMNS = [
        'a_pengguna_id',
        'a_kategori_id', //Kawasan
        'day', //untuk angka
        'hari',
        'date',
        'stime',
        'etime',
        'tipe',
        'is_active',
        'is_deleted',
        'cdate',
    ];
    const DEFAULTS = [
        0,
        0,
        null,
        null,
        null,
        '08:00',
        '20:00',
        'piket',
        1,
        0,
        'NOW()',
    ];
    const REQUIREDS = [
        'a_pengguna_id',
        'day'
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
            ["$this->tbl2_as.nama", 'nama', 'Nama'],
            ["$this->tbl_as.tipe", 'tipe', 'Tipe'],
            ["$this->tbl_as.hari", 'hari', 'Hari'],
            ["$this->tbl3_as.nama", 'kawasan', 'Kawasan'],
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
