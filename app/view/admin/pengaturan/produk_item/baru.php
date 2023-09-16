<style>
    .pe-1 {
        padding-left: 1rem !important;
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

            <form id="ftambah" action="<?= base_url_admin() ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label for="ib_produk_id" class="control-label">Tipe Rumah</label>
                            <select id="ib_produk_id" type="text" name="b_produk_id" class="form-control select2" required>
                                <?php if (isset($bpm[0]->id)) : ?>
                                    <?php foreach ($bpm as $k => $v) : ?>
                                        <option value="<?= $v->id ?>">Tipe <?= $v->luas_tanah ?>/<?= $v->luas_bangunan ?> - Rp. <?= number_format($v->harga, 0, ',', '.') ?> - <?= $v->kawasan ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="iblok" class="control-label">Blok</label>
                            <select id="iblok" name="blok" type="text" class="form-control select2">
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
                        <div class="col-md-6 mb-2">
                            <label for="inomor" class="control-label">Nomor</label>
                            <input id="inomor" name="nomor" type="text" class="form-control" placeholder="ex: 48">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="iposisi" class="control-label">Posisi</label>
                            <select id="iposisi" name="posisi" type="text" class="form-control select2">
                                <option value="sayap">sayap</option>
                                <option value="utama">utama</option>
                                <option value="hook">hook</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="iis_active" class="control-label">Status</label>
                            <select name="is_active" id="iis_active" class="form-control">
                                <option value="1">Aktif</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group form-actions">
                    <div class="col-xs-12 text-right">
                        <div class="btn-group pull-right">
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