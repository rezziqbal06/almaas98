var media_target_div = 'dgaleri_items';
var media_single = 0;
var media_name = 'image[]';
var media_caption = 0;
var media_id = '';
var folder_id = '';
var galeri_item_count = 0;
var id_spec = 0;

function gritter(pesan,jenis="info"){
	$.bootstrapGrowl(pesan, {
		type: jenis,
		delay: 3500,
		allow_dismiss: true
	});
}

$('.currency').mask("#.##0", {reverse: true});

$(".select2").select2();
function convertToSlug(Text) {
  	return Text.toLowerCase()
             .replace(/ /g, '-')
             .replace(/[^\w-]+/g, '');
}


//fill data
var data_fill = <?=json_encode($bpm)?>;
$.each(data_fill,function(k,v){
	if(k == 'gambar'){
  }else{
    $("#ie"+k).val(v);
    if(k == 'harga') $("#ie"+k).trigger('input')
  }
});

var data_fill_gambar = <?=json_encode($bpgm)?>;
if(data_fill_gambar){
  console.log(data_fill_gambar)
  $.each(data_fill_gambar, function(k,v){
    $('#img-iegambar'+v.ke).attr('src', '<?=base_url()?>'+v.gambar);
    if(v.is_cover == 1){
      $("[name='is_cover'][value='"+v.ke+"']").prop('checked', true)
    } 
  })
}

//submit form
$("#fedit").on("submit",function(e){
	e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch fa-spin');

	var fd = new FormData($(this)[0]);
  var i = 1;
  for(i = 1;i <= 5; i++){
    var gambar = getImageData('iegambar'+i+'prev');
    if(gambar){
      fd.append('gambar'+i, gambar.blob, 'gambar.'+gambar.extension);
    }
  }
	fd.append('deskripsi', editor["#iedeskripsi"].getData())

	var url = '<?=base_url("api_admin/pengaturan/produk/edit/".$bpm->id)?>';

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
					window.location = '<?=base_url_admin('pengaturan/produk/')?>';
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
				gritter('<h4>Error</h4><p>Tidak dapat mengubah data sekarang, silahkan coba lagi nanti</p>','danger');
			}, 666);

			$('.icon-submit').removeClass('fa-circle-o-notch fa-spin');
			$('.btn-submit').prop('disabled',false);
			NProgress.done();
			return false;
		}
	});

});

$("#ienegara").on("change",function(e){
	e.preventDefault();
	$("#ieprovinsi").trigger("change");
});

$("#ieprovinsi").select2({
	ajax: {
		method: 'post',
		url: '<?=$this->config->semevar->api_address."provinsi/get/"?>',
		dataType: 'json',
    delay: 250,
		data: function (params) {
      var query = {
        keyword: params.term,
        negara: $("#ienegara").val()
      }
      return query;
    },
    processResults: function (dt) {
      return {
        results:  $.map(dt.result, function (itm) {
          return {
            text: itm.text,
            id: itm.text
          }
        })
      };
    },
    cache: true
	}
});

$("#iekabkota").select2({
	ajax: {
		method: 'post',
		url: '<?=$this->config->semevar->api_address."kabkota/get/"?>',
		dataType: 'json',
    delay: 250,
		data: function (params) {
      var query = {
        keyword: params.term,
        provinsi: $("#ieprovinsi").val()
      }
      return query;
    },
    processResults: function (dt) {
      return {
        results:  $.map(dt.result, function (itm) {
          return {
            text: itm.text,
            id: itm.text
          }
        })
      };
    },
    cache: true
	}
});

$("#iekecamatan").select2({
	ajax: {
		method: 'post',
		url: '<?=$this->config->semevar->api_address."kecamatan/get/"?>',
		dataType: 'json',
    delay: 250,
		data: function (params) {
      var query = {
        keyword: params.term,
        kabkota: $("#iekabkota").val()
      }
      return query;
    },
    processResults: function (dt) {
      return {
        results:  $.map(dt.result, function (itm) {
          return {
            text: itm.text,
            id: itm.text
          }
        })
      };
    },
    cache: true
	}
});


$("#iekelurahan").select2({
	ajax: {
		method: 'post',
		url: '<?=$this->config->semevar->api_address."kelurahan/get/"?>',
		dataType: 'json',
    delay: 250,
		data: function (params) {
      var query = {
        keyword: params.term,
        kecamatan: $("#iekecamatan").val()
      }
      return query;
    },
    processResults: function (dt) {
      return {
        results:  $.map(dt.result, function (itm) {
          return {
            text: itm.text,
            id: itm.text
          }
        })
      };
    },
    cache: true
	}
});

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
  setCompressedImage(e)
	var id = $(this).attr('id');
	readURLImage(this, 'img-'+id);
});

$('.select2').select2();

function generateCombinations(arrays, i = 0) {
  if (!arrays[i]) {
    return [];
  }
  if (i == arrays.length - 1) {
    return arrays[i];
  }
  const tmp = generateCombinations(arrays, i + 1);
  const result = [];
  for (let j = 0; j < arrays[i].length; j++) {
    for (let k = 0; k < tmp.length; k++) {
      result.push(Array.isArray(tmp[k]) ? [arrays[i][j], ...tmp[k]] : [arrays[i][j], tmp[k]]);
    }
  }
  return result;
}

initEditor('#iedeskripsi');
