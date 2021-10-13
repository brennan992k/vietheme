<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('paypal/charge') }}" method="post">
        <input type="text" name="amount" />
        {{ csrf_field() }}
        <input type="submit" name="submit" value="Pay Now">
    </form>
</body>
</html>