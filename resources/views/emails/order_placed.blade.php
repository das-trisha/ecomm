<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h2>Thank you for your order!</h2>
    <p>Hello {{ $order->name }},</p>
    <p>Your order has been placed successfully. Here are the order details:</p>
    
    <table>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
        <tr>
            <td>{{ $order->product_title }}</td>
            <td>{{ $order->price }}</td>
            <td>{{ $order->quantity }}</td>
        </tr>
        <!-- Add more rows for other products if needed -->
    </table>
    
    <p>Total amount: {{ $order->price * $order->quantity }}</p>
    
    <p>Thank you for shopping with us!</p>
</body>
</html>
