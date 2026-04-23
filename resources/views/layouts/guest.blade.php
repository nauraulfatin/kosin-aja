<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KosinAja!</title>
    @vite('resources/css/app.css') <!-- Jika Anda menggunakan Laravel Mix -->
</head>
<body class="bg-[#F8F5F0]">

    <!-- Content Here -->
    {{ $slot }} <!-- Ini akan menampilkan konten dari komponen seperti form register -->

</body>
</html>