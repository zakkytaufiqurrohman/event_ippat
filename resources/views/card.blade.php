<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    nama {{Crypt::decryptString($data->nama)}}
    <?php $i = 'abc';?>
    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($data->kode, 'QRCODE',10,10)}}" alt="barcode" />
</body>
</html>