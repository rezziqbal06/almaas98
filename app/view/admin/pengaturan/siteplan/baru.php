<style>
    .pe-1 {
        padding-left: 1rem !important;
    }

    #siteplan {
        min-height: 450px;
        border-radius: 16px;
        background-color: var(--background);
        margin-bottom: 2em;
        padding: 1em;
    }

    #siteplan svg {
        width: 100%;
        height: 80vh;
    }

    path:hover {
        fill: var(--background) !important;
        cursor: pointer;
    }

    .selected {
        fill: var(--dark-accent) !important;
    }

    .selected:hover {
        fill: var(--dark-accent) !important;
    }

    .tersedia {
        fill: var(--tersedia) !important;
    }


    .booking {
        fill: var(--booking) !important;
    }


    .terjual {
        fill: var(--terjual) !important;
    }

    .text-tersedia {
        color: var(--tersedia) !important;
    }


    .text-booking {
        color: var(--booking) !important;
    }


    .text-terjual {
        color: var(--terjual) !important;
    }
</style>
<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row" style="">
            <div class="col-md-6">
                <div class="btn-group">
                    <button type="button" onclick="history.back()" class="btn btn-info btn-submit"><i class="fa fa-arrow-left icon-submit"></i> Kembali</button>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="card">

        <div class="card-header">
            <h6><strong><?= $this->getTitle() ?></strong></h6>
        </div>

        <div class="card-body position-relative overflow-hidden">

            <form id="ftambah" action="<?= base_url_admin() ?>" method="POST" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">


                <div class="form-group">
                    <div class="col-md-4 mb-2">
                        <label for="isiteplan" class="control-label">Siteplan</label>
                        <input id="isiteplan" type="file" name="siteplan" class="form-control" accept=".svg">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <input id="ipath_siteplan" type="hidden" name="path_siteplan" value="<?= $akm->siteplan ?? '' ?>">
                        <div id="siteplan" style="position: relative; overflow: hidden;"> </div>
                    </div>

                    <div class="col-md-3">
                        <div class="row bg-white" style="border-radius: 16px 0px 0px 16px;">
                            <div class="col-md-12 mb-2">
                                <p><b id="detail_rumah"></b></p>
                                <div class="col-md-12 mb-2">
                                    <p><b id="detail_rumah"></b></p>
                                    <small><i class="fa fa-square text-tersedia "></i> tersedia</small>
                                    <small><i class="fa fa-square text-booking ms-3"></i> booking</small>
                                    <small><i class="fa fa-square text-terjual ms-3"></i> terjual</small>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="irumah" class="control-label">Rumah</label>
                                <select id="irumah" type="file" class="form-control select2">
                                    <?php if (isset($bpim[0]->id)) : ?>
                                        <?php foreach ($bpim as $k => $v) : ?>
                                            <option value="ID-<?= $v->id ?? 0 ?>|TP-<?= $v->tipe ?? 0 ?>|LT-<?= $v->luas_tanah ?? 0 ?>|LB-<?= $v->luas_bangunan ?? 0 ?>|L-<?= $v->lantai ?? 0 ?>|K-<?= $v->kamar_tidur ?? 0 ?>|T-<?= $v->toilet ?? 0 ?>|G-<?= $v->garasi ?? 0 ?>|B-<?= $v->blok ?? 0 ?>|N-<?= $v->nomor ?? 0 ?>|PS-<?= $v->posisi ?>" data-id="<?= $v->id ?>">Blok <?= $v->blok ?><?= $v->nomor ?> Type <?= $v->tipe ?? 0 ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-2 d-none">
                                <label for="istatus" class="control-label">Status</label>
                                <select id="istatus" type="text" class="form-control select2">
                                    <option value="tersedia" selected>tersedia</option>
                                    <option value="booking">booking</option>
                                    <option value="terjual">terjual</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="iaksi" class="control-label">aksi</label>
                                <br>
                                <div class="btn-group">
                                    <button id="attach" class="btn btn-success">Terapkan</button>
                                    <button id="remove" class="btn btn-danger">Hapus</button>
                                </div>
                            </div>
                            <input type="hidden" id="id_path">
                        </div>
                    </div>
                </div>



                <div class="form-group form-actions">
                    <div class="col-xs-12">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>