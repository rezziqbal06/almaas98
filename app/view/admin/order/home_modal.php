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
<div id="modal_kwitansi" class="modal fade" role="dialog">
	<div class="modal-dialog modal-md">
		<div class="modal-content">

			<!-- Modal Body -->
			<div class="modal-body">
				<div class="row">

				</div>

			</div>
		</div>
	</div>
</div>