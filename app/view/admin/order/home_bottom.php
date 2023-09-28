var drTable = {};
var ieid = '';
var nIndikator;
var order;

function addIndikator(type='tambah'){
	nIndikator = $("#panel_indikator_"+type).children().length;
	var row = $("#row_indikator_"+type+"_0").get(0).outerHTML;
	row = row.replaceAll('_0', `_${nIndikator}`);
	row = row.replaceAll('none', '');
	$("#panel_indikator_"+type).append(row);
}

function convertToSlug(Text) {
  	return Text.toLowerCase()
             .replace(/ /g, '-')
             .replace(/[^\w-]+/g, '');
}

initCompressingImage('igambar');
initCompressingImage('iegambar');


App.datatables();


if(jQuery('#drTable').length>0){
	drTable = jQuery('#drTable')
	.on('preXhr.dt', function ( e, settings, data ){
		$().btnSubmit();
	}).DataTable({
			"order"					: [[ 0, "desc" ]],
			"responsive"	  : true,
			"bProcessing"		: true,
			"bServerSide"		: true,
			"sAjaxSource"		: "<?=base_url("api_admin/order/")?>",
			"fnServerParams": function ( aoData ) {
				aoData.push(
					{ "name": "a_company_id", "value": $("#fl_a_company_id").val() },
					{ "name": "is_active", "value": $("#fl_is_active").val() }
				);
			},
			"fnServerData"	: function (sSource, aoData, fnCallback, oSettings) {
				oSettings.jqXHR = $.ajax({
					dataType 	: 'json',
					method 		: 'POST',
					url 		: sSource,
					data 		: aoData
				}).done(function (response, status, headers, config) {
					$('#drTable > tbody').off('click', 'tr');
					$('#drTable > tbody').on('click', 'tr', function (e) {
						e.preventDefault();
						var id = $(this).find("td").html();
						ieid = id;
						$.get('<?=base_url("api_admin/order/detail/")?>'+ieid).done(function(dt){
							order = dt.data;
							console.log(dt.data.detail.is_setor)
							if(dt.data.detail.is_setor.includes('Selesai')){
								$("#bhapus").hide();
								$("#bkwitansi").show();
								$(".asetorkan").html('<i class="fa fa-money"></i> Batal Setoran')
							}else{
								$("#bhapus").show();
								$("#bkwitansi").hide();
								$(".asetorkan").html('<i class="fa fa-money"></i> Setorkan')
							}
							if(dt.data.detail){
								var detail = dt.data.detail;
								var s = `
									<table class="w-100">
										<tr>
											<td class="text-grey">Kode</td>
											<td>${detail?.kode}</td>
										</tr>
										<tr>
											<td class="text-grey">Pembeli</td>
											<td class="text-primary">${detail?.pembeli}</td>
										</tr>
										<tr>
											<td class="text-grey">Marketing</td>
											<td>${detail?.marketing}</td>
										</tr>
										<tr>
											<td class="text-grey">Tanggal</td>
											<td>${detail?.tgl_pesan}</td>
										</tr>
										<tr>
											<td class="text-grey">Kunjungan Ke</td>
											<td>${detail?.kunjungan_ke}</td>
										</tr>
										<tr>
											<td class="text-grey">Status</td>
											<td>${detail?.status}</td>
										</tr>
										
									</table>
								`;
								$("#table_header").html(s);
								var s2 = `
									<table class="w-100">
										<tr>
											<td class="text-grey">Metode</td>
											<td>${detail?.metode}</td>
										</tr>
										<tr>
											<td class="text-grey">Nominal</td>
											<td class="text-primary">Rp. ${detail?.total_harga}</td>
										</tr>
										<tr>
											<td class="text-grey">Metode Pembayaran</td>
											<td>${detail?.metode_pembayaran}</td>
										</tr>`
										if(detail?.metode_pembayaran == 'transfer'){
								s2 +=	`<tr>
											<td class="text-grey">Rekening Tujuan</td>
											<td><img src="<?=base_url("media/bank/")?>${detail?.icon_rekening}.png" width="70px" class="img-fluid" alt=""><br>${detail?.nomor_rekening} <br>a.n ${detail?.nama_rekening}</td>
										</tr>`
										}
								s2 +=	`<tr>
											<td class="text-grey">Bukti</td>
											<td><a href="<?=base_url()?>${detail?.gambar}" target="_blank"><img src="<?=base_url()?>${detail?.gambar}" alt="" class="img-fluid rounded"></a></td>
										</tr>
										<tr class="mt-2">
											<td class="text-grey">Disetorkan</td>
											<td>${detail?.is_setor}</td>
										</tr>
										<tr>
											<td class="text-grey">Catatan</td>
											<td>${detail?.catatan}</td>
										</tr>
									</table>
								`;
								$("#table_transaksi").html(s2);
							}
							if(dt.data.produk[0]){
								var produk = dt.data.produk[0]
								var s = '';
								s += `<div class="row">
										<div class="col-4 col-md-2">
											<img src="<?=base_url()?>${produk?.gambar}" class="img-fluid rounded" alt="">
										</div>
										<div class="col-8 col-md-10">
											<p class="m-0">Blok ${produk?.blok} - ${produk?.nomor} Tipe ${produk?.luas_tanah}/${produk?.luas_bangunan}</p>
											<small class="text-grey">${produk?.posisi}</small>
											<p class="m-0"></p>
										</div>
									</div>`
								$("#table_produk").html(s);
							}
							
						})
						
						$("#aedit").attr("href","<?=base_url_admin("order/edit/")?>"+ieid);
						$("#areseller").attr("href","<?=base_url_admin("partner/reseller/baru/")?>"+ieid);
						$("#modal_option").modal("show");
						
					});

					$().btnSubmit('finished');

					fnCallback(response);
				}).fail(function (response, status, headers, config) {
					gritter("<?=DATATABLES_AJAX_FAILED_MSG?>", '<?=DATATABLES_AJAX_FAILED_CLASS?>');
					$().btnSubmit('finished');
				});
			},
	});
	$('.dataTables_filter input').attr('placeholder', 'Cari nama, telp');
	$("#fl_button").on("click",function(e){
		e.preventDefault();
		drTable.ajax.reload();
	});
}

