<div class="container">
   <div class="mt-3 mx-2 d-flex justify-content-between align-middle">
      <p class="fs-2 fw-light">Products</p>
      <span>
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
      </span>
   </div>
   <div class="row">
@foreach($product as $products)
   <div class="card col mx-4" style="width: 18rem;">
   <img height="350" class="card-img-top object-fit-cover pt-2 rounded-1" src="product/{{$products->imagee}}" alt="Card image cap">
   <div class="card-body">
       <h5 class="card-title">{{$products->title}}</h5>
      <p class="card-text"><span class="text-secondary">MRP:</span> ₹{{$products->price}}</p>
      <form action ="{{url('add_cart',$products->id)}}" method="POST">
         @csrf
         <div class="d-flex justify-content-between align-middle my-3">
            <input class="form-control flex-grow-1 me-2" type="number" name="quantity" value="1" min="1" style="width:100px">
            <input class="btn btn-outline-primary btn-sm" type="submit" value="Add to cart">
         </div>
      </form> 
      <a class="btn btn-success d-block mt-4 mb-2" href="{{url('product_details',$products->id)}}">View Details</a>
   </div>
   </div>
@endforeach
   </div>
</div>