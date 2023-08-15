<!DOCTYPE html>
<html>
   <head>
   <style type="text/css">
    
    .center{
      margin:auto;
      width:50%;
      text-align:center;
      margin-top:30px;
      border: 10px solid white;
    }
    .img_size{
        height: 150px;
        width: 150px;
    }
    table,td,th{
        border: 1px solid grey;
    }
    .th_deg{
        padding: 5px;
        font-size:30px;
        background:skyblue;
    }
    .total_deg{
        font-size:20px;
        padding: 40px;
    }
    </style>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <!-- Add this inside the <head> section of your layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

   </head>
   <body>
      <div class="hero_area">
         @include('home.header')  
      
         <div class="center">
    <table>
        <tr>
            <th class="th_deg">Product Title</th>
            <th class="th_deg">Product Quantity</th>
            <th class="th_deg">Payment Status</th>
            <th class="th_deg">Delivery Status</th>
            <th class="th_deg">Image</th>
            <th class="th_deg">Cancel Order</th>
        </tr>
        @foreach ($order as $order)
        <tr>   
            <td class="th_deg"><?php echo $order->product_title; ?></td>
            <td class="th_deg"><?php echo $order->quantity; ?></td>
            <td class="th_deg"><?php echo $order->payment_status; ?></td>
            <td class="th_deg"><?php echo $order->delivery_status; ?></td>
            <td><img class="img_size" src="product/{{$order->image}}" alt=""></td>
            <td>
            @if($order->delivery_status == 'processing')
            <a onclick="return confirm('Are you sure to cancel this order?')"class="btn btn-danger" href="{{url('cancel_order',$order->id)}}"></a>Cancel Order
            @else
          <p style="color:blue">Not allowed</p>
            @endif
        </td>
        </tr>
       @endforeach
    </table>
</div>

</div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>