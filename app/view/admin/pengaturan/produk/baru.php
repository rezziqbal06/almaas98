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
                        <div class="col-md-4 mb-2">
                            <label for="inama" class="control-label">Nama</label>
                            <input id="inama" type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="islug" class="control-label">Slug</label>
                            <input id="islug" type="text" name="slug" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ia_kategori_id" class="control-label">Kawasan</label>
                            <select id="ia_kategori_id" type="text" name="a_kategori_id" class="form-control select2" required>
                                <?php if (isset($akm[0]->id)) : ?>
                                    <?php foreach ($akm as $k => $v) : ?>
                                        <option value="<?= $v->id ?>"><?= $v->nama ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="itipe" class="control-label">Tipe Rumah</label>
                            <select id="itipe" type="text" name="tipe" class="form-control select2" required>
                                <option value="36">36</option>
                                <option value="48">48</option>
                                <option value="50">50</option>
                                <option value="70">70</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-4 mb-2">
                            <label for="iblok" class="control-label">Blok</label>
                            <input id="iblok" type="text" name="blok" class="form-control" placeholder="ex: A" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="inomor" class="control-label">Nomor</label>
                            <input id="inomor" type="text" name="nomor" class="form-control" required>
                        </div> -->
                        <div class="col-md-4 mb-2">
                            <label for="iluas_tanah" class="control-label">Luas Tanah (m<sup>2</sup>)</label>
                            <input id="iluas_tanah" type="text" name="luas_tanah" class="form-control" placeholder="ex: 5.6" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="iluas_bangunan" class="control-label">Luas Bangunan (m<sup>2</sup>)</label>
                            <input id="iluas_bangunan" type="text" name="luas_bangunan" class="form-control" placeholder="ex: 5.6" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ilantai" class="control-label">Lantai</label>
                            <input id="ilantai" type="number" name="lantai" class="form-control" value="1" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ikamar_tidur" class="control-label">Kamar</label>
                            <input id="ikamar_tidur" type="number" name="kamar_tidur" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="itoilet" class="control-label">Toilet</label>
                            <input id="itoilet" type="number" name="toilet" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="igarasi" class="control-label">Garasi</label>
                            <input id="igarasi" type="number" name="garasi" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ia_three_d_id" class="control-label">3D Model House</label>
                            <select id="ia_three_d_id" type="text" name="a_three_d_id" class="form-control select2">
                                <?php if (isset($atdm[0]->id)) : ?>
                                    <?php foreach ($atdm as $k => $v) : ?>
                                        <option value="<?= $v->id ?>"><?= $v->deskripsi ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="iharga" class="control-label">Harga</label>
                            <input id="iharga" type="text" name="harga" class="form-control currency" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="ilistrik" class="control-label">Listrik</label>
                            <select id="ilistrik" type="text" name="listrik" class="form-control select2" required>
                                <option value="900">900</option>
                                <option value="1300" selected>1300</option>
                                <option value="2500">2500</option>
                                <option value="3300">3300</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="iair" class="control-label">Air</label>
                            <input id="iair" type="text" name="air" class="form-control" value="pdam">
                        </div>
                        <!-- <div class="col-md-4 mb-2">
                            <label for="istatus" class="control-label">Status Rumah/Kavling</label>
                            <select id="istatus" type="text" name="status" class="form-control select2" required>
                                <option value="tersedia">tersedia</option>
                                <option value="booking">booking</option>
                                <option value="terjual">terjual</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label for="igambar1" class="control-label">Gambar 1</label>
                            <div class="input-group">

                                <input id="igambar1" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
                                <div class="input-group-text">
                                    <input type="radio" name="is_cover" value="1">
                                </div>
                            </div>
                            <img id="img-igambar1" src="" alt="" class="img-fluid rounded mt-2">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="igambar2" class="control-label">Gambar 2</label>
                            <div class="input-group">
                                <input id="igambar2" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
                                <div class="input-group-text">
                                    <input type="radio" name="is_cover" value="2">
                                </div>
                            </div>
                            <img id="img-igambar2" src="" alt="" class="img-fluid rounded mt-2">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="igambar3" class="control-label">Gambar 3</label>
                            <div class="input-group">
                                <input id="igambar3" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
                                <div class="input-group-text">
                                    <input type="radio" name="is_cover" value="3">
                                </div>
                            </div>
                            <img id="img-igambar3" src="" alt="" class="img-fluid rounded mt-2">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="igambar4" class="control-label">Gambar 4</label>
                            <div class="input-group">
                                <input id="igambar4" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
                                <div class="input-group-text">
                                    <input type="radio" name="is_cover" value="4">
                                </div>
                            </div>
                            <img id="img-igambar4" src="" alt="" class="img-fluid rounded mt-2">
                        </div>
                        <div class="col-md-3 mb-2">
                            <label for="igambar5" class="control-label">Gambar 5</label>
                            <div class="input-group">
                                <input id="igambar5" type="file" accept=".png,.jpg,.jpeg" name="" class="form-control">
                                <div class="input-group-text">
                                    <input type="radio" name="is_cover" value="5">
                                </div>
                            </div>
                            <img id="img-igambar5" src="" alt="" class="img-fluid rounded mt-2">
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="ideskripsi" class="control-label">Deskripsi</label>
                            <textarea name="deskripsi" id="ideskripsi" class="form-control" cols="30" rows="10"></textarea>
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

                <hr>
                <!-- <div class="form-group">
                    <h5>Spesifikasi</h5>
                    <div class="row mb-3">
                        <div class="col-12">
                            <button id="btn_add_spec" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Spesifikasi</button>
                        </div>
                    </div>
                    <div>
                        <div id="panel_qty" class="rounded border border-warning p-3">
                            <div id="panel_spesifikasi">


                            </div>
                            <div id="ps_qty" class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text" id="ispec_qty" name="spec[]" class="form-control" placeholder="Ex: Warna" value="QTY" readonly>
                                        <input type="hidden" id="icount_spec_qty" name="count_spec[]" value="qty" class="form-control" placeholder="Ex: Warna" value="qty" readonly>
                                        <button class="btn btn-danger btn-remove-spec d-none" type="button" data-count="qty"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-add-spec-qty-detail" type="button" data-count="qty"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div id="psd_qty">
                                        <div id="sd_qty_0" class="input-group mb-3">
                                            <input type="number" id="ispec_detail_from_qty_0" name="spec_detail_from_qty[]" class="form-control input-spec" data-count="qty" data-count-detail="0" readonly placeholder="">
                                            <select name="spec_detail_operator_qty[]" class="bg-dark text-white form-select input-group-text input-spec" id="ispec_detail_operator_qty_0" data-count="qty" data-count-detail="0">
                                                <option value="<">
                                                    < </option>
                                                <option value="-"> - </option>
                                                <option value=">"> > </option>
                                            </select>
                                            <input type="number" id="ispec_detail_to_qty_0" name="spec_detail_to_qty[]" class="form-control pe-1 input-spec" data-count="qty" data-count-detail="0" placeholder="">
                                            <button class="btn btn-danger btn-remove-spec-detail" type="button" data-count="qty" data-count-detail="0"><i class="fa fa-minus"></i></button>
                                            <div class="input-group-text bg-light">
                                                <input type="checkbox" id="icheck_spec_detail_qty_0" data-count="qty" data-count-detail="0" value="" class="check-spec-filter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3 mt-3">
                        <div class="col-12">
                            <button id="btn_price_setting" class="btn btn-warning pull-right"><i class="fa fa-calculator"></i> Setting Harga</button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div id="panel_spec"></div>
                        <div id="panel_price" class="col-md-12" style="overflow-x: scroll;"></div>
                    </div>
                </div> -->

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