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
                    <div class="col-lg-7">
                        
                    </div>
                    <div class="col-lg-3">
                        <?php $id = "0" ?>;
                        <a href="{{route('lap_pendaftar.export',$id)}}" target='_blank' id="print-btn" class="btn btn-md btn-primary float-right"><i class='fa fa-print'></i>Excel</a>
                    </div>
                </div>
                <!-- <button class="btn btn-md btn-primary" onclick="OpenModalAdd()"><i class='fa fa-plus'></i>&nbsp;Tambah</button> -->
                <div class="table-responsive mt-4">
                    <table class="table table-striped table-bordered" id="table-data">
                        <thead>
                            <th>No</th>
                            <th>Pengda</th>
                            <th>Nama</th>
                        </thead>
                    </table>
                </div>
            </div>
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
                    url: "{{ route('lap_pendaftar.data') }}",
                    data: {
                        id: id
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'no', "width": "2%", orderable: false, searchable: false},
                    {data: 'pengda', name: 'nama'},
                    {data: 'nama', name: 'nama'},
                ]
            });
        }

        function OpenModalAdd(){
            $('#modal-register').modal('show');
        }


        $("#waktu").change(function(){
            var id = $(this).val();
            var url = "{{ route('lap_pendaftar.export', ':id') }}";
            url = url.replace(':id',id);
            $('#print-btn').attr("href", url);
            GetData(id);
        });

        
    </script>
@endsection