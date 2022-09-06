<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Przekierowywanie do płatności...</title>
</head>
<body>
    Przekierowywanie do płatności...
    <form method="POST" action="https://ssl.dotpay.pl/test_payment/" name="form">
        @foreach ($parametersList as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
    </form>
    <script>
        document.forms['form'].submit();
    </script>
</body>
</html>




