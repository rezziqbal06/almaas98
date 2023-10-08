var media_target_div = 'dgaleri_items';
var media_single = 0;
var media_name = 'image[]';
var media_caption = 0;
var media_id = '';
var folder_id = '';
var galeri_item_count = 0;
var id_produk = 0;


function priceFormat(selector){
  $("#"+selector).priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator:'.',
    decimalSeparator:',',
    centsLimit: 0
  })
}


//submit form
$("#fedit").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch fa-spin');

	var fd = new FormData($(this)[0]);

  var gambar = getImageData('igambarprev');
	if(gambar){
		fd.append('gambar', gambar.blob, 'gambar.'+gambar.extension);
	}

	fd.append('catatan', editor["#icatatan"].getData())

	var url = '<?= base_url("api_admin/order/edit/$com->id")?>';

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


priceFormat('ietotal_harga')

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

function setSpesifikasi(id){
  var value = $("#ib_produk_id_"+id).find('option:selected').val();
  var qty = $("#iqty_"+id).val();
  if(value && qty){
    $.get(`<?=base_url("api_admin/pengaturan/produk/get_spesifikasi/")?>${value}/${qty}`).done(function(dt){
      if(dt.data.spesifikasi){
        var option = ""
        $.each(dt.data.spesifikasi, function(k,v){
          option += `<option value="${v.id}" data-harga="${v.harga}">${v.option}</option>`
        })
        $("#ib_produk_id_harga_"+id).html(option).trigger('change').trigger('keyup');
      }
    })
  }
}
function getTersedia(b_user_id){
    $.get('<?=base_url("api_admin/pengaturan/produk_item/get_tersedia/?b_user_id=")?>'+b_user_id).done(function(dt){
        if(dt.status == 200){
          if(dt.data){
            var is_owner = [];
            var is_sold = [];
            var blok_owning = [];

            var s= '<option value="">-- pilih rumah yang tersedia --</option>';
            s += '<option value="kustom">kustom</option>';
            $.each(dt.data, function(k,v){
              is_owner[k] = '';
              is_sold[k] = false;
              var text = `${v?.is_custom ? 'KUSTOM | ' : ''}Blok ${v?.blok} No ${v?.nomor} - ${v?.posisi} - Rp. ${v?.harga} - ${v?.kawasan}`;
              var status = '';
              if(v.status == 'pembayaran' || v.status == 'dp'){
                status = 'terjual';
              }
              if(v.status != 'tersedia'){
                is_sold[k] = true;
              }
              if(v.b_user_id && b_user_id == v.b_user_id){
                blok_owning.push({id:v.id,text:text,blok:v?.blok,nomor:v?.nomor});
                is_owner[k] = 'is_owner';
                is_sold[k] = false;
              }
              s += `<option value="${v.id}" class="${is_owner}" ${is_sold ? 'disabled' : ''}>${text}</option>`
            })
            $("[name='b_produk_id[]']").html(s);
            if(blok_owning.length > 0){
                var s = '<p>Pelanggan ini memiliki histori pembelian pada:</p><ul>'
                $.each(blok_owning, function(kb, vb){
                  s += '<li><a href="#" class="history-pembayaran text-white" data-id="'+vb.id+'" data-blok="'+vb.blok+vb.nomor+'">'+vb.text+'</a></li>'
                })
                s+= '</ul>'
                $("#panel_info_owning").html(s).slideDown();
            }else{
              $("#panel_info_owning").slideUp();
            }
            $.each(is_sold, function(ks, vs){
              if(vs === true){
                $("#ib_produk_id_0 option:eq("+(ks+2)+")").prop('disabled');
              }else{
                $("#ib_produk_id_0 option:eq("+(ks+2)+")").prop('disabled', false);
              }
            })
            $("#ib_produk_id_0").select2();
          }
        }
      })
  }

