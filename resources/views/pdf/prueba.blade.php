<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate('PRUEBA DE CODIGO QR')) }} ">
</body>
</html>