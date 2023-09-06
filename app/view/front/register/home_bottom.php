var register_try = 0;
function gritter(pesan,judul="info"){
	$.bootstrapGrowl(pesan, {
		type: judul,
		delay: 3456,
		allow_dismiss: true
	});
}

$("#form-register").on("submit",function(evt){
	evt.preventDefault();
	console.log('register')
	register_try++;
	var url = '<?=base_url('register/proses'); ?>';
	var fd = $(this).serialize();

	var repassword = $("#irepassword").val();
	var password = $("#ipassword").val();

	if(password.length<=4){
		$("#ipassword").focus();
		gritter("<h4>Info</h4><p>Password terlalu pendek</p>",'warning');
		return false;
	}

	if(password != repassword){
		$("#irepassword").focus();
		gritter("<h4>Info</h4><p>Ulangi Password salah</p>",'warning');
		return false;
	}
	NProgress.start();
	
	$(".btn-submit").prop("disabled",true);
	$("#icon-submit").removeClass("fa-chevron-right");
	$("#icon-submit").addClass("fa-circle-o-notch");
	$("#icon-submit").addClass("fa-spin");
	$.post(url,fd).done(function(dt){
		if(dt.status == 200){
			NProgress.done();
			gritter("<h4>Sukses</h4><p>Berhasil. Selamat Anda menjadi bagian dari kami!</p>",'success');
			setTimeout(function(){
				window.location =  '<?=base_url('')?>';
			},1500);
		}else{
			$("#iusername").prop("disabled",false);
			$("#ipassword").prop("disabled",false);
			$(".btn-submit").prop("disabled",false);
			$("#icon-submit").addClass("fa-chevron-right");
			$("#icon-submit").removeClass("fa-circle-o-notch");
			$("#icon-submit").removeClass("fa-spin");
			NProgress.done();
			gritter("<h4>Gagal</h4><p>"+dt.message+"</p>",'danger');
		}
	}).error(function(){
		$("#iusername").prop("disabled",false);
		$("#ipassword").prop("disabled",false);
		$(".btn-submit").prop("disabled",false);
		$("#icon-submit").addClass("fa-chevron-right");
		$("#icon-submit").removeClass("fa-circle-o-notch");
		$("#icon-submit").removeClass("fa-spin");
		gritter("<h4>Error</h4><p>tidak dapat register sekarang, silahkan coba lagi nanti</p>",'warning');
		NProgress.done();
	});
});
