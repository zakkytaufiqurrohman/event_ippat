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
                    <h4><center>IPPAT E-Card</center></h4>
                  </div>
                  <div class="card-body">
                    <div class="empty-state" data-height="400">
                        <img src="{{asset('/upload/foto/'.$data->img_foto)}}" class="rounded-circle z-depth-2 img-fluid img-thumbnail" width="100px" heigth=90px" alt="barcode" data-holder-rendered="true" />
                        <hr style="height:2px; width:50%; border-width:0; color:red; background-color:green">

                      <!-- <div class="empty-state-icon"> -->
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->kode, 'QRCODE',10,10)}}"class="img-fluid img-thumbnail" alt="barcode" />
                        
                      <!-- </div> -->
                      <h2 class="badge badge-success">{{$data->kode}}</h2>
                      <h2>{{Crypt::decryptString($data->nama)}}</h2>
                      <p class="lead">
                        {{Crypt::decryptString($data->no_sk)}}
                      </p>
                      <p >
                      {{Crypt::decryptString($data->ktp)}}
                      </p>
                      <a href="#" class="btn btn-primary mt-4">Daftar Ulang</a>
                      <a href="#" class="mt-4 bb">Need Help?</a>
                    </div>
                  </div>
                </div>
              </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>