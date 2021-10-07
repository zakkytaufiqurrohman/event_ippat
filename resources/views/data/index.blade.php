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
@section('title','Data Peserta')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button>
                <button disabled class="btn btn-md btn-success" onclick="importModal()"><i class='fa fa-download'></i>&nbsp;Import</button>
                <a href="{{route('data.export')}}" target='_blank' id="print-btn" class="btn btn-md btn-primary float-right"><i class='fa fa-print'></i>Excel</a>

                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered" id="table-data">
                        <thead>
                            <th>No</th>
                            <th>Pengda</th>
                            <th>Nama</th>
                            <th>Nick</th>
                            <th>SK</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-import">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('data.import')}}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label>File EXCEL</label>
                    <input type="file" class="form-control" name="file" placeholder="file" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-add">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data pendaftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="javascript:void(0)" id="form-add">
            <div class="modal-body">
                @csrf
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
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dengan gelar" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>No SK</label>
                    <input type="text" class="form-control" name="no_sk" id="no_sk" placeholder="" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" autocomplete="off">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
    <div class="modal-dialog modal-lg" role="document">
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
                <input type="hidden" class="form-control" name="id" id="id">
                <div class="form-group form-role">
                    <label>Kanwil</label>
                    <select class="form-control" name="pengda" id="pengda-edit">
                        @foreach($pengdas as $kanwil)
                        <option value="{{ $kanwil->id }}" > {{ $kanwil->nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback-custom"></div>
                </div>
                <div class="form-group">
                    <label>Nick Name</label>
                    <input type="text" class="form-control" name="nick_name" id="nick_name" placeholder="Nama tanpa gelar" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Dengan gelar" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>No SK</label>
                    <input type="text" class="form-control" name="no_sk" id="no_sk" placeholder="" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="textarea" class="form-control" name="alamat" id="alamat" autocomplete="off">
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

            $("#form-add").on("submit", function(e) {
                e.preventDefault();
                AddData();
            });

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

        function GetData(){
            $('#table-data').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{ route('data.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'no', "width": "2%", orderable: false, searchable: false},
                    {data: 'pengda', name: 'nama'},
                    {data: 'name', name: 'name'},
                    {data: 'nick', name: 'nick'},
                    {data: 'sk', name: 'sk'},
                   
                    {data: 'alamat', name: 'alamat'},
                    {data: 'action', name: 'action', 'text-align': 'center', orderable: false, searchable: false},
                ]
            });
        }

        function OpenModalAdd(){
            $('#modal-add').modal('show');
        }

        function importModal(){
            $('#modal-import').modal('show');
        }

        function Edit(object){
            var id = $(object).data('id')

            var url = "{{ route('data.edit', ':id') }}";
            url = url.replace(':id',id);
            
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success(result){
                    $('#modal-edit').modal('show');
                    var data = result['data'];
                    $('#modal-edit').find('input[name="id"]').val(data.id);
                    $('#modal-edit').find('input[name="nick_name"]').val(data.nick_name);
                    $('#modal-edit').find('input[name="nama"]').val(data.nama);
                    $('#modal-edit').find('input[name="no_sk"]').val(data.no_sk);
                    $('#modal-edit').find('input[name="alamat"]').val(data.alamat);
                    console.log(data);
                    $('#pengda-edit').val(data.pengda_id).change()
                }
            });
        }

        function AddData(){
            var formData = $("#form-add").serialize();

            $.ajax({
                url: "{{ route('data') }}",
                type: "POST",
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
                    if(result.status == 'success'){
                        $("#form-add")[0].reset();
                        $('#modal-add').modal('hide');
                        GetData();
                                            
                        iziToast.success({
                            title: result.status,
                            message: result.message,
                            position: 'topRight'
                        });
                    }
                    if(result.status == 'error'){
                        $("#form-add")[0].reset();
                        $('#modal-add').modal('hide');
                        GetData();
                        iziToast.error({
                        title: 'Error',
                        message: result.message,
                        position: 'topRight'
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
        }

        function UpdateData(){
            var formData = $("#form-edit").serialize();

            var id = $('#idEdit').val();
            var url = "{{ route('data.update', ':id') }}"
            url = url.replace(':id',id);

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
                        url: "{{ route('data.delete') }}",
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

        
    </script>
@endsection