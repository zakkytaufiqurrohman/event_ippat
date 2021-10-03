
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>IPPAT</title>
    <link rel="stylesheet" href="{{ asset('live/sb-admin-2.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}"> -->
    <!-- <link href="ippat/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="ippat/css/sb-admin-2.min.css" rel="stylesheet"> -->
    <meta http-equiv="refresh" content="1200" >
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/pricing/">

    

    <!-- Bootstrap core CSS -->
<link href="mathassets/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="mathassets/pricing.css" rel="stylesheet">
  </head>
  <body>

<div class="container py-3">
  <header>

    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h4 class="display-4 fw-normal">Ikatan Pejabat Pembuat Akta Tanah (IPPAT)</h4>
      <p class="fs-5 text-muted"></p>
    </div>
  </header>

  <main>
      
      <div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Anggota Terdaftar
                                                </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{$data}}                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
     </div>
      
      
      
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-success">
          <div class="card-header py-3 text-white bg-success border-success">
            <h4 class="my-0 fw-normal">Registrasi Peserta</h4>
          </div>
          <div class="card-body">
            <h1 style=font-size:80px class="card-title pricing-card-title">
            @asyncWidget('daftar_ulang')
            <small class=" text-success">/ {{$data}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Jumlah Peserta yang Sudah Registrasi / Daftar Ulang</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-success">
          <div class="card-header py-3 text-white bg-success border-success">
            <h4 class="my-0 fw-normal">Surat Suara</h4>
          </div>
          <div class="card-body">
            <h1 style=font-size:80px class="card-title pricing-card-title">
            @asyncWidget('surat_suara')
            <small class=" text-success">/ {{$data}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Jumlah Peserta yang sudah mendapatkan Surat Suara</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm border-success">
          <div class="card-header py-3 text-white bg-success border-success">
            <h4 class="my-0 fw-normal">Kotak Suara</h4>
          </div>
          <div class="card-body">
            <h1 style=font-size:80px class="card-title pricing-card-title">
            @asyncWidget('kotak_suara')
            <small class=" text-success">/ {{$data}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Jumlah Peserta yang sudah mengisi Surat Suara</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>


    
  </body>
</html>