//submit form
$("#ftambah").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch fa-spin');

	var fd = new FormData($(this)[0]);
	var gambar = getImageData('igambarprev');
	if(gambar){
		fd.append('gambar', gambar.blob, 'gambar.'+gambar.extension);
	}
	var url = '<?= base_url("api_admin/order/baru/")?>';

	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status==200){
				gritter('<h4>Sukses</h4><p>Data berhasil ditambahkan</p>','success');
				setTimeout(function(){
					window.location = '<?=base_url_admin('order/')?>';
				},500);
			}else{
				gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','warning');
				$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
				$('.btn-submit').prop('disabled',false);
				NProgress.done();
			}
		},
		error:function(){
			setTimeout(function(){
				gritter('<h4>Error</h4><p>Tidak dapat menambah data, silahkan coba beberapa saat lagi</p>','danger');
			}, 666);

			$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
			$('.btn-submit').prop('disabled',false);
			NProgress.done();
			return false;
		}
	});
});

// edit form 
$("#fedit").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch fa-spin');

	var fd = new FormData($(this)[0]);
	var url = '<?=base_url("api_admin/order/edit/")?>';
	var gambar = getImageData('iegambarprev');
	console.log(gambar, 'gambar')
	if(gambar){
		fd.append('gambar', gambar.blob, 'gambar.'+gambar.extension);
	}
	$.ajax({
		type: $(this).attr('method'),
		url: url,
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status==200){
				gritter('<h4>Sukses</h4><p>Data berhasil diubah</p>','success');
				setTimeout(function(){
					window.location = '<?=base_url_admin('order/')?>';
				},500);
			}else{
				gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','warning');

				$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
				$('.btn-submit').prop('disabled',false);
			}
			NProgress.done();
		},
		error:function(){
			setTimeout(function(){
				gritter('<h4>Error</h4><p>Tidak dapat mengubah data sekarang, silahkan coba lagi nanti</p>','danger');
			}, 666);

			$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
			$('.btn-submit').prop('disabled',false);
			NProgress.done();
			return false;
		}
	});

});

