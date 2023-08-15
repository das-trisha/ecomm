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
         @include('home.header')
         @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" 
                    aria-hidden="true">x</button>
                 {{session()->get('message')}}
                </div>
                @endif
      <div class="center">
        <table>
            <tr>
                <th class="th_deg">Product Title</th>
                <th class="th_deg">Product Quantity</th>
                <th class="th_deg">Price</th>
                <th class="th_deg">Image</th>
                <th class="th_deg">Action</th>
            </tr>
            @php $totalcartprice = 0; @endphp
            @foreach($cart as $cart)
            <tr>
                <th class="th_deg">{{$cart->product_title}}</th>
                <th class="th_deg">{{$cart->quantity}}</th>
                <th class="th_deg">{{$cart->price}}</th>
                <th><img class="img_size" src="product/{{$cart->image}}" alt=""></th>
                <th><a class="btn btn-danger" onclick="return confirm('Are you sure to remove this product?')" href="{{url('/remove_cart',$cart->id)}}">Remove Product</a></th>
            </tr>
            @php $totalcartprice += $cart->price; @endphp
            @endforeach
        </table>
        <div>
            <h1 class="total_deg"> Total Cart Price:  ${{$totalcartprice}} </h1>
        </div>
        <div>
            <h1 style="font-size:25px; padding-bottom:15px;">Proceed To Order</h1>
            <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{url('stripe',$totalcartprice)}}" class="btn btn-danger">Pay using Card</a>
        </div>
      </div>
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
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