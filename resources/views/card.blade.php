<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>IPPAT &mdash; E-card</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-social/bootstrap-social.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('node_modules/izitoast/dist/css/iziToast.min.css') }}">
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                <div class="col-12 col-md-3 col-sm-12">
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4><center>E-CARD RAKORWIL IPPAT JATENG 2021</center></h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="javascript:void(0)" id="form-absen">
                    <div class="empty-state" data-height="400">
                    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->kode, 'QRCODE',10,10)}}" class="img-fluid img-thumbnail" alt="barcode" />

                        <hr style="height:2px; width:50%; border-width:0; color:red; background-color:green">
                        <h2 style="margin-top:0px">{{$data->nama}}</h2>
						
                      <!-- <div class="empty-state-icon"> -->
                      <img src="{{asset('/upload/foto/'.$data->img_foto)}}" width="200px" heigth=100px" alt="barcode" data-holder-rendered="true" />

                        
                      <!-- </div> -->
                      <h2 class="badge badge-success">{{$data->kode}}</h2>
                      <p tyle="margin-top:0px">
                        {{$data->no_sk}}
                      </p>
                      <p tyle="margin-top:0px" >
                      {{$data->ktp}}
                      </p>
					  <hr style="height:2px; width:95%; border-width:0; color:red; background-color:green">

                      <button type='submit' class="btn btn-primary mt-4">Daftar Ulang</button>
                      <a href="#" class="mt-4 bb">Need Help?</a>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
            var kode = '{{ $data->kode }}'
            $.ajax({
                url: "{{ route('scan.daftar_ulang') }}",
                type: "POST",
                dataType: "json",
                data: {
                  'kode': kode,
                  "_token": "{{ csrf_token() }}"
                },
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
                        text: result.message
                    });
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
    </script>
</body>

</html>