//hapus
$("#bhapus").on("click",function(e){
	e.preventDefault();
	if(ieid){
		var c = confirm('Apakah kamu yakin?');
		if(c){
			NProgress.start();
			$('.btn-submit').prop('disabled',true);
			$('.icon-submit').addClass('fa-circle-o-notch fa-spin');
			var url = '<?=base_url('api_admin/order/hapus/')?>'+ieid;
			$.get(url).done(function(response){
				NProgress.done();
				if(response.status==200){
					gritter('<h4>Sukses</h4><p>Data berhasil dihapus</p>','success');
					$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
					$('.btn-submit').prop('disabled',false);
					NProgress.done();

					drTable.ajax.reload();
					$("#modal_option").modal("hide");
					$("#modal_edit").modal("hide");
				}else{
					gritter('<h4>Gagal</h4><p>'+response.message+'</p>','danger');

					$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
					$('.btn-submit').prop('disabled',false);
					NProgress.done();
				}
			}).fail(function() {
				gritter('<h4>Error</h4><p>Tidak dapat menghapus data, Cobalah beberapa saat lagi</p>','danger');
				$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
				$('.btn-submit').prop('disabled',false);
				NProgress.done();
			});
		}
	}
});

//get induk perusahaan
$("#fl_a_company_id_parent").select2({
	ajax: {
		method: 'post',
		url: '<?=base_url("api_admin/order/get_parent/")?>',
		dataType: 'json',
    delay: 250,
		data: function (params) {
      var query = {
        keyword: params.term,
      }
      return query;
    },
    processResults: function (dt) {
      return {
        results:  $.map(dt, function (itm) {
          return {
            text: itm.text,
            id: itm.id
          }
        })
      };
    },
    cache: true
	}
});

$("#btn_close_modal").on("click",function(e){
	e.preventDefault();
	$("#modal_option").modal("hide");
});

$("#fl_do").on("click",function(e){
		e.preventDefault();
		drTable.ajax.reload();
	});

	
$("#atambah").on("click",function(e){
		e.preventDefault();
		window.location = '<?=base_url_admin('order/baru/')?>'
	});

// edit modal
$("#aedit").on("click",function(e){
	e.preventDefault();
	window.location = '<?=base_url_admin('order/edit/')?>' + ieid
});

$(document).off('click', '.btn-tambah-indikator')
$(document).on('click', '.btn-tambah-indikator', function(e){
	e.preventDefault();
	var type = $(this).attr('data-type');
	addIndikator(type)
})
$(document).off('click', '.btn-remove-row')
$(document).on('click', '.btn-remove-row', function(e){
	e.preventDefault();
	$(this).closest('tr').remove();
})
$(document).off('change', '[name="nama"]')
$(document).on('change', '[name="nama"]', function(e){
	e.preventDefault();
	var type = $(this).attr('id').replace('nama','');
	var slug = convertToSlug($(this).val());
	$("#"+type+"slug").val(slug);
})

$(document).off('change', 'input[type="file"]');
$(document).on('change', 'input[type="file"]', function(e){
	e.preventDefault();
	var id = $(this).attr('id');
	readURLImage(this, 'img-'+id);
});

$('.select2').select2();

$("#adetail").on('click', function(e){
	e.preventDefault();
	$("#modal_option").modal('hide');
	$("#modal_produk").modal('show');
})