function initCariPembeli(){
  
  $("#ieb_user_id_cari").select2({
    ajax: {
      method: 'post',
      url: '<?=base_url("api_admin/akun/user/cari")?>',
      dataType: 'json',
      delay: 250,
      data: function (params) {
        var query = {
          keyword: params.term
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

  

  $("#ieb_user_id_cari").on('change', function(e){
    var b_user_id = $(this).find('option:selected').val();
    var b_user_nama = $(this).find('option:selected').text();
    $("#ieb_user_nama").val(b_user_nama)
    $("#ieb_user_id").val(b_user_id)
    getTersedia(b_user_id)
  })

}

var option_produk = '<option value="">-- pilih rumah --</option>';
<?php if(isset($bpim)){ ?>
  <?php foreach($bpim as $k => $v){ ?>
    option_produk += '<option value="<?= $v->id ?>">Blok <?= $v->blok ?> No <?= $v->nomor ?> - <?= $v->posisi ?? '' ?>- Rp. <?= number_format($v->harga, 0, ',', '.') ?> - <?= $v->kawasan ?></option>'
  <?php } ?>
<?php } ?>

var option_kategori = '<option value="">-- pilih kawasan --</option>';
<?php if(isset($akm)){ ?>
  <?php foreach($akm as $k1 => $v2){ ?>
    option_kategori += '<option value="<?= $v2->id ?>"><?= $v2->nama ?></option>'
  <?php } ?>
<?php } ?>


function addProduk(id, b_produk_id="", qty="", b_produk_id_harga="", harga="", status="pending", is_custom=0, blok="", nomor="", a_kategori_id="", lt="", lb="", harga_satuan=""){
  if(!window['produk_'+id]) window['produk_'+id] = 0;
  var s = `<div id="ps_${id}" class="row">
            <div class="col-md-6 mb-3">
                <label for="istatus_${id}" data-count="${id}">Jenis</label>
                <select name="status[]" id="istatus_${id}" data-count="${id}" class="form-control select2">
                <option value="">-- pilih jenis --</option>
                  <option value="survey">survey</option>
                  <option value="pembayaran">pembayaran</option>
                  <option value="booking">booking</option>
                  <option value="dp">dp</option>
                </select>
            </div>
            <div class="col-md-6 panel-pembayaran mb-3">
                <label for="ib_produk_id_${id}">Rumah</label>
                <select name="b_produk_id[]" id="ib_produk_id_${id}" data-count="${id}" class="form-control select2">
                  <option value="">-- pilih pembeli terlebih dahulu --</option>
                </select>
            </div>
            <div class="col-md-1 mb-3 d-none">
                <label for="iqty_${id}" data-count="${id}">Qty</label>
                <input type="number" name="qty[]" id="iqty_${id}" data-count="${id}" class="form-control">
            </div>
            <div class="col-md-4 mb-3 d-none">
                <label for="ib_produk_id_harga_${id}" data-count="${id}">Spesifikasi</label>
                <select name="b_produk_id_harga[]" id="ib_produk_id_harga_${id}" data-count="${id}" class="form-control select2">
                   <option>-- pilih nama & qty terlebih dahulu --</option>
                </select>
            </div>
            
            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="ia_kategori_id_${id}" data-count="${id}">Kawasan</label>
                <select name="a_kategori_id[]" id="ia_kategori_id_${id}" data-count="${id}" class="form-control form-kustom">
                   ${option_kategori}
                </select>
            </div>

            <input type="hidden" id="iis_custom_${id}" name="is_custom[]" value="${is_custom}">

            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="iblok_${id}" data-count="${id}">Blok</label>
                <select name="blok[]" id="iblok_${id}" data-count="${id}" class="form-control form-kustom">
                    <option>-- pilih blok --</option>
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

            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="inomor_${id}" data-count="${id}">Nomor</label>
                <input name="nomor[]" type="number" id="inomor_${id}" data-count="${id}" value="${nomor}" class="form-control form-kustom">
            </div>

            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="ilt_${id}" data-count="${id}">Luas Tanah (m<sup>2</sup>)</label>
                <input name="lt[]" type="number" id="ilt_${id}" data-count="${id}" value="${lt}" class="form-control form-kustom">
            </div>

            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="ilb_${id}" data-count="${id}">Luas Bangunan (m<sup>2</sup>)</label>
                <input name="lb[]" type="number" id="ilb_${id}" data-count="${id}" value="${lb}" class="form-control form-kustom">
            </div>

            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="iharga_satuan_${id}" data-count="${id}">Harga/m<sup>2</sup></label>
                <input name="harga_satuan[]" type="text" id="iharga_satuan_${id}" data-count="${id}" value="${harga_satuan}" class="form-control form-kustom">
            </div>

            <div class="col-md-4 panel-kustom mb-3" style="display: none;">
                <label for="isub_harga_${id}" data-count="${id}">Total Harga</label>
                <input type="text" id="isub_harga_${id}" data-count="${id}" class="form-control form-kustom" readonly>
            </div>
            
            <div class="col-md-1 mb-3 d-none">
                <label for="" class="text-white">Aksi</label>
                <button class="btn btn-danger btn-remove-produk pull-right " type="button" data-count="${id}" data-count-detail="${window['produk_'+id]}"><i class="fa fa-minus"></i></button>
            </div>
        </div>`;
  $('#panel_produk').append(s);
  $(".select2").select2();
  priceFormat('iharga_'+id)
  priceFormat('iharga_satuan_'+id)
  priceFormat('isub_harga_'+id)

  if(b_produk_id) $("#ib_produk_id_"+id).val(b_produk_id)
  if(qty) $("#iqty_"+id).val(qty)
  if(status) $("#istatus_"+id).val(status).select2().trigger('change');
  if(b_produk_id && qty){
    setSpesifikasi(id)
    setTimeout(function(){
      console.log("#ib_produk_id_harga_"+id, b_produk_id_harga)
      console.log("#iblok_"+id, blok)
      console.log("#ia_kategori_id_"+id, a_kategori_id)
      if(b_produk_id_harga) $("#ib_produk_id_harga_"+id).val(b_produk_id_harga).trigger('change')
      if(a_kategori_id) $("#ia_kategori_id_"+id).val(a_kategori_id).trigger('change')
      if(blok) $("#iblok_"+id).val(blok).trigger('change')
      if(is_custom){
        console.log(is_custom, 'is_custom')
        $("#ib_produk_id_"+id).val('kustom-'+blok+nomor).trigger('change')
        $("#ilt_"+id).trigger('input')
      } 
    },333)
  }
 
  initCariPembeli()
  window['produk_'+id]++;
  id_produk++;
}


function removeProduk(id){
  $('#ps_'+id).slideUp();
  setTimeout(function(){
    $('#ps_'+id).remove();
    setTotal()
  },700)
}

function setTotal(){
  var total = 0;
  $("[name='harga[]']").map(function(){
    var harga = $(this).val()
    if(harga) total += parseInt(harga.replaceAll('.',''))
    console.log(harga)
  })
  $("#ietotal_harga").val(total).trigger('keyup')
}

$("#btn_add_produk").on('click', function(e){
  e.preventDefault();
  addProduk(id_produk);
})

function getHistory(id, user_id, blok=""){
  return new Promise(function(resolve, reject){
    var url = '<?=base_url("api_admin/order/get_history/?produk_id=")?>'+id + '&user_id='+user_id + '&blok='+blok
    var metode = $("#imetode").val();
    if(metode) url += '&metode='+metode;
    var s = '';
    $.get(url).done(function(dt){
      if(dt.status == 200){
        
        if(dt.data.history.length > 0){
          s += '<div class="table table-responsive"><table class="table table-striped">';
          s += '<tr><th>No</th><th>Jenis</th><th>Nominal</th><th class="text-end">Marketing</th></tr>'
          $.each(dt.data.history, function(k,v){
            s += `<tr><td>${(k+1)}</td><td>${v.status}</td><td class="text-end">${v.sub_harga}</td><td >${v.a_pengguna_nama}</td></tr>`
            $("#iblok_0").val(v?.blok)
            $("#inomor_0").val(v?.nomor)
            $("#ia_kategori_id_0").val(v?.a_kategori_id)
            $("#ilt_0").val(v?.lt)
            $("#ilb_0").val(v?.lb)
            $("#iharga_satuan_0").val(v?.harga_satuan).trigger('input').trigger('keyup')
          })
          s += `<tr><td colspan="2"><b>Total</b></td><td class="text-end"><b>${dt.data.total}</b></td><td></td></tr>`
          if(dt.data.harga) s += `<tr class="table-info"><td colspan="2"><b>Harga</b></td><td class="text-end">${dt.data.harga}</td><td></td></tr>`
          if(dt.data.diskon) s += `<tr class="table-success"><td colspan="2"><b>Diskon (${dt.data.diskon}%)</b></td><td class="text-end">${dt.data.nominal_diskon}</td><td></td></tr>`
          if(dt.data.sisa) s += `<tr class="table-warning"><td colspan="2"><b>Sisa</b></td><td class="text-end"><b>${dt.data.sisa}</b></td><td></td></tr>`
          s += `</table></div>`
          if(dt.data.metode){
            $("#imetode").val(dt.data.metode);
            $("#imetode option[value!='"+dt.data.metode+"']").prop("disabled");
          }else{
            $("#imetode option").prop("disabled", false);
          }
          resolve(s);
        }else{
          $("#imetode option").prop("disabled", false);
          if(dt.data.metode){
            $("#imetode").val(dt.data.metode);
            s += '<div class="table table-responsive"><table class="table table-striped">';
            s += `<tr><td colspan="2"><b>Harga</b></td><td class="text-end">${dt.data.harga}</td><td></td></tr>`
            if(dt.data.diskon) s += `<tr class="table-success"><td colspan="2"><b>Diskon (${dt.data.diskon}%)</b></td><td class="text-end">${dt.data.nominal_diskon}</td><td></td></tr>`
            s += `</table></div>`
            resolve(s);
          }else{
            reject();
          }
        }
        
      }else{
        reject()
      }
    })
  })
}


$("#imetode").on('change', function(e){
  e.preventDefault();
  var id = $("#ib_produk_id_0").find("option:selected").val();
  var text = $("#ib_produk_id_0").find("option:selected").text();
  var b_user_id = $("#ib_user_id").val();
  getHistory(id, b_user_id, text).then(function(dt){
    if(dt){
      $(".panel_history").html(dt).slideDown();
    }else{
      $(".panel_history").html('').slideUp();
    }  
  }).catch(function(){
    $(".panel_history").html('').slideUp();
  });  
})


$("#imetode_pembayaran").on('change', function(e){
  e.preventDefault();
  var value = $(this).find("option:selected").val();
  if(value == 'transfer'){
    $("#panel_a_rekening_id").slideDown();
  }else{
    $("#panel_a_rekening_id").slideUp();
    $("#ia_rekening_id").val('');
  }
})

$(document).off('click', '.btn-remove-produk');
$(document).on('click', '.btn-remove-produk', function(e){
	e.preventDefault();
	var id = $(this).attr('data-count');
	removeProduk(id);
});

$(document).off('change', '[name="b_produk_id[]"]');
$(document).on('change', '[name="b_produk_id[]"]', function(e){
	e.preventDefault();
  var count = $(this).attr('data-count');
  var b_user_id = $("#ib_user_id").val();
	var id = $(this).find("option:selected").val();
	var text = $(this).find("option:selected").text();
  $(".panel_history").html('').slideUp();
  getHistory(id, b_user_id, text).then(function(dt){
    if(dt){
      $(".panel_history").html(dt).slideDown();
    }else{
      $(".panel_history").html('').slideUp();
    }  
  }).catch(function(){
    $(".panel_history").html('').slideUp();
  });  

  console.log(id,'produk')
  
  
  if(id.includes('kustom')){
    $("#iis_custom_"+count).val(1)
    $(".panel-kustom").slideDown();
  }else{
    $("#iis_custom_"+count).val(0)
    $(".form-kustom").val('');
    $(".panel-kustom").slideUp();
  }
});

$(document).off('input', '[name="qty[]"]');
$(document).on('input', '[name="qty[]"]', function(e){
	e.preventDefault();
	var id = $(this).attr('data-count');
  setSpesifikasi(id)
});

$(document).off('change', '[name="b_produk_id_harga[]"]');
$(document).on('change', '[name="b_produk_id_harga[]"]', function(e){
	e.preventDefault();
	var id = $(this).attr('data-count');
  var qty = $("#iqty_"+id).val()
	var harga = $(this).find("option:selected").attr('data-harga');
	var value = $(this).find("option:selected").val();
  $("#iharga_"+id).val(parseInt(harga)*qty).trigger('keyup');
  setTotal()
});


$(document).off('input', '[name="harga_satuan[]"]');
$(document).on('input', '[name="harga_satuan[]"]', function(e){
	e.preventDefault();
  var count = $(this).attr('data-count');
  var harga_satuan = $(this).val();
  var lt = $("#ilt_"+count).val();
  if(harga_satuan && lt){
    harga_satuan = harga_satuan.replaceAll('.','');
    var harga = harga_satuan * lt;
    $("#isub_harga_"+count).val(harga).trigger("keyup");
    setTotal();
  }
});

$(document).off('input', '[name="lt[]"]');
$(document).on('input', '[name="lt[]"]', function(e){
	e.preventDefault();
  var count = $(this).attr('data-count');
  var lt = $(this).val();
  var harga_satuan = $("#iharga_satuan_"+count).val();
  if(harga_satuan && lt){
    harga_satuan = harga_satuan.replaceAll('.','');
    var harga = harga_satuan * lt;
    $("#isub_harga_"+count).val(harga).trigger("keyup");
    setTotal();
  }
});

$(document).off('change', '[name="status[]"]');
$(document).on('change', '[name="status[]"]', function(e){
	e.preventDefault();
	var id = $(this).attr('data-count');
  var qty = $("#iqty_"+id).val()
	var harga = $(this).find("option:selected").attr('data-harga');
	var value = $(this).find("option:selected").val();
  if(value == 'survey'){
    $(".panel-pembayaran").slideUp();
    $("#igambar").prop('required', false);
    $("#imetode_pembayaran").prop('required', false);
    $("#imetode").prop('required', false);
    $("#iharga").val('0');
    $("#itotal_harga").val('0');
    $(".form-kustom").val('');
    $(".panel-kustom").slideUp();
    $("#ib_produk_id_"+id).val('').trigger('change');
  }else{
    $(".panel-pembayaran").slideDown();
    $("#igambar").prop('required', true);
    $("#imetode_pembayaran").prop('required', true);
    $("#imetode").prop('required', true);
    if(value == 'booking'){
      $("#iharga_"+id).val(parseInt("1000000")).trigger('keyup');
    }else{
      $("#iharga_"+id).val('')
    }

    setTotal()
  }
});

initCariPembeli()

$('.datepicker').datepicker({format: 'yyyy-mm-dd'})



$(document).off('click', '.history-pembayaran');
$(document).on('click', '.history-pembayaran', function(e){
	e.preventDefault();
  var id = $(this).attr('data-id');
  var blok = $(this).attr('data-blok');
  var text = $(this).text();
  var b_user_id = $("#ib_user_id").val();
  getHistory(id, b_user_id, blok).then(function(dt){
    var history = dt;
    $(".modal-title").text(text)
    $(".panel_history").html(history)
    $("#modal_history").modal('show')
  });  
});

initEditor('#icatatan');





setTimeout(function(){
  <?php if(isset($copm) && count($copm)){ ?>
    <?php foreach($copm as $kpm => $vpm){ ?>
        addProduk(id_produk, "<?=$vpm->b_produk_id?>", "<?=$vpm->qty?>", "<?=$vpm->b_produk_id_harga?>", "<?=$vpm->sub_harga?>", "<?=$vpm->status ?? "pending"?>", "<?=$vpm->is_custom ?? 0?>", "<?=$vpm->blok ?? ''?>", "<?=$vpm->nomor ?? ''?>",  "<?=$vpm->a_kategori_id ?? ''?>", "<?=$vpm->lt ?? ''?>", "<?=$vpm->lb ?? ''?>", "<?=$vpm->harga_satuan ?? ''?>")
    <?php } ?>
  <?php } ?>

  //fill data
  var data_fill = <?=json_encode($com)?>;
  console.log(data_fill);
  $.each(data_fill,function(k,v){
    if(k == 'gambar'){
      $('#img-igambar').attr('src', '<?=base_url()?>'+v);
      if(v) $("#igambar").prop('required', false)
    }else if(k == 'b_user_id'){
      $("#ie"+k).val(v);
      getTersedia(v);
    }else if(k == 'total_harga'){
      var harga = v.replaceAll('.00','');
      console.log(harga, 'harga');
      setTimeout(function(){
        $("#iharga_0").val(harga).trigger('keyup');
        setTotal();
      },333)
    }else if(k == 'metode_pembayaran'){
      $("#i"+k).val(v).trigger('change');
    }else{
      $("#ie"+k).val(v);
      $("#i"+k).val(v);
    }
  });

  setTimeout(function(){
    <?php if(isset($copm) && count($copm)){ ?>
    <?php foreach($copm as $kpm => $vpm){ ?>
        console.log("#ib_produk_id_<?=$kpm?>",'<?=$vpm->b_produk_id?>')
        <?php if(isset($vpm->b_produk_id) && strlen($vpm->b_produk_id) && !empty($vpm->b_produk_id) && !$vpm->is_custom) { ?>
          $("#ib_produk_id_<?=$kpm?>").val('<?=$vpm->b_produk_id?>').select2().trigger('change');
        <?php } ?>
    <?php } ?>
  <?php } ?>
  },333)

},333)

$(document).off('input', '[name="harga[]"]');
$(document).on('input', '[name="harga[]"]', function(e){
	e.preventDefault();
	setTotal();
});