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

        <div class="card-body">

            <form id="ftambah" action="<?= base_url_admin() ?>" method="POST" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="isiteplan" class="control-label">Siteplan</label>
                            <input id="isiteplan" type="file" name="siteplan" class="form-control" accept=".svg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <input id="ipath_siteplan" type="hidden" name="path_siteplan" value="<?= $akm->siteplan ?? '' ?>">
                            <div id="siteplan"> </div>
                        </div>
                        <div class="col-md-3 " style="position: fixed;top: 15em;right:2em;">
                            <div class="row bg-white" style="border-radius: 16px 0px 0px 16px;">
                                <div class="col-md-12 mb-2">
                                    <p><b id="detail_rumah"></b></p>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="irumah" class="control-label">Rumah</label>
                                    <select id="irumah" type="file" class="form-control select2">
                                        <?php if (isset($bpm[0]->id)) : ?>
                                            <?php foreach ($bpm as $k => $v) : ?>
                                                <option value="ID-<?= $v->id ?? 0 ?>|TP-<?= $v->tipe ?? 0 ?>|LT-<?= $v->luas_tanah ?? 0 ?>|LB-<?= $v->luas_bangunan ?? 0 ?>|L-<?= $v->lantai ?? 0 ?>|K-<?= $v->kamar_tidur ?? 0 ?>|T-<?= $v->toilet ?? 0 ?>|G-<?= $v->garasi ?? 0 ?>">Type <?= $v->luas_tanah ?? 0 ?>/<?= $v->luas_bangunan ?? 0 ?> - <?= $v->nama ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="iblok" class="control-label">Blok</label>
                                    <select id="iblok" type="text" class="form-control select2">
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="I">I</option>
                                        <option value="J">J</option>
                                        <option value="K">K</option>
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="N">N</option>
                                        <option value="O">O</option>
                                        <option value="P">P</option>
                                        <option value="Q">Q</option>
                                        <option value="R">R</option>
                                        <option value="S">S</option>
                                        <option value="T">T</option>
                                        <option value="U">U</option>
                                        <option value="V">V</option>
                                        <option value="W">W</option>
                                        <option value="X">X</option>
                                        <option value="Y">Y</option>
                                        <option value="Z">Z</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="inomor" class="control-label">Nomor</label>
                                    <input id="inomor" type="text" class="form-control" placeholder="ex: 48">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="istatus" class="control-label">Status Rumah/Kavling</label>
                                    <select id="istatus" type="text" class="form-control select2">
                                        <option value="tersedia">tersedia</option>
                                        <option value="booking">booking</option>
                                        <option value="terjual">terjual</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
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