function setStatus(status, tgl_selesai, id){
	var fd = new FormData();

	fd.append('tgl_selesai', tgl_selesai)
	fd.append('status', status)
	fd.append('id', id)
	$.ajax({
		type: 'POST',
		url: '<?=base_url("api_admin/order/set_status")?>',
		data: fd,
		processData: false,
		contentType: false,
		success: function(respon){
			if(respon.status==200){
				drTable.ajax.reload();
			}else{
				gritter('<h4>Gagal</h4><p>'+respon.message+'</p>','warning');
			}
			
			NProgress.done();
		},
		error:function(){
			setTimeout(function(){
				gritter('<h4>Error</h4><p>Tidak dapat menambah data, silahkan coba beberapa saat lagi</p>','danger');
			}, 666);

			$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
			$('.btn-submit').prop('disabled',false);
			NProgress.done();
			return false;
		}
	});
}

$(document).off('change', '.rd-status')
$(document).on('change', '.rd-status', function(e){
	e.preventDefault();
	NProgress.start();
	var status = $(this).val()
	var k = $(this).attr('data-k')
	var id = $(this).attr('data-id')
	if(status == 'done' || status == 'cancel'){
		$("#tgl_selesai"+k).show()
	}else{
		$("#tgl_selesai"+k).hide()
	}
	var tgl_selesai = $("#tgl_selesai"+k).val()

	setStatus(status, tgl_selesai, id)
})

$(document).off('change', '.tgl_selesai')
$(document).on('change', '.tgl_selesai', function(e){
	e.preventDefault();
	NProgress.start();
	var k = $(this).attr('data-k')
	var id = $(this).attr('data-id')
	var status = $('input[name="status'+k+'"]:checked').val();
	var tgl_selesai = $("#tgl_selesai"+k).val()

	setStatus(status, tgl_selesai, id)
})

$(document).off('click', '.asetorkan')
$(document).on('click', '.asetorkan', function(e){
	e.preventDefault();
	$.get('<?=base_url("api_admin/order/set_setor/")?>'+ieid).done(function(dt){
		if(dt.status == 200){
			gritter(dt.message, 'success');
			drTable.ajax.reload();
			$("#modal_option").modal('hide');
			$("#modal_produk").modal('hide');
		}else{
			gritter(dt.message, 'warning');
		}
	}).fail(function(){
		gritter('Gagal, coba beberapa saat lagi', 'danger');
	})
})

$("#bkwitansi").on('click', function(e){
	e.preventDefault();
	
  if('ontouchstart' in window == false && window.matchMedia("(orientation: portrait)").matches == false) {
  $.get('<?=base_url("api_admin/order/detail/")?>'+ieid).done(function(dt){
      order = dt.data;
      if(dt.data.detail){
        var detail = dt.data.detail;
        var tujuan_pembayaran = tujuan_pembayaran_handler(`Blok ${order.produk[0].blok} ${order.produk[0].nomor ?? ''} - ${order.produk[0].posisi ?? ''}. ${detail.catatan ?? '-'}`);

        $('#no_kwitansi').html(detail.kode ?? '')
        $('#kwitansi_diterima_dari').html(detail.pembeli ?? '')
        $('#kwitansi_uang_sejumlah').html(`${terbilangRupiah (detail.total_harga.replaceAll('.', '') ?? 0)} `)
        $('#kwitansi_untuk_pembayaran').html(tujuan_pembayaran)
        var tanggal_sekarang = `${getNamaHari(moment().format('d'))}, ${moment().format('DD')} ${getNamaBulan(moment().format('M'))} ${moment().format('YYYY')}`
        $('#kwitansi_tanggal_sekarang').html(tanggal_sekarang ?? '')
        $('#kwitansi_nominal').html('Rp. '+detail.total_harga)
      }
      
    })
	$("#modal_kwitansi").modal('show')
  } else{
    cetak_handler()
  }
});

$('#cetak_kwitansi').click(function(){
  cetak_handler()
})

