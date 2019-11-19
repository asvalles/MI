<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Screen</title>

    <script type="text/javascript">
        function shareFB(){
            var getUrl = window.location;
            var baseUrl = getUrl.protocol + '//' + getUrl.host + '/';
            baseUrl = baseUrl + '/screen/screen.png';
            var pts = document.getElementById('usuarioPunt').value;
            shareScore(pts, baseUrl);
        }
    </script>


</head>
<body>
    <div>
        <img src="{{ asset('screen/screen.png') }}">
        <input type="hidden" id="usuarioPunt" value="{{ $puntuacion }}">
        <button onclick="shareFB();">Publicar en Facebook</button>
    </div>
</body>
</html>