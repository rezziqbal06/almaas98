<!-- modal option -->
<div id="modal_option" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Aksi </h2>
                <h5 id="t"></h5>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 btn-group-vertical">
                        <a id="adetail" href="#" class="btn btn-info btn-left"><i class="fa fa-info"></i> Detail</a>
                        <a id="aedit" href="#" class="btn btn-primary btn-left"><i class="fa fa-pencil"></i> Edit</a>
                        <a id="bkwitansi" href="#" class="btn btn-success btn-left"><i class="fa fa-print"></i> Cetak Kwitansi</a>
                        <?php if ($sess->admin->a_jabatan_nama == 'Direktur') : ?>
                            <a id="" href="#" class="btn btn-warning btn-left asetorkan text-white"><i class="fa fa-money"></i> Setorkan</a>
                        <?php endif ?>
                        <button id="bhapus" type="button" class="btn btn-danger btn-left btn-submit"><i class="fa fa-trash-o icon-submit"></i> Hapus</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em; ">
                    <div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
                    <div class="col-xs-12 btn-group-vertical" style="">
                        <button type="button" class="btn btn-default btn-block text-left" data-dismiss="modal" id="btn_close_modal"><i class="fa fa-close"></i> Tutup</button>
                    </div>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
</div>

<!-- modal produk -->
<div id="modal_produk" class="modal fade" role="dialog">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Detail Order</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <div id="table_header" class=""></div>
                <hr>
                <div id="table_produk" class=""></div>
                <hr>
                <div id="table_transaksi" class=""></div>

                <?php if ($sess->admin->a_jabatan_nama == 'Direktur') : ?>
                    <div class="row">
                        <div class="col-xs-12 btn-group-vertical">
                            <a id="" href="#" class="btn btn-warning btn-left asetorkan text-white"><i class="fa fa-money"></i> Setorkan</a>
                        </div>
                    </div>
                <?php endif ?>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
</div>

<!-- modal kwitansi -->
<style>
    @media only screen and (min-width: 364) {
        #modal_kwitansi .modal-content {
            min-height: 377.95px !important;
            height: 100%;

            width: 1209.45px !important;
        }
    }


    #modal_kwitansi .modal-dialog {
        max-width: 1209.45px !important;
    }

    #modal_kwitansi .contents {
        background: linear-gradient(168deg, #3EFF96 0%, #FFF942 100%);
        background-repeat: no-repeat;
        background-size: 100% 100%;
        print-color-adjust: exact;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
    }

    .rectangle-right-bottom {
        background-color: white;
        border-top-left-radius: 100px;
    }

    .rectangle-right-bottom-1 {
        background-color: white;
        border-right: 100px solid white;
        content: "";
        position: absolute;
        top: 0;
        left: -2%;
        background-color: white;
        transform: skewx(-15deg);
        z-index: 0 !important;
        width: 100%;
        height: 100%;
    }

    .rectangle-right-bottom-2 {
        background-color: white;
        content: "";
        position: absolute;
        top: 0;
        left: -6%;
        background-color: white;
        transform: skewx(-15deg);
        z-index: 0 !important;
        width: 100%;
        height: 100%;
    }

    .rectangle-right-bottom-3 {
        background-color: white;
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: -7%;
        background-color: white;
        transform: skewx(-15deg);
        z-index: 0 !important;
        width: 100%;
        height: 100%;
    }

    .content {
        position: absolute;
        right: 15%;
    }

    #modal_kwitansi table {
        border-collapse: collapse;
        position: relative;
        overflow: hidden;
    }

    #modal_kwitansi.vertical-align-top {
        vertical-align: top;
        text-align: center;
    }

    #modal_kwitansi.vertical-align-bottom {
        padding-bottom: 2rem;
        vertical-align: bottom;
        text-align: center;
    }

    .rectangle-top-left {
        background-color: white;
        position: absolute;
        z-index: 1;
        width: 55%;
        transform: skewX(-15deg);
        height: 3rem;
        top: 0;
        left: -30%;
    }


    #modal_kwitansi td {
        padding: 0.1rem;
        vertical-align: top;
        font-size: 0.8rem;
    }

    #modal_kwitansi .kwitansi-header {
        position: absolute;
        left: 0;
        z-index: 2;
        top: 3%;
        letter-spacing: 0.5rem;
    }

    #modal_kwitansi table tr {
        margin: 0;
    }

    #modal_kwitansi .position-relative {
        position: relative;
    }

    #modal_kwitansi .min-h {
        max-height: 4.5rem;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>
<div id="modal_kwitansi" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body overflow-auto position-relative">
                <!-- Header -->

                <div class="contents">
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <div class="rectangle-top-left"></div>
                                <h2 class="kwitansi-header">KWITANSI</h2>
                            </td>
                            <td style="width: 10%;"><img src="<?= $this->cdn_url("media/logo.png") ?>" alt="Almaas" style="height: 4rem;"></td>
                        </tr>
                    </table>
                    <table style="width: 100%;">
                        <tr>
                            <td style="white-space: nowrap;">No</td>
                            <td style="width: 1%;">:</td>
                            <td>
                                <div id="no_kwitansi"></div>
                            </td>
                            <td rowspan="6"></td>
                            <td style="width: 30%;" rowspan="3"></td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap;">Diterima dari</td>
                            <td>:</td>
                            <td>
                                <div id="kwitansi_diterima_dari"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap;">Uang Sejumlah</td>
                            <td>:</td>
                            <td>
                                <div id="kwitansi_uang_sejumlah"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="white-space: nowrap;">Untuk Pembayaran</td>
                            <td>:</td>
                            <td class="min-h">
                                <div id="kwitansi_untuk_pembayaran"></div>
                            </td>
                            <td style="position: relative;" class="vertical-align-top rectangle-right-bottom">
                                <div class="rectangle-right-bottom-1"></div>
                                <center>
                                    <div id="kwitansi_tanggal_sekarang" class="content"></div>
                                </center>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td style="position: relative;" class="rectangle-right-bottom">
                                <div class="rectangle-right-bottom-2"></div>
                            </td>
                        </tr>
                        <tr class="position-relative">
                            <td colspan="3">
                                <div id="kwitansi_nominal"></div>
                            </td>
                            <td style="position: relative;" class="rectangle-right-bottom vertical-align-bottom">
                                <div class="rectangle-right-bottom-3"></div>
                                <center class="content">YAYAT HENDRAYANA</center>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer"><button type="button" id="cetak_kwitansi" class="btn btn-secondary">Cetak Kwitansi</button></div>
        </div>
    </div>
</div>