<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('idcard/idCard.css')}}">
    <title>ID Card</title>
<!--     
    So lets start -->
</head>
<body>
        <div class="container">
            <div class="padding">
                <div class="font">
                    <div class="top">
                        <!-- <img src="download.png"> -->
                    </div>
                    <div class="bottom">
                        <p>{{Crypt::decryptString($data->nama)}}</p>
                        <p class="desi">{{Crypt::decryptString($data->no_sk)}}</p>
                        <div class="barcode">
                            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->kode, 'QRCODE',10,10)}}" alt="barcode" />

                        </div>
                        <br>
                        <p class="no">{{$data->getPengda->nama}}</p>
                        <p class="no">{{$data->kode}}</p>
                        <p class="no">{{Crypt::decryptString($data->ktp)}}</p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>