function terbilangRupiah (nominal){
  const bilangan = [
    "", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh",
        "Sebelas"]

  if(nominal < 12){
    return bilangan[nominal]
  } else if(nominal < 20){
    return bilangan[nominal - 10] + " Belas";
  } else if(nominal < 100){
    return bilangan[Math.floor(nominal / 10)] + " Puluh " + bilangan[nominal % 10];
  } else if (nominal < 200) {
    return "Seratus " + terbilangRupiah(nominal - 100);
  } else if(nominal < 1000) {
      return bilangan[Math.floor(nominal / 100)] + " Ratus " + terbilangRupiah(nominal % 100);
  } else if (nominal < 2000) {
      return "Seribu " + terbilangRupiah(nominal - 1000);
  } else if (nominal < 1000000) {
      return terbilangRupiah(Math.floor(nominal / 1000)) + " Ribu " + terbilangRupiah(nominal % 1000);
  } else if (nominal < 1000000000) {
      return terbilangRupiah(Math.floor(nominal / 1000000)) + " Juta " + terbilangRupiah(nominal % 1000000);
  } else if (nominal < 1000000000000) {
      return terbilangRupiah(Math.floor(nominal / 1000000000)) + " Miliar " + terbilangRupiah(nominal % 1000000000);
  } else {
      return "nilai terlalu besar";
  }
}

function getNamaHari(digit) {
  const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

  if (digit >= 0 && digit <= 6) {
    return hari[digit]; 
  } else {
    return 'Angka hari tidak valid' ; 
  } 

}

function getNamaBulan(digit) {
  const bulan = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  ];

  if (digit >= 1 && digit <= 12) {
    return bulan[digit - 1]; // Karena indeks array dimulai dari 0
  } else {
    return 'Angka bulan tidak valid';
  }
}

