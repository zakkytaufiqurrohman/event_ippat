<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Register</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo.png')}}" />

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="../node_modules/selectric/public/selectric.css">

	<!-- Template CSS -->
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/components.css">
	<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">

</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
						<!-- <div class="login-brand">
						<img src="{{asset('assets/img/logo.png')}}" alt="logo" width="200" heigth="200" class="shadow-light rounded-circle">
						</div> -->

						<div class="card card-primary">
							<div class="card-header">
								<h4>Register</h4>
							</div>

							<div class="card-body">
								<form method="POST" id='form-register' enctype="multipart/form-data">
									@csrf
                                    <div class="form-group">
                                    <label>Pengda</label>
											<select class="form-control selectric" id="pengda" name="pengda">
												<option value='0'>-pengda-</option>
												@foreach($pengdas as $pengda)
												<option value="{{$pengda->id}}">{{$pengda->nama}}</option>
												@endforeach
											</select>
									</div>

									<div class="form-group">
										<label for="nama">Nama</label>
										<input id="nama" type="text" class="form-control" required name="nama" autofocus>

									</div>

									<div class="form-group">
										<label for="nik">No SK</label>
										<input id="no_sk" type="text" class="form-control" required name="no_sk" autofocus readonly>

									</div>

									<div class="row">
										<div class="form-group col-6">
											<label>NO WA</label>
                                            <input id="wa" type="text" class="form-control" required name="wa" disabled >
                                            <span>*Patikan No benar (digunakan untuk E-Card)</span>

										</div>
										<div class="form-group col-6">
											<label>Email</label>
                                            <input id="email" type="email" class="form-control" required name="email"  disabled >

										</div>
									</div>

									<div class="row">
										<div class="form-group col-6">
                                        <label>No KTP</label>
                                            <input id="ktp" type="number" class="form-control" required name="ktp" disabled >

										</div>
										<div class="form-group col-6">
											<label for="sk" class="d-block">Sk</label>
											<input id="sk" type="file" class="form-control" name="sk" required disabled >
                                            <span>*Patikan foto terlihat jelas (Max 500 Kbps jpg/png)</span>
										</div>
									</div>
                                    <div class="row">
										<div class="form-group col-6">
											<label for="foto" class="d-block">Foto Diri</label>
											<input id="foto" type="file" class="form-control" name="foto" required disabled >
                                            <span>*Patikan foto terlihat jelas (Max 500 Kbps jpg/png)</span>
                                            <span>*Foto akan digunakan untuk verifikasi data</span>

										</div>
										<div class="form-group col-6">
											<label for="bukti_tf" class="d-block">Bukti Transfer</label>
											<input id="bukti_tf" type="file" class="form-control" name="bukti_tf" required disabled >
                                            <span>*Patikan foto terlihat jelas (Max 500 Kbps jpg/png)</span>
										</div>
									</div>

									<div class="form-group">
										<button type="submit" id="btn-register" class="btn btn-primary btn-lg btn-block" disabled>
											Register
										</button>
									</div>
									<div class="mt-5 text-muted text-center">
									</div>
								</form>
							</div>
						</div>
						<div class="simple-footer">
                        Copyright &copy;2021 - {{date('Y')}} IPPAT All Right Reserved designed by Stisla {{ Date('Y')}}
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="../assets/js/stisla.js"></script>

	<!-- JS Libraies -->
	
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- toast -->
    <script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>

	<!-- Page Specific JS File -->
	<!-- <script src="{{ asset('assets/js/page/auth-register.js')}}"></script> -->

	<script type="text/javascript">
		$("#nama").on('keyup', function(){
			var pengda = $("#pengda").find(":selected").val();
			console.log(pengda);
			if(pengda === '0' || pengda.length == 0){
				alert('penda belum di pilih');
			}
			var form=$("body");
			form.find('.invalid-feedback').remove();
			form.find('.form-group .is-invalid').removeClass('is-invalid');
			var nama =  $(this).val();
			$.ajax({
				url: "{{route('daftar.cek_nama')}}",
				type: "POST",
				data :{
					"pengda": pengda,
					"nama":nama,
					"_token": "{{ csrf_token() }}",
				},
				dataType: "json",
				beforeSend() {
                    $("#no_sk").addClass("btn-progress");
                },
                complete() {
                    $("#no_sk").removeClass("btn-progress");
                },
				success: function(data) {
					var form=$("body");
					form.find('.invalid-feedback').remove();
					form.find('.form-group .is-invalid').removeClass('is-invalid');
					if(data == 0){
						$("#no_sk").addClass('is-invalid').after('<div class="invalid-feedback">Nomor SK tidak terdaftar</div>');
						$("#wa").prop('disabled',true);
						$("#ktp").prop('disabled',true);
						$("#sk").prop('disabled',true);
						$("#foto").prop('disabled',true);
						$("#bukti_tf").prop('disabled',true);
						$("#email").prop('disabled',true);
						$("#no_sk").val('')
						$("#btn-register").prop('disabled',true);
					}
					else {
						$("#wa").prop('disabled',false);
						$("#ktp").prop('disabled',false);
						$("#sk").prop('disabled',false);
						$("#foto").prop('disabled',false);
						$("#bukti_tf").prop('disabled',false);
						$("#email").prop('disabled',false);
						$("#btn-register").prop('disabled',false);
						$("#no_sk").val(data)
					}
					
				}
			});
		});

		// register
		$("#form-register").on("submit", function(e) {
            e.preventDefault();
            var form=$("body");
                form.find('.invalid-feedback').remove();
				$('input').removeClass('is-invalid');
			$.ajax({
				url: "{{route('daftar.register')}}",
				type: "POST",
				dataType: "json",
				data: new FormData(this),
				processData: false,
				contentType: false,
                beforeSend() {
                    $("#btn-register").addClass("btn-progress");
                    $("input").attr("disabled", "disabled");
                    $("button").attr("disabled", "disabled");
					$('input').removeClass('is-invalid');
                },
                complete() {
                    $("#btn-register").removeClass("btn-progress");
                    $("input").removeAttr("disabled", "disabled");
                    $("button").removeAttr("disabled", "disabled");
                },
                success(result) {
                    if (result['status'] == 'success') {
                        iziToast.success({
                            title: "success",
                            message: result.message,
                            position: 'bottomRight'
                        });
                        window.location = "/daftars/success";
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: result.message,
                            position: 'bottomRight'
                        });
                    }
                },
                error:function (response){
					$.each(response.responseJSON.errors,function(key,value){
						$("input[name="+key+"]").addClass('is-invalid').after('<div class="invalid-feedback">'+value+'</div>');
                })
                }
            });
		});          
    </script>
</body>

</html>