<!-- modal filter -->
<div id="modal_filter" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Filter</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="" method="POST" id="ffilter">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="ilantai" class="control-label">Lantai</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lantai" checked id="lantai_4" value="">
                                <label class="form-check-label" for="lantai_4">semua</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lantai" id="lantai_1" value="1">
                                <label class="form-check-label" for="lantai_1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lantai" id="lantai_2" value="2">
                                <label class="form-check-label" for="lantai_2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="lantai" id="lantai_3" value="3">
                                <label class="form-check-label" for="lantai_3">3</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="ikamar" class="control-label">Kamar</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kamar_tidur" checked id="kamar_tidur_4" value="">
                                <label class="form-check-label" for="kamar_tidur_4">semua</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kamar_tidur" id="kamar_tidur_1" value="1">
                                <label class="form-check-label" for="kamar_tidur_1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kamar_tidur" id="kamar_tidur_2" value="2">
                                <label class="form-check-label" for="kamar_tidur_2">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="kamar_tidur" id="kamar_tidur_3" value="3">
                                <label class="form-check-label" for="kamar_tidur_3">3</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="itoilet" class="control-label">Toilet</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="toilet" checked id="toilet_4" value="">
                                <label class="form-check-label" for="toilet_4">semua</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="toilet" id="toilet_1" value="1">
                                <label class="form-check-label" for="toilet_1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="toilet" id="toilet_2" value="2">
                                <label class="form-check-label" for="toilet_2">2</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="igarasi" class="control-label">Garasi</label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="garasi" checked id="garasi_4" value="">
                                <label class="form-check-label" for="garasi_4">semua</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="garasi" id="garasi_1" value="1">
                                <label class="form-check-label" for="garasi_1">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="garasi" id="garasi_2" value="2">
                                <label class="form-check-label" for="garasi_2">2</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="isharga" class="control-label">Harga</label>
                            <div class="input-group">
                                <input type="text" id="sharga" name="sharga" class="form-control currency" placeholder="" aria-label="">
                                <span class="input-group-text"> - </span>
                                <input type="text" id="eharga" name="eharga" class="form-control currency" placeholder="" aria-label="">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 1em; ">
                            <div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
                            <div class="col-xs-12 btn-group-vertical" style="">
                                <button type="" id="breset" class="btn btn-default btn-block bg-danger text-left" data-dismiss="modal"> Reset</button>
                                <button type="submit" class="btn btn-default btn-block text-left" data-dismiss="modal"> Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
</div>