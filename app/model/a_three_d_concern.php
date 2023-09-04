<?php

namespace Model;

register_namespace(__NAMESPACE__);
/**
 * Define all general method(s) and constant(s) for a_three_d table,
 *   can be inherited a Concern class also can be reffered as class constants
 *
 * @version 1.0.0
 *
 * @package Model\a_three_d
 * @since 1.0.0
 */
class A_Three_D_Concern extends \JI_Model
{
    public $tbl = 'a_three_d';
    public $tbl_as = 'atd';

    const COLUMNS = [
        'gambar',
        'deskripsi',
        'cdate',
        'is_active',
        'is_deleted'
    ];
    const DEFAULTS = [
        '',
        '',
        NULL,
        1,
        0,
    ];

    const REQUIREDS = [];

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
            ["$this->tbl_as.deskripsi", 'deskripsi', 'Deskripsi'],
            ["$this->tbl_as.is_active", 'is_active', 'Status']
        ]);
    }
}
