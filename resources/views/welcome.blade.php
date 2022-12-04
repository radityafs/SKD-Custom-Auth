<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Landing Page</title>
</head>

<body>
    <h1>Website ini sudah menerapkan ci/cd pipeline</h1>
    <p>
        Tunggu sebentar, website ini akan diarahkan ke halaman register
    </p>
</body>
<script>
    setTimeout(function() {
        window.location.href = "{{ url('register') }}";
    }, 5000);
</script>

</html>
