<!DOCTYPE html>
<html>
   <head>
   <style type="text/css">
    
    
    .img_size{
        height: 150px;
        width: 150px;
    }
    </style>
      <base href="/public">
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

      <title>EComm - One stop shop for all your needs</title>

      <link rel="shortcut icon" href="images/delivery.png" type="x-icon/png">
      
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
   </head>
   <body>
      @include('home.header')
      
      <div class="grid container mx-auto py-5">
         <div class="row w-75 mx-auto">
            <div class="col">
               <img class="object-fit-cover" width="450" height="550" src="product/{{$product->imagee}}" alt="">
            </div>
            <div class="col">
               <p class="fs-2 fw-medium">{{$product->title}}</p>
               <div class="d-flex align-middle fs-5">
                  <p>MRP: </p>
                  @if($product->discount_price)
                     <div class="d-flex align-middle ms-2">
                        <p class="fw-light text-secondary"><del>₹{{$product->price}}</del></p>
                        <p class="fw-medium ms-2">₹{{$product->discount_price}}</p>
                     </div>
                  @else
                     <p class="fw-medium ms-2">₹{{$product->price}}</p>
                  @endif
               </div>
               <p class="fs-6 fw-light">Category: {{$product->category}}</p>
               <div class="w-100 block">
                  <p class="fs-6 fw-medium">Product Description</p>
                  <p class="fs-6 p-2 bg-body-secondary w-100">{{$product->description}}</p>
               </div>
               <form class="d-flex block align-items" action ="{{url('add_cart',$product->id)}}" method="POST">
                  @csrf
                  <input class="form-control" type="number" name="quantity" value="1" min="1" max="5" style="width:100px">
                  <input class="btn btn-primary ms-2" type="submit" value="Add To Cart">
               </form>
            </div>
         </div>
      </div>
      @error('comment')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
      @if(isset($order) && $order && $order->delivery_status == 'delivered')
      <div style="text-align:center;padding-bottom:30px;">
         <h1 style="font-size:30px; text-align:center; padding-top:20px; padding-bottom:20px;">Add a review</h1>
        
         <form action="{{ url('add_comment') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <textarea style="height:150px; width: 600px;" placeholder="Comment something here" name="comment"></textarea>
    <div class="div_design">
        <label>Product Image Here:</label>
        <input type="file" name="image">
    </div>
    <input type="submit" class="btn btn-primary" value="Comment">
</form>

      </div>
      <div style="padding-left:20%;">
         <h1 style="font-size:20px;padding-bottom:20px;">Reviews</h1>
         @foreach($comment as $comment)
         <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <img class="img_size" src="product/{{$comment->image}}" alt="">
         </div>
        
            @endforeach
         </div>
        @endif
      <!-- Comment and reply system ends here -->
      @include('home.footer')
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
   </body>
</html>