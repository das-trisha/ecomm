<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;
use App\Events\OrderDelivered;


class AdminController extends Controller
{
    public function view_category(){
        $data = category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request){
       $data = new category;
       $data->category_name = $request->category;
       $data->save();
       return redirect()->back()->with('message','Category added successfully');
    }
    public function delete_category($id){
        $data = category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted successfully');
    }
     public function view_product(){
        $category = category::all();
        return view('admin.product',compact('category'));
    }
    public function add_product(Request $request){
        $data = new product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category	 = $request->category;
        $data->discount_price = $request->dis_price;
        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product',$imagename);
        $data->imagee = $imagename;
        $data->save();
        return redirect()->back()->with('message','Product added successfully');
     }
    public function show_product(){
        $data = product::all();
        return view('admin.show_product',compact('data'));
    }
    public function delete_product($id){
        $data = product::find($id);
        $data->delete();
        return redirect()->back()->with('message','Product Deleted successfully');
    }
    public function update_product($id){
        $data = product::find($id);
        $category = category::all();
        return view('admin.update_product',compact('data','category'));
    }
    public function update_product_confirm(Request $request,$id){
        $data = product::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->category	 = $request->category;
        $data->discount_price = $request->dis_price;
        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product',$imagename);
            $data->imagee = $imagename;
        }
        $data->save();
        return redirect()->back()->with('message','Product Updated successfully');
    }
    public function order(){
        $order = order::all();
        return view('admin.order',compact('order'));
    }
    public function delivered($id){
        $order = order::find($id);

        $order->delivery_status = "delivered";
        $order->payment_status = "paid";
        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id){
        $order = order::find($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.pdf',compact('order')); //this line will convert the blade file into pdf file
        return $pdf->download('order_details.pdf');
    }
    public function send_email($id){
        $order = order::find($id);
        return view('admin.email_info',compact('order'));
    }
    public function send_user_email(Request $request,$id){
        $order = order::find($id);
        $details = [
            'greeting'=>$request->greeting,
            'firstline'=>$request->firstline,
            'body'=>$request->body,
            'button'=>$request->button,
            'url'=>$request->url,
            'lastline'=>$request->lastline,

        ];
        Notification::send($order,new SendEmailNotification($details));
        return view('admin.email_info',compact('order'));
    }
    public function searchdata(Request $request){
        $searchText = $request->input('search'); // Replace 'search' with the actual name of  input field
        $order = Order::where('name', 'like', "%$searchText%")->get(); // Note the double quotes for variable interpolation
        return view('admin.order', compact('order'));
    }
    
}
