@extends('layouts.app')

@section('top-script')
<style>
    .img-custom{
        width: 300px;
        height: 300px;
        object-fit: cover;
    }
    .info-custom{
        text-align: center;
        color: #34395E;
    }
</style>
@endsection

@section('body')
@section('title','Scan Surat Suara')
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <span>Silahkan Scan ID Card Anda Di Bawah Ini</span>
                {{-- <div class="card-header-action">
                    <a class="btn btn-primary">18:00:00</a>
                </div> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="javascript:void(0)" id="form-absen">
                @csrf
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg" autofocus name="kode" id="kode" placeholder="Scan Kode QR Anda" autocomplete="off">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-lg btn-primary" id='btn-submit' type="button">
                                <i class='fa' aria-hidden="true" id='icon-submit'></i>
                                <span>Absen</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-5" id="info">
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('bottom-script')
    <script src="{{ asset('node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script>
        $(function () {
            $("#form-absen").on("submit", function(e) {
                e.preventDefault();
                SaveAbsent();
            });
        });

        function SaveAbsent(){
            var formData = $("#form-absen").serialize();
            $('#info').empty();

            $.ajax({
                url: "{{ route('scan.surat_suara') }}",
                type: "POST",
                dataType: "json",
                data: formData,
                beforeSend() {
                    $('#icon-submit').addClass('fa-spinner');
                    $('#btn-submit').attr('disabled',true);
                },
                complete(){
                    $('#icon-submit').removeClass('fa-spinner');
                    $('#btn-submit').attr('disabled',false);
                },
                success(result){
                    swal({
                        icon: result.status,
                        title: 'Ooops...',
                        text: result.message,
                        timer: 2000, //timeOut for auto-close
                        buttons: {
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true
                            }
                        }
                    });      
                    if(result.status=='success'){
                        $("#form-absen")[0].reset();
                        GetData(result.kode)
                    }
                    $("#kode").val('')
                    $("#kode").focus()
                },
                error(xhr, status, error) {
                    var err = eval('(' + xhr.responseText + ')');
                    $.each(err.errors,function(key,value){
                        iziToast.error({
                            title: 'Error',
                            message: value,
                            position: 'topRight'
                        });
                    })
                    
                }
            });
        }

        function GetData(kode){
             
            var url = "{{ route('scan', ':id') }}";
            url = url.replace(':id',kode);
            
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success(result){

                    var data = result.data;
                    var html = '';
                    html += `
                        <img src="{{ asset('upload/foto/${data.img_foto}') }}" alt="Photo" class="img-fluid rounded mx-auto d-block img-custom">
                        <div class="info-custom mt-4">
                            <h4>NIK : <span>${data.nik}</span></h4>
                            <h4>No SK : <span>${data.no_sk}</span></h4>
                            <h4>Nama : <span>${data.nama}</span></h4>
                            <h4>Pengda : <span>${data.pengda}</span></h4>
                        </div>
                    `;

                    $('#info').append(html);
                }
            });
        }
    </script>
@endsection