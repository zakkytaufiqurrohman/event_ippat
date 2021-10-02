@extends('layouts.app')

@section('top-script')
<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
<style>
    .is-invalid-custom{
        border-color: #dc3545 !important;
    }
    .invalid-feedback-custom {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }
</style>
@endsection
@section('body')
@section('title','Data pendaftar')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <div class="form-group row" style="margin-left: 1px;">
                    <div class="col-lg-2">
                            <select class="form-control" width="50px"  name="waktu" id="waktu">
                                <option value="">All</option>
                                @foreach($pengdas as $pengda)
                                    <option value="{{$pengda->id}}">{{$pengda->nama}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-lg-8">
                    </div>
                    <div class="col-lg-2">
                    <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
                    </div>
                </div>
                <!-- <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button> -->
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered" id="table-data">
                        <thead>
                            <th>No</th>
                            <th>Pengda</th>
                            <th>Nama</th>
                            <th>No Sk</th>
                            <th>Kode</th>
                            <th>Wa</th>
                            <th>Email</th>
                            <th>Foto</th>
                            <th>Bukti</th>
                            <th>SK foto</th>
                            <th>Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-register">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data pendaftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-register">
            <div class="modal-body">
                @csrf
                <input type="hidden" class="form-control" value="flag" name="flag" id="flag" placeholder="flag" autocomplete="off">
                <div class="form-group form-role">
                    <label>Pengda</label>
                    <select class="form-control" name="pengda" id="pengda">
                        @foreach($pengdas as $pengda)
                        <option value="{{ $pengda->id }}" > {{ $pengda->nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback-custom"></div>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Tanpa gelar" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>SK</label>
                    <input type="text" class="form-control" name="no_sk" id="no_sk" placeholder="no_sk" autocomplete="off">
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label>NO WA</label>
                        <input id="wa" type="text" class="form-control" required name="wa" >
                        <span>*Patikan No benar (digunakan untuk E-Card)</span>

                    </div>
                    <div class="form-group col-6">
                        <label>Email</label>
                        <input id="email" type="email" class="form-control" required name="email"  >

                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                    <label>No KTP</label>
                        <input id="ktp" type="number" class="form-control" required name="ktp" >

                    </div>
                    <div class="form-group col-6">
                        <label for="sk" class="d-block">Sk</label>
                        <input id="sk" type="file" class="form-control" name="sk" required >
                        <span>*Patikan foto terlihat jelas (Max 500 Kbps jpg/png)</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="foto" class="d-block">Foto Diri</label>
                        <input id="foto" type="file" class="form-control" name="foto" required >
                        <span>*Patikan foto terlihat jelas (Max 500 Kbps jpg/png)</span>
                        <span>*Foto akan digunakan untuk verifikasi data</span>

                    </div>
                    <div class="form-group col-6">
                        <label for="bukti_tf" class="d-block">Bukti Transfer</label>
                        <input id="bukti_tf" type="file" class="form-control" name="bukti_tf" required >
                        <span>*Patikan foto terlihat jelas (Max 500 Kbps jpg/png)</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button id="btn-register" type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data pendaftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-edit">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input type="hidden" name="id" id="idEdit">
                    <input type="text" class="form-control" name="nama" id="namaEdit" placeholder="Nama" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Wa</label>
                    <input type="text" class="form-control" name="wa"  placeholder="wa" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email"  placeholder="email" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('bottom-script')
    <script src="{{ asset('node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('node_modules/select2/dist/js/select2.full.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            GetData();

            // $("#form-add").on("submit", function(e) {
            //     e.preventDefault();
            //     AddData();
            // });

            $("#form-edit").on("submit", function(e) {
                e.preventDefault();
                UpdateData();
            });

            $('#modal-add').on('hidden.bs.modal', function () {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            $('#modal-edit').on('hidden.bs.modal', function () {
                $('input').removeClass('is-invalid');
                $('select').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });
            
        });

        function GetData(id){
            $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: "{{ route('pendaftar.data') }}",
                    data: {
                        id: id
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'no', "width": "2%", orderable: false, searchable: false},
                    {data: 'pengda', name: 'nama'},
                    {data: 'nama', name: 'nama'},
                    {data: 'no_sk', name: 'no_sk'},
                    {data: 'kode', name: 'kode'},
                    {data: 'wa', name: 'wa'},
                    {data: 'email', name: 'email'},
                    {data: 'foto', name: 'nama'},
                    {data: 'bukti', name: 'nama'},
                    {data: 'sk', name: 'sk'},
                    {data: 'action', name: 'action', 'text-align': 'center', orderable: false, searchable: false},
                ]
            });
        }

        function OpenModalAdd(){
            $('#modal-register').modal('show');
        }

        function Edit(object){
            var id = $(object).data('id')

            var url = "{{ route('pendaftar.edit', ':id') }}";
            url = url.replace(':id',id);
            
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success(result){
                    $('#modal-edit').modal('show');
                    var data = result['data'];
                    $('#modal-edit').find('input[name="id"]').val(data.id);
                    $('#modal-edit').find('input[name="nama"]').val(data.nama);
                    $('#modal-edit').find('input[name="wa"]').val(data.wa);
                    $('#modal-edit').find('input[name="email"]').val(data.email);

                }
            });
        }

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
                    $("input").attr('disabled', 'disabled');
                    $("button").attr('disabled', 'disabled');
                    $("select").attr('disabled', 'disabled');
                    $('input').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                },
                complete(){
                    $("input").removeAttr('disabled', 'disabled');
                    $("button").removeAttr('disabled', 'disabled');
                    $("select").removeAttr('disabled', 'disabled');
                },
                success(result){
                    if (result['status'] == 'success') {
                        $("#form-register")[0].reset();
                        $('#modal-register').modal('hide');
                        GetData();
                    } else {
                        iziToast.error({
                            title: "Error",
                            message: result.message,
                            position: 'bottomRight'
                        });
                    }
                },
                error(xhr, status, error) {
                    var err = eval('(' + xhr.responseText + ')');
                    iziToast.error({
                        title: 'Error',
                        message: err.message,
                        position: 'topRight'
                    });
                },
                error:function (response){
                    $.each(response.responseJSON.errors,function(key,value){
                        $("input[name="+key+"]").addClass('is-invalid').after('<div class="invalid-feedback">'+value+'</div>');
                    })
                }
            });
        })
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

        function UpdateData(){
            var formData = $("#form-edit").serialize();

            var id = $('#idEdit').val();
            var url = "{{ route('pendaftar.update') }}"

            $.ajax({
                url: url,
                method: "POST",
                dataType: "json",
                data: formData,
                beforeSend() {
                    $("input").attr('disabled', 'disabled');
                    $("button").attr('disabled', 'disabled');
                    $("select").attr('disabled', 'disabled');
                    $('input').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                },
                complete(){
                    $("input").removeAttr('disabled', 'disabled');
                    $("button").removeAttr('disabled', 'disabled');
                    $("select").removeAttr('disabled', 'disabled');
                },
                success(result){
                    $("#form-edit")[0].reset();
                    $("#role-edit").val("");
                    $("#role-edit").trigger("change");
                    $('#modal-edit').modal('hide');
                    GetData();
                                        
                    iziToast.success({
                        title: result.status,
                        message: result.message,
                        position: 'topRight'
                    });
                },
                error(xhr, status, error) {
                    var err = eval('(' + xhr.responseText + ')');
                    iziToast.error({
                        title: 'Error',
                        message: err.message,
                        position: 'topRight'
                    });
                },
                error:function (response){
                    $.each(response.responseJSON.errors,function(key,value){
                        $("input[name="+key+"]").addClass('is-invalid').after('<div class="invalid-feedback">'+value+'</div>');
                        if(key=='roleEdit'){ 
                            $("#role-edit").addClass('is-invalid is-invalid-custom'); 
                            $(".form-role").append('<div class="invalid-feedback invalid-feedback-custom">'+value+'</div>')
                        }
                    })
                }
            });
        }

        function Delete(object){
            var id = $(object).data('id');
            swal({
                title: 'Hapus?',
                text: 'Apakah anda yakin ingin menghapus data ini?',
                icon: 'error',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "{{ route('pendaftar.delete') }}",
                        method: "POST",
                        dataType: "json",
                        data: {
                            "id": id,
                            "_token": "{{ csrf_token() }}",
                            "_method": "DELETE"
                        },
                        success(result){
                            iziToast.success({
                                title: result.status,
                                message: result.message,
                                position: 'topRight'
                            });
                            GetData()
                        },
                        error(xhr, status, error) {
                            var err = eval('(' + xhr.responseText + ')');
                            iziToast.error({
                                title: 'Error',
                                message: err.message,
                                position: 'topRight'
                            });
                        }
                    });
                }
            });
        }

        $("#waktu").change(function(){
            var id = $(this).val();
            GetData(id);
        });

        
    </script>
@endsection