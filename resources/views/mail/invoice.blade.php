<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 class="">Successfully Order Placed</h1><br>
    <strong>Order Id: {{$order['order_id']}}</strong><br>
    <strong>Order Date: {{$order['date']}}</strong><br>
    <strong>Total Amount: {{$order['total']}}</strong><br>
    <hr>
    <strong>Name: {{$order['c_name']}}</strong><br>
    <strong>Phone: {{$order['c_phone']}}</strong><br>
    <strong>Address {{$order['c_address']}}</strong><br>

</body>
</html>