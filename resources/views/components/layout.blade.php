<!doctype html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta namse="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0,
                 maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'つぶやきアプリ' }}</title>
</head>
<body>
    {{ $slot }}
</body>




