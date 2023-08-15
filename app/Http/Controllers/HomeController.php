<?php

namespace App\Http\Controllers;
use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Session;
use Stripe;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            $total_product = product::all()->count();
            $total_order = order::all()->count();
            $total_user = user::all()->count();
            $order = order::all();
            $total_revenue = 0;
            foreach($order as $order){
                $total_revenue = $total_revenue + $order->price;
            }
            $order_delivered = order::where('delivery_status', '=', "delivered")->get()->count();
            $order_processing = order::where('delivery_status', '=', "processing")->get()->count();
            return view('admin.home', compact('total_product','total_order','total_user','total_revenue','order_delivered','order_processing'));
        } else {
            $product = Product::paginate(3);
            $comment = Comment::orderby('id','desc')->get();
            $replies = Reply::all();
            return view('home.userpage', compact('product','comment','replies'));
        }
    }
    public function index()
    {
        $comment = Comment::orderby('id','desc')->get();
        $product = Product::paginate(3);
        $replies = Reply::all();
        return view('home.userpage', compact('product','comment','replies'));
    }
    public function product_details($id)
   {
    // Check if the user is logged in
    if (auth()->check()) {
        $user_id = auth()->user()->id;
        
        $order = Order::select('user_id', 'delivery_status')
            ->where('user_id', $user_id)
            ->where('product_id', $id)
            ->where('delivery_status', 'delivered')
            ->first();
        
        $product = Product::find($id);
        
        // Retrieve comments for the specific product ID
        $comment = Comment::where('product_id', $id) // Filter by product ID
            ->orderBy('id', 'desc')
            ->get();
        return view('home.product_details', compact('product', 'comment', 'order'));
    } else {
        // User is not logged in, handle this case as needed
        $product = Product::find($id);
        $comment = Comment::orderBy('id', 'desc')->get();

        return view('home.product_details', compact('product', 'comment'));
    }
}

    public function add_cart(Request $request,$id)
    {
        if(Auth::id()){
            $user = Auth::user();
            $product = product::find($id);
            $cart = new Cart();
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            if($product->discount_price != null){
                $cart->price = $product->discount_price * $request->quantity;
            }else{
                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->imagee;
            $cart->product_id = $product->id;
            $cart->quantity= $request->quantity;
            $cart->save();
            return redirect()->back();
        }else{
            return redirect('login');
        }    
    }
    public function show_cart()
    {
        if(Auth::id()){ //checking user is loggedin or not
            $id = Auth::user()->id;
            $cart = cart::where('user_id','=',$id)->get();
            return view('home.show_cart',compact('cart'));
        }else{
            return redirect('login');
        }
       
    }
    public function remove_cart($id)
    {
        $data = cart::find($id);
        $data->delete();
        return redirect()->back();   
    }
    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = cart::where('user_id','=',$userid)->get();
        foreach($data as $data){
            $order = new Order();
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->image = $data->image;
            $order->product_id = $data->product_id;
            $order->price = $data->price;
            $order->quantity= $data->quantity;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status ='processing';
            $order->save();
            $cart_id = $data->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        event(new OrderPlaced($order));
        return redirect()->back()->with('message','We received your order.We will connect with you soon');;
    }
    public function stripe($totalcartprice)
    {
       
        return view('home.stripe',compact('totalcartprice'));   
    }
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
      
        Session::flash('success', 'Payment successful!');
              
        return back();
    }
    public function show_order()
    {
        if(Auth::id()){ //checking user is loggedin or not
             $user = Auth::user();
             $userid = $user->id;
             $order = order::where('user_id','=',$userid)->get();
            return view('home.order',compact('order'));
        }else{
            return redirect('login');
        }
       
    }
    public function cancel_order($id)
    {
        $order = order::find($id);
        $order->delivery_status = 'You Canceled the order';
        $order->save();
        return redirect()->back();
    }
    
    
    public function add_comment(Request $request)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $userId = $user->id;
    
            $productId = $request->input('product_id'); // Assuming the product_id is submitted along with the form
           
    
            // Apply rate limiting based on user ID and product ID
            $rateLimitKey = 'comment_' . $userId . '_' . $productId;

            
    
            if (Cache::has($rateLimitKey)) {
                //ValidationException-handle validation errors
                throw ValidationException::withMessages([
                    'comment' => 'You have reached the comment rate limit for this product.',
                ])->status(429);
            }
    
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->comment = $request->comment;
            $comment->user_id = $userId;
            $comment->product_id = $productId;
    
            $image = $request->image;
            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('product', $imagename);
                $comment->image = $imagename;
            }
    
            $comment->save();
    
            // Store a comment indicator in the cache to track user's comment for this product
            Cache::forever($rateLimitKey, true); // Adjust the duration as needed
    
            return redirect()->back();
        } else {
            return redirect('login');
        }
    }
    
    

    
    public function add_reply(Request $request)
    {
        if(Auth::id()){ //checking user is loggedin or not
            $user = Auth::user();
            $userid = $user->id;
            $reply = new Reply;
            $reply->name =Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        }
            else{
                return redirect('login');
            }
        
       
    }
    
}
