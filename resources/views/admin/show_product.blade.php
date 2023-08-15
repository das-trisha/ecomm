<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.css')
  <style type="text/css">
    .div_center{
        text-align:center;
        padding: top 40px;

    }
    .h2_font{
        font-size:40px;
        padding: bottom 40px;
    }
    .input_color{
        color:black;
    }
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
    .th_color{
        background:skyblue;
    }
    .th_deg{
        padding: 30px;
    }
  </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
      <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                 {{session()->get('message')}}
                </div>
                @endif
                <div class="div_center">
                 <h2 class="h2_font">All Products</h2>
                </div>
                <table class="center">
                  <tr class="th_color">
                    <td class="th_deg">Product Title</td>
                    <td class="th_deg">Description</td>
                    <td class="th_deg">Quantity</td>
                    <td class="th_deg">Category</td>
                    <td class="th_deg">Price</td>
                    <td class="th_deg">Discount</td>
                    <td class="th_deg">Product Image</td>
                    <td class="th_deg">Delete</td>
                    <td class="th_deg">Edit</td>
                  </tr>
                  @foreach($data as $data)
                  <tr>
                    <td>{{$data->title}}</td>
                    <td>{{$data->description}}</td>
                    <td>{{$data->quantity}}</td>
                    <td>{{$data->category}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->discount_price}}</td>
                    <td><img class="img_size" src="/product/{{$data->imagee}}" alt=""></td>
                    <td><a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('/delete_product',$data->id)}}">Delete</a></td>
                    <td><a class="btn btn-success" href="{{url('/update_product',$data->id)}}">Edit</a></td>
                  </tr>
                  @endforeach
                </table>
            </div>
      </div>  
        <!-- partial -->
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>

