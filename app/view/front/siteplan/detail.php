<style>
    .pe-1 {
        padding-left: 1rem !important;
    }

    .fill-white {
        fill: #ffffff !important;
    }

    .tersedia.fill-white {
        fill: #ffffff !important;
    }

    .booking.fill-white {
        fill: #ffffff !important;
    }

    .terjual.fill-white {
        fill: #ffffff !important;
    }

    #siteplan {
        min-height: 450px;
        border-radius: 16px;
        margin-bottom: 2em;
        padding: 1em;
    }

    #siteplan svg {
        width: 100%;
        height: auto;
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


    <!-- Content -->
    <div class="card">


        <div class="card-body">

            <form id="ftambah" action="<?= base_url_admin() ?>" method="POST" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="siteplan"> </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row bg-white" style="border-radius: 16px 0px 0px 16px;">
                                <div class="col-md-12 mb-2">
                                    <p><b id="detail_rumah"></b></p>
                                    <small><i class="fa fa-square text-tersedia "></i> tersedia</small>
                                    <small><i class="fa fa-square text-booking ms-3"></i> booking</small>
                                    <small><i class="fa fa-square text-terjual ms-3"></i> terjual</small>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="istatus" class="control-label">Status Rumah</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_rumah" checked id="status_rumah_4" value="">
                                        <label class="form-check-label" for="status_rumah_4">semua</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_rumah" id="status_rumah_1" value="tersedia">
                                        <label class="form-check-label" for="status_rumah_1">tersedia</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_rumah" id="status_rumah_2" value="booking">
                                        <label class="form-check-label" for="status_rumah_2">booking</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_rumah" id="status_rumah_3" value="terjual">
                                        <label class="form-check-label" for="status_rumah_3">terjual</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="iblok" class="control-label">Blok</label>
                                    <select id="iblok" type="text" name="blok" class="form-control select2">
                                        <option value="">Semua Blok</option>
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
                                    <label for="irumah" class="control-label">Type</label>
                                    <select id="irumah" type="" name="rumah" class="form-control select2">
                                        <option value="">Semua Tipe</option>
                                        <?php if (isset($bpm[0]->id)) : ?>
                                            <?php foreach ($bpm as $k => $v) : ?>
                                                <option value="LT-<?= $v->luas_tanah ?? 0 ?>|LB-<?= $v->luas_bangunan ?? 0 ?>">Type <?= $v->luas_tanah ?? 0 ?>/<?= $v->luas_bangunan ?? 0 ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>

                                <div class="col-12 d-grid">
                                    <a href="#" id="reset" class="btn btn-info">reset</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>