function cetak_handler(){
    $.get('<?=base_url("api_admin/order/detail/")?>'+ieid).done(function(dt){
      order = dt.data;
      var contentToPrint = ''
      if(dt.data.detail){
        var detail = dt.data.detail;
        var tanggal_sekarang = `${getNamaHari(moment().format('d'))}, ${moment().format('DD')} ${getNamaBulan(moment().format('M'))} ${moment().format('YYYY')}`
        var tujuan_pembayaran = tujuan_pembayaran_handler(`Blok ${order.produk[0].blok} ${order.produk[0].nomor ?? ''} - ${order.produk[0].posisi ?? ''}. ${detail.catatan ?? '-'}`);
        
        contentToPrint = `
				<html>
          <head>
              <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
              <style>  
                  .contents {
                    background: linear-gradient(168deg, #3EFF96 0%, #FFF942 100%);
                    background-repeat: no-repeat;
                    background-size: 100% 100%;
                    print-color-adjust: exact;
                    margin: 0;
                    padding: 0;
                    position: relative; 
                    overflow: hidden; 
                    width: 1210.45px;
                    height: 377.95px;
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
                    left: -5.1%;
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
                    left: -8.5%;
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
              
                  table {
                    border-collapse: collapse;
                    position: relative;
                    overflow: hidden;
                    border-spacing: 0;
                    margin: 0;
                    padding: 0;
                  }
              
                  .vertical-align-top {
                    vertical-align: top;
                    text-align: center;
                  }
              
                  .vertical-align-bottom {
                    padding-top: 3rem;
                    padding-bottom: 2rem;
                    vertical-align: bottom;
                    text-align: center;
                  }
              
                  .rectangle-top-left {
                    background-color: white;
                    position: absolute;
                    z-index: 1;
                    width: 60%;
                    transform: skewX(-15deg);
                    height: 4rem;
                    /* top: 10; */
                    left: -30%;
                  }
              
                  td {
                    padding: 0.4rem;
                    vertical-align: top;
                    font-size: 1rem;
                  }
              
                  .kwitansi-header {
                    position: absolute;
                    left: 1%;
                    z-index: 2;
                    top: 3%;
                    letter-spacing: 0.5rem;
                  }
              
                  h1 {
                    margin: 0;
                    padding: 0;
                  }
              
                  table tr {
                    margin: 0;
                  }
              
                  .position-relative {
                    position: relative;
                  }
              
                  .min-h {
                    max-height: 4.8rem;
                    height: 4.8rem;
                    overflow: hidden;
                    display: -webkit-box;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;
                  }
              
                  * {
                    color: black;
                    font-family: 'Inter', sans-serif;
                  }
                </style>
                <title>Cetak Kwitansi_${detail.pembeli}_${moment().format('YYYY-MM-DD')}</title>
              </head>

              <body>
                  <div class="contents">
                    <table style="width: 100%;">
                      <tr>
                        <td><div class="rectangle-top-left"></div> <h1 class="kwitansi-header">KWITANSI</h1></td>
                        <td style="width: 10%;"><img src="<?= $this->cdn_url("media/logo.png") ?>" alt="Almaas" style="height: 4rem;"></td>
                      </tr>
                    </table>
                    <table style="width: 100%;">
                      <tr>
                        <td style="white-space: nowrap;">No</td>
                        <td style="width: 1%;">:</td>
                        <td>${detail.kode ?? '-'}</td>
                        <td rowspan="6"></td>
                        <td style="width: 30%;" rowspan="3"></td>
                      </tr>
                      <tr>
                        <td style="white-space: nowrap;">Diterima dari</td>
                        <td>:</td>
                        <td>${detail.pembeli ?? '-'}</td>
                      </tr>
                      <tr>
                        <td style="white-space: nowrap;">Uang Sejumlah</td>
                        <td>:</td>
                        <td>${terbilangRupiah (detail.total_harga.replaceAll('.', '') ?? 0)} Rupiah</td>
                      </tr>
                      <tr>
                        <td style="white-space: nowrap;">Untuk Pembayaran</td>
                        <td>:</td>
                        <td class="min-h"> ${tujuan_pembayaran ?? ''}</td>
                        <td style="position: relative;" class="vertical-align-top rectangle-right-bottom"><div class="rectangle-right-bottom-1"></div> <center><div class="content">${tanggal_sekarang}</div></center></td>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                        <td style="position: relative;" class="rectangle-right-bottom"><div class="rectangle-right-bottom-2"></div></td>
                      </tr>
                      <tr class="position-relative">
                        <td colspan="3">Rp. ${detail.total_harga ?? 0}</td>
                        <td style="position: relative;" class="rectangle-right-bottom vertical-align-bottom"><div class="rectangle-right-bottom-3"></div><center class="content">YAYAT HENDRAYANA</center></td>
                      </tr>
                    </table>
                  </div>
              </body>

              </html>
      `;
            
   const options = {
      margin: 0,
      filename: `Cetak Kwitansi_${detail.pembeli}_${moment().format('YYYY-MM-DD')}`,
      image: { type: 'jpeg', quality: 1 },
      html2canvas: { 
        scale: 2,
        removeContainer: true,
        windowWidthHeight: 23.5,
        windowWidthWidth: 75, 
      },
      pagebreak: { mode: ['avoid-all', 'css', 'legacy'] },
      jsPDF: { 
        unit: 'in',
        orientation: 'landscape',
        format: [1210.45/96, 377.95/96]
      },
      page: {
        width: 1210.45 / 96, // Convert width from pixels to inches
        height: 377.95 / 96, // Convert height from pixels to inches
      }
    }

    console.log(contentToPrint)

    // Fungsi untuk mengonversi ke PDF
    html2pdf()
        .from(contentToPrint)
        .set(options)
        .save()

      }
      
    })
}

function tujuan_pembayaran_handler(params = ''){
  var tujuan_pembayaran = ''
  $.each(params.split(''), function(idx, value){
    if((idx + 1) % 30 == 0){
    tujuan_pembayaran += '<br>'
    } else {
    tujuan_pembayaran += value
    }
  }) 

  return tujuan_pembayaran
}
