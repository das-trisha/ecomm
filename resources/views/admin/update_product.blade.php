<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
  @include('admin.css')
  <style type="text/css">
    .div_center{
        text-align:center;
        padding: top 40px;

    }
    .font_size{
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
    label{
           display:inline-block;
           width: 200px;
    }
   .div_design{
    padding-bottom:15px;
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
                <div class="div_center">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                 {{session()->get('message')}}
                </div>
                @endif
                 <h2 class="font_size">Update Product</h2>
                 <form action="{{url('/update_product_confirm',$data->id)}}" method="POST" enctype="multipart/form-data">
                 @csrf
                <div class="div_design">
                    <label>Product Title</label>
                    <input type="text" class="input_color" value="{{$data->title}}" name="title" placeholder="Write a title" required=""></input>
                </div>    
                <div class="div_design">
                    <label>Product Description:</label>
                    <input type="text" class="input_color" value="{{$data->description}}" name="description" placeholder="Write a description" required=""></input>
                </div>    
                <div class="div_design">
                    <label>Product Price:</label>
                    <input type="number" class="input_color" value="{{$data->price}}" name="price" placeholder="Write a price" required=""></input>
                </div>   
                <div class="div_design">
                    <label>Discount Price:</label>
                    <input type="number" class="input_color" value="{{$data->discount_price}}" name="dis_price" placeholder="Write a price"></input>
                </div>   
                <div class="div_design">
                    <label>Product Quantity</label>
                    <input type="number" class="input_color" value="{{$data->quantity}}" name="quantity" min ="0" placeholder="Write a quantity" required=""></input>
                </div>     
                <div class="div_design">
                    <label>Product Category:</label>
                    <select class="input_color" name="category" required="">
                    <option value="{{$data->category}}" selected="">{{$data->category}}</option>
                    @foreach($category as $category)
                        <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div> 
                <div class="div_design">
                    <label>Current Product Image Here:</label>
                    <img style="margin:auto" height= "100" width="100" src="/product/{{$data->imagee}}" alt="">
                </div>    
                <div class="div_design">
                    <label>Change Product Image Here:</label>
                    <input type="file" name="image" ></input>
                </div>
                <div class="div_design">
                <input type="submit" value="Update Product" class="btn btn-primary">

               </div></form>    
            </div>
        </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>