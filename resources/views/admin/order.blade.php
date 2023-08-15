<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
  <style type="text/css">
    .title_deg{
        text-align:center;
        font-size:25px;
        font-width:bold;

    }
    .search{
      padding-left: 400px;
      padding-bottom:40px;

    }
    .h2_font{
        font-size:40px;
        padding: bottom 40px;
    }
    .input_color{
        color:black;
    }
    .img_size{
        height: 150px;
        width: 150px;
    }
    .center{
      margin:auto;
      width:90%;
      text-align:center;
      margin-top:30px;
      border: 2px solid white;
    }
    .th_deg{
        background-color:skyblue;
    }
  </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <h1 class="title_deg">All orders</h1>
                <div class="search">
                  <form action="{{url('search')}}" method="get">
                    @csrf
                    <input style="color: black;" type="text" name="search" placeholder="Search for something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                  </form>
                </div>
                <table class="center">
                  <tr class="th_deg">
                    <td>Category Name</td>
                    <td>Email</td>
                    <td>Address</td>
                    <td>Phone</td>
                    <td>Product Title</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Payment Status</td>
                    <td>Delivery Status</td>
                    <td>Image</td>
                    <td>Delivered</td>
                    <td>PDF</td>
                    <td>Send Email</td>
                  </tr>
                  @forelse($order as $order)
                  <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td><img class="img_size" src="/product/{{$order->image}}" alt=""></td>
                    @if($order->delivery_status=='processing')
                    <td><a onclick="return confirm('Are you sure to change this?')" href="{{url('delivered',$order->id)}}"class="btn btn-primary">Delivered</a></td>
                    @else
                    <td>Delivered</td>
                    @endif
                    <td><a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary"></a>Print PDF</td>
                    <td><a href="{{url('send_email',$order->id)}}" class="btn btn-info"></a>Send Email</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="16">
                      No Data Found
                    </td>
                  </tr>
                  @endforelse
                </table>
            